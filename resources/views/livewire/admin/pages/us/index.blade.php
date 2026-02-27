<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Gestión de Nosotros</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Personaliza la historia, misión, visión y
                    valores de la empresa.</p>
            </div>
            <button wire:click="save"
                class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-red-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-save"></i>
                <span wire:loading.remove wire:target="save">Guardar Cambios</span>
                <span wire:loading wire:target="save">Guardando...</span>
            </button>
        </header>

        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif
        @if (session()->has('error'))
            <div
                class="mb-6 p-4 bg-red-50 dark:bg-red-900/30 border border-red-200 dark:border-red-800 rounded-xl flex items-center gap-3 text-red-700 dark:text-red-400">
                <i class="fas fa-exclamation-triangle"></i>
                <span class="font-medium">{{ session('error') }}</span>
            </div>
        @endif

        <div class="space-y-8">

            <!-- Banner Section -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-image text-red-500"></i> Banner Principal
                </h3>
                <div class="grid grid-cols-1 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título del
                            Banner</label>
                        <input wire:model="banner_title" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                        @error('banner_title')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Subtítulo del
                            Banner</label>
                        <textarea wire:model="banner_subtitle" rows="2"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                        @error('banner_subtitle')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- History Section -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-book-open text-red-500"></i> Sección de Historia
                </h3>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título de
                                Historia</label>
                            <input wire:model="history_title" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                            @error('history_title')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Texto de
                                Historia</label>
                            <textarea wire:model="history_text" rows="8"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                            @error('history_text')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Imagen
                                Representativa</label>
                            <div class="flex flex-col sm:flex-row items-center gap-4">
                                <div class="relative group">
                                    @if ($new_history_image)
                                        <img src="{{ $new_history_image->temporaryUrl() }}"
                                            class="w-48 h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                                    @elseif($history_image)
                                        <img src="{{ asset('storage/' . $history_image) }}"
                                            class="w-48 h-48 object-cover rounded-xl border border-gray-200 dark:border-gray-700 shadow-sm">
                                    @else
                                        <div
                                            class="w-48 h-48 bg-gray-50 dark:bg-gray-900 flex flex-col items-center justify-center rounded-xl border-2 border-dashed border-gray-300 dark:border-gray-600 hover:border-red-500 transition-colors">
                                            <i class="fas fa-image text-gray-400 text-4xl mb-2"></i>
                                            <span class="text-sm text-gray-500 font-medium">Sin Imagen</span>
                                        </div>
                                    @endif
                                </div>
                                <div class="flex-1 w-full sm:w-auto">
                                    <label
                                        class="cursor-pointer flex items-center justify-center gap-2 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-700 dark:text-gray-300 px-4 py-3 rounded-xl text-sm font-bold hover:bg-gray-50 dark:hover:bg-gray-600 hover:text-red-600 dark:hover:text-red-400 transition-all w-full text-center">
                                        <i class="fas fa-upload"></i> Subir Nueva Imagen
                                        <input type="file" wire:model="new_history_image" class="hidden">
                                    </label>
                                    <p class="text-xs text-gray-500 mt-2 text-center sm:text-left">Formatos: JPG, PNG.
                                        Max: 2MB.</p>
                                </div>
                            </div>
                            @error('new_history_image')
                                <span class="text-xs text-red-500 font-medium block mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <div
                            class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700">
                            <div
                                class="col-span-1 md:col-span-2 text-sm font-bold text-gray-700 dark:text-gray-300 mb-1 border-b dark:border-gray-700 pb-2">
                                <i class="fas fa-chart-line text-red-500 mr-1"></i> Métrica Destacada (Estadística)
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2">Dato
                                    Destacado (#)</label>
                                <input wire:model="history_stat_number" type="text"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                    placeholder="Ej: +10">
                            </div>
                            <div>
                                <label class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-2">Dato
                                    Destacado (Texto)</label>
                                <input wire:model="history_stat_text" type="text"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                    placeholder="Años en el mercado">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Mission and Vision -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-bullseye text-red-500"></i> Misión y Visión
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div
                        class="bg-blue-50/50 dark:bg-blue-900/10 p-6 rounded-xl border border-blue-100 dark:border-blue-900/30">
                        <label class="flex items-center gap-2 text-lg font-bold text-blue-800 dark:text-blue-400 mb-4">
                            <i class="fas fa-rocket"></i> Texto Misión
                        </label>
                        <textarea wire:model="mission_text" rows="5"
                            class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-blue-500 text-gray-900 dark:text-white"></textarea>
                        @error('mission_text')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div
                        class="bg-emerald-50/50 dark:bg-emerald-900/10 p-6 rounded-xl border border-emerald-100 dark:border-emerald-900/30">
                        <label
                            class="flex items-center gap-2 text-lg font-bold text-emerald-800 dark:text-emerald-400 mb-4">
                            <i class="fas fa-eye"></i> Texto Visión
                        </label>
                        <textarea wire:model="vision_text" rows="5"
                            class="w-full bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-emerald-500 text-gray-900 dark:text-white"></textarea>
                        @error('vision_text')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Values -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-star text-red-500"></i> Valores Core
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <!-- Valor 1 -->
                    <div
                        class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700 space-y-4 hover:border-red-200 dark:hover:border-red-900 transition-colors">
                        <div class="flex items-center gap-2 text-red-500 font-black mb-2">
                            <div
                                class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                1</div>
                            VALOR PRINCIPAL
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Título</label>
                            <input wire:model="value_1_title" type="text"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Ej: Integridad">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea wire:model="value_1_desc" rows="2"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Trato honesto..."></textarea>
                        </div>
                    </div>

                    <!-- Valor 2 -->
                    <div
                        class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700 space-y-4 hover:border-red-200 dark:hover:border-red-900 transition-colors">
                        <div class="flex items-center gap-2 text-red-500 font-black mb-2">
                            <div
                                class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                2</div>
                            SEGUNDO VALOR
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Título</label>
                            <input wire:model="value_2_title" type="text"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Ej: Calidad">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea wire:model="value_2_desc" rows="2"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Equipo impecable..."></textarea>
                        </div>
                    </div>

                    <!-- Valor 3 -->
                    <div
                        class="bg-gray-50 dark:bg-gray-900/50 p-6 rounded-xl border border-gray-100 dark:border-gray-700 space-y-4 hover:border-red-200 dark:hover:border-red-900 transition-colors">
                        <div class="flex items-center gap-2 text-red-500 font-black mb-2">
                            <div
                                class="w-8 h-8 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center">
                                3</div>
                            TERCER VALOR
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Título</label>
                            <input wire:model="value_3_title" type="text"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Ej: Cercanía">
                        </div>
                        <div>
                            <label
                                class="block text-xs font-bold text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                            <textarea wire:model="value_3_desc" rows="2"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="De Tuxtla para Tuxtla..."></textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-mouse-pointer text-red-500"></i> Llamado a la Acción (CTA)
                </h3>
                <div
                    class="bg-gradient-to-r from-gray-50 to-gray-100 dark:from-gray-900/50 dark:to-gray-800 p-6 rounded-xl border border-gray-200 dark:border-gray-700">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título de
                                CTA</label>
                            <input wire:model="cta_title" type="text"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Texto del
                                Botón</label>
                            <input wire:model="cta_button_text" type="text"
                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Redirección
                                del Botón (URL)</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <i class="fas fa-link text-gray-400"></i>
                                </div>
                                <input wire:model="cta_button_url" type="text"
                                    class="w-full pl-10 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                    placeholder="Ej: /#servicios">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <footer class="mt-12 flex justify-end">
            <button wire:click="save"
                class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 hover:bg-black dark:bg-red-600 dark:hover:bg-red-700 text-white font-bold rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-save text-xl"></i>
                <span class="text-lg" wire:loading.remove wire:target="save">Guardar Toda la Información</span>
                <span class="text-lg" wire:loading wire:target="save">Guardando...</span>
            </button>
        </footer>
    </div>
</div>
