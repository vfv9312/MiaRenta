<div class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1
                class="text-4xl font-black text-gray-900 dark:text-white sm:text-5xl border-b-8 border-red-600 inline-block pb-4 rounded-b-xl">
                Términos y Condiciones
            </h1>
            <p class="mt-8 text-xl text-gray-600 dark:text-gray-400 font-medium">
                Políticas de renta de mobiliario y servicios de <span class="text-red-600 font-black">Mia Renta</span>
            </p>
        </div>

        <div class="space-y-12">
            <!-- Pagos -->
            <div
                class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-10 border border-gray-100 dark:border-zinc-800 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-center mb-8">
                    <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-2xl mr-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white">Métodos y Políticas de Pago</h2>
                </div>
                <div class="space-y-6 text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                    <p>{{ $pagos_intro }}</p>
                    <ul class="list-none space-y-4">
                        <li class="flex items-start"><span
                                class="w-2 h-2 bg-red-600 rounded-full mr-3 mt-2.5 flex-shrink-0"></span>
                            <span>{{ $pagos_item_1 }}</span>
                        </li>
                        <li class="flex items-start"><span
                                class="w-2 h-2 bg-red-600 rounded-full mr-3 mt-2.5 flex-shrink-0"></span>
                            <span>{{ $pagos_item_2 }}</span>
                        </li>
                        <li class="flex items-start"><span
                                class="w-2 h-2 bg-red-600 rounded-full mr-3 mt-2.5 flex-shrink-0"></span>
                            <span>{{ $pagos_item_3 }}</span>
                        </li>
                        <li class="flex items-start"><span
                                class="w-2 h-2 bg-red-600 rounded-full mr-3 mt-2.5 flex-shrink-0"></span>
                            <span>{{ $pagos_item_4 }}</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Reservaciones -->
            <div
                class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-10 border border-gray-100 dark:border-zinc-800 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-center mb-8">
                    <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-2xl mr-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white">Horarios y Reservaciones</h2>
                </div>
                <div class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                    <p class="mb-8">{{ $reservaciones_intro }}</p>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-gray-50 dark:bg-black/50 p-6 rounded-2xl border-l-8 border-red-600">
                            <span
                                class="block font-black text-gray-900 dark:text-white mb-2">{{ $reservacion_estandar_titulo }}</span>
                            {{ $reservacion_estandar_texto }}
                        </div>
                        <div class="bg-gray-50 dark:bg-black/50 p-6 rounded-2xl border-l-8 border-amber-500">
                            <span
                                class="block font-black text-gray-900 dark:text-white mb-2">{{ $reservacion_urgente_titulo }}</span>
                            {{ $reservacion_urgente_texto }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Entregas y Recolección -->
            <div
                class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-10 border border-gray-100 dark:border-zinc-800 hover:shadow-2xl transition-all duration-300">
                <div class="flex items-center mb-8">
                    <div class="bg-red-50 dark:bg-red-900/20 p-4 rounded-2xl mr-6">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h2 class="text-3xl font-black text-gray-900 dark:text-white">Entregas y Recolección</h2>
                </div>
                <div class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">
                    <div
                        class="flex items-start p-6 bg-red-50 dark:bg-red-900/10 rounded-2xl border border-red-100 dark:border-red-900/30">
                        <svg class="w-8 h-8 text-red-600 mr-4 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z">
                            </path>
                        </svg>
                        <span>{{ $entregas_texto }}</span>
                    </div>
                </div>
            </div>

            <!-- Cancelaciones y Cuidado -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-10 border border-gray-100 dark:border-zinc-800 hover:shadow-2xl transition-all duration-300">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Cancelaciones</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">{{ $cancelaciones_texto }}</p>
                </div>
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-10 border border-gray-100 dark:border-zinc-800 hover:shadow-2xl transition-all duration-300">
                    <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Cuidado del Mobiliario</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-lg leading-relaxed">{{ $cuidado_texto }}</p>
                </div>
            </div>
        </div>

        <!-- Footer Note -->
        <div class="mt-16 text-center text-gray-500 text-sm">
            <p>{{ $footer_nota }}</p>
            <p class="mt-1">© {{ date('Y') }} Mia Renta - Soluciones en Mobiliario</p>
        </div>
    </div>
</div>
