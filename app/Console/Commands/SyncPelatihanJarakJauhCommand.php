<?php

namespace App\Console\Commands;

use App\Models\PelatihanJarakJauh;
use App\Services\PelatihanJarakJauhApiService;
use Illuminate\Console\Command;

class SyncPelatihanJarakJauhCommand extends Command
{
    protected $signature = 'pjj:sync {--fresh : Delete all existing records before syncing}';

    protected $description = 'Sync Pelatihan Jarak Jauh data from Moodle API';

    public function handle(PelatihanJarakJauhApiService $apiService): int
    {
        $this->info('Fetching courses from PJJ Moodle API...');

        $courses = $apiService->refreshCourses();

        if ($courses->isEmpty()) {
            $this->error('No courses found from API');
            return self::FAILURE;
        }

        $this->info("Found {$courses->count()} courses");

        if ($this->option('fresh')) {
            $this->info('Deleting existing records...');
            PelatihanJarakJauh::truncate();
        }

        $bar = $this->output->createProgressBar($courses->count());
        $bar->start();

        $synced = 0;
        $updated = 0;

        foreach ($courses as $course) {
            $existing = PelatihanJarakJauh::where('id', $course['id'])->first();

            $data = [
                'nama_pelatihan' => $course['fullname'] ?? '',
                'penyelenggara' => $this->getCategoryName($course['categoryid'] ?? 0),
                'tanggal_mulai' => $course['startdate'] && $course['startdate'] > 0 
                    ? date('Y-m-d', $course['startdate']) 
                    : null,
                'tanggal_selesai' => $course['enddate'] && $course['enddate'] > 0 
                    ? date('Y-m-d', $course['enddate']) 
                    : null,
                'deskripsi' => strip_tags($course['summary'] ?? ''),
                'terlihat' => $course['visible'] == 1,
                'nama' => $course['fullname'] ?? '',
                'display_name' => $course['displayname'] ?? '',
                'short_name' => $course['shortname'] ?? '',
                'course_category' => (string)($course['categoryid'] ?? ''),
                'kategori_order' => $course['categorysortorder'] ?? 0,
                'id_number' => $course['idnumber'] ?? '',
                'summary' => $course['summary'] ?? '',
                'summary_format' => $course['summaryformat'] ?? 1,
                'news_items' => $course['newsitems'] ?? 3,
                'tanggal_akhir' => $course['enddate'] && $course['enddate'] > 0 
                    ? date('Y-m-d', $course['enddate']) 
                    : null,
                'group_mode' => $course['groupmode'] ?? 0,
                'visible' => $course['visible'] == 1,
            ];

            if ($existing) {
                $existing->update($data);
                $updated++;
            } else {
                $record = new PelatihanJarakJauh($data);
                $record->id = $course['id'];
                $record->save();
                $synced++;
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        
        $this->info("Sync completed: {$synced} created, {$updated} updated");

        return self::SUCCESS;
    }

    protected function getCategoryName(int $categoryId): string
    {
        // Map category IDs to penyelenggara names based on the API data
        $categories = [
            0 => 'Pusbangkom MKMB',
            1 => 'Balai Diklat Keagamaan Bandung',
            2 => 'Balai Diklat Keagamaan Semarang',
            3 => 'Balai Diklat Keagamaan Denpasar',
        ];

        return $categories[$categoryId] ?? 'Pusbangkom MKMB';
    }
}
