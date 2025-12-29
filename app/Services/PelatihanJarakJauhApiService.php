<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Collection;

class PelatihanJarakJauhApiService
{
    protected string $baseUrl;
    protected string $wsToken;
    protected int $cacheDuration;
    
    public function __construct()
    {
        $this->baseUrl = config('services.pjj_moodle.base_url', 'https://pjj.kemenag.go.id/webservice/rest/server.php');
        $this->wsToken = config('services.pjj_moodle.ws_token', 'e12b06bf9973df4d0f1bdcf4c31c53d2');
        $this->cacheDuration = config('services.pjj_moodle.cache_duration', 3600); // 1 hour default
    }
    
    /**
     * Get all courses from the Moodle API
     *
     * @param bool $useCache Whether to use cached data
     * @return Collection
     */
    public function getCourses(bool $useCache = true): Collection
    {
        $cacheKey = 'pjj_moodle_courses';
        
        if ($useCache && Cache::has($cacheKey)) {
            return Cache::get($cacheKey);
        }
        
        try {
            $response = Http::timeout(30)->get($this->baseUrl, [
                'wstoken' => $this->wsToken,
                'wsfunction' => 'core_course_get_courses',
                'moodlewsrestformat' => 'json',
            ]);
            
            if ($response->successful()) {
                $data = $response->json();
                
                if (is_array($data)) {
                    $courses = collect($data)->map(function ($course) {
                        return $this->transformCourse($course);
                    });
                    
                    if ($useCache) {
                        Cache::put($cacheKey, $courses, $this->cacheDuration);
                    }
                    
                    return $courses;
                }
                
                Log::warning('PJJ Moodle API returned unexpected format', ['response' => $data]);
                return collect([]);
            }
            
            Log::error('PJJ Moodle API request failed', [
                'status' => $response->status(),
                'body' => $response->body(),
            ]);
            
            return collect([]);
            
        } catch (\Exception $e) {
            Log::error('PJJ Moodle API exception', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return collect([]);
        }
    }
    
    /**
     * Get a single course by ID
     *
     * @param int $id
     * @return array|null
     */
    public function getCourseById(int $id): ?array
    {
        $courses = $this->getCourses();
        
        return $courses->firstWhere('id', $id);
    }
    
    /**
     * Get courses filtered by category ID
     *
     * @param int $categoryId
     * @return Collection
     */
    public function getCoursesByCategory(int $categoryId): Collection
    {
        return $this->getCourses()->where('categoryid', $categoryId);
    }
    
    /**
     * Get only visible courses
     *
     * @return Collection
     */
    public function getVisibleCourses(): Collection
    {
        return $this->getCourses()->where('visible', 1);
    }
    
    /**
     * Search courses by name
     *
     * @param string $search
     * @return Collection
     */
    public function searchCourses(string $search): Collection
    {
        $search = strtolower($search);
        
        return $this->getCourses()->filter(function ($course) use ($search) {
            return str_contains(strtolower($course['fullname'] ?? ''), $search) ||
                   str_contains(strtolower($course['shortname'] ?? ''), $search) ||
                   str_contains(strtolower($course['displayname'] ?? ''), $search);
        });
    }
    
    /**
     * Clear the courses cache
     *
     * @return bool
     */
    public function clearCache(): bool
    {
        return Cache::forget('pjj_moodle_courses');
    }
    
    /**
     * Refresh courses cache
     *
     * @return Collection
     */
    public function refreshCourses(): Collection
    {
        $this->clearCache();
        return $this->getCourses(false);
    }
    
    /**
     * Transform API course data to standardized format
     *
     * @param array $course
     * @return array
     */
    protected function transformCourse(array $course): array
    {
        return [
            'id' => $course['id'] ?? null,
            'shortname' => $course['shortname'] ?? '',
            'categoryid' => $course['categoryid'] ?? 0,
            'categorysortorder' => $course['categorysortorder'] ?? 0,
            'fullname' => $course['fullname'] ?? '',
            'displayname' => $course['displayname'] ?? '',
            'idnumber' => $course['idnumber'] ?? '',
            'summary' => $this->cleanHtml($course['summary'] ?? ''),
            'summaryformat' => $course['summaryformat'] ?? 1,
            'format' => $course['format'] ?? 'topics',
            'showgrades' => $course['showgrades'] ?? 1,
            'newsitems' => $course['newsitems'] ?? 3,
            'startdate' => $course['startdate'] ?? 0,
            'enddate' => $course['enddate'] ?? 0,
            'numsections' => $course['numsections'] ?? 0,
            'maxbytes' => $course['maxbytes'] ?? 0,
            'showreports' => $course['showreports'] ?? 0,
            'visible' => $course['visible'] ?? 1,
            'groupmode' => $course['groupmode'] ?? 0,
            'groupmodeforce' => $course['groupmodeforce'] ?? 0,
            'defaultgroupingid' => $course['defaultgroupingid'] ?? 0,
            'timecreated' => $course['timecreated'] ?? 0,
            'timemodified' => $course['timemodified'] ?? 0,
            'enablecompletion' => $course['enablecompletion'] ?? 0,
            'completionnotify' => $course['completionnotify'] ?? 0,
            'lang' => $course['lang'] ?? '',
            'forcetheme' => $course['forcetheme'] ?? '',
            'courseformatoptions' => $course['courseformatoptions'] ?? [],
            'showactivitydates' => $course['showactivitydates'] ?? false,
            'showcompletionconditions' => $course['showcompletionconditions'] ?? null,
            // Formatted dates for display
            'tanggal_mulai' => $course['startdate'] ? date('Y-m-d', $course['startdate']) : null,
            'tanggal_selesai' => $course['enddate'] ? date('Y-m-d', $course['enddate']) : null,
            'tanggal_dibuat' => $course['timecreated'] ? date('Y-m-d H:i:s', $course['timecreated']) : null,
            'tanggal_diubah' => $course['timemodified'] ? date('Y-m-d H:i:s', $course['timemodified']) : null,
        ];
    }
    
    /**
     * Clean HTML from summary text
     *
     * @param string $html
     * @return string
     */
    protected function cleanHtml(string $html): string
    {
        // Decode HTML entities and return
        return html_entity_decode($html, ENT_QUOTES, 'UTF-8');
    }
}
