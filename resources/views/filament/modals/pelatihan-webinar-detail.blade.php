<div class="space-y-4">
    <div>
        <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-4">Sertifikat TTE</h3>
        
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
                            {{ $record->sertifikat_filename ?? 'syafii-sign-cert-1724036455.pdf' }}
                        </p>
                        <button type="button" class="ml-2 text-gray-400 hover:text-gray-600 dark:hover:text-gray-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 dark:text-gray-400">{{ $record->sertifikat_size ?? '418 KB' }}</p>
                </div>
            </div>
        </div>
    </div>
</div>