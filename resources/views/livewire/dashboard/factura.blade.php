<div class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1
                class="text-4xl font-black text-gray-900 dark:text-white sm:text-5xl border-b-8 border-red-600 inline-block pb-4 rounded-b-xl">
                Solicitud de Facturación
            </h1>
            <p class="mt-8 text-xl text-gray-600 dark:text-gray-400 font-medium">
                Genera tu <span class="text-red-600 font-black">CFDI 4.0</span> de manera rápida y segura.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Instructions -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-8 border border-gray-100 dark:border-zinc-800 transition-all">
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8 flex items-center">
                        <div class="p-2 bg-red-600 rounded-lg text-white mr-4 shadow-lg shadow-red-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Instrucciones
                    </h2>
                    <ul class="space-y-6 text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">1</span>
                            <span>Solo dentro del <span class="font-black text-red-600">mes fiscal</span> de la
                                compra.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">2</span>
                            <span>Adjuntar <span class="font-bold text-gray-900 dark:text-white">Constancia
                                    Fiscal</span> y <span class="font-bold text-gray-900 dark:text-white">Nota de
                                    Renta</span>.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">3</span>
                            <span>Tiempo de entrega: <span class="font-black text-gray-900 dark:text-white">2 días
                                    hábiles</span>.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">4</span>
                            <span>Lunes a Viernes de <span class="font-bold text-gray-900 dark:text-white">9:00 AM a
                                    9:00 PM</span>.</span>
                        </li>
                    </ul>
                </div>

                <!-- Simple FAQ/Alert -->
                <div class="bg-black dark:bg-zinc-900 rounded-[2rem] p-8 border border-white/5 shadow-2xl">
                    <p class="text-white text-sm font-medium">
                        <strong class="text-red-600 block mb-2 uppercase tracking-widest text-xs">¿Dónde recibo mi
                            factura?</strong>
                        Se enviará automáticamente a tu email una vez procesada por nuestro equipo contable.
                    </p>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[3rem] shadow-2xl border border-gray-100 dark:border-zinc-800 overflow-hidden transition-all duration-300">
                    <div class="p-8 sm:p-14">
                        <form action="#" method="POST" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- RFC -->
                                <div class="col-span-1">
                                    <label for="rfc"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">RFC</label>
                                    <input type="text" name="rfc" id="rfc"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 uppercase placeholder-gray-400"
                                        placeholder="XAXX010101000">
                                </div>

                                <!-- Razón Social -->
                                <div class="col-span-1">
                                    <label for="razon_social"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Razón
                                        Social</label>
                                    <input type="text" name="razon_social" id="razon_social"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="Como aparece en su constancia">
                                </div>

                                <!-- Régimen Fiscal -->
                                <div class="col-span-1">
                                    <label for="regimen"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Régimen
                                        Fiscal</label>
                                    <select name="regimen" id="regimen"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600">
                                        <option value="">Seleccione una opción</option>
                                        <option value="601">General de Ley Personas Morales</option>
                                        <option value="603">Personas Morales con Fines no Lucrativos</option>
                                        <option value="605">Sueldos e Ingresos Asimilados a Salarios</option>
                                        <option value="606">Arrendamiento</option>
                                        <option value="612">Personas Físicas con Actividades Empresariales</option>
                                        <option value="626">Régimen Simplificado de Confianza (RESICO)</option>
                                    </select>
                                </div>

                                <!-- Uso de CFDI -->
                                <div class="col-span-1">
                                    <label for="uso_cfdi"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Uso
                                        de CFDI</label>
                                    <select name="uso_cfdi" id="uso_cfdi"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600">
                                        <option value="G03">G03 - Gastos en general</option>
                                        <option value="S01">S01 - Sin efectos fiscales</option>
                                        <option value="CP01">CP01 - Pagos</option>
                                    </select>
                                </div>

                                <!-- Código Postal -->
                                <div class="col-span-1">
                                    <label for="cp"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">CP
                                        Fiscal</label>
                                    <input type="text" name="cp" id="cp"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="12345">
                                </div>

                                <!-- Email para envío -->
                                <div class="col-span-1">
                                    <label for="email"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Email
                                        de Envío</label>
                                    <input type="email" name="email" id="email"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="tu@email.com">
                                </div>

                                <!-- File: Constancia -->
                                <div class="col-span-1 md:col-span-2">
                                    <label
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Constancia
                                        de Situación Fiscal</label>
                                    <div
                                        class="mt-2 flex justify-center px-8 pt-10 pb-10 border-2 border-gray-200 dark:border-zinc-700 border-dashed rounded-[2rem] hover:border-red-600 cursor-pointer bg-gray-50 dark:bg-black/50 transition-all group">
                                        <div class="space-y-4 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-red-600 transition-colors"
                                                fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                <span class="text-red-600 font-black">Haz clic para subir
                                                    archivo</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- File: Nota -->
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adjuntar Nota de
                                        Renta</label>
                                    <div
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 cursor-pointer bg-gray-50 transition-all">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48">
                                                <path d="M9 12h6m-6 4h12m-12 4h12M9 8h24v32H9V8z" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <span class="text-indigo-600 font-medium">Sube tu nota o ticket</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-span-1 md:col-span-2 pt-10">
                                <button type="button"
                                    class="w-full bg-red-600 text-white py-6 rounded-2xl font-black text-xl shadow-2xl hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-95 shadow-red-600/30">
                                    Enviar Solicitud
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
