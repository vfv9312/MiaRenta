<div class="p-6 bg-white rounded-lg shadow-md max-w-5xl mx-auto">
    <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Generar Orden de Alquiler</h2>

    @if (session()->has('message'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded relative">
            <span class="block sm:inline">{{ session('message') }}</span>
        </div>
    @endif
    @if (session()->has('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded relative">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <form wire:submit.prevent="submitOrder">
        <!-- 1. CLIENTE -->
        <div class="mb-8 border border-gray-200 p-5 rounded-md bg-gray-50">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-lg font-bold text-gray-800">1. Selección de Cliente</h3>
                <button type="button" wire:click="toggleNewClient"
                    class="text-sm font-semibold text-blue-600 hover:text-blue-800 hover:underline focus:outline-none">
                    {{ $is_new_client ? 'Cancelar y buscar cliente existente' : '+ Registrar Nuevo Cliente' }}
                </button>
            </div>

            @if ($is_new_client)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Nombre(s) *</label>
                        <input type="text" wire:model.defer="nombre"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('nombre')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Apellido(s) *</label>
                        <input type="text" wire:model.defer="apellido"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('apellido')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Teléfono / WhatsApp *</label>
                        <input type="text" wire:model.defer="telefono"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                            placeholder="Ej. 998 123 4567">
                        @error('telefono')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Correo Electrónico (Opcional)</label>
                        <input type="email" wire:model.defer="correo"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('correo')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            @else
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Buscar Cliente</label>
                    <div class="relative">
                        <input type="text" wire:model.live.debounce.300ms="search_cliente"
                            placeholder="Buscar por nombre, apellido o correo..."
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                        @if (strlen($search_cliente) > 0 && count($clientes) > 0)
                            <ul
                                class="absolute z-10 mt-1 border border-gray-200 rounded max-h-48 overflow-y-auto bg-white shadow-lg w-full md:w-2/3">
                                @foreach ($clientes as $cli)
                                    <li class="p-3 hover:bg-gray-100 cursor-pointer flex justify-between items-center border-b last:border-b-0 {{ $cliente_id == $cli->id ? 'bg-blue-50' : '' }}"
                                        wire:click="selectCliente({{ $cli->id }})">
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $cli->persona->nombre ?? '' }}
                                                {{ $cli->persona->apellido ?? '' }}</p>
                                            <p class="text-xs text-gray-500">{{ $cli->correo }}</p>
                                        </div>
                                        @if ($cliente_id == $cli->id)
                                            <span class="text-blue-600 text-sm font-semibold">Seleccionado</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @elseif (strlen($search_cliente) > 0)
                            <p
                                class="absolute z-10 w-full md:w-2/3 bg-white text-gray-500 text-sm mt-1 p-3 border rounded shadow-lg">
                                No se encontraron clientes que coincidan con la búsqueda.</p>
                        @endif
                    </div>

                    @if ($cliente_id)
                        <div
                            class="mt-4 p-3 bg-blue-100 border border-blue-200 text-blue-800 rounded-md flex justify-between items-center">
                            <span>✅ Cliente seleccionado para la orden.</span>
                            <button type="button" wire:click="$set('cliente_id', '')"
                                class="text-sm text-blue-600 hover:text-blue-900 font-medium">Cambiar</button>
                        </div>
                    @endif
                </div>
            @endif
        </div>

        <!-- 2. DIRECCIÓN -->
        <div
            class="mb-8 border border-gray-200 p-5 rounded-md bg-gray-50 {{ !$is_new_client && !$cliente_id ? 'opacity-50 pointer-events-none' : '' }}">
            <div class="flex justify-between items-center mb-4 border-b pb-2">
                <h3 class="text-lg font-bold text-gray-800">2. Dirección de Entrega</h3>
                @if (!$is_new_client && $cliente_id)
                    <button type="button" wire:click="toggleNewAddress"
                        class="text-sm font-semibold text-blue-600 hover:text-blue-800 hover:underline focus:outline-none">
                        {{ $is_new_address ? 'Elegir Dirección Existente' : '+ Agregar Nueva Dirección' }}
                    </button>
                @endif
            </div>

            @if ($is_new_address || $is_new_client)
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Colonia / Localidad *</label>
                        @if ($colonia_id)
                            <div
                                class="mt-1 flex items-center justify-between p-2 bg-blue-50 border border-blue-200 rounded-md">
                                <span
                                    class="text-sm text-blue-800 font-medium whitespace-nowrap overflow-hidden text-ellipsis">{{ $selected_colonia_name }}</span>
                                <button type="button" wire:click="$set('colonia_id', '')"
                                    class="text-sm text-blue-600 hover:text-blue-900 font-bold ml-2">Cambiar</button>
                            </div>
                        @else
                            <div class="relative">
                                <input type="text" wire:model.live.debounce.300ms="search_colonia"
                                    placeholder="Escriba la localidad o colonia..."
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">

                                @if (strlen($search_colonia) >= 2)
                                    <div
                                        class="absolute z-30 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-48 overflow-y-auto md:w-[150%]">
                                        @forelse($colonias as $col)
                                            <div wire:click="selectColonia({{ $col->id }}, '{{ addslashes($col->localidad) }}, {{ addslashes($col->municipio) }}')"
                                                class="p-3 border-b hover:bg-gray-50 cursor-pointer text-sm transition-colors">
                                                <p class="font-semibold text-gray-800">{{ $col->localidad }}</p>
                                                <p class="text-xs text-gray-500">{{ $col->municipio }}
                                                    ({{ $col->estado }}) - CP: {{ $col->cp }}</p>
                                            </div>
                                        @empty
                                            <div class="p-3 text-sm text-gray-500 text-center">No se encontraron
                                                colonias que coincidan con "{{ $search_colonia }}".</div>
                                        @endforelse
                                    </div>
                                @endif
                            </div>
                        @endif
                        @error('colonia_id')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Código Postal</label>
                        <input type="number" wire:model.defer="cp"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('cp')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Calle *</label>
                        <input type="text" wire:model.defer="calle"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('calle')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Entre Calles *</label>
                        <input type="text" wire:model.defer="entre_calles"
                            class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        @error('entre_calles')
                            <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-4">
                    <label class="block text-sm font-medium text-gray-700">Referencia (Opcional)</label>
                    <textarea wire:model.defer="referencia" rows="2"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"></textarea>
                    @error('referencia')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            @elseif ($cliente_id)
                @if (count($direcciones_cliente) == 0)
                    <div class="p-4 bg-yellow-50 text-yellow-800 rounded-md border border-yellow-200">
                        Este cliente no tiene direcciones registradas. <button type="button"
                            wire:click="toggleNewAddress" class="font-bold underline">Agregue una nueva
                            dirección</button>.
                    </div>
                @else
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Seleccionar Dirección Ligada al
                            Cliente *</label>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach ($direcciones_cliente as $cat_dir)
                                <div class="border rounded-md p-3 cursor-pointer hover:border-blue-500 {{ $catalogo_cliente_id == $cat_dir->id ? 'border-blue-500 bg-blue-50 ring-1 ring-blue-500' : 'border-gray-300 bg-white' }}"
                                    wire:click="$set('catalogo_cliente_id', {{ $cat_dir->id }})">
                                    <p class="font-medium text-gray-800">{{ $cat_dir->direccion->calle ?? '' }}</p>
                                    <p class="text-sm text-gray-600">
                                        Colonia: {{ $cat_dir->direccion->colonia->localidad ?? '' }}<br>
                                        Ref: {{ $cat_dir->direccion->referencia ?? 'N/A' }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        @error('catalogo_cliente_id')
                            <span class="text-red-500 text-xs mt-2 block">{{ $message }}</span>
                        @enderror
                    </div>
                @endif
            @else
                <p class="text-gray-500 text-sm">Seleccione o registre un cliente primero para configurar la dirección.
                </p>
            @endif
        </div>

        <!-- 3. DATOS DE LA ORDEN -->
        <div
            class="mb-8 border border-gray-200 p-5 rounded-md bg-gray-50 {{ (!$is_new_client && !$cliente_id) || (!$is_new_address && !$is_new_client && !$catalogo_cliente_id) ? 'opacity-50 pointer-events-none' : '' }}">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">3. Datos Finales de la Orden</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Persona que recibe el pedido *</label>
                    <input type="text" wire:model.defer="recibe"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('recibe')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Chofer o persona de entrega *</label>
                    <input type="text" wire:model.defer="entrega"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('entrega')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha del Evento (Solicitada) *</label>
                    <input type="datetime-local" wire:model.defer="fecha_solicitada"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                    @error('fecha_solicitada')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Método de Pago Preferido *</label>
                    <select wire:model.defer="metodo_pago_id"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        <option value="">Seleccione un método de pago...</option>
                        @foreach ($metodos_pago as $mp)
                            <option value="{{ $mp->id }}">{{ $mp->nombre }}</option>
                        @endforeach
                    </select>
                    @error('metodo_pago_id')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha de Entrega Física *</label>
                    <input type="datetime-local" wire:model.live.debounce.500ms="fecha_entrega"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    @error('fecha_entrega')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                    <p class="text-xs text-gray-500 mt-1">Requerido para consultar inventario disponible.</p>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Fecha Prevista de Recolección *</label>
                    <input type="datetime-local" wire:model.live.debounce.500ms="fecha_recepcion"
                        class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        required>
                    @error('fecha_recepcion')
                        <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <!-- 4. SELECCIÓN DE MOBILIARIO (COTIZADOR) -->
        <div
            class="mb-8 border border-gray-200 p-5 rounded-md bg-gray-50 {{ !$fecha_entrega ? 'opacity-50 pointer-events-none' : '' }}">
            <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">4. Selección de Mobiliario (Cotizador)</h3>
            @if (!$fecha_entrega)
                <div class="mb-4 p-3 bg-yellow-100 text-yellow-800 rounded">
                    ⚠️ Debe ingresar la <strong>Fecha de Entrega Física</strong> en el paso anterior para poder calcular la disponibilidad del inventario.
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-1">Buscar y agregar mobiliario</label>
                <div class="relative">
                    <input type="text" wire:model.live.debounce.300ms="search_producto"
                        placeholder="Escriba el nombre del producto..."
                        class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm"
                        {{ !$fecha_entrega ? 'disabled' : '' }}>

                    @if (count($catalog_products) > 0 && strlen($search_producto) > 0)
                        <div
                            class="absolute z-20 mt-1 w-full bg-white border border-gray-200 rounded-md shadow-lg max-h-48 overflow-y-auto md:w-3/4 lg:w-1/2">
                            @foreach ($catalog_products as $cp)
                                <div
                                    class="flex justify-between items-center p-3 border-b hover:bg-gray-50 {{ $selected_catalogo_precio_id == $cp->id ? 'bg-blue-50' : '' }}">
                                    <div>
                                        <p class="text-sm font-semibold text-gray-800">
                                            {{ $cp->producto->nombre ?? 'N/A' }} <span
                                                class="text-xs text-gray-500">({{ $cp->producto->color->nombre ?? 'Sin color' }})</span>
                                        </p>
                                        @php
                                            $en_reparacion = $cp->producto->reparaciones
                                                ->where('status_id', 5)
                                                ->sum('cantidad');
                                            $en_renta = $cp->en_renta_calculado ?? 0;
                                            
                                            $en_carrito = 0;
                                            foreach($carrito_productos as $c_item) {
                                                if($c_item['catalago_precio_id'] == $cp->id) {
                                                    $en_carrito += $c_item['cantidad'];
                                                }
                                            }
                                            
                                            $disponible = $cp->producto->cantidad - $en_reparacion - $en_renta - $en_carrito;
                                        @endphp
                                        <p class="text-xs text-gray-500 mt-1">Disp: <span
                                                class="{{ $disponible > 0 ? 'font-bold text-gray-700' : 'font-bold text-red-600' }}">{{ $disponible }}</span>
                                            <span class="text-[10px] text-gray-400">(Total:
                                                {{ $cp->producto->cantidad }}, Rep: {{ $en_reparacion }}, Renta:
                                                {{ $en_renta }}{{ $en_carrito > 0 ? ', En Carrito: '.$en_carrito : '' }})</span></p>
                                        <p class="text-xs text-green-600 font-bold mt-1">
                                            ${{ number_format($cp->precio, 2) }}</p>
                                    </div>
                                    <div class="flex flex-col items-end space-y-2">
                                        @if ($selected_catalogo_precio_id == $cp->id)
                                            <div class="flex items-center space-x-2">
                                                <input type="number" wire:model="cantidad_producto" min="1"
                                                    max="{{ $disponible }}"
                                                    class="w-16 text-sm border-gray-300 rounded-md shadow-sm">
                                                <button type="button" wire:click="addProductToCart"
                                                    class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 text-sm rounded-md shadow-sm font-semibold disabled:opacity-50"
                                                    {{ $disponible < 1 ? 'disabled' : '' }}>Cargar</button>
                                            </div>
                                            @error('cantidad_producto')
                                                <span
                                                    class="text-red-500 text-[10px] font-bold block max-w-[150px] text-right leading-tight">{{ $message }}</span>
                                            @enderror
                                        @else
                                            <button type="button"
                                                wire:click="selectCatalogoPrecio({{ $cp->id }})"
                                                class="text-blue-600 hover:underline text-sm font-medium">Seleccionar</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>

            <!-- Tabla de productos en carrito -->
            <div class="mt-4 border rounded-md overflow-hidden bg-white shadow-sm">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-2 text-left text-xs text-gray-500 font-bold">Producto</th>
                            <th class="px-4 py-2 text-right text-xs text-gray-500 font-bold">Precio U.</th>
                            <th class="px-4 py-2 text-center text-xs text-gray-500 font-bold">Cantidad</th>
                            <th class="px-4 py-2 text-right text-xs text-gray-500 font-bold">Subtotal</th>
                            <th class="px-4 py-2 text-center text-xs text-gray-500"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @php $sum_total = 0; @endphp
                        @forelse($carrito_productos as $index => $item)
                            @php
                                $subtotal = $item['precio'] * $item['cantidad'];
                                $sum_total += $subtotal;
                            @endphp
                            <tr>
                                <td class="px-4 py-3 text-sm text-gray-800 font-medium">{{ $item['nombre'] }} <span
                                        class="text-xs text-gray-500">({{ $item['color'] }})</span></td>
                                <td class="px-4 py-3 text-sm text-right text-gray-600">
                                    ${{ number_format($item['precio'], 2) }}</td>
                                <td class="px-4 py-3 text-sm text-center text-gray-800">{{ $item['cantidad'] }}</td>
                                <td class="px-4 py-3 text-sm text-right font-semibold text-gray-800">
                                    ${{ number_format($subtotal, 2) }}</td>
                                <td class="px-4 py-3 text-center">
                                    <button type="button" wire:click="removeProductFromCart({{ $index }})"
                                        class="text-red-500 hover:text-red-700">
                                        <svg class="h-5 w-5 inline" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-6 text-center text-gray-500 text-sm bg-gray-50">El
                                    carrito de mobiliario está vacío. Busque y agregue productos a la orden.</td>
                            </tr>
                        @endforelse
                        @if (count($carrito_productos) > 0)
                            <tr class="bg-blue-50 border-t-2 border-blue-200">
                                <td colspan="3" class="px-4 py-3 text-right font-bold text-gray-700 uppercase">
                                    Total Estimado de Renta:</td>
                                <td class="px-4 py-3 text-right font-black text-blue-700 text-lg">
                                    ${{ number_format($sum_total, 2) }}</td>
                                <td></td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
            @error('carrito_productos')
                <div
                    class="mt-2 p-3 bg-red-100 border border-red-300 text-red-700 text-sm font-semibold rounded shadow-sm flex items-center">
                    <svg class="w-5 h-5 mr-2 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg> {{ $message }}</div>
            @enderror
        </div>

        <!-- ACCIONES -->
        <div class="flex justify-end border-t border-gray-300 pt-6">
            <button type="submit"
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-lg shadow-md focus:outline-none focus:ring-4 focus:ring-blue-300 transition-all transform hover:-translate-y-1 text-lg">
                Generar Orden de Cotización
            </button>
        </div>
    </form>
</div>
