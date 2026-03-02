<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <header class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Gestión de Facturación
                </h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Edita las instrucciones y el texto informativo
                    de la página de facturación.</p>
            </div>
            <button wire:click="save"
                class="inline-flex items-center gap-2 px-8 py-3 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-red-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-save"></i>
                <span wire:loading.remove wire:target="save">Guardar Cambios</span>
                <span wire:loading wire:target="save">Guardando...</span>
            </button>
        </header>

        {{-- Flash Messages --}}
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

            {{-- Instrucciones --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-list-ol text-red-500"></i> Instrucciones
                </h3>
                <div class="space-y-5">

                    {{-- Instrucción 1 --}}
                    <div class="flex items-start gap-4">
                        <span
                            class="mt-2 flex-shrink-0 bg-red-600 text-white rounded-lg w-7 h-7 flex items-center justify-center text-xs font-black">1</span>
                        <div class="flex-1">
                            <input wire:model="instruccion_1" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Instrucción 1">
                            @error('instruccion_1')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instrucción 2 --}}
                    <div class="flex items-start gap-4">
                        <span
                            class="mt-2 flex-shrink-0 bg-red-600 text-white rounded-lg w-7 h-7 flex items-center justify-center text-xs font-black">2</span>
                        <div class="flex-1">
                            <input wire:model="instruccion_2" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Instrucción 2">
                            @error('instruccion_2')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instrucción 3 --}}
                    <div class="flex items-start gap-4">
                        <span
                            class="mt-2 flex-shrink-0 bg-red-600 text-white rounded-lg w-7 h-7 flex items-center justify-center text-xs font-black">3</span>
                        <div class="flex-1">
                            <input wire:model="instruccion_3" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Instrucción 3">
                            @error('instruccion_3')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    {{-- Instrucción 4 --}}
                    <div class="flex items-start gap-4">
                        <span
                            class="mt-2 flex-shrink-0 bg-red-600 text-white rounded-lg w-7 h-7 flex items-center justify-center text-xs font-black">4</span>
                        <div class="flex-1">
                            <input wire:model="instruccion_4" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                                placeholder="Instrucción 4">
                            @error('instruccion_4')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                </div>
            </div>

            {{-- Bloque FAQ --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-question-circle text-red-500"></i> Bloque Informativo (FAQ)
                </h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Título</label>
                        <input wire:model="faq_title" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                            placeholder="¿Dónde recibo mi factura?">
                        @error('faq_title')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Texto /
                            Descripción</label>
                        <textarea wire:model="faq_body" rows="4"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"
                            placeholder="Se enviará automáticamente..."></textarea>
                        @error('faq_body')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>

        </div>

        {{-- Footer Save Button --}}
        <footer class="mt-10 flex justify-end">
            <button wire:click="save"
                class="inline-flex items-center gap-3 px-10 py-4 bg-gray-900 hover:bg-black dark:bg-red-600 dark:hover:bg-red-700 text-white font-bold rounded-2xl transition-all shadow-xl hover:shadow-2xl hover:-translate-y-1">
                <i class="fas fa-save text-xl"></i>
                <span class="text-lg" wire:loading.remove wire:target="save">Guardar Toda la Información</span>
                <span class="text-lg" wire:loading wire:target="save">Guardando...</span>
            </button>
        </footer>

    </div>
</div>
