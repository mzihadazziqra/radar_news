<x-guest-layout>
    <div class="flex flex-col md:flex-row">

        <div class="w-full md:w-1/2 bg-white flex flex-col justify-center items-center p-8 sm:p-12 dark:bg-gray-800">
            <div class="w-full max-w-md">

                <h1 class="text-3xl sm:text-4xl font-bold text-secondary dark:text-white mb-3">
                    Selamat Datang di <span class="text-primary">RadarNews</span>
                </h1>
                <p class="text-medium-gray dark:text-gray-400 text-sm mb-8">
                    RadarNews hadir untuk mengabarkan fakta, mengupas peristiwa, dan membuka wawasan anda.
                </p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9.05 14.5h1.9a3.987 3.987 0 0 1 3.998 2.012A8.949 8.949 0 0 1 10 18Z"/>
                                </svg>
                            </div>
                            <input id="name" type="text" name="name" :value="old('name')" required
                                autofocus autocomplete="name"
                                class="bg-light-gray border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                                placeholder="Username">
                        </div>
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>
                    <div class="mb-6">
                        <div class="relative">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                                {{-- Ikon Email SVG --}}
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                                    <path d="m10.036 8.278 9.258-7.79A1.979 1.979 0 0 0 18 0H2A1.987 1.987 0 0 0 .641.541l9.395 7.737Z"/>
                                    <path d="M11.241 9.817c-.36.275-.801.425-1.255.427-.428 0-.845-.138-1.187-.395L0 2.6V14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2.5l-8.759 7.317Z"/>
                                </svg>
                            </div>
                            <input id="email" type="text" name="email" :value="old('email')" required
                                autofocus autocomplete="username"
                                class="bg-light-gray border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 p-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                                placeholder="Email">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                    <div class="mb-6" x-data="{ showPassword: false }">
                        <div class="relative">

                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                                {{-- Ikon Gembok SVG --}}
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                                </svg>
                            </div>

                            <input id="password" :type="showPassword ? 'text' : 'password'" name="password" required
                                autocomplete="new-password"
                                class="bg-light-gray border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 pe-10 py-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                                placeholder="Password">


                            <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">

                                    <svg x-show="!showPassword" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <svg x-show="showPassword" style="display: none;" class="w-5 h-5"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div class="mb-6" x-data="{ showPassword: false }">
                        <div class="relative">

                            <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none text-gray-400">
                                {{-- Ikon Gembok SVG --}}
                                <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 16 20">
                                    <path d="M14 7h-1.5V4.5a4.5 4.5 0 1 0-9 0V7H2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-5 8a1 1 0 1 1-2 0v-3a1 1 0 1 1 2 0v3Zm1.5-8h-5V4.5a2.5 2.5 0 1 1 5 0V7Z"/>
                                </svg>
                            </div>

                            <input id="password_confirmation" :type="showPassword ? 'text' : 'password'" name="password_confirmation"
                                required autocomplete="new-password"
                                class="bg-light-gray border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full ps-10 pe-10 py-3 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary dark:focus:border-primary"
                                placeholder="Konfirmasi Password">


                            <div class="absolute inset-y-0 end-0 flex items-center pe-3.5">
                                <button type="button" @click="showPassword = !showPassword"
                                    class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                    {{-- Ikon Mata Terbuka (Password Terlihat) --}}
                                    <svg x-show="!showPassword" class="w-5 h-5" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                        aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                    </svg>

                                    <svg x-show="showPassword" style="display: none;" class="w-5 h-5"
                                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>

                    <button type="submit" class="w-full btn btn-primary mb-6">
                        {{ __('Daftar') }}
                    </button>

                    <p class="text-sm text-center text-medium-gray">
                        Sudah memiliki akun?
                        <a href="{{ route('login') }}" class="font-semibold text-primary hover:underline">
                            Masuk
                        </a>
                    </p>
                </form>
            </div>
        </div>
        <div
            class="hidden md:flex w-full md:w-1/2 bg-primary  flex-col justify-center items-center p-12 text-white relative">
            <img src="{{ asset('images/reporter.svg') }}" alt="Ilustrasi RadarNews"
                class="max-w-xs lg:max-w-sm xl:max-w-md">
        </div>
    </div>
</x-guest-layout>
