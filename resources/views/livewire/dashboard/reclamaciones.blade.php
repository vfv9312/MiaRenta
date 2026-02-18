<div class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 min-h-screen">
    <div class="max-w-3xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-3xl font-extrabold text-gray-900 sm:text-4xl">
                Libro de Reclamaciones
            </h1>
            <p class="mt-4 text-lg text-gray-600">
                Tu opinión es muy importante para nosotros. Por favor, completa el siguiente formulario para hacernos
                llegar tu queja, sugerencia o reclamo.
            </p>
        </div>

        <!-- Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100">
            <div class="p-8 sm:p-10">
                <form action="#" method="POST" class="space-y-6">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-6 gap-x-6 sm:grid-cols-2">
                        <!-- Full Name -->
                        <div class="sm:col-span-2">
                            <label for="full-name" class="block text-sm font-semibold text-gray-700 mb-1">Nombre
                                Completo</label>
                            <input type="text" name="full-name" id="full-name" autocomplete="name"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Ej. Juan Pérez">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-1">Correo
                                Electrónico</label>
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="juan@ejemplo.com">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone" class="block text-sm font-semibold text-gray-700 mb-1">Teléfono de
                                Contacto</label>
                            <input type="tel" name="phone" id="phone" autocomplete="tel"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="999 123 4567">
                        </div>

                        <!-- Order Number -->
                        <div>
                            <label for="order-id" class="block text-sm font-semibold text-gray-700 mb-1">Nº de Pedido
                                (Opcional)</label>
                            <input type="text" name="order-id" id="order-id"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="#12345">
                        </div>

                        <!-- Type of Claim -->
                        <div>
                            <label for="claim-type" class="block text-sm font-semibold text-gray-700 mb-1">Tipo de
                                Requerimiento</label>
                            <select id="claim-type" name="claim-type"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
                                <option>Queja</option>
                                <option>Reclamo</option>
                                <option>Sugerencia</option>
                                <option>Otro</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="sm:col-span-2">
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-1">Detalle del
                                Reclamo o Sugerencia</label>
                            <textarea id="message" name="message" rows="4"
                                class="block w-full px-4 py-3 rounded-xl border-gray-200 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                                placeholder="Describe brevemente lo sucedido..."></textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="sm:col-span-2">
                            <label class="block text-sm font-semibold text-gray-700 mb-2">Adjuntar Evidencia (PDF o
                                Imágenes)</label>
                            <div
                                class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 transition-colors cursor-pointer bg-gray-50">
                                <div class="space-y-1 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none"
                                        viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex text-sm text-gray-600">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-transparent rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                            <span>Sube un archivo</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                        </label>
                                        <p class="pl-1 text-gray-500">o arrastra y suelta</p>
                                    </div>
                                    <p class="text-xs text-gray-500">PNG, JPG, PDF hasta 10MB</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-4">
                        <button type="button"
                            class="w-full inline-flex justify-center py-4 px-6 border border-transparent shadow-lg text-lg font-bold rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition-all transform hover:scale-[1.01] active:scale-95">
                            Enviar Reclamación
                        </button>
                    </div>

                    <p class="text-center text-xs text-gray-400 mt-6 italic">
                        Nota: Al enviar este formulario, se enviará una notificación a nuestro equipo de soporte para su
                        revisión inmediata.
                    </p>
                </form>
            </div>
        </div>

        <!-- Help Info -->
        <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="flex items-center p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
                <div class="p-3 bg-white rounded-xl shadow-sm mr-4">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Atención Directa</h3>
                    <p class="text-sm text-gray-600">Llámanos al (999) 123 4567</p>
                </div>
            </div>
            <div class="flex items-center p-6 bg-indigo-50 rounded-2xl border border-indigo-100">
                <div class="p-3 bg-white rounded-xl shadow-sm mr-4">
                    <svg class="h-6 w-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="font-bold text-gray-800">Tiempo de Respuesta</h3>
                    <p class="text-sm text-gray-600">Atendemos en menos de 24 horas hábiles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
