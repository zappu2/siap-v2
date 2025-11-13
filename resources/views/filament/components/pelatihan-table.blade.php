<div class="bg-white dark:bg-gray-900 rounded-lg border border-gray-200 dark:border-gray-700">
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3 font-medium">Nama Pelatihan</th>
                    <th scope="col" class="px-6 py-3 font-medium">Penyelenggara</th>
                    <th scope="col" class="px-6 py-3 font-medium">Waktu</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pelatihan as $item)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <td class="px-6 py-4 text-gray-900 dark:text-white">
                        {{ $item['nama'] }}
                    </td>
                    <td class="px-6 py-4 text-gray-700 dark:text-gray-300">
                        {{ $item['penyelenggara'] }}
                    </td>
                    <td class="px-6 py-4 text-gray-500 dark:text-gray-400">
                        {{ $item['waktu'] }}
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                        Belum ada data pelatihan.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    @if(count($pelatihan) > 0)
    <div class="flex items-center justify-between px-6 py-3 bg-gray-50 dark:bg-gray-700">
        <div class="text-sm text-gray-700 dark:text-gray-300">
            Menampilkan <strong>1</strong> sampai <strong>5</strong> dari <strong>{{ count($pelatihan) }}</strong> hasil
        </div>
        <div class="flex items-center space-x-1">
            <span class="text-sm text-gray-500 dark:text-gray-400">per halaman</span>
            <select class="ml-2 text-sm border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-gray-300 rounded-md">
                <option value="5" selected>5</option>
                <option value="10">10</option>
                <option value="25">25</option>
            </select>
            <div class="flex ml-4">
                <button class="px-3 py-1 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-l-md">1</button>
                <button class="px-3 py-1 text-sm font-medium text-gray-500 bg-white border-t border-b border-r hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700">2</button>
                <button class="px-3 py-1 text-sm font-medium text-gray-500 bg-white border-t border-b border-r hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 rounded-r-md">3</button>
                <button class="ml-2 px-3 py-1 text-sm font-medium text-gray-500 bg-white border hover:bg-gray-50 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400 dark:hover:bg-gray-700 rounded-md">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>
    @endif
</div>