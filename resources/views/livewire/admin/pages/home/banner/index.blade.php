<div class="px-4 py-8 max-w-7xl mx-auto">
    <div class="flex items-center justify-between mb-8">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Gestión del Banner Principal</h2>
            <p class="text-gray-500 dark:text-gray-400 mt-1">Añade o edita los slides que aparecen en el carrusel de
                inicio.</p>
        </div>
        <button wire:click="create"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-medium rounded-lg transition-colors shadow-sm">
            <i class="fas fa-plus text-xs"></i>
            <span>Nuevo Slide</span>
        </button>
    </div>

    @if (session()->has('message'))
        <div
            class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
            <i class="fas fa-check-circle"></i>
            <span class="font-medium">{{ session('message') }}</span>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach ($items as $item)
            <div
                class="bg-white dark:bg-gray-800 rounded-xl border border-gray-100 dark:border-gray-700 shadow-sm overflow-hidden group">
                <div class="relative h-48 bg-gray-100 dark:bg-gray-700">
                    @if ($item->imagen)
                        <img src="{{ asset($item->imagen) }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                            <i class="fas fa-image text-3xl"></i>
                        </div>
                    @endif
                    <div
                        class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center gap-3">
                        <button wire:click="edit({{ $item->id }})"
                            class="p-2 bg-white rounded-lg text-gray-700 hover:bg-gray-50 transition-colors shadow-lg">
                            <i class="fas fa-edit"></i>
                        </button>
                        <button wire:click="delete({{ $item->id }})"
                            onclick="confirm('¿Eliminar este slide?') || event.stopImmediatePropagation()"
                            class="p-2 bg-red-600 rounded-lg text-white hover:bg-red-700 transition-colors shadow-lg">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div class="absolute top-3 right-3">
                        <span
                            class="px-2 py-1 text-[10px] font-bold uppercase rounded-md tracking-wider {{ $item->activo ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $item->activo ? 'Activo' : 'Inactivo' }}
                        </span>
                    </div>
                </div>
                <div class="p-5">
                    <h4 class="font-bold text-gray-900 dark:text-white truncate">{{ $item->titulo }}</h4>
                    <p class="text-sm text-gray-500 dark:text-gray-400 mt-1 line-clamp-2 h-10">{{ $item->descripcion }}
                    </p>
                    @if ($item->boton_texto)
                        <div class="mt-4 flex gap-2">
                            <span
                                class="px-2 py-1 bg-gray-100 dark:bg-gray-700 rounded text-xs text-gray-600 dark:text-gray-300">{{ $item->boton_texto }}</span>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach

        @if (count($items) === 0)
            <div
                class="col-span-full py-16 flex flex-col items-center justify-center border-2 border-dashed border-gray-200 dark:border-gray-700 rounded-2xl">
                <i class="fas fa-images text-5xl text-gray-200 dark:text-gray-700 mb-4"></i>
                <p class="text-gray-500 dark:text-gray-400 font-medium">No hay slides en el carrusel</p>
                <button wire:click="create"
                    class="mt-4 text-indigo-600 dark:text-indigo-400 font-bold hover:underline">Empieza por crear
                    uno</button>
            </div>
        @endif
    </div>

    @include('partials.modalCreateBannerHome')
</div>
