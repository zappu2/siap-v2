<div class="space-y-6">
    <!-- Sertifikat Section -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sertifikat</h3>
        
        <div class="border border-gray-300 dark:border-gray-600 rounded-lg p-4 bg-gray-50 dark:bg-gray-800">
            <div class="flex items-center space-x-3">
                <!-- PDF Icon -->
                <div class="flex-shrink-0">
                    <svg class="w-8 h-8 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                    </svg>
                </div>
                
                <!-- File Info -->
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                            {{ $record->sertifikat_filename ?? 'basma-graha-nashorinal-certificate-1748337123.pdf' }}
                        </p>
                        <button type="button" class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $record->sertifikat_size ?? '161 KB' }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sertifikat TTE Section -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sertifikat TTE</h3>
        
        <div class="border-2 border-dashed border-gray-300 dark:border-gray-600 rounded-lg p-8 text-center bg-gray-50 dark:bg-gray-800">
            <div class="space-y-2">
                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <div class="text-gray-600 dark:text-gray-400">
                    <span class="font-medium text-blue-600 hover:text-blue-500 cursor-pointer">Seret & Jatuhkan berkas Anda atau Jelajahi</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Nilai Kualifikasi Section -->
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Nilai Kualifikasi</h3>
        
        <div class="relative">
            <input 
                type="text" 
                value="{{ $record->nilai_kualifikasi ?? 'Cukup' }}"
                readonly
                class="block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white focus:outline-none focus:ring-1 focus:ring-blue-500 focus:border-blue-500"
            >
        </div>
    </div>
</div>