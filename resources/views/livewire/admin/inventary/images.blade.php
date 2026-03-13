<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Imágenes del Inventario</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona fotos de productos individuales y combinaciones.</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-plus"></i> Subir Imagen
            </button>
        </header>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Search -->
        <div class="mb-6">
            <div class="relative max-w-md">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" wire:model.live="search"
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                    placeholder="Buscar por nombre de producto o combinación...">
            </div>
        </div>

        <!-- Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @forelse ($images as $img)
                <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden group">
                    <div class="aspect-square relative overflow-hidden bg-gray-100 dark:bg-gray-900">
                        <img src="{{ asset($img->imagen) }}" alt="Imagen" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">

                        {{-- Badge --}}
                        @if ($img->combinacion_id)
                            <span class="absolute top-3 left-3 bg-purple-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                <i class="fas fa-layer-group mr-1"></i> Combinación
                            </span>
                        @else
                            <span class="absolute top-3 left-3 bg-indigo-600 text-white text-xs font-bold px-3 py-1 rounded-full shadow">
                                <i class="fas fa-cube mr-1"></i> Producto
                            </span>
                        @endif

                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                            <button wire:click="edit({{ $img->id }})" class="p-3 bg-white/20 backdrop-blur-md rounded-full text-white hover:bg-white/40 transition-colors">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button wire:click="confirmDelete({{ $img->id }})" class="p-3 bg-red-500/80 backdrop-blur-md rounded-full text-white hover:bg-red-600 transition-colors">
                                <i class="fas fa-trash-alt"></i>
                            </button>
                        </div>
                    </div>
                    <div class="p-4 border-t border-gray-50 dark:border-gray-700">
                        @if ($img->producto_id)
                            <h4 class="font-bold text-gray-900 dark:text-white truncate">{{ $img->producto->nombre ?? 'N/A' }}</h4>
                        @elseif ($img->combinacion_id)
                            <h4 class="font-bold text-gray-900 dark:text-white truncate">{{ $img->combinacion->nombre ?? 'N/A' }}</h4>
                            <div class="mt-1 flex flex-wrap gap-1">
                                @foreach ($img->combinacion->productos as $prod)
                                    <span class="text-xs bg-purple-50 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300 px-2 py-0.5 rounded-full">{{ $prod->nombre }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-span-full py-12 text-center text-gray-500 dark:text-gray-400 bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-200 dark:border-gray-600">
                    <div class="flex flex-col items-center gap-3">
                        <i class="fas fa-images text-4xl text-gray-300 dark:text-gray-600"></i>
                        <p class="text-lg font-medium">No se encontraron imágenes</p>
                    </div>
                </div>
            @endforelse
        </div>

        <div class="mt-8">
            {{ $images->links() }}
        </div>
    </div>

    {{-- ===================== MODAL FORM ===================== --}}
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full animate-in fade-in zoom-in duration-200 overflow-y-auto max-h-[90vh]">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $item_id ? 'Editar Imagen' : 'Subir Nueva Imagen' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="store" class="p-6 space-y-5">

                    {{-- Tipo toggle --}}
                    @if (!$item_id)
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-3">Tipo de Imagen</label>
                            <div class="grid grid-cols-2 gap-3">
                                <button type="button" wire:click="$set('tipo_imagen', 'producto')"
                                    class="p-3 rounded-xl border-2 text-center font-bold transition-all {{ $tipo_imagen === 'producto' ? 'border-indigo-500 bg-indigo-50 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400' : 'border-gray-200 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-gray-300' }}">
                                    <i class="fas fa-cube mb-1 text-lg block"></i>
                                    Producto Individual
                                </button>
                                <button type="button" wire:click="$set('tipo_imagen', 'combinacion')"
                                    class="p-3 rounded-xl border-2 text-center font-bold transition-all {{ $tipo_imagen === 'combinacion' ? 'border-purple-500 bg-purple-50 dark:bg-purple-900/30 text-purple-600 dark:text-purple-400' : 'border-gray-200 dark:border-gray-600 text-gray-500 dark:text-gray-400 hover:border-gray-300' }}">
                                    <i class="fas fa-layer-group mb-1 text-lg block"></i>
                                    Combinación
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- ===== PRODUCTO INDIVIDUAL ===== --}}
                    @if ($tipo_imagen === 'producto')
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Producto</label>
                            <select wire:model="producto_id" class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $p)
                                    <option value="{{ $p->id }}">{{ $p->nombre }}</option>
                                @endforeach
                            </select>
                            @error('producto_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    @endif

                    {{-- ===== COMBINACIÓN ===== --}}
                    @if ($tipo_imagen === 'combinacion')
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre de la Combinación</label>
                            <input wire:model="combinacion_nombre" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Ej: Mesa Tablón + Mantel Azul + Camino Dorado">
                            @error('combinacion_nombre') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Descripción <span class="text-gray-400 font-normal">(opcional)</span></label>
                            <textarea wire:model="combinacion_descripcion" rows="2"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-purple-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Describe la combinación..."></textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Productos que componen la combinación <span class="text-xs text-gray-400">(mín. 2)</span></label>
                            <div class="max-h-48 overflow-y-auto border border-gray-200 dark:border-gray-600 rounded-xl p-3 space-y-2 bg-gray-50 dark:bg-gray-700">
                                @foreach($productos as $p)
                                    <label class="flex items-center gap-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-colors">
                                        <input type="checkbox" value="{{ $p->id }}" wire:model="selectedProductos"
                                            class="w-4 h-4 text-purple-600 border-gray-300 rounded focus:ring-purple-500">
                                        <span class="text-sm text-gray-900 dark:text-white font-medium">{{ $p->nombre }}</span>
                                    </label>
                                @endforeach
                            </div>
                            @error('selectedProductos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror

                            @if (count($selectedProductos) > 0)
                                <div class="mt-2 flex flex-wrap gap-1">
                                    @foreach($productos->whereIn('id', $selectedProductos) as $sp)
                                        <span class="text-xs bg-purple-100 dark:bg-purple-900/40 text-purple-700 dark:text-purple-300 px-2 py-1 rounded-full font-medium">{{ $sp->nombre }}</span>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    @endif

                    {{-- ===== IMAGEN (siempre visible) ===== --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Imagen</label>
                        <input type="file" wire:model="imagen" class="w-full text-sm text-gray-500 dark:text-gray-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-sm file:font-bold file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 dark:file:bg-gray-700 dark:file:text-gray-300 transition-colors">
                        @error('imagen') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror

                        @if ($imagen)
                            <div class="mt-4 p-2 border border-gray-100 dark:border-gray-700 rounded-xl bg-gray-50 dark:bg-gray-900">
                                <p class="text-xs text-gray-500 mb-2">Previsualización:</p>
                                <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-48 object-cover rounded-lg">
                            </div>
                        @endif
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" wire:loading.attr="disabled"
                            class="px-6 py-2.5 {{ $tipo_imagen === 'combinacion' ? 'bg-purple-600 hover:bg-purple-700 shadow-purple-200' : 'bg-indigo-600 hover:bg-indigo-700 shadow-indigo-200' }} text-white font-bold rounded-xl transition-colors shadow-lg dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-cloud-upload-alt" wire:loading.remove></i>
                            <i class="fas fa-spinner fa-spin" wire:loading></i>
                            <span>{{ $item_id ? 'Actualizar' : 'Subir Imagen' }}</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===================== DELETE MODAL ===================== --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="$set('showDeleteModal', false)"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center animate-in fade-in zoom-in duration-200">
                <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">¿Eliminar imagen?</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">Esta acción marcará la imagen como eliminada.</p>
                <div class="flex gap-3">
                    <button wire:click="$set('showDeleteModal', false)" class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-bold rounded-xl transition-colors w-full">
                        Cancelar
                    </button>
                    <button wire:click="delete" class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-red-200 dark:shadow-none w-full">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
