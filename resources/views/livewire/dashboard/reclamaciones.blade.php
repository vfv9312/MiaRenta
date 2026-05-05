<div class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
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
                @if (session()->has('success'))
                    <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-600 text-green-700 dark:text-green-400 rounded-r-xl font-medium">
                        {{ session('success') }}
                    </div>
                @endif

                <form wire:submit.prevent="save" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 gap-y-8 gap-x-8 sm:grid-cols-2">
                        <!-- Full Name -->
                        <div class="sm:col-span-2">
                            <label for="nombre"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Nombre
                                Completo</label>
                            <input type="text" wire:model="nombre" id="nombre" autocomplete="name"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="Ej. Juan Pérez">
                            @error('nombre') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Email</label>
                            <input type="email" wire:model="email" id="email" autocomplete="email"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="juan@ejemplo.com">
                            @error('email') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label for="telefono"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Teléfono</label>
                            <input type="tel" wire:model="telefono" id="telefono" autocomplete="tel"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="961 123 4567">
                            @error('telefono') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Order Number -->
                        <div>
                            <label for="pedido"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Pedido
                                (Opcional)</label>
                            <input type="text" wire:model="pedido" id="pedido"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="#12345">
                            @error('pedido') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Type of Claim -->
                        <div>
                            <label for="asunto"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Asunto</label>
                            <select id="asunto" wire:model="asunto"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all">
                                <option value="Queja">Queja</option>
                                <option value="Reclamo">Reclamo</option>
                                <option value="Sugerencia">Sugerencia</option>
                                <option value="Otro">Otro</option>
                            </select>
                            @error('asunto') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Message -->
                        <div class="sm:col-span-2">
                            <label for="mensaje"
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Detalle</label>
                            <textarea id="mensaje" wire:model="mensaje" rows="5"
                                class="block w-full px-6 py-4 rounded-2xl border-gray-200 dark:border-zinc-700 dark:bg-black dark:text-white shadow-sm focus:ring-red-600 focus:border-red-600 transition-all placeholder-gray-400"
                                placeholder="Cuéntanos más para poder ayudarte..."></textarea>
                            @error('mensaje') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- File Upload -->
                        <div class="sm:col-span-2">
                            <label
                                class="block text-sm font-black text-gray-700 dark:text-gray-300 uppercase tracking-wider mb-2">Evidencia
                                (Opcional)</label>
                            <div
                                class="relative mt-2 flex justify-center px-8 pt-8 pb-8 border-2 border-dashed border-gray-200 dark:border-zinc-700 rounded-3xl hover:border-red-600 transition-all cursor-pointer bg-gray-50 dark:bg-black/50 group overflow-hidden">
                                <input id="evidencia" wire:model="evidencia" type="file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png">
                                <div class="space-y-4 text-center z-0">
                                    @if($evidencia)
                                        <svg class="mx-auto h-16 w-16 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <div class="flex flex-col text-sm text-gray-600 dark:text-gray-400">
                                            <span class="relative bg-transparent rounded-md font-black text-green-600 transition-colors">
                                                {{ $evidencia->getClientOriginalName() }}
                                            </span>
                                            <p class="mt-1">Archivo listo para enviar</p>
                                        </div>
                                    @else
                                        <svg class="mx-auto h-16 w-16 text-gray-400 group-hover:text-red-600 transition-colors"
                                            stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                            <path
                                                d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex flex-col text-sm text-gray-600 dark:text-gray-400">
                                            <span class="relative bg-transparent rounded-md font-black text-red-600 group-hover:text-red-700 transition-colors">
                                                <span>Sube un archivo aquí</span>
                                            </span>
                                            <p class="mt-1">PNG, JPG, PDF hasta 10MB</p>
                                        </div>
                                    @endif
                                    <div wire:loading wire:target="evidencia" class="text-xs text-red-600 mt-2 font-black">
                                        Cargando archivo...
                                    </div>
                                </div>
                            </div>
                            @error('evidencia') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-8">
                        <button type="submit"
                            class="w-full flex justify-center py-5 px-10 border border-transparent shadow-2xl text-xl font-black rounded-[2rem] text-white bg-red-600 hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-95 shadow-red-500/30">
                            <span wire:loading.remove wire:target="save">Enviar Reclamación</span>
                            <span wire:loading wire:target="save">Enviando...</span>
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
