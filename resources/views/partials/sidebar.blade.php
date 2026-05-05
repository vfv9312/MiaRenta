@if (!request()->routeIs('login'))
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <div>
        <div class="antialiased bg-gray-50 dark:bg-gray-900">
            <nav
                class="bg-white -b  -gray-200 px-4 py-2.5 dark:bg-gray-800 dark:-gray-700 fixed left-0 right-0 top-0 z-50">
                <div class="flex flex-wrap items-center justify-between">
                    <div class="flex items-center justify-start">
                        <button data-drawer-target="drawer-navigation" data-drawer-toggle="drawer-navigation"
                            aria-controls="drawer-navigation"
                            class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer md:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <svg aria-hidden="true" class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="sr-only">Toggle sidebar</span>
                        </button>
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-between mr-4">
                            <img src="{{ asset('imagenes/logos/logoprueba2.png') }}"
                                class="mr-3 h-10 md:h-14 w-auto object-contain dark:hidden" alt="MiaRenta Logo" />
                        </a>
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-between mr-4">
                            <img src="{{ asset('imagenes/logos/logoprueba2.png') }}"
                                class="hidden mr-3 h-10 md:h-14 w-auto object-contain dark:block" alt="MiaRenta Logo" />
                        </a>


                    </div>
                    <div class="flex items-center lg:order-2">
                        {{-- usuario --}}
                        <button type="button"
                            class="flex mx-3 text-sm bg-gray-100 rounded-full md:mr-0 ring-2 ring-indigo-500 focus:ring-4 focus:ring-indigo-300 dark:bg-gray-800 dark:ring-indigo-600 dark:focus:ring-indigo-800 relative"
                            id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                            <span class="sr-only">Open user menu</span>
                            @if(Auth::user() && Auth::user()->profile_photo_path)
                                <img class="w-8 h-8 rounded-full object-cover"
                                    src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}"
                                    alt="user photo" />
                            @else
                                <div class="w-8 h-8 rounded-full flex items-center justify-center text-indigo-700 dark:text-indigo-400 font-bold bg-indigo-100 dark:bg-indigo-900/50">
                                    {{ substr(optional(Auth::user()->person)->nombre ?? 'U', 0, 1) }}
                                </div>
                            @endif
                        </button>
                        <!-- Dropdown menu -->
                        <div class="z-50 hidden w-64 my-4 text-base list-none bg-white divide-y divide-gray-100 shadow-xl dark:bg-gray-800 dark:divide-gray-700 rounded-xl border border-gray-100 dark:border-gray-700 overflow-hidden"
                            id="dropdown">
                            <div class="px-5 py-4 bg-gray-50/50 dark:bg-gray-900/50">
                                <span class="block text-sm font-bold text-gray-900 dark:text-white">
                                    @if(Auth::user() && Auth::user()->person)
                                        {{ Auth::user()->person->nombre }} {{ Auth::user()->person->apellido }}
                                    @else
                                        Administrador
                                    @endif
                                </span>
                                <span class="block text-xs font-semibold text-indigo-600 dark:text-indigo-400 mt-0.5">
                                    {{ optional(Auth::user()->role)->name ?? 'Rol no asignado' }}
                                </span>
                                <span class="block text-xs text-gray-500 truncate dark:text-gray-400 mt-1">{{ optional(Auth::user())->email }}</span>
                            </div>
                            <ul class="py-2 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                                <li>
                                    <a href="{{ route('perfil') }}"
                                        class="block px-5 py-2.5 text-sm hover:bg-gray-100 dark:hover:bg-gray-700 dark:text-gray-300 dark:hover:text-white font-medium transition-colors flex items-center gap-2">
                                        <i class="fas fa-user-circle w-4 text-center"></i> Mi Perfil
                                    </a>
                                </li>

                            </ul>

                            <ul class="py-1 text-gray-700 dark:text-gray-300" aria-labelledby="dropdown">
                                <li>
                                    <form action="{{ route('logout') }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                            class="block w-full px-4 py-2 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Cerrar
                                            sesión</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- Sidebar -->

            <aside
                class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-white shadow-xl -r -gray-200 pt-14 md:translate-x-0 dark:bg-gray-800 dark:-gray-700"
                aria-label="Sidenav" id="drawer-navigation">
                <div class="h-full px-3 py-5 overflow-y-auto bg-white dark:bg-gray-800">

                    <ul class="space-y-2">
                        <li>
                            <a href="{{ route('dashboard') }}"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg aria-hidden="true"
                                    class="w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z"></path>
                                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z"></path>
                                </svg>
                                <span class="ml-3">Inicio</span>
                            </a>
                        </li>
                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-pages" data-collapse-toggle="dropdown-pages">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">Páginas</span>
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-pages" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="{{ route('inicio.index') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Inicio</a>
                                </li>

                                <li>
                                    <a href="{{ route('nosotros.index') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Nosotros</a>
                                </li>

                                <li>
                                    <a href="{{ route('factura.index') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Facturación</a>
                                </li>

                                <li>
                                    <a href="{{ route('politica.index') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Politica</a>
                                </li>

                                <li>
                                    <a href="{{ route('contacto.index') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Redes
                                        y Contacto</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-ordenes" data-collapse-toggle="dropdown-ordenes">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                        clip-rule="evenodd"></path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">Ordenes</span>
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-ordenes" class="hidden py-2 space-y-2">
                                <li>
                                    <a href="{{ route('generar-orden') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Generar
                                        Ordenes</a>
                                </li>

                                <li>
                                    <a href="{{ route('ordenes') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Historial
                                        de Ordenes</a>
                                </li>
                                <li>
                                    <a href="{{ route('ordenes.estadisticas') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Estadisticas</a>
                                </li>

                            </ul>
                        </li>


                        <li>
                            <button type="button"
                                class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                                aria-controls="dropdown-clientes" data-collapse-toggle="dropdown-clientes">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z">
                                    </path>
                                </svg>
                                <span class="flex-1 ml-3 text-left whitespace-nowrap">Clientes</span>
                                <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"></path>
                                </svg>
                            </button>
                            <ul id="dropdown-clientes" class="hidden py-2 space-y-2">
                                <li>

                                    <a href="{{ route('clientes') }}"
                                        class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Clientes</a>
                                </li>

                            </ul>
                        </li>

                        <li>
                            <a href="#"
                                class="flex items-center p-2 text-base font-medium text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                                <svg aria-hidden="true"
                                    class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white"
                                    fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd"
                                        d="M10 2a1 1 0 00-1 1v1a1 1 0 001 1h4a1 1 0 001-1V3a1 1 0 00-1-1h-4zM6 5a1 1 0 011-1h1a1 1 0 110 2H7a1 1 0 01-1-1zm6 0a1 1 0 011-1h1a1 1 0 110 2h-1a1 1 0 01-1-1zm-6 3a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm8 3a1 1 0 100-2 1 1 0 000 2zm-2 0a1 1 0 11-2 0 1 1 0 012 0zm-5 1a1 1 0 100-2 1 1 0 000 2zm7 2a1 1 0 11-2 0 1 1 0 012 0zm-5 1a1 1 0 100-2 1 1 0 000 2z"
                                        clip-rule="evenodd"></path>
                                    <path d="M4 13h12v3a2 2 0 01-2 2H6a2 2 0 01-2-2v-3z"></path>
                                </svg>
                                <span class="flex-1 ml-3 whitespace-nowrap">Empleados</span>
                                <span
                                    class="inline-flex items-center justify-center w-5 h-5 text-xs font-semibold rounded-full text-primary-800 bg-primary-100 dark:bg-primary-200 dark:text-primary-800">
                                </span>
                            </a>
                        </li>

                    </ul>

                    <li>
                        <button type="button"
                            class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-inventario" data-collapse-toggle="dropdown-inventario">
                            <svg aria-hidden="true"
                                class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"
                                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M10 2a4 4 0 00-4 4v1H5a1 1 0 00-.994.89l-1 9A1 1 0 004 18h12a1 1 0 00.994-1.11l-1-9A1 1 0 0015 7h-1V6a4 4 0 00-4-4zm2 5V6a2 2 0 10-4 0v1h4zm-6 3a1 1 0 112 0 1 1 0 01-2 0zm7-1a1 1 0 100 2 1 1 0 000-2z"
                                    clip-rule="evenodd"></path>
                            </svg>
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">Inventario</span>
                            <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd"></path>
                            </svg>
                        </button>
                        <ul id="dropdown-inventario" class="hidden py-2 space-y-2">
                            <li>
                                <a href="{{ route('colores') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Color</a>
                            </li>
                            <li>
                                <a href="{{ route('categorias') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Categoria</a>
                            </li>
                            <li>
                                <a href="{{ route('tipos') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Tipo</a>
                            </li>
                            <li>
                                <a href="{{ route('productos') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Productos</a>
                            </li>
                            <li>
                                <a href="{{ route('imagenes.inventary') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Imagenes</a>
                            </li>
                            <li>
                                <a href="{{ route('reparaciones') }}"
                                    class="flex items-center w-full p-2 text-base font-medium text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">Reparaciones</a>
                            </li>

                        </ul>
                    </li>

                </div>
                <div
                    class="absolute bottom-0 left-0 z-20 justify-center hidden w-full p-4 space-x-4 bg-white lg:flex dark:bg-gray-800">

                    <a href="{{ route('configuracion') }}" data-tooltip-target="tooltip-settings"
                        class="inline-flex justify-center p-2 text-gray-500 rounded cursor-pointer dark:text-gray-400 dark:hover:text-white hover:text-gray-900 hover:bg-gray-100 dark:hover:bg-gray-600">
                        <svg aria-hidden="true" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M11.49 3.17c-.38-1.56-2.6-1.56-2.98 0a1.532 1.532 0 01-2.286.948c-1.372-.836-2.942.734-2.106 2.106.54.886.061 2.042-.947 2.287-1.561.379-1.561 2.6 0 2.978a1.532 1.532 0 01.947 2.287c-.836 1.372.734 2.942 2.106 2.106a1.532 1.532 0 012.287.947c.379 1.561 2.6 1.561 2.978 0a1.533 1.533 0 012.287-.947c1.372.836 2.942-.734 2.106-2.106a1.533 1.533 0 01.947-2.287c1.561-.379 1.561-2.6 0-2.978a1.532 1.532 0 01-.947-2.287c.836-1.372-.734-2.942-2.106-2.106a1.532 1.532 0 01-2.287-.947zM10 13a3 3 0 100-6 3 3 0 000 6z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </a>
                    <div id="tooltip-settings" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip">
                        Configuraciones
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>

                </div>
            </aside>

            <main class="h-auto p-4 pt-20 overflow-x-auto md:ml-64">
                @include('partials.alerts')

                @yield('content')

            </main>
        </div>

    </div>
@else
    @yield('content')
@endif
