{{-- resources/views/profile/partials/update-password-form.blade.php (MODIFIKASI) --}}
<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Ubah Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Pastikan akun Anda menggunakan password yang panjang dan acak agar tetap aman.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        {{-- Current Password --}}
        <div x-data="{ showPassword: false }">
            <label for="current_password"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Password Saat Ini') }}</label>
            <div class="relative">
                <input id="current_password" name="current_password" :type="showPassword ? 'text' : 'password'"
                    class="block w-full text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark pe-10 py-2.5"
                    autocomplete="current-password" />
                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                    <button type="button" @click="showPassword = !showPassword"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        <svg x-show="!showPassword" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                        </svg>
                        <svg x-show="showPassword" style="display: none;" class="w-5 h-5"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                        </svg>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        {{-- New Password --}}
        <div x-data="{ showPassword: false }">
            <label for="password"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Password Baru') }}</label>
            <div class="relative">
                <input id="password" name="password" :type="showPassword ? 'text' : 'password'"
                    class="block w-full text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark pe-10 py-2.5"
                    autocomplete="new-password" />
                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                    <button type="button" @click="showPassword = !showPassword"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        {{-- SVG Ikon Mata --}}
                        <svg x-show="!showPassword" class="w-5 h-5" ...>...</svg>
                        <svg x-show="showPassword" style="display: none;" class="w-5 h-5" ...>...</svg>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        {{-- Confirm New Password --}}
        <div x-data="{ showPassword: false }">
            <label for="password_confirmation"
                class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-1">{{ __('Konfirmasi Password Baru') }}</label>
            <div class="relative">
                <input id="password_confirmation" name="password_confirmation"
                    :type="showPassword ? 'text' : 'password'"
                    class="block w-full text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark pe-10 py-2.5"
                    autocomplete="new-password" />
                <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                    <button type="button" @click="showPassword = !showPassword"
                        class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                        {{-- SVG Ikon Mata --}}
                        <svg x-show="!showPassword" class="w-5 h-5" ...>...</svg>
                        <svg x-show="showPassword" style="display: none;" class="w-5 h-5" ...>...</svg>
                    </button>
                </div>
            </div>
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit"
                class="inline-flex items-center px-6 py-2.5 bg-primary hover:bg-primary-dark border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 focus:ring-primary-dark transition ease-in-out duration-150">
                {{ __('Simpan') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600 dark:text-gray-400">{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
