<div class="bg-white">
    @push('css')
        <style>
            @keyframes slideInLeft {
                from {
                    opacity: 0;
                    transform: translateX(-50px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            @keyframes slideInRight {
                from {
                    opacity: 0;
                    transform: translateX(50px);
                }

                to {
                    opacity: 1;
                    transform: translateX(0);
                }
            }

            .animate-slideInLeft {
                animation: slideInLeft 0.8s ease-out forwards;
            }

            .animate-slideInRight {
                animation: slideInRight 0.8s ease-out forwards;
            }

            .bg-pattern {
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23CC0000' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    @endpush

    {{-- Banner Seccion --}}
    <section class="relative py-24 bg-black overflow-hidden">
        <div class="absolute inset-0 opacity-10 bg-pattern"></div>
        <div class="absolute inset-0 bg-gradient-to-b from-red-900/10 to-transparent"></div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h1 class="text-4xl font-black text-white md:text-7xl animate-fadeInUp">
                Nuestra <span class="text-red-600">Historia</span>
            </h1>
            <p class="mt-6 text-xl text-gray-400 max-w-2xl mx-auto animate-fadeInUp delay-200">
                Más de una década llevando elegancia y compromiso a cada rincón de Tuxtla Gutiérrez.
            </p>
        </div>
    </section>

    {{-- Historia --}}
    <section class="py-24 overflow-hidden dark:bg-black transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center gap-20 lg:flex-row">
                <div class="w-full lg:w-1/2 animate-slideInLeft text-center lg:text-left">
                    <div class="relative inline-block lg:block">
                        <div class="absolute -top-6 -left-6 w-24 h-24 bg-red-600/10 rounded-full z-0"></div>
                        <h2
                            class="relative z-10 mb-8 text-4xl font-black text-gray-900 dark:text-white md:text-5xl leading-tight">
                            Mía Renta: Una Tradición en <span class="text-red-600">Excelencia</span>
                        </h2>
                    </div>
                    <div class="space-y-6 text-lg text-gray-600 dark:text-gray-400 leading-relaxed max-w-2xl">
                        <p>
                            Nacimos hace más de una década en el corazón de **Tuxtla Gutiérrez**, impulsados por la
                            visión de transformar cualquier espacio en un escenario de celebración inolvidable. Lo que
                            inició como un pequeño negocio familiar con apenas unas cuantas sillas, hoy es un referente
                            de calidad en todo el estado de **Chiapas**.
                        </p>
                        <p>
                            En **Mía Renta**, entendemos que detrás de cada mesa y cada mantel, hay un sueño, una unión
                            o un logro que celebrar. Por eso, nos dedicamos a ofrecer no solo mobiliario, sino la base
                            perfecta para que tus momentos brillen con luz propia.
                        </p>
                        <p>
                            Nuestra trayectoria está marcada por el compromiso con la puntualidad, la limpieza impecable
                            de nuestros equipos y una atención cálida que solo los tuxtlecos sabemos brindar.
                        </p>
                    </div>
                </div>
                <div class="w-full lg:w-1/2 animate-slideInRight">
                    <div
                        class="relative p-2 bg-gradient-to-tr from-red-600 to-black rounded-3xl shadow-2xl overflow-hidden group">
                        <img src="{{ asset('imagenes/imagenes/4.jpg') }}"
                            class="rounded-2xl w-full h-[600px] object-cover transition-transform duration-700 group-hover:scale-105"
                            alt="Mía Renta Historia">
                        <div
                            class="absolute bottom-8 right-8 bg-white/90 dark:bg-black/90 backdrop-blur-md p-8 rounded-2xl shadow-2xl max-w-xs transition-all hover:scale-105 border border-white/20">
                            <span class="text-5xl font-black text-red-600 block mb-2">+10</span>
                            <p class="text-gray-900 dark:text-white font-bold text-lg leading-tight">Años creando
                                memorias inolvidables en Tuxtla.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mision y Vision --}}
    <section class="py-24 bg-gray-50 dark:bg-zinc-900 transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Mision -->
                <div
                    class="p-10 transition-all duration-300 bg-white dark:bg-black rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 group border border-gray-100 dark:border-zinc-800">
                    <div
                        class="flex items-center justify-center w-20 h-20 mb-10 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 transition-all duration-300">
                        <svg class="w-10 h-10 text-red-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-3xl font-black text-gray-900 dark:text-white">Misión</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                        Proveer mobiliario de alta gama y servicios excepcionales que faciliten la realización de
                        eventos espectaculares, superando siempre las expectativas de nuestros clientes.
                    </p>
                </div>

                <!-- Vision -->
                <div
                    class="p-10 transition-all duration-300 bg-white dark:bg-black rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 group border border-gray-100 dark:border-zinc-800">
                    <div
                        class="flex items-center justify-center w-20 h-20 mb-10 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 transition-all duration-300">
                        <svg class="w-10 h-10 text-red-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-3xl font-black text-gray-900 dark:text-white">Visión</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                        Ser la empresa líder en renta de mobiliario en Chiapas, reconocida por nuestra innovación
                        constante, elegancia en diseños y compromiso inquebrantable con la excelencia.
                    </p>
                </div>

                <!-- Valores -->
                <div
                    class="p-10 transition-all duration-300 bg-white dark:bg-black rounded-[2.5rem] shadow-sm hover:shadow-2xl hover:-translate-y-2 group border border-gray-100 dark:border-zinc-800">
                    <div
                        class="flex items-center justify-center w-20 h-20 mb-10 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 transition-all duration-300">
                        <svg class="w-10 h-10 text-red-600 group-hover:text-white transition-colors" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-5 text-3xl font-black text-gray-900 dark:text-white">Valores</h3>
                    <ul class="text-gray-600 dark:text-gray-400 space-y-4 text-lg">
                        <li class="flex items-center space-x-3"><span class="w-2 h-2 bg-red-600 rounded-full"></span>
                            <span><strong>Integridad</strong>: Trato honesto.</span>
                        </li>
                        <li class="flex items-center space-x-3"><span class="w-2 h-2 bg-red-600 rounded-full"></span>
                            <span><strong>Calidad</strong>: Equipo impecable.</span>
                        </li>
                        <li class="flex items-center space-x-3"><span class="w-2 h-2 bg-red-600 rounded-full"></span>
                            <span><strong>Cercanía</strong>: De Tuxtla para Tuxtla.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="py-24 text-center dark:bg-black transition-colors duration-300">
        <h2 class="text-4xl font-black text-gray-900 dark:text-white mb-10">Sé parte de nuestra historia</h2>
        <a href="{{ route('dashboard') }}#servicios"
            class="inline-flex px-12 py-5 bg-red-600 text-white font-black rounded-full hover:bg-red-700 transition-all hover:shadow-2xl hover:shadow-red-500/30 text-lg">
            Explora nuestro mobiliario
        </a>
    </section>
</div>
