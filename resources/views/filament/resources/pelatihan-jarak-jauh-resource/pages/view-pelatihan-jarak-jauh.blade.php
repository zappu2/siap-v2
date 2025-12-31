<x-filament-panels::page>
    {{-- Course Info Section --}}
    {{ $this->infolist }}

    {{-- Participants Section --}}
    <x-filament::section class="mt-6">
        <x-slot name="heading">
            <div class="flex items-center gap-2">
                <x-heroicon-o-users class="w-5 h-5" />
                Peserta Pelatihan
            </div>
        </x-slot>

        @if($hasLoaded)
            <x-slot name="description">
                <div class="flex items-center gap-4">
                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-medium rounded-full bg-primary-100 text-primary-700 dark:bg-primary-500/20 dark:text-primary-400">
                            {{ $this->getStudentsCount() }}
                        </span>
                        Peserta
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-medium rounded-full bg-warning-100 text-warning-700 dark:bg-warning-500/20 dark:text-warning-400">
                            {{ $this->getTeachersCount() }}
                        </span>
                        Pengajar
                    </span>
                    <span class="inline-flex items-center gap-1.5">
                        <span class="inline-flex items-center justify-center w-6 h-6 text-xs font-medium rounded-full bg-gray-100 text-gray-700 dark:bg-gray-500/20 dark:text-gray-400">
                            {{ count($participants) }}
                        </span>
                        Total
                    </span>
                </div>
            </x-slot>
        @endif

        @if(!$hasLoaded)
            {{-- Not loaded yet --}}
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="mb-4 rounded-full bg-primary-100 p-3 dark:bg-primary-500/20">
                    <x-heroicon-o-users class="h-6 w-6 text-primary-500 dark:text-primary-400" />
                </div>
                <h3 class="text-base font-semibold text-gray-950 dark:text-white">
                    Muat Data Peserta
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400 mb-4">
                    Klik tombol "Muat Peserta" di atas untuk mengambil data peserta dari API.
                </p>
            </div>
        @elseif(count($participants) > 0)
            <div class="overflow-x-auto">
                <x-filament-tables::table>
                    <x-slot name="header">
                        <x-filament-tables::header-cell>
                            No
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Nama
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            NIP
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Unit Kerja
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Role
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Terakhir Akses
                        </x-filament-tables::header-cell>
                        <x-filament-tables::header-cell>
                            Sertifikat
                        </x-filament-tables::header-cell>
                    </x-slot>

                    @foreach($participants as $index => $participant)
                        <x-filament-tables::row @class(['bg-gray-50 dark:bg-white/5' => $index % 2 === 0])>
                            <x-filament-tables::cell>
                                {{ $index + 1 }}
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <div class="flex items-center gap-3">
                                    @if($participant['profileimageurlsmall'])
                                        <img 
                                            src="{{ $participant['profileimageurlsmall'] }}" 
                                            alt="{{ $participant['fullname'] }}"
                                            class="w-8 h-8 rounded-full object-cover"
                                        >
                                    @else
                                        <div class="w-8 h-8 rounded-full bg-gray-200 dark:bg-gray-700 flex items-center justify-center">
                                            <x-heroicon-o-user class="w-4 h-4 text-gray-500" />
                                        </div>
                                    @endif
                                    <div>
                                        <div class="font-medium text-gray-950 dark:text-white">
                                            {{ $participant['fullname'] }}
                                        </div>
                                        <div class="text-sm text-gray-500 dark:text-gray-400">
                                            {{ $participant['email'] }}
                                        </div>
                                    </div>
                                </div>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $participant['nip'] ?: '-' }}
                                </span>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $participant['unit_kerja'] ?: '-' }}
                                </span>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($participant['role_names'] as $role)
                                        <x-filament::badge 
                                            :color="$role === 'Pengajar' || $role === 'Pengajar Non-Edit' ? 'warning' : ($role === 'Peserta' ? 'success' : 'gray')"
                                            size="sm"
                                        >
                                            {{ $role }}
                                        </x-filament::badge>
                                    @endforeach
                                </div>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                <span class="text-sm text-gray-600 dark:text-gray-300">
                                    {{ $participant['last_course_access_formatted'] }}
                                </span>
                            </x-filament-tables::cell>
                            <x-filament-tables::cell>
                                @if($participant['is_student'])
                                    <button 
                                        type="button"
                                        wire:click="viewCertificate({{ $participant['id'] }})"
                                        class="inline-flex items-center gap-1 text-sm font-medium text-primary-600 hover:text-primary-500 dark:text-primary-400 dark:hover:text-primary-300"
                                    >
                                        <x-heroicon-o-document-text class="w-4 h-4" />
                                        Lihat
                                    </button>
                                @else
                                    <span class="text-sm text-gray-400">-</span>
                                @endif
                            </x-filament-tables::cell>
                        </x-filament-tables::row>
                    @endforeach
                </x-filament-tables::table>
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-12 text-center">
                <div class="mb-4 rounded-full bg-gray-100 p-3 dark:bg-gray-500/20">
                    <x-heroicon-o-users class="h-6 w-6 text-gray-500 dark:text-gray-400" />
                </div>
                <h3 class="text-base font-semibold text-gray-950 dark:text-white">
                    Belum ada peserta
                </h3>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">
                    Tidak ada peserta yang terdaftar pada pelatihan ini.
                </p>
            </div>
        @endif
    </x-filament::section>

    {{-- Certificate Modal --}}
    @if($showCertificateModal && $selectedParticipant)
        <div 
            x-data="{ isOpen: @entangle('showCertificateModal') }"
            x-show="isOpen"
            x-on:keydown.escape.window="$wire.closeCertificateModal()"
            x-transition:enter="duration-300 ease-out"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="duration-200 ease-in"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto"
            style="background-color: rgba(0, 0, 0, 0.5);"
        >
            <div 
                x-show="isOpen"
                x-transition:enter="duration-300 ease-out"
                x-transition:enter-start="opacity-0 scale-95"
                x-transition:enter-end="opacity-100 scale-100"
                x-transition:leave="duration-200 ease-in"
                x-transition:leave-start="opacity-100 scale-100"
                x-transition:leave-end="opacity-0 scale-95"
                class="relative w-full max-w-4xl mx-4 bg-white rounded-xl shadow-xl dark:bg-gray-900"
                @click.away="$wire.closeCertificateModal()"
            >
                {{-- Modal Header --}}
                <div class="flex items-center justify-between px-6 pt-6">
                    <h2 class="text-base font-semibold leading-6 text-gray-950 dark:text-white">
                        Lihat {{ $selectedParticipant['fullname'] }}
                    </h2>
                    <button 
                        type="button"
                        wire:click="closeCertificateModal"
                        class="relative flex items-center justify-center w-9 h-9 -m-1.5 rounded-lg text-gray-400 hover:text-gray-500 dark:text-gray-500 dark:hover:text-gray-400 transition duration-75"
                    >
                        <span class="sr-only">Tutup</span>
                        <x-heroicon-o-x-mark class="w-6 h-6" />
                    </button>
                </div>

                {{-- Modal Content --}}
                <div class="px-6 py-6 space-y-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        {{-- Sertifikat --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-950 dark:text-white">
                                Sertifikat
                            </label>
                            <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 ring-gray-950/10 dark:ring-white/20 bg-gray-50 dark:bg-gray-800 p-3">
                                <div class="flex items-center gap-3 w-full">
                                    <div class="flex-shrink-0">
                                        <x-heroicon-o-document class="w-8 h-8 text-red-500" />
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                            {{ strtolower(str_replace(' ', '-', $selectedParticipant['fullname'])) }}-certificate.pdf
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                            Placeholder - PDF
                                        </p>
                                    </div>
                                    <a 
                                        href="{{ $selectedParticipant['certificate_file'] ?? '#' }}" 
                                        target="_blank"
                                        class="flex-shrink-0 p-2 text-primary-600 hover:text-primary-500 dark:text-primary-400"
                                    >
                                        <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5" />
                                    </a>
                                </div>
                            </div>
                        </div>

                        {{-- Sertifikat TTE --}}
                        <div class="space-y-2">
                            <label class="block text-sm font-medium text-gray-950 dark:text-white">
                                Sertifikat TTE
                            </label>
                            @if($selectedParticipant['certificate_tte'] ?? false)
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 ring-gray-950/10 dark:ring-white/20 bg-gray-50 dark:bg-gray-800 p-3">
                                    <div class="flex items-center gap-3 w-full">
                                        <div class="flex-shrink-0">
                                            <x-heroicon-o-document-check class="w-8 h-8 text-green-500" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-900 dark:text-white truncate">
                                                {{ strtolower(str_replace(' ', '-', $selectedParticipant['fullname'])) }}-sign-cert.pdf
                                            </p>
                                            <p class="text-xs text-green-600 dark:text-green-400">
                                                <x-heroicon-s-check-circle class="w-3 h-3 inline" /> Sudah ditandatangani
                                            </p>
                                        </div>
                                        <a 
                                            href="{{ $selectedParticipant['certificate_tte'] }}" 
                                            target="_blank"
                                            class="flex-shrink-0 p-2 text-primary-600 hover:text-primary-500 dark:text-primary-400"
                                        >
                                            <x-heroicon-o-arrow-top-right-on-square class="w-5 h-5" />
                                        </a>
                                    </div>
                                </div>
                            @else
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 ring-gray-950/10 dark:ring-white/20 bg-gray-50 dark:bg-gray-800 p-3">
                                    <div class="flex items-center gap-3 w-full">
                                        <div class="flex-shrink-0">
                                            <x-heroicon-o-document class="w-8 h-8 text-gray-400" />
                                        </div>
                                        <div class="flex-1 min-w-0">
                                            <p class="text-sm font-medium text-gray-500 dark:text-gray-400">
                                                Belum ditandatangani
                                            </p>
                                            <p class="text-xs text-gray-400 dark:text-gray-500">
                                                Klik tombol "Tanda Tangani" untuk menandatangani sertifikat
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Nilai Kualifikasi --}}
                    <div class="space-y-2">
                        <label class="block text-sm font-medium text-gray-950 dark:text-white">
                            Nilai Kualifikasi
                        </label>
                        <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 ring-gray-950/10 dark:ring-white/20 bg-gray-50 dark:bg-transparent">
                            <input 
                                type="text" 
                                value="{{ $selectedParticipant['nilai_kualifikasi'] ?? 'Sangat Baik' }}"
                                disabled
                                class="block w-full border-none py-2 px-3 text-sm text-gray-500 dark:text-gray-400 bg-transparent rounded-lg"
                            >
                        </div>
                    </div>
                </div>

                {{-- Modal Footer --}}
                <div class="flex items-center justify-between gap-3 px-6 pb-6">
                    <div>
                        @if(!($selectedParticipant['certificate_tte'] ?? false))
                            <button 
                                type="button"
                                wire:click="signCertificate"
                                wire:loading.attr="disabled"
                                class="inline-flex items-center gap-2 px-4 py-2 text-sm font-semibold text-white bg-primary-600 rounded-lg hover:bg-primary-500 focus:outline-none focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 dark:focus:ring-offset-gray-900 transition duration-75"
                            >
                                <x-heroicon-o-pencil-square class="w-4 h-4" />
                                <span wire:loading.remove wire:target="signCertificate">Tanda Tangani (TTE)</span>
                                <span wire:loading wire:target="signCertificate">Memproses...</span>
                            </button>
                        @endif
                    </div>
                    <button 
                        type="button"
                        wire:click="closeCertificateModal"
                        class="inline-flex items-center px-4 py-2 text-sm font-semibold text-gray-950 bg-white rounded-lg ring-1 ring-gray-950/10 hover:bg-gray-50 dark:bg-white/5 dark:text-white dark:ring-white/20 dark:hover:bg-white/10 transition duration-75"
                    >
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif
</x-filament-panels::page>
