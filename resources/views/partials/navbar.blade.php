<section x-data="{ mobileMenuOpen: false }">
    <nav
        class="fixed top-0 z-50 w-full transition-all duration-300 border-b border-gray-200 glass-effect dark:bg-black/80 bg-white/80 dark:border-gray-800 backdrop-blur-md">
        <div class="flex flex-wrap items-center justify-between max-w-screen-xl p-4 mx-auto">
            <a href="{{ route('home') }}"
                class="flex items-center space-x-3 transition-transform duration-300 hover:scale-105 active:scale-95">
                <img src="{{ asset('imagenes/logos/logopeque1.png') }}"
                    class="h-10 sm:h-12 md:h-14 w-auto flex-shrink-0 drop-shadow-md" alt="Logo Mia Renta">
                <span
                    class="self-center text-xl font-black whitespace-nowrap dark:text-white text-gray-900 tracking-tighter sm:text-2xl hidden xs:block">
                    MÍA <span class="text-red-600">RENTA</span>
                </span>
            </a>

            <div class="flex items-center space-x-2 md:order-2">
                <!-- Dark Mode Toggle -->
                <button @click="darkMode = !darkMode" type="button"
                    class="p-2.5 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm transition-colors duration-200">
                    <svg x-show="!darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg x-show="darkMode" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 10-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>

                <a href="{{ route('orden') }}"
                    class="hidden sm:inline-flex items-center px-5 py-2.5 text-sm font-bold text-center text-white bg-red-600 rounded-full hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900 transition-all duration-300 hover:shadow-lg hover:shadow-red-500/30">
                    Ordena aquí
                </a>

                <button @click="mobileMenuOpen = !mobileMenuOpen" type="button"
                    class="inline-flex items-center justify-center w-10 h-10 p-2 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 dark:text-gray-400 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:focus:ring-gray-700"
                    aria-controls="navbar-sticky" :aria-expanded="mobileMenuOpen">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M1 1h15M1 7h15M1 13h15" />
                    </svg>
                </button>
            </div>

            <div class="items-center justify-between hidden w-full md:flex md:w-auto md:order-1" id="navbar-sticky"
                :class="{ 'block': mobileMenuOpen, 'hidden': !mobileMenuOpen }">
                <ul
                    class="flex flex-col p-4 mt-4 font-black border border-gray-100 dark:border-zinc-800 rounded-[2rem] bg-white/95 dark:bg-black/95 md:p-0 md:space-x-8 md:flex-row md:mt-0 md:border-0 md:bg-transparent dark:md:bg-transparent uppercase tracking-widest text-[10px]">
                    <li>
                        <a href="{{ route('home') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('home') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Inicio
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('nosotros') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('nosotros') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Nosotros
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('lista') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('lista') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Productos
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('reclamacion') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('reclamacion') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Reclamaciones
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('factura') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('factura') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Factura
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('ubicanos') }}"
                            class="block px-3 py-2 rounded-lg transition-all duration-200 {{ Route::is('ubicanos') ? 'text-red-600' : 'text-gray-900 dark:text-white hover:text-red-600' }}">
                            Ubícanos
                        </a>
                    </li>
                    <li class="sm:hidden mt-4">
                        <a href="{{ route('orden') }}"
                            class="block w-full px-5 py-3 text-center text-white bg-red-600 rounded-xl font-bold">
                            Ordena aquí
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</section>
