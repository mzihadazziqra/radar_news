{{-- resources/views/profile/edit.blade.php (MODIFIKASI) --}}
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profil Saya') }}
        </h2>
    </x-slot>

    <div class="py-8"> {{-- Padding vertikal utama halaman --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-6"> {{-- Padding horizontal dan space antar kartu --}}

            {{-- Kartu untuk Update Informasi Profil --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <div class="p-6 md:p-8"> {{-- Padding internal kartu --}}
                    {{-- max-w-xl bisa dipertahankan agar form tidak terlalu lebar di dalam kartu --}}
                    <div class="max-w-xl">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>
            </div>

            {{-- Kartu untuk Update Password --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <div class="p-6 md:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>
            </div>

            {{-- Kartu untuk Hapus Akun --}}
            <div class="bg-white dark:bg-gray-800 shadow-md sm:rounded-lg dark:border dark:border-gray-700">
                <div class="p-6 md:p-8">
                    <div class="max-w-xl">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
