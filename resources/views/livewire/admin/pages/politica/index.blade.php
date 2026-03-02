<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-5xl mx-auto">

        {{-- Header --}}
        <header class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Gestión de Políticas
                </h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Edita los términos y condiciones de Mia Renta.
                </p>
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

            {{-- Sección 1: Métodos y Políticas de Pago --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-credit-card text-red-500"></i> Métodos y Políticas de Pago
                </h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Texto
                            introductorio</label>
                        <textarea wire:model="pagos_intro" rows="2"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                        @error('pagos_intro')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>

                    @foreach (['pagos_item_1' => 'Punto 1', 'pagos_item_2' => 'Punto 2', 'pagos_item_3' => 'Punto 3', 'pagos_item_4' => 'Punto 4'] as $field => $label)
                        <div class="flex items-start gap-3">
                            <span class="mt-2 w-2 h-2 bg-red-600 rounded-full flex-shrink-0"></span>
                            <div class="flex-1">
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">{{ $label }}</label>
                                <input wire:model="{{ $field }}" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white text-sm">
                                @error($field)
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Sección 2: Horarios y Reservaciones --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-calendar-alt text-red-500"></i> Horarios y Reservaciones
                </h3>
                <div class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Texto
                            introductorio</label>
                        <textarea wire:model="reservaciones_intro" rows="2"
                            class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                        @error('reservaciones_intro')
                            <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        {{-- Estándar --}}
                        <div class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border-l-4 border-red-600 space-y-3">
                            <div class="text-xs font-black text-red-500 uppercase tracking-widest mb-1">Anticipación
                                Estándar</div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Título</label>
                                <input wire:model="reservacion_estandar_titulo" type="text"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                                @error('reservacion_estandar_titulo')
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Texto</label>
                                <textarea wire:model="reservacion_estandar_texto" rows="2"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                                @error('reservacion_estandar_texto')
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- Urgente --}}
                        <div
                            class="bg-gray-50 dark:bg-gray-900/50 p-5 rounded-xl border-l-4 border-amber-500 space-y-3">
                            <div class="text-xs font-black text-amber-500 uppercase tracking-widest mb-1">Pedidos
                                Urgentes</div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Título</label>
                                <input wire:model="reservacion_urgente_titulo" type="text"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                                @error('reservacion_urgente_titulo')
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-xs font-bold text-gray-500 dark:text-gray-400 mb-1">Texto</label>
                                <textarea wire:model="reservacion_urgente_texto" rows="2"
                                    class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-sm focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                                @error('reservacion_urgente_texto')
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Sección 3: Entregas y Recolección --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-clock text-red-500"></i> Entregas y Recolección
                </h3>
                <textarea wire:model="entregas_texto" rows="3"
                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                @error('entregas_texto')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
            </div>

            {{-- Sección 4 & 5: Cancelaciones y Cuidado --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                        <i class="fas fa-ban text-red-500"></i> Cancelaciones
                    </h3>
                    <textarea wire:model="cancelaciones_texto" rows="4"
                        class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                    @error('cancelaciones_texto')
                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                    @enderror
                </div>
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                    <h3
                        class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                        <i class="fas fa-shield-alt text-red-500"></i> Cuidado del Mobiliario
                    </h3>
                    <textarea wire:model="cuidado_texto" rows="4"
                        class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white"></textarea>
                    @error('cuidado_texto')
                        <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            {{-- Footer nota --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-8">
                <h3
                    class="text-xl font-bold text-gray-900 dark:text-white mb-6 flex items-center gap-2 border-b dark:border-gray-700 pb-4">
                    <i class="fas fa-info-circle text-red-500"></i> Nota al Pie de Página
                </h3>
                <input wire:model="footer_nota" type="text"
                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-red-500 text-gray-900 dark:text-white">
                @error('footer_nota')
                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                @enderror
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
