<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Galería Pública</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona las imágenes que se muestran en la
                    sección de galería de tu sitio.</p>
            </div>

        </header>

        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-lime-100 border-l-4 border-lime-500 text-lime-700 shadow-sm rounded-r-lg flex items-center gap-3 animate-fade-in-down">
                <i class="fas fa-check-circle text-xl"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Formulario -->
            <div class="lg:col-span-4">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden sticky top-6">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white flex items-center gap-2">
                            <i class="fas {{ $isEdit ? 'fa-edit text-blue-500' : 'fa-plus-circle text-lime-500' }}"></i>
                            {{ $isEdit ? 'Editar Imagen' : 'Agregar Nueva Imagen' }}
                        </h2>
                    </div>

                    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'store' }}" class="p-6 space-y-5">
                        <!-- Título -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Título</label>
                            <input type="text" wire:model="title"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all dark:text-white"
                                placeholder="Ej: Boda en Jardín">
                            @error('title')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Subtítulo -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Subtítulo</label>
                            <input type="text" wire:model="subtitle"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all dark:text-white"
                                placeholder="Ej: Decoración Premium">
                            @error('subtitle')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Tipo/Categoría -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Categoría</label>
                            <select wire:model="type"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all dark:text-white">
                                <option value="paquetes">Paquetes</option>
                                <option value="sillas">Sillas</option>
                                <option value="mesas">Mesas</option>
                                <option value="manteleria">Mantelería</option>
                                <option value="cristaleria">Cristalería</option>
                                <option value="decoracion">Decoración</option>
                                <option value="fundas">Fundas</option>
                                <option value="inflables">Inflables</option>
                                <option value="otros">Otros</option>
                            </select>
                            @error('type')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</label>
                            <textarea wire:model="description" rows="3"
                                class="w-full px-4 py-2.5 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-lime-500 focus:border-lime-500 transition-all dark:text-white"
                                placeholder="Breve detalle de la imagen..."></textarea>
                            @error('description')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Imagen -->
                        <div>
                            <label
                                class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-2">Imagen</label>
                            <div class="relative group">
                                <div
                                    class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 dark:border-gray-600 border-dashed rounded-xl hover:border-lime-500 transition-colors cursor-pointer bg-gray-50 dark:bg-gray-900">
                                    <div class="space-y-1 text-center">
                                        <i
                                            class="fas fa-cloud-upload-alt text-3xl text-gray-400 group-hover:text-lime-500 transition-colors mb-2"></i>
                                        <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                            <label
                                                class="relative cursor-pointer rounded-md font-medium text-lime-600 hover:text-lime-500">
                                                <span>Subir archivo</span>
                                                <input type="file" wire:model="image" class="sr-only">
                                            </label>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG hasta 2MB</p>
                                    </div>
                                </div>
                                <div wire:loading wire:target="image"
                                    class="mt-2 text-xs text-lime-600 flex items-center gap-2">
                                    <i class="fas fa-spinner fa-spin"></i> Subiendo...
                                </div>
                            </div>
                            @error('image')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror

                            @if ($image)
                                <div
                                    class="mt-4 relative rounded-xl overflow-hidden aspect-video border border-gray-200 dark:border-gray-700">
                                    <img src="{{ $image->temporaryUrl() }}" class="w-full h-full object-cover">
                                    <button type="button" wire:click="$set('image', null)"
                                        class="absolute top-2 right-2 w-8 h-8 bg-black/50 text-white rounded-full flex items-center justify-center hover:bg-black/70 transition-colors">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            @endif
                        </div>

                        <div class="pt-4 flex items-center gap-3">
                            <button type="submit"
                                class="flex-1 px-6 py-3 bg-lime-600 hover:bg-lime-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-lime-200 dark:shadow-none flex items-center justify-center gap-2">
                                <i class="fas {{ $isEdit ? 'fa-sync-alt' : 'fa-save' }}"></i>
                                {{ $isEdit ? 'Actualizar' : 'Guardar Imagen' }}
                            </button>
                            @if ($isEdit)
                                <button type="button" wire:click="resetFields"
                                    class="px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-xl transition-all">
                                    Cancelar
                                </button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>

            <!-- Listado -->
            <div class="lg:col-span-8">
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
                    <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Imágenes en Galería</h2>
                        <span
                            class="px-3 py-1 bg-lime-100 text-lime-700 text-xs font-bold rounded-full">{{ count($publicGalleries) }}
                            items</span>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50 dark:bg-gray-900/50">
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Imagen</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Info</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                        Categoría</th>
                                    <th
                                        class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">
                                        Acciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                @forelse ($publicGalleries as $gallery)
                                    <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div
                                                class="w-20 h-20 rounded-xl overflow-hidden border border-gray-100 dark:border-gray-700 shadow-sm">
                                                <img src="{{ asset($gallery->path) }}" alt="{{ $gallery->title }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="text-sm font-bold text-gray-900 dark:text-white">
                                                {{ $gallery->title }}</div>
                                            <div class="text-xs text-gray-500 dark:text-gray-400">
                                                {{ $gallery->subtitle }}</div>
                                            <div class="text-[10px] text-gray-400 mt-1 line-clamp-1 italic">
                                                "{{ $gallery->description }}"</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-2.5 py-1 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-300 text-[10px] font-bold rounded-lg uppercase tracking-wide border border-gray-200 dark:border-gray-600">
                                                {{ $gallery->type }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <div class="flex items-center justify-end gap-2">
                                                <button wire:click="edit({{ $gallery->id }})"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-blue-50 text-blue-600 hover:bg-blue-600 hover:text-white transition-all shadow-sm"
                                                    title="Editar">
                                                    <i class="fas fa-edit text-sm"></i>
                                                </button>
                                                <button wire:click="confirmDelete({{ $gallery->id }})"
                                                    class="w-9 h-9 flex items-center justify-center rounded-lg bg-red-50 text-red-600 hover:bg-red-600 hover:text-white transition-all shadow-sm"
                                                    title="Eliminar">
                                                    <i class="fas fa-trash-alt text-sm"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4"
                                            class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                            <div class="flex flex-col items-center gap-2">
                                                <i class="fas fa-images text-4xl text-gray-200 mb-2"></i>
                                                <p class="font-medium text-lg">No hay imágenes en la galería</p>
                                                <p class="text-sm">Empieza agregando una nueva imagen desde el
                                                    formulario.</p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('partials.modalDelete')
</div>
