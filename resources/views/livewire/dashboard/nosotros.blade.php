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
                background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%239C92AC' fill-opacity='0.1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            }
        </style>
    @endpush

    {{-- Banner Seccion --}}
    <section class="relative py-20 bg-blue-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20 bg-pattern"></div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h1 class="text-4xl font-extrabold text-white md:text-6xl animate-fadeInUp">
                Nuestra <span class="text-blue-400">Historia</span>
            </h1>
            <p class="mt-4 text-xl text-blue-100 animate-fadeInUp delay-200">
                Llevando elegancia a cada rincón de Tuxtla Gutiérrez.
            </p>
        </div>
    </section>

    {{-- Historia --}}
    <section class="py-24 overflow-hidden">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center gap-16 lg:flex-row">
                <div class="w-full lg:w-1/2 animate-slideInLeft">
                    <div class="relative">
                        <div class="absolute -top-4 -left-4 w-24 h-24 bg-blue-100 rounded-full z-0 opacity-50"></div>
                        <h2 class="relative z-10 mb-8 text-3xl font-bold text-gray-900 md:text-4xl">
                            Mía Renta: Una Tradición en Eventos
                        </h2>
                    </div>
                    <div class="space-y-6 text-lg text-gray-600 leading-relaxed">
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
                    <div class="relative p-2 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-2xl shadow-2xl">
                        <img src="{{ asset('imagenes/imagenes/4.jpg') }}"
                            class="rounded-xl w-full h-[500px] object-cover" alt="Mía Renta Historia">
                        <div
                            class="absolute bottom-6 right-6 bg-white p-6 rounded-xl shadow-lg max-w-xs transition-transform hover:scale-105">
                            <span class="text-4xl font-bold text-blue-600">+10</span>
                            <p class="text-gray-600 font-medium">Años creando memorias en los eventos más importantes de
                                Tuxtla.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Mision y Vision --}}
    <section class="py-24 bg-gray-50">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Mision -->
                <div class="p-10 transition-all bg-white rounded-3xl shadow-sm hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-8 bg-blue-100 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900">Misión</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Proveer mobiliario de alta gama y servicios excepcionales que faciliten la realización de
                        eventos espectaculares, superando siempre las expectativas de nuestros clientes.
                    </p>
                </div>

                <!-- Vision -->
                <div class="p-10 transition-all bg-white rounded-3xl shadow-sm hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-8 bg-blue-100 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900">Visión</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Ser la empresa líder en renta de mobiliario en Chiapas, reconocida por nuestra innovación
                        constante, elegancia en diseños y compromiso inquebrantable con la excelencia.
                    </p>
                </div>

                <!-- Valores -->
                <div class="p-10 transition-all bg-white rounded-3xl shadow-sm hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-8 bg-blue-100 rounded-2xl group-hover:bg-blue-600 group-hover:text-white transition-colors">
                        <svg class="w-8 h-8 text-blue-600 group-hover:text-white" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-4 text-2xl font-bold text-gray-900">Valores</h3>
                    <ul class="text-gray-600 space-y-2">
                        <li>• **Integridad**: Honestidad en cada trato.</li>
                        <li>• **Calidad**: El mejor equipo para tu evento.</li>
                        <li>• **Cercanía**: Somos de Tuxtla y para Tuxtla.</li>
                        <li>• **Pasión**: Amamos lo que hacemos.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    {{-- Final CTA --}}
    <section class="py-20 text-center">
        <h2 class="text-3xl font-bold text-gray-900 mb-8">Sé parte de nuestra historia</h2>
        <a href="{{ route('dashboard') }}#servicios"
            class="inline-block px-10 py-4 bg-blue-700 text-white font-bold rounded-full hover:bg-blue-800 transition-all hover:shadow-2xl">
            Explora nuestro mobiliario
        </a>
    </section>
</div>
