{{-- resources/views/profile/partials/delete-user-form.blade.php (MODIFIKASI) --}}
<section class="space-y-6">
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Hapus Akun') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Sebelum menghapus akun Anda, harap unduh semua data atau informasi yang ingin Anda simpan.') }}
        </p>
    </header>

    {{-- Tombol Hapus Akun (biasanya memicu modal) --}}
    {{-- Breeze menggunakan komponen x-danger-button di sini --}}
    <x-danger-button x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')">{{ __('Hapus Akun') }}</x-danger-button>

    {{-- Modal Konfirmasi Penghapusan --}}
    {{-- Modal ini didefinisikan oleh Breeze, biasanya sebagai komponen <x-modal> atau <x-dialog-modal> --}}
    {{-- Kita perlu memastikan modal ini juga mendukung dark mode --}}
    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 bg-white dark:bg-gray-800 rounded-lg">
            {{-- Tambahkan dark:bg-gray-800 pada form/modal --}}
            @csrf
            @method('delete')

            <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                {{ __('Apakah Anda yakin ingin menghapus akun Anda?') }}
            </h2>

            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                {{ __('Setelah akun Anda dihapus, semua sumber daya dan datanya akan dihapus secara permanen. Harap masukkan password Anda untuk mengkonfirmasi bahwa Anda ingin menghapus akun Anda secara permanen.') }}
            </p>

            <div class="mt-6" x-data="{ showPassword: false }">
                <label for="password_delete" class="sr-only">{{ __('Password') }}</label>
                <div class="relative">
                    <input id="password_delete" name="password" :type="showPassword ? 'text' : 'password'"
                        class="block w-3/4 text-sm rounded-lg border-gray-300 bg-gray-50 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:placeholder-gray-400 focus:ring-primary focus:border-primary dark:focus:ring-primary-dark dark:focus:border-primary-dark pe-10 py-2.5"
                        placeholder="{{ __('Password') }}" />
                    <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                        <button type="button" @click="showPassword = !showPassword"
                            class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                            {{-- SVG Ikon Mata --}}
                            <svg x-show="!showPassword" class="w-5 h-5" ...>...</svg>
                            <svg x-show="showPassword" style="display: none;" class="w-5 h-5" ...>...</svg>
                        </button>
                    </div>
                </div>
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    {{ __('Batal') }}
                </x-secondary-button>

                {{-- Tombol konfirmasi hapus di dalam modal --}}
                <x-danger-button class="ms-3">
                    {{ __('Hapus Akun') }}
                </x-danger-button>
            </div>
        </form>
    </x-modal>
</section>
