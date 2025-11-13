<div class="grid grid-cols-1 gap-6">
    <!-- User Photo -->
    <div class="flex items-center gap-4">
        <div class="flex-shrink-0">
            @if($user->avatar)
                <img src="{{ \Storage::url($user->avatar) }}" 
                     class="w-16 h-16 rounded-full object-cover ring-4 ring-white shadow-lg">
            @else
                @php
                    $initials = collect(explode(' ', $user->name))
                        ->map(fn($word) => strtoupper($word[0]))
                        ->take(2)
                        ->join('');
                @endphp
                <div class="w-16 h-16 rounded-full bg-primary-500 flex items-center justify-center text-white font-medium text-xl ring-4 ring-white shadow-lg">
                    {{ $initials }}
                </div>
            @endif
        </div>
        <div>
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">{{ $user->name }}</h3>
            @if($user->nip)
                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $user->nip }}</p>
            @endif
        </div>
    </div>

    <!-- User Details -->
    <div class="grid grid-cols-1 gap-4">
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Email</label>
            <p class="text-sm text-gray-900 dark:text-white">{{ $user->email }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Unit Kerja</label>
            <p class="text-sm text-gray-900 dark:text-white">{{ $user->unit_kerja ?: '-' }}</p>
        </div>
        
        <div>
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">Jabatan</label>
            <p class="text-sm text-gray-900 dark:text-white">{{ $user->jabatan ?: '-' }}</p>
        </div>
    </div>
</div>