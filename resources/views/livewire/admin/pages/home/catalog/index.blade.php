<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="mb-8 flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Gestión de Catálogo</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Modifica los títulos, iconos y enlaces de la
                    sección de categorías del inicio.</p>
            </div>
            <button wire:click="save"
                class="inline-flex items-center gap-2 px-8 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-save"></i>
                <span>Guardar Cambios</span>
            </button>
        </header>

        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <div class="space-y-8">
            <!-- Información General -->
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2">
                    <i class="fas fa-info-circle text-indigo-500"></i>
                    Información General
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título de la
                            Sección</label>
                        <input wire:model="title" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500"
                            placeholder="Ej: Nuestro Catálogo">
                        @error('title')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Subtítulo</label>
                        <input wire:model="subtitle" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500"
                            placeholder="Breve descripción de la sección...">
                        @error('subtitle')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Grid de Tarjetas -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                @php
                    $cards = [
                        ['id' => 'one', 'label' => 'Tarjeta 1', 'color' => 'indigo'],
                        ['id' => 'two', 'label' => 'Tarjeta 2', 'color' => 'emerald'],
                        ['id' => 'three', 'label' => 'Tarjeta 3', 'color' => 'amber'],
                        ['id' => 'four', 'label' => 'Tarjeta 4', 'color' => 'rose'],
                    ];
                @endphp

                @foreach ($cards as $card)
                    <div
                        class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8 transition-all hover:shadow-md">
                        <div class="flex items-center justify-between mb-6">
                            <h3 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                                <span
                                    class="w-8 h-8 rounded-lg bg-{{ $card['color'] }}-100 dark:bg-{{ $card['color'] }}-900/30 flex items-center justify-center text-{{ $card['color'] }}-600 font-black text-sm">
                                    {{ $loop->iteration }}
                                </span>
                                {{ $card['label'] }}
                            </h3>
                            <label class="relative inline-flex items-center cursor-pointer">
                                <input wire:model="status_{{ $card['id'] }}" type="checkbox" class="sr-only peer">
                                <div
                                    class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-{{ $card['color'] }}-600">
                                </div>
                            </label>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Clase
                                        del Icono (FontAwesome)</label>
                                    <div class="relative">
                                        <div
                                            class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="{{ ${'icon_' . $card['id']} }} text-gray-400"></i>
                                        </div>
                                        <input wire:model="icon_{{ $card['id'] }}" type="text"
                                            class="w-full pl-10 bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-{{ $card['color'] }}-500"
                                            placeholder="fas fa-chair">
                                    </div>
                                    @error('icon_' . $card['id'])
                                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título
                                        de la Tarjeta</label>
                                    <input wire:model="title_button_{{ $card['id'] }}" type="text"
                                        class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-{{ $card['color'] }}-500"
                                        placeholder="Ej: Sillas">
                                    @error('title_button_' . $card['id'])
                                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label
                                        class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Descripción
                                        / Texto</label>
                                    <textarea wire:model="text_button_{{ $card['id'] }}" rows="2"
                                        class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-{{ $card['color'] }}-500"
                                        placeholder="Breve descripción..."></textarea>
                                    @error('text_button_' . $card['id'])
                                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div>
                                    <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">URL de
                                        Destino</label>
                                    <input wire:model="button_url_{{ $card['id'] }}" type="text"
                                        class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-{{ $card['color'] }}-500"
                                        placeholder="Ej: /catalogo/sillas o #">
                                    @error('button_url_' . $card['id'])
                                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <footer class="mt-12 flex justify-end">
            <button wire:click="save"
                class="inline-flex items-center gap-2 px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-2xl transition-all shadow-xl shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-save text-lg"></i>
                <span>Guardar Todos los Cambios</span>
            </button>
        </footer>
    </div>
</div>
