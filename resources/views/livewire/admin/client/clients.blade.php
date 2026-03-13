<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Clientes</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona la información de tus clientes.</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-plus"></i> Nuevo Cliente
            </button>
        </header>

        @if (session()->has('message'))
            <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Card Container -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Search -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live="search"
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="Buscar por nombre, apellido o correo...">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cliente</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Correo</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Teléfonos</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Direcciones</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($clients as $client)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900/40 flex items-center justify-center">
                                            <span class="text-indigo-600 dark:text-indigo-400 font-bold text-sm">
                                                {{ strtoupper(substr($client->persona->nombre ?? '', 0, 1)) }}{{ strtoupper(substr($client->persona->apellido ?? '', 0, 1)) }}
                                            </span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">{{ $client->persona->nombre ?? '' }} {{ $client->persona->apellido ?? '' }}</div>
                                            @if($client->persona->RFC)
                                                <div class="text-xs text-gray-500 dark:text-gray-400">RFC: {{ $client->persona->RFC }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white">{{ $client->correo }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex flex-col gap-1">
                                        @foreach ($client->telefonos->take(2) as $tel)
                                            <span class="inline-flex items-center gap-1 text-sm text-gray-700 dark:text-gray-300">
                                                @if($tel->tipo === 'whatsapp')
                                                    <i class="fab fa-whatsapp text-green-500"></i>
                                                @elseif($tel->tipo === 'telefono')
                                                    <i class="fas fa-phone text-blue-500"></i>
                                                @else
                                                    <i class="fas fa-phone-alt text-purple-500"></i>
                                                @endif
                                                {{ $tel->telefono }}
                                            </span>
                                        @endforeach
                                        @if ($client->telefonos->count() > 2)
                                            <span class="text-xs text-gray-400">+{{ $client->telefonos->count() - 2 }} más</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center gap-1 text-sm text-gray-700 dark:text-gray-300">
                                        <i class="fas fa-map-marker-alt text-red-400"></i>
                                        {{ $client->catalogoDirecciones->count() }} {{ $client->catalogoDirecciones->count() == 1 ? 'dirección' : 'direcciones' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $client->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors dark:hover:bg-blue-900/30" title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $client->id }})"
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
                                        <i class="fas fa-users text-4xl text-gray-300 dark:text-gray-600"></i>
                                        <p class="text-lg font-medium">No se encontraron clientes</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($clients->hasPages())
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $clients->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ===================== MODAL FORM ===================== --}}
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-3xl w-full animate-in fade-in zoom-in duration-200 overflow-y-auto max-h-[90vh]">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $item_id ? 'Editar Cliente' : 'Nuevo Cliente' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="store" class="p-6 space-y-6">

                    {{-- ===== DATOS PERSONALES ===== --}}
                    <div>
                        <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-4">
                            <i class="fas fa-user mr-2"></i> Datos Personales
                        </h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre</label>
                                <input wire:model="nombre" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="Nombre">
                                @error('nombre') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Apellido</label>
                                <input wire:model="apellido" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="Apellido">
                                @error('apellido') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Correo Electrónico</label>
                                <input wire:model="correo" type="email"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="correo@ejemplo.com">
                                @error('correo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">INE <span class="text-gray-400 font-normal">(opcional)</span></label>
                                <input wire:model="INE" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="Número de INE">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">CURP <span class="text-gray-400 font-normal">(opcional)</span></label>
                                <input wire:model="CURP" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="CURP">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">RFC <span class="text-gray-400 font-normal">(opcional)</span></label>
                                <input wire:model="RFC" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                    placeholder="RFC">
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-100 dark:border-gray-700">

                    {{-- ===== TELÉFONOS ===== --}}
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <i class="fas fa-phone mr-2"></i> Teléfonos
                            </h4>
                            <button type="button" wire:click="addPhone" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold flex items-center gap-1">
                                <i class="fas fa-plus-circle"></i> Agregar
                            </button>
                        </div>

                        <div class="space-y-3">
                            @foreach ($telefonos as $i => $tel)
                                <div class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600">
                                    <div class="flex-1 grid grid-cols-2 gap-3">
                                        <div>
                                            <input wire:model="telefonos.{{ $i }}.telefono" type="text"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="Ej: 6141234567">
                                            @error("telefonos.{$i}.telefono") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <select wire:model="telefonos.{{ $i }}.tipo"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm">
                                                <option value="whatsapp">WhatsApp</option>
                                                <option value="telefono">Teléfono</option>
                                                <option value="ambos">Ambos</option>
                                            </select>
                                        </div>
                                    </div>
                                    @if (count($telefonos) > 1)
                                        <button type="button" wire:click="removePhone({{ $i }})" class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        @error('telefonos') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <hr class="border-gray-100 dark:border-gray-700">

                    {{-- ===== DIRECCIONES ===== --}}
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                <i class="fas fa-map-marker-alt mr-2"></i> Direcciones
                            </h4>
                            <button type="button" wire:click="addAddress" class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold flex items-center gap-1">
                                <i class="fas fa-plus-circle"></i> Agregar
                            </button>
                        </div>

                        <div class="space-y-4">
                            @foreach ($direcciones as $i => $dir)
                                <div class="p-4 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600 space-y-3">
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm font-bold text-gray-600 dark:text-gray-300">Dirección {{ $i + 1 }}</span>
                                        @if (count($direcciones) > 1)
                                            <button type="button" wire:click="removeAddress({{ $i }})" class="text-red-500 hover:text-red-700 text-sm font-bold">
                                                <i class="fas fa-trash-alt mr-1"></i> Quitar
                                            </button>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                        <div>
                                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Calle</label>
                                            <input wire:model="direcciones.{{ $i }}.calle" type="text"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="Calle y número">
                                            @error("direcciones.{$i}.calle") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                        <div>
                                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Entre calles</label>
                                            <input wire:model="direcciones.{{ $i }}.entre_calles" type="text"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="Entre calle X y calle Y">
                                            @error("direcciones.{$i}.entre_calles") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                        </div>
                                    </div>

                                    <div>
                                        <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Referencia</label>
                                        <input wire:model="direcciones.{{ $i }}.referencia" type="text"
                                            class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                            placeholder="Referencia para encontrar el lugar">
                                        @error("direcciones.{$i}.referencia") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                                    </div>

                                    <div class="grid grid-cols-3 gap-3">
                                        <div>
                                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">C.P.</label>
                                            <input wire:model="direcciones.{{ $i }}.cp" type="text"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="31000">
                                        </div>
                                        <div>
                                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Latitud</label>
                                            <input wire:model="direcciones.{{ $i }}.lat" type="text" id="lat-{{ $i }}"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="28.6353"
                                                readonly>
                                        </div>
                                        <div>
                                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Longitud</label>
                                            <input wire:model="direcciones.{{ $i }}.lng" type="text" id="lng-{{ $i }}"
                                                class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                                placeholder="-106.089"
                                                readonly>
                                        </div>
                                    </div>

                                    {{-- Google Maps --}}
                                    <div>
                                        <div id="map-{{ $i }}" class="w-full h-48 rounded-lg border border-gray-200 dark:border-gray-600 bg-gray-100 dark:bg-gray-900" wire:ignore></div>
                                        <p class="text-xs text-gray-400 mt-1">Haz clic en el mapa para seleccionar la ubicación.</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @error('direcciones') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-save"></i> {{ $item_id ? 'Actualizar' : 'Guardar Cliente' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>

        {{-- Google Maps Script --}}
        <script>
            document.addEventListener('livewire:navigated', initMaps);
            document.addEventListener('livewire:init', initMaps);

            function initMaps() {
                setTimeout(() => {
                    @foreach ($direcciones as $i => $dir)
                        (function(index) {
                            const mapEl = document.getElementById('map-' + index);
                            if (!mapEl || mapEl.dataset.initialized) return;
                            mapEl.dataset.initialized = 'true';

                            const initialLat = {{ $dir['lat'] ?: '28.6353' }};
                            const initialLng = {{ $dir['lng'] ?: '-106.089' }};

                            const map = new google.maps.Map(mapEl, {
                                center: { lat: initialLat, lng: initialLng },
                                zoom: 15,
                                mapTypeControl: false,
                                streetViewControl: false,
                            });

                            let marker = new google.maps.Marker({
                                position: { lat: initialLat, lng: initialLng },
                                map: map,
                                draggable: true,
                            });

                            @if(!empty($dir['lat']) && !empty($dir['lng']))
                                marker.setVisible(true);
                            @else
                                marker.setVisible(false);
                            @endif

                            map.addListener('click', function(e) {
                                const lat = e.latLng.lat();
                                const lng = e.latLng.lng();
                                marker.setPosition(e.latLng);
                                marker.setVisible(true);

                                document.getElementById('lat-' + index).value = lat;
                                document.getElementById('lng-' + index).value = lng;
                                @this.set('direcciones.' + index + '.lat', lat.toString());
                                @this.set('direcciones.' + index + '.lng', lng.toString());
                            });

                            marker.addListener('dragend', function(e) {
                                const lat = e.latLng.lat();
                                const lng = e.latLng.lng();
                                document.getElementById('lat-' + index).value = lat;
                                document.getElementById('lng-' + index).value = lng;
                                @this.set('direcciones.' + index + '.lat', lat.toString());
                                @this.set('direcciones.' + index + '.lng', lng.toString());
                            });
                        })({{ $i }});
                    @endforeach
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
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">¿Eliminar cliente?</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">Se eliminarán también sus teléfonos y direcciones asociadas.</p>
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
