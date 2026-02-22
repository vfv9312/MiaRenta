<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión del Footer</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Edita el contenido y diseño de la sección final de la página
                de inicio.</p>
        </div>
        <button wire:click="save" wire:loading.attr="disabled"
            class="inline-flex items-center gap-2 px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none disabled:opacity-50">
            <span wire:loading.remove wire:target="save" class="flex items-center gap-2">
                <i class="fas fa-save text-sm"></i>
                Guardar Cambios
            </span>
            <span wire:loading wire:target="save" class="flex items-center gap-2">
                <i class="fas fa-circle-notch fa-spin text-sm"></i>
                Guardando...
            </span>
        </button>
    </div>

    @if (session()->has('message'))
        <div
            class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400 animate-in fade-in slide-in-from-top-4 duration-300">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    @if (session()->has('error'))
        <div
            class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl flex items-center gap-3 text-red-700 dark:text-red-400 animate-in fade-in slide-in-from-top-4 duration-300">
            <i class="fas fa-exclamation-circle"></i>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Text Content -->
        <div class="lg:col-span-2 space-y-6">
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-6 border-b dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-align-left text-indigo-500"></i>
                        Contenido de Texto
                    </h3>
                </div>
                <div class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Título</label>
                            <input wire:model="title" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 dark:text-white"
                                placeholder="Ej: ¿Listo para tu próximo evento?">
                            @error('title')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="space-y-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Subtítulo</label>
                            <input wire:model="subtitle" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 dark:text-white"
                                placeholder="Ej: Contáctanos hoy mismo">
                            @error('subtitle')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300">Descripción</label>
                        <textarea wire:model="description" rows="4"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500 dark:text-white"
                            placeholder="Describe por qué son la mejor opción..."></textarea>
                        @error('description')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Buttons -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-6 border-b dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-link text-indigo-500"></i>
                        Botones de Acción
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <!-- Button 1 -->
                        <div
                            class="space-y-4 p-4 bg-indigo-50/30 dark:bg-indigo-900/10 rounded-2xl border border-indigo-100/50 dark:border-indigo-800/30">
                            <span class="text-xs font-bold text-indigo-500 tracking-widest uppercase italic">Botón
                                Principal</span>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Texto
                                        del Botón</label>
                                    <input wire:model="button_text" type="text"
                                        class="w-full bg-white dark:bg-gray-700 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 dark:text-white shadow-sm"
                                        placeholder="Ej: WhatsApp">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Enlace
                                        (URL)</label>
                                    <input wire:model="button_link" type="text"
                                        class="w-full bg-white dark:bg-gray-700 border-none rounded-xl text-sm focus:ring-2 focus:ring-indigo-500 dark:text-white shadow-sm"
                                        placeholder="Ej: https://wa.me/...">
                                </div>
                            </div>
                        </div>

                        <!-- Button 2 -->
                        <div
                            class="space-y-4 p-4 bg-amber-50/30 dark:bg-amber-900/10 rounded-2xl border border-amber-100/50 dark:border-amber-800/30">
                            <span class="text-xs font-bold text-amber-500 tracking-widest uppercase italic">Botón
                                Secundario</span>
                            <div class="space-y-3">
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Texto
                                        del Botón</label>
                                    <input wire:model="button_text_two" type="text"
                                        class="w-full bg-white dark:bg-gray-700 border-none rounded-xl text-sm focus:ring-2 focus:ring-amber-500 dark:text-white shadow-sm"
                                        placeholder="Ej: Facebook">
                                </div>
                                <div>
                                    <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Enlace
                                        (URL)</label>
                                    <input wire:model="button_link_two" type="text"
                                        class="w-full bg-white dark:bg-gray-700 border-none rounded-xl text-sm focus:ring-2 focus:ring-amber-500 dark:text-white shadow-sm"
                                        placeholder="Ej: https://facebook.com/...">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Images Sidebar -->
        <div class="space-y-6">
            <!-- Desktop Image -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-6 border-b dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-desktop text-indigo-500"></i>
                        Imagen Escritorio
                    </h3>
                </div>
                <div class="p-6">
                    <div
                        class="relative group aspect-video bg-gray-100 dark:bg-gray-700 rounded-2xl overflow-hidden border-2 border-dashed border-gray-200 dark:border-gray-600 flex flex-col items-center justify-center transition-all hover:border-indigo-400">
                        @if ($new_image)
                            <img src="{{ $new_image->temporaryUrl() }}"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full">Cambiar</span>
                            </div>
                        @elseif($image)
                            <img src="{{ asset('storage/' . $image) }}"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full">Cambiar</span>
                            </div>
                        @else
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-300"></i>
                            <span class="text-xs text-gray-400 mt-2">1920x1080 recomendado</span>
                        @endif
                        <input type="file" wire:model="new_image" class="absolute inset-0 opacity-0 cursor-pointer">
                        <div wire:loading wire:target="new_image"
                            class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 flex items-center justify-center">
                            <i class="fas fa-circle-notch fa-spin text-indigo-600"></i>
                        </div>
                    </div>
                    @error('new_image')
                        <span class="text-xs text-red-500 font-medium mt-2 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- Mobile Image -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden">
                <div class="p-6 border-b dark:border-gray-700 bg-gray-50/50 dark:bg-gray-700/30">
                    <h3 class="font-bold text-gray-900 dark:text-white flex items-center gap-2">
                        <i class="fas fa-mobile-alt text-indigo-500"></i>
                        Imagen Móvil
                    </h3>
                </div>
                <div class="p-6">
                    <div
                        class="relative group aspect-[9/16] max-w-[200px] mx-auto bg-gray-100 dark:bg-gray-700 rounded-2xl overflow-hidden border-2 border-dashed border-gray-200 dark:border-gray-600 flex flex-col items-center justify-center transition-all hover:border-indigo-400">
                        @if ($new_image_mobile)
                            <img src="{{ $new_image_mobile->temporaryUrl() }}"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full">Cambiar</span>
                            </div>
                        @elseif($image_mobile)
                            <img src="{{ asset('storage/' . $image_mobile) }}"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span
                                    class="text-white font-bold text-sm bg-black/50 px-3 py-1 rounded-full">Cambiar</span>
                            </div>
                        @else
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-300"></i>
                            <span class="text-xs text-gray-400 mt-2">1080x1920 recomendado</span>
                        @endif
                        <input type="file" wire:model="new_image_mobile"
                            class="absolute inset-0 opacity-0 cursor-pointer">
                        <div wire:loading wire:target="new_image_mobile"
                            class="absolute inset-0 bg-white/80 dark:bg-gray-800/80 flex items-center justify-center">
                            <i class="fas fa-circle-notch fa-spin text-indigo-600"></i>
                        </div>
                    </div>
                    @error('new_image_mobile')
                        <span class="text-xs text-red-500 font-medium mt-2 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
</div>
