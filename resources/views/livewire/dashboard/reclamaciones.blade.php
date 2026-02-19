<div class="py-12 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
    <div class="max-w-4xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1
                class="text-4xl font-black text-gray-900 dark:text-white sm:text-5xl border-b-8 border-red-600 inline-block pb-4 rounded-b-xl">
                Libro de Reclamaciones
            </h1>
            <p class="mt-8 text-xl text-gray-600 dark:text-gray-400 font-medium">
                Tu opinión es vital para nuestra mejora continua. <br>
                Háznoslo saber y <span class="text-red-600 font-black">lo solucionaremos</span>.
            </p>
        </div>

        <!-- Form Card -->
        <div
            class="bg-white dark:bg-zinc-900 rounded-[3rem] shadow-2xl overflow-hidden border border-gray-100 dark:border-zinc-800 transition-all duration-300">
            <div class="p-8 sm:p-14">
                <form action="#" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-8 gap-x-8 sm:grid-cols-2">
                        <!-- Full Name -->
                        <div class="sm:col-span-2">
                            <label for="full-name"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Nombre
                                Completo</label>
                            <input type="text" name="full-name" id="full-name" autocomplete="name"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="Ej. Juan Pérez">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" name="email" id="email" autocomplete="email"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="juan@ejemplo.com">
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="phone"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Teléfono</label>
                            <input type="tel" name="phone" id="phone" autocomplete="tel"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="961 123 4567">
                        </div>

                        <!-- Order Number -->
                        <div>
                            <label for="order-id"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Pedido
                                (Opcional)</label>
                            <input type="text" name="order-id" id="order-id"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="#12345">
                        </div>

                        <!-- Type of Claim -->
                        <div>
                            <label for="claim-type"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Asunto</label>
                            <select id="claim-type" name="claim-type"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all">
                                <option>Queja</option>
                                <option>Reclamo</option>
                                <option>Sugerencia</option>
                                <option>Otro</option>
                            </select>
                        </div>

                        <!-- Message -->
                        <div class="sm:col-span-2">
                            <label for="message"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Detalle</label>
                            <textarea id="message" name="message" rows="5"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="Cuéntanos más para poder ayudarte..."></textarea>
                        </div>

                        <!-- File Upload -->
                        <div class="sm:col-span-2">
                            <label
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Evidencia
                                (Opcional)</label>
                            <div
                                class="mt-2 flex justify-center px-8 pt-8 pb-8 border-2 border-dashed border-gray-200 dark:border-zinc-700 rounded-3xl hover:border-red-600 transition-all cursor-pointer bg-gray-50 dark:bg-black/50 group">
                                <div class="space-y-4 text-center">
                                    <svg class="mx-auto h-16 w-16 text-gray-400 group-hover:text-red-600 transition-colors"
                                        stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                        <path
                                            d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <div class="flex flex-col text-sm text-gray-600 dark:text-gray-400">
                                        <label for="file-upload"
                                            class="relative cursor-pointer bg-transparent rounded-md font-black text-red-600 hover:text-red-700 focus-within:outline-none transition-colors">
                                            <span>Sube un archivo aquí</span>
                                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                                        </label>
                                        <p class="mt-1">PNG, JPG, PDF hasta 10MB</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-8">
                        <button type="button"
                            class="w-full flex justify-center py-5 px-10 border border-transparent shadow-2xl text-xl font-black rounded-[2rem] text-white bg-red-600 hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-95 shadow-red-500/30">
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
        <div class="mt-16 grid grid-cols-1 md:grid-cols-2 gap-8">
            <div
                class="flex items-center p-8 bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-gray-100 dark:border-zinc-800 shadow-xl">
                <div class="p-4 bg-red-600 rounded-2xl shadow-lg shadow-red-500/30 text-white mr-6">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                        </path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-1">Atención Directa</h3>
                    <p class="text-gray-600 dark:text-gray-400">961 123 4567</p>
                </div>
            </div>
            <div
                class="flex items-center p-8 bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-gray-100 dark:border-zinc-800 shadow-xl">
                <div class="p-4 bg-red-600 rounded-2xl shadow-lg shadow-red-500/30 text-white mr-6">
                    <svg class="h-8 w-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-xl font-black text-gray-900 dark:text-white mb-1">Respuesta Rápida</h3>
                    <p class="text-gray-600 dark:text-gray-400">Menos de 24 horas hábiles.</p>
                </div>
            </div>
        </div>
    </div>
</div>
