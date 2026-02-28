    <!-- Modal Form -->
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto animate-in fade-in zoom-in duration-200">
                <div class="p-6 border-b dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $carousel_id ? 'Editar Slide' : 'Nuevo Slide' }}</h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500"><i
                            class="fas fa-times"></i></button>
                </div>

                <div class="p-6 space-y-6">
                    <!-- Status Toggle -->
                    <div class="flex items-center justify-between p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl">
                        <div>
                            <span class="block font-bold text-gray-900 dark:text-white">Estado del Slide</span>
                            <span
                                class="text-sm text-gray-500">{{ $activo ? 'El slide será visible públicamente' : 'El slide estará oculto' }}</span>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input wire:model="activo" type="checkbox" class="sr-only peer">
                            <div
                                class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-indigo-600">
                            </div>
                        </label>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Título</label>
                                <input wire:model="titulo" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500"
                                    placeholder="Ej: Las mejores rentas">
                                @error('titulo')
                                    <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                                @enderror
                            </div>
                            <div>
                                <label
                                    class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Descripción</label>
                                <textarea wire:model="descripcion" rows="3"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl focus:ring-2 focus:ring-indigo-500"
                                    placeholder="Breve descripción del slide..."></textarea>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Imagen del
                                Slide</label>
                            <div
                                class="relative group h-40 bg-gray-100 dark:bg-gray-700 rounded-xl overflow-hidden border-2 border-dashed border-gray-200 dark:border-gray-600 flex flex-col items-center justify-center">
                                @if ($new_imagen)
                                    <img src="{{ $new_imagen->temporaryUrl() }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                @elseif($imagen)
                                    <img src="{{ asset($imagen) }}"
                                        class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-300"></i>
                                    <span class="text-xs text-gray-400 mt-2">Haz clic para subir</span>
                                @endif
                                <input type="file" wire:model="new_imagen"
                                    class="absolute inset-0 opacity-0 cursor-pointer">
                            </div>
                            @error('new_imagen')
                                <span class="text-xs text-red-500 font-medium">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="border-t dark:border-gray-700 pt-6">
                        <h4 class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-4">Botones de Acción
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-3">
                                <span class="text-xs font-bold text-indigo-500">BOTÓN 1</span>
                                <input wire:model="boton_texto" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-sm"
                                    placeholder="Texto (ej: Ver más)">
                                <input wire:model="boton_url" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-sm"
                                    placeholder="URL (ej: /nosotros)">
                            </div>
                            <div class="space-y-3">
                                <span class="text-xs font-bold text-amber-500">BOTÓN 2</span>
                                <input wire:model="boton_texto_two" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-sm"
                                    placeholder="Texto">
                                <input wire:model="boton_url_two" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border-none rounded-xl text-sm"
                                    placeholder="URL">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-6 bg-gray-50 dark:bg-gray-900 border-t dark:border-gray-700 flex justify-end gap-3">
                    <button wire:click="closeModal"
                        class="px-6 py-2.5 text-gray-500 hover:text-gray-700 font-bold transition-colors">Cancelar</button>
                    <button wire:click="store"
                        class="px-8 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none">Guardar
                        Slide</button>
                </div>
            </div>
        </div>
    @endif
