<?php

namespace App\Http\Controllers;

use App\Models\PelatihanWebinar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PelatihanWebinarController extends Controller
{
    public function downloadSertifikat($id)
    {
        $webinar = PelatihanWebinar::findOrFail($id);
        
        if (!$webinar->sertifikat_url) {
            abort(404, 'Sertifikat tidak ditemukan');
        }
        
        $filePath = storage_path('app/public/' . $webinar->sertifikat_url);
        
        if (!file_exists($filePath)) {
            abort(404, 'File sertifikat tidak ditemukan');
        }
        
        $filename = $webinar->sertifikat_filename ?? 'sertifikat-' . $webinar->id . '.pdf';
        
        return response()->download($filePath, $filename);
    }
}
