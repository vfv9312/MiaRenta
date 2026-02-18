<div class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">Solicitud de Facturación Fiscal</h1>
            <p class="mt-4 text-lg text-gray-600">Completa el formulario para generar tu factura (CFDI 4.0)</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Instructions -->
            <div class="lg:col-span-1 space-y-6">
                <div class="bg-white rounded-2xl shadow-sm p-6 border border-gray-100 italic">
                    <h2 class="text-xl font-bold text-indigo-700 mb-4 flex items-center">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Instrucciones Importantes
                    </h2>
                    <ul class="space-y-4 text-sm text-gray-600 leading-relaxed">
                        <li class="flex items-start">
                            <span
                                class="bg-indigo-100 text-indigo-700 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-2 mt-0.5 flex-shrink-0">1</span>
                            <span>La factura se emitirá únicamente dentro del <span class="font-bold text-red-600">mes
                                    fiscal</span> en el que se realizó la compra/renta.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-indigo-100 text-indigo-700 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-2 mt-0.5 flex-shrink-0">2</span>
                            <span>Fuera del mes fiscal, únicamente se le podrá entregar una copia de su nota de venta
                                original.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-indigo-100 text-indigo-700 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-2 mt-0.5 flex-shrink-0">3</span>
                            <span>Es obligatorio adjuntar su <span class="font-semibold">Constancia de Situación
                                    Fiscal</span> actualizada y la <span class="font-semibold">Nota de
                                    Renta</span>.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-indigo-100 text-indigo-700 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-2 mt-0.5 flex-shrink-0">4</span>
                            <span>El tiempo de entrega de su factura es de <span class="font-bold text-indigo-600">2
                                    días hábiles</span> posteriores a su solicitud.</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-indigo-100 text-indigo-700 rounded-full w-5 h-5 flex items-center justify-center text-xs font-bold mr-2 mt-0.5 flex-shrink-0">5</span>
                            <span>Horario de procesamiento: Lunes a Viernes de <span class="font-semibold">9:00 AM a
                                    9:00 PM</span>.</span>
                        </li>
                    </ul>
                </div>

                <!-- Simple FAQ/Alert -->
                <div class="bg-amber-50 rounded-2xl p-6 border border-amber-100">
                    <p class="text-amber-800 text-sm">
                        <strong>¿Dónde recibo mi factura?</strong><br>
                        Se enviará automáticamente a la dirección de correo electrónico que proporciones en el
                        formulario una vez procesada.
                    </p>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <form action="#" method="POST" class="space-y-6">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <!-- RFC -->
                                <div class="col-span-1">
                                    <label for="rfc"
                                        class="block text-sm font-semibold text-gray-700 mb-1">RFC</label>
                                    <input type="text" name="rfc" id="rfc"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500 uppercase"
                                        placeholder="XAXX010101000">
                                </div>

                                <!-- Razón Social -->
                                <div class="col-span-1">
                                    <label for="razon_social"
                                        class="block text-sm font-semibold text-gray-700 mb-1">Razón Social / Nombre
                                        Completo</label>
                                    <input type="text" name="razon_social" id="razon_social"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="Como aparece en su constancia">
                                </div>

                                <!-- Régimen Fiscal -->
                                <div class="col-span-1">
                                    <label for="regimen" class="block text-sm font-semibold text-gray-700 mb-1">Régimen
                                        Fiscal</label>
                                    <select name="regimen" id="regimen"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500">
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
                                    <label for="uso_cfdi" class="block text-sm font-semibold text-gray-700 mb-1">Uso de
                                        CFDI</label>
                                    <select name="uso_cfdi" id="uso_cfdi"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="G03">G03 - Gastos en general</option>
                                        <option value="S01">S01 - Sin efectos fiscales</option>
                                        <option value="CP01">CP01 - Pagos</option>
                                    </select>
                                </div>

                                <!-- Código Postal -->
                                <div class="col-span-1">
                                    <label for="cp" class="block text-sm font-semibold text-gray-700 mb-1">Código
                                        Postal Fiscal</label>
                                    <input type="text" name="cp" id="cp"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="12345">
                                </div>

                                <!-- Email para envío -->
                                <div class="col-span-1">
                                    <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Email
                                        para envío de Factura</label>
                                    <input type="email" name="email" id="email"
                                        class="block w-full px-4 py-3 rounded-xl border-gray-200 focus:ring-indigo-500 focus:border-indigo-500"
                                        placeholder="tu@email.com">
                                </div>

                                <!-- File: Constancia -->
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Constancia de
                                        Situación Fiscal (PDF/Imagen)</label>
                                    <div
                                        class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 cursor-pointer bg-gray-50 transition-all">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-10 w-10 text-gray-400" stroke="currentColor"
                                                fill="none" viewBox="0 0 48 48">
                                                <path
                                                    d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                    stroke-width="2" stroke-linecap="round"
                                                    stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <span class="text-indigo-600 font-medium">Sube tu constancia</span>
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
                            <div class="pt-6">
                                <button type="button"
                                    class="w-full bg-indigo-600 text-white py-4 rounded-xl font-bold text-lg shadow-lg hover:bg-indigo-700 transition-all transform hover:scale-[1.01] active:scale-95">
                                    Enviar solicitud de factura
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
