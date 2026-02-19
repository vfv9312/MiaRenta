<div class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
    <div class="max-w-5xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-20">
            <h1 class="text-5xl font-black text-gray-900 dark:text-white mb-6 uppercase tracking-tighter">
                ¿Cómo <span class="text-red-600">Rentar</span>?
            </h1>
            <p class="text-xl text-gray-600 dark:text-gray-400 font-medium max-w-2xl mx-auto">
                Sigue estos sencillos pasos para asegurar el mobiliario perfecto para tu próximo evento.
            </p>
        </div>

        <!-- Steps Timeline -->
        <div class="relative">
            <!-- Central Line (Desktop) -->
            <div
                class="hidden md:block absolute left-1/2 top-0 bottom-0 w-1 bg-gray-100 dark:bg-zinc-800 -translate-x-1/2">
            </div>

            <div class="space-y-16">
                <!-- Step 1 -->
                <div class="relative flex flex-col md:flex-row items-center group">
                    <div class="md:w-1/2 flex justify-center md:justify-end md:pr-16 mb-8 md:mb-0">
                        <div class="text-center md:text-right">
                            <span
                                class="inline-block px-4 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full text-xs font-black uppercase mb-4 tracking-widest">Paso
                                01</span>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-4">Elige tu Mobiliario</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed max-w-sm">
                                Navega por nuestro <a href="{{ route('lista') }}"
                                    class="text-red-600 font-black underline decoration-2 underline-offset-4">catálogo
                                    online</a> y selecciona las piezas que mejor se adapten a tu estilo.
                            </p>
                        </div>
                    </div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-red-600 rounded-full border-4 border-white dark:border-black z-10 hidden md:flex items-center justify-center shadow-xl shadow-red-500/20 group-hover:scale-125 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    <div class="md:w-1/2"></div>
                </div>

                <!-- Step 2 -->
                <div class="relative flex flex-col md:flex-row items-center group">
                    <div class="md:w-1/2"></div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-black dark:bg-white rounded-full border-4 border-white dark:border-black z-10 hidden md:flex items-center justify-center shadow-xl group-hover:scale-125 transition-transform">
                        <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 0a2 2 0 110 4 2 2 0 010-4z">
                            </path>
                        </svg>
                    </div>
                    <div class="md:w-1/2 flex justify-center md:justify-start md:pl-16">
                        <div class="text-center md:text-left">
                            <span
                                class="inline-block px-4 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full text-xs font-black uppercase mb-4 tracking-widest">Paso
                                02</span>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-4">Arma tu Paquete</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed max-w-sm">
                                Agrega las cantidades necesarias a tu carrito. Verás un resumen detallado y el total
                                estimado al instante.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative flex flex-col md:flex-row items-center group">
                    <div class="md:w-1/2 flex justify-center md:justify-end md:pr-16 mb-8 md:mb-0">
                        <div class="text-center md:text-right">
                            <span
                                class="inline-block px-4 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full text-xs font-black uppercase mb-4 tracking-widest">Paso
                                03</span>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-4">Confirma vía WhatsApp
                            </h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed max-w-sm">
                                Una vez listo, haz clic en "Rentar Ahora". Te redirigiremos a WhatsApp con tu pedido
                                listo para ser confirmado por nuestro equipo.
                            </p>
                        </div>
                    </div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-red-600 rounded-full border-4 border-white dark:border-black z-10 hidden md:flex items-center justify-center shadow-xl shadow-red-500/20 group-hover:scale-125 transition-transform">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                            </path>
                        </svg>
                    </div>
                    <div class="md:w-1/2"></div>
                </div>

                <!-- Step 4 -->
                <div class="relative flex flex-col md:flex-row items-center group">
                    <div class="md:w-1/2"></div>
                    <div
                        class="absolute left-1/2 -translate-x-1/2 w-12 h-12 bg-black dark:bg-white rounded-full border-4 border-white dark:border-black z-10 hidden md:flex items-center justify-center shadow-xl group-hover:scale-125 transition-transform">
                        <svg class="w-6 h-6 text-white dark:text-black" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7">
                            </path>
                        </svg>
                    </div>
                    <div class="md:w-1/2 flex justify-center md:justify-start md:pl-16">
                        <div class="text-center md:text-left">
                            <span
                                class="inline-block px-4 py-1 bg-red-100 dark:bg-red-900/30 text-red-600 rounded-full text-xs font-black uppercase mb-4 tracking-widest">Paso
                                04</span>
                            <h3 class="text-3xl font-black text-gray-900 dark:text-white mb-4">Entrega y Disfruta</h3>
                            <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed max-w-sm">
                                Coordinamos la entrega en tu domicilio. Liquidar el saldo restante y ¡disfruta de tu
                                evento!
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <div
            class="mt-32 text-center bg-black dark:bg-zinc-900 rounded-[3rem] p-12 md:p-20 shadow-2xl relative overflow-hidden">
            <div class="absolute top-0 right-0 -mr-20 -mt-20 w-64 h-64 bg-red-600/10 rounded-full blur-3xl"></div>
            <div class="relative z-10">
                <h2 class="text-4xl font-black text-white mb-8">¿Listo para comenzar?</h2>
                <a href="{{ route('lista') }}"
                    class="inline-flex items-center px-12 py-5 bg-red-600 text-white font-black rounded-full hover:bg-red-700 transition-all hover:shadow-2xl hover:shadow-red-500/30 text-xl group">
                    Ver Catálogo
                    <svg class="w-6 h-6 ml-4 transition-transform group-hover:translate-x-2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </div>
</div>
