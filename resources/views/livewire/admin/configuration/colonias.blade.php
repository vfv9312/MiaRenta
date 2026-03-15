<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <div class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400 mb-2">
                    <a href="{{ route('configuracion') }}" class="hover:underline flex items-center gap-1">
                        <i class="fas fa-arrow-left text-xs"></i>
                        Regresar
                    </a>
                </div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Colonias</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona el catálogo de colonias y zonas.</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-plus"></i> Nueva Colonia
            </button>
        </header>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Table Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Search -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live="search"
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="Buscar por CP, estado, municipio o localidad...">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">CP</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Municipio</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Localidad</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($colonias as $colonia)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <span class="font-bold text-indigo-600 dark:text-indigo-400">{{ $colonia->cp }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white font-medium">{{ $colonia->estado }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $colonia->id_estado }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white">{{ $colonia->municipio }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $colonia->id_municipio }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white">{{ $colonia->localidad }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">ID: {{ $colonia->id_localidad }}</div>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $colonia->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors dark:hover:bg-blue-900/30" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $colonia->id }})"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors dark:hover:bg-red-900/30" title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-map-marked-alt text-4xl text-gray-300 dark:text-gray-600"></i>
                                        <p class="text-lg font-medium">No se encontraron colonias</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($colonias->hasPages())
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $colonias->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ===================== MODAL FORM ===================== --}}
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-2xl w-full animate-in fade-in zoom-in duration-200 overflow-y-auto max-h-[90vh]">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $item_id ? 'Editar Colonia' : 'Nueva Colonia' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="store" class="p-6 space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Código Postal (CP)</label>
                            <input wire:model="cp" type="number"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Ej: 31000">
                            @error('cp') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <hr class="md:col-span-2 border-gray-100 dark:border-gray-700">

                        <!-- Estado -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ID Estado</label>
                            <input wire:model="id_estado" type="number"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="08">
                            @error('id_estado') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Estado</label>
                            <input wire:model="estado" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Chihuahua">
                            @error('estado') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Municipio -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ID Municipio</label>
                            <input wire:model="id_municipio" type="number"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="019">
                            @error('id_municipio') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Municipio</label>
                            <input wire:model="municipio" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Chihuahua">
                            @error('municipio') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Localidad -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">ID Localidad</label>
                            <input wire:model="id_localidad" type="number"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="0001">
                            @error('id_localidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Localidad / Colonia</label>
                            <input wire:model="localidad" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Ej: Centro">
                            @error('localidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <hr class="md:col-span-2 border-gray-100 dark:border-gray-700">

                        <!-- Ubicación -->
                        <div class="md:col-span-2">
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Ubicación aproximada (Mapa)</label>
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div>
                                    <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Latitud</label>
                                    <input wire:model="lat" type="text" id="lat"
                                        class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white p-2 text-sm"
                                        readonly>
                                </div>
                                <div>
                                    <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Longitud</label>
                                    <input wire:model="lng" type="text" id="lng"
                                        class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-900 dark:text-white p-2 text-sm"
                                        readonly>
                                </div>
                            </div>
                            <div id="map" class="w-full h-48 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-900" wire:ignore></div>
                            <p class="text-xs text-gray-400 mt-1">Suelte el marcador para seleccionar la ubicación de la zona.</p>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-save"></i> {{ $item_id ? 'Actualizar' : 'Guardar' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            document.addEventListener('livewire:navigated', initMapColonia);
            document.addEventListener('livewire:init', initMapColonia);

            function initMapColonia() {
                setTimeout(() => {
                    const mapEl = document.getElementById('map');
                    if (!mapEl || mapEl.dataset.initialized) return;
                    mapEl.dataset.initialized = 'true';

                    const initialLat = {{ $lat ?: '28.6353' }};
                    const initialLng = {{ $lng ?: '-106.089' }};

                    const map = new google.maps.Map(mapEl, {
                        center: { lat: initialLat, lng: initialLng },
                        zoom: 12,
                        mapTypeControl: false,
                        streetViewControl: false,
                    });

                    let marker = new google.maps.Marker({
                        position: { lat: initialLat, lng: initialLng },
                        map: map,
                        draggable: true,
                    });

                    map.addListener('click', function(e) {
                        const lat = e.latLng.lat();
                        const lng = e.latLng.lng();
                        marker.setPosition(e.latLng);
                        @this.set('lat', lat.toString());
                        @this.set('lng', lng.toString());
                    });

                    marker.addListener('dragend', function(e) {
                        const lat = e.latLng.lat();
                        const lng = e.latLng.lng();
                        @this.set('lat', lat.toString());
                        @this.set('lng', lng.toString());
                    });
                }, 300);
            }
        </script>
    @endif

    {{-- ===================== DELETE MODAL ===================== --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="$set('showDeleteModal', false)"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center animate-in fade-in zoom-in duration-200">
                <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">¿Eliminar colonia?</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">Esta acción no se puede deshacer.</p>
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
