<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-4xl mx-auto">

        {{-- Header --}}
        <header class="mb-8 flex items-center gap-4">
            <a href="{{ route('clientes') }}"
                class="p-2 text-gray-500 hover:bg-gray-200 dark:hover:bg-gray-700 rounded-lg transition-colors">
                <i class="fas fa-arrow-left"></i>
            </a>
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">
                    {{ $clientId ? 'Editar Cliente' : 'Nuevo Cliente' }}
                </h1>
                <p class="mt-1 text-gray-500 dark:text-gray-400">
                    {{ $clientId ? 'Modifica los datos del cliente.' : 'Completa el formulario para registrar un nuevo cliente.' }}
                </p>
            </div>
        </header>

        <form wire:submit.prevent="store" class="space-y-8">

            {{-- ===== DATOS PERSONALES ===== --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider mb-5">
                    <i class="fas fa-user mr-2"></i> Datos Personalesssssss
                </h4>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre</label>
                        <input wire:model="nombre" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="Nombre">
                        @error('nombre')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Apellido</label>
                        <input wire:model="apellido" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="Apellido">
                        @error('apellido')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Correo
                            Electrónico</label>
                        <input wire:model="correo" type="email"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="correo@ejemplo.com">
                        @error('correo')
                            <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">INE <span
                                class="text-gray-400 font-normal">(opcional)</span></label>
                        <input wire:model="INE" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="Número de INE">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">CURP <span
                                class="text-gray-400 font-normal">(opcional)</span></label>
                        <input wire:model="CURP" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="CURP">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">RFC <span
                                class="text-gray-400 font-normal">(opcional)</span></label>
                        <input wire:model="RFC" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="RFC">
                    </div>
                </div>
            </div>

            {{-- ===== TELÉFONOS ===== --}}
            <div
                class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex items-center justify-between mb-5">
                    <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                        <i class="fas fa-phone mr-2"></i> Teléfonos
                    </h4>
                    <button type="button" wire:click="addPhone"
                        class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold flex items-center gap-1">
                        <i class="fas fa-plus-circle"></i> Agregar
                    </button>
                </div>
                <div class="space-y-3">
                    @foreach ($telefonos as $i => $tel)
                        <div
                            class="flex items-start gap-3 p-3 bg-gray-50 dark:bg-gray-700/50 rounded-xl border border-gray-100 dark:border-gray-600">
                            <div class="flex-1 grid grid-cols-2 gap-3">
                                <div>
                                    <input wire:model="telefonos.{{ $i }}.telefono" type="text"
                                        class="w-full bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                        placeholder="Ej: 6141234567">
                                    @error("telefonos.{$i}.telefono")
                                        <span class="text-xs text-red-500">{{ $message }}</span>
                                    @enderror
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
                                <button type="button" wire:click="removePhone({{ $i }})"
                                    class="p-2 text-red-500 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg">
                                    <i class="fas fa-trash-alt text-sm"></i>
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
                @error('telefonos')
                    <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                @enderror
            </div>

            {{-- ===== DIRECCIONES ===== --}}
            @foreach ($direcciones as $i => $dir)
                <div
                    class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 p-6 space-y-4">
                    <div class="flex items-center justify-between">
                        <h4 class="text-sm font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                            <i class="fas fa-map-marker-alt mr-2"></i> Dirección {{ $i + 1 }}
                        </h4>
                        <div class="flex items-center gap-3">
                            @if (count($direcciones) > 1)
                                <button type="button" wire:click="removeAddress({{ $i }})"
                                    class="text-sm text-red-500 hover:text-red-700 font-bold flex items-center gap-1">
                                    <i class="fas fa-trash-alt"></i> Quitar
                                </button>
                            @endif
                            @if ($loop->last)
                                <button type="button" wire:click="addAddress"
                                    class="text-sm text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 font-bold flex items-center gap-1">
                                    <i class="fas fa-plus-circle"></i> Agregar dirección
                                </button>
                            @endif
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Calle</label>
                            <input wire:model="direcciones.{{ $i }}.calle" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                placeholder="Calle y número">
                            @error("direcciones.{$i}.calle")
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Entre
                                calles</label>
                            <input wire:model="direcciones.{{ $i }}.entre_calles" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                placeholder="Entre calle X y calle Y">
                            @error("direcciones.{$i}.entre_calles")
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Referencia</label>
                        <input wire:model="direcciones.{{ $i }}.referencia" type="text"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                            placeholder="Referencia para encontrar el lugar">
                        @error("direcciones.{$i}.referencia")
                            <span class="text-xs text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="relative">
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Buscar Colonia
                                / Municipio</label>
                            <div class="relative">
                                <input wire:model.live="direcciones.{{ $i }}.colonia_nombre"
                                    wire:input="search_colonia({{ $i }})" type="text"
                                    class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm"
                                    placeholder="Escribe municipio o CP...">
                                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                                    <i class="fas fa-search text-gray-400 text-xs"></i>
                                </div>
                            </div>
                            @if (!empty($coloniaResults[$i]))
                                <div
                                    class="absolute z-50 w-full mt-1 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg shadow-xl overflow-hidden">
                                    @foreach ($coloniaResults[$i] as $res)
                                        <button type="button"
                                            wire:click="select_colonia({{ $i }}, {{ $res['id'] }}, '{{ $res['localidad'] }}', '{{ $res['municipio'] }}', '{{ $res['cp'] }}')"
                                            class="w-full text-left px-4 py-2 text-sm hover:bg-indigo-50 dark:hover:bg-indigo-900/40 border-b border-gray-50 dark:border-gray-700 last:border-0 transition-colors">
                                            <div class="font-bold text-gray-900 dark:text-white">
                                                {{ $res['localidad'] }}</div>
                                            <div class="text-xs text-gray-500">{{ $res['municipio'] }},
                                                {{ $res['estado'] }} - CP: {{ $res['cp'] }}</div>
                                        </button>
                                    @endforeach
                                </div>
                            @endif
                            @error("direcciones.{$i}.colonias_id")
                                <span class="text-xs text-red-500">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">C.P.</label>
                            <input wire:model="direcciones.{{ $i }}.cp" type="text"
                                class="w-full bg-gray-100 dark:bg-gray-600 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-500 dark:text-gray-400 p-2 text-sm"
                                placeholder="31000" readonly>
                        </div>
                    </div>

                    {{-- Google Maps URL --}}
                    <div class="col-span-full">
                        <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">URL de Google Maps</label>
                        <div class="relative">
                            <input wire:model.live="direcciones.{{ $i }}.google_maps_url" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2 text-sm pl-10"
                                placeholder="Pega aquí la URL de Google Maps (ej: https://www.google.com/maps/...)">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-link text-gray-400" wire:loading.remove wire:target="direcciones.{{ $i }}.google_maps_url"></i>
                                <i class="fas fa-circle-notch fa-spin text-indigo-500" wire:loading wire:target="direcciones.{{ $i }}.google_maps_url"></i>
                            </div>
                        </div>
                        <p class="text-[10px] text-gray-400 mt-1">Extraeremos automáticamente la ubicación de la URL (soporta enlaces cortos).</p>
                    </div>

                    {{-- Lat / Lng (readonly verification) --}}
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Latitud</label>
                            <input wire:model="direcciones.{{ $i }}.lat" type="text"
                                class="w-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-400 p-2 text-sm cursor-not-allowed"
                                placeholder="..." readonly>
                        </div>
                        <div>
                            <label class="text-xs font-bold text-gray-500 dark:text-gray-400 mb-1 block">Longitud</label>
                            <input wire:model="direcciones.{{ $i }}.lng" type="text"
                                class="w-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-600 rounded-lg text-gray-400 p-2 text-sm cursor-not-allowed"
                                placeholder="..." readonly>
                        </div>
                    </div>
                </div>
            @endforeach

            {{-- ===== BOTONES ===== --}}
            <div class="flex justify-end gap-3 pb-8">
                <a href="{{ route('clientes') }}"
                    class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                    Cancelar
                </a>
                <button type="submit"
                    class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                    <i class="fas fa-save"></i> {{ $clientId ? 'Actualizar Cliente' : 'Guardar Cliente' }}
                </button>
            </div>
        </form>
    </div>
</div>
