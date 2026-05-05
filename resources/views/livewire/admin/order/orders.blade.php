<div class="p-6 bg-white rounded-lg shadow-md mx-auto">
    <h2 class="text-2xl font-semibold mb-6 border-b pb-2">Gestión de Órdenes (Alquileres)</h2>

    <!-- Filtros -->
    <div class="mb-6 flex flex-col md:flex-row md:items-end gap-4 bg-gray-50 p-4 rounded-md border border-gray-200">
        <div class="w-full md:w-1/3">
            <label class="block text-sm font-medium text-gray-700 mb-1">Filtrar por Estatus</label>
            <select wire:model.live="filter_status_id" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                <option value="">Todos los Estatus</option>
                @foreach($statuses as $st)
                    <option value="{{ $st->id }}">{{ $st->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <!-- Tabla -->
    <div class="overflow-x-auto border border-gray-200 rounded-md">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Cliente</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fechas</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estatus</th>
                    <th scope="col" class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Económico</th>
                    <th scope="col" class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse ($alquileres as $alq)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-900 font-bold">#{{ $alq->id }}</td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                            {{ $alq->cliente->persona->nombre ?? '' }} {{ $alq->cliente->persona->apellido ?? '' }}<br>
                            <span class="text-xs text-gray-500">{{ $alq->cliente->correo ?? '' }}</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                            Sol: {{ $alq->fecha_solicitada ? $alq->fecha_solicitada->format('d/m/Y H:i') : 'N/A' }}<br>
                            Ent: {{ $alq->fecha_entrega ? $alq->fecha_entrega->format('d/m/Y H:i') : 'N/A' }}
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                {{ $alq->status_id == 6 ? 'bg-gray-100 text-gray-800' : '' }}
                                {{ $alq->status_id == 7 ? 'bg-yellow-100 text-yellow-800' : '' }}
                                {{ $alq->status_id == 8 ? 'bg-red-100 text-red-800' : '' }}
                                {{ $alq->status_id == 9 ? 'bg-blue-100 text-blue-800' : '' }}
                                {{ $alq->status_id == 10 ? 'bg-green-100 text-green-800' : '' }}
                                {{ $alq->status_id == 11 ? 'bg-indigo-100 text-indigo-800' : '' }}
                                {{ $alq->status_id == 13 ? 'bg-purple-100 text-purple-800' : '' }}
                                {{ $alq->status_id == 14 ? 'bg-teal-100 text-teal-800' : '' }}">
                                {{ $alq->status->name ?? 'Desconocido' }}
                            </span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-sm text-gray-700">
                            Total: ${{ number_format($alq->total ?? 0, 2) }}<br>
                            Pagado: <span class="{{ ($alq->monto_pagado >= $alq->total && $alq->total > 0) ? 'text-green-600 font-bold' : 'text-orange-500' }}">${{ number_format($alq->monto_pagado ?? 0, 2) }}</span>
                        </td>
                        <td class="px-4 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <!-- Details btn -->
                            <button wire:click="openDetailsModal({{ $alq->id }})" class="text-blue-600 hover:text-blue-900 mr-1" title="Ver Detalles">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                            </button>

                            <!-- Edit btn -->
                            <button wire:click="openEditModal({{ $alq->id }})" class="text-orange-500 hover:text-orange-700 mr-1" title="Editar Fechas / Dirección">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                            </button>

                            <!-- Mobiliario btn (Always available to view, maybe not edit if finished) -->
                            <button wire:click="openProductsModal({{ $alq->id }})" class="text-blue-600 hover:text-blue-900" title="Mobiliario">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            </button>

                            @if($alq->status_id == 6)
                                <button wire:click="validarCotizacion({{ $alq->id }})" class="text-indigo-600 hover:text-indigo-900" title="Validar Cotizacion">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            @endif

                            @if(in_array($alq->status_id, [7, 9]))
                                <button wire:click="openPaymentModal({{ $alq->id }})" class="text-green-600 hover:text-green-900" title="Pagar">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            @endif

                            @if($alq->status_id == 10)
                                <button wire:click="validarRenta({{ $alq->id }})" class="text-teal-600 hover:text-teal-900" title="Validar Renta (Entregar)">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                </button>
                            @endif

                            @if($alq->status_id == 11)
                                <button wire:click="finalizarRenta({{ $alq->id }})" class="text-gray-600 hover:text-gray-900" title="Finalizar Alquiler">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                </button>
                            @endif

                            @if(in_array($alq->status_id, [6, 7, 9, 10, 11]))
                                <button wire:click="openCancelModal({{ $alq->id }})" class="text-red-600 hover:text-red-900" title="Cancelar / Devolver">
                                    <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </button>
                            @endif

                            <!-- WhatsApp and Ticket -->
                            <button wire:click="downloadTicket({{ $alq->id }})" class="text-purple-600 hover:text-purple-900 mr-1" title="Descargar Ticket PDF">
                                <svg class="w-5 h-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                            </button>
                            <a href="https://wa.me/{{ $alq->cliente->telefonos->first()->numero ?? '' }}?text=Hola,%20seguimiento%20de%20su%20renta%20#{{ $alq->id }}" target="_blank" class="text-green-500 hover:text-green-700" title="WhatsApp">
                                <svg class="w-5 h-5 inline" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51h-.57c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347z"/><path d="M12 0C5.373 0 0 5.373 0 12c0 2.123.553 4.118 1.543 5.86L0 24l6.305-1.503C8.038 23.475 9.975 24 12 24c6.627 0 12-5.373 12-12S18.627 0 12 0zm0 21.98c-1.802 0-3.535-.465-5.1-1.348l-.367-.208-3.774.896.915-3.612-.23-.374C2.553 15.657 2.02 13.864 2.02 12c0-5.514 4.486-10 10-10s10 4.486 10 10-4.486 9.98-10 9.98z"/></svg>
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-4 text-center text-gray-500">No hay órdenes que coincidan con los filtros.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-4">
        {{ $alquileres->links() }}
    </div>

    <!-- MODAL PRODUCTS -->
    @if($showProductsModal)
        @php
            // 8: Cancelado, 10: Pagado, 11: Rentado, 13: Devuelto, 14: Finalizado
            $canEditProducts = !in_array($selected_order_status_id, [8, 10, 11, 13, 14]);
        @endphp
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-3xl overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Mobiliario de la Orden #{{ $selected_order_id }}</h3>
                    <button wire:click="closeProductsModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-6">
                    @if(!$canEditProducts)
                        <div class="mb-4 bg-yellow-50 border border-yellow-200 text-yellow-800 text-sm p-3 rounded-md shadow-sm">
                            ℹ️ Esta orden ya no puede ser editada porque se encuentra en un estatus avanzado (Pagado, Rentado, Finalizado, etc).
                        </div>
                    @endif

                    @if($canEditProducts)
                        <!-- Buscador -->
                        <div class="mb-6 bg-gray-50 p-4 border rounded-md">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Buscar y agregar mobiliario</label>
                        <input type="text" wire:model.live.debounce.300ms="search_product" placeholder="Escriba el nombre del producto..." class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                        
                        @if(count($catalog_products) > 0)
                            <div class="mt-2 bg-white border border-gray-200 rounded-md shadow-sm max-h-48 overflow-y-auto">
                                @foreach($catalog_products as $cp)
                                    <div class="flex justify-between items-center p-3 border-b hover:bg-gray-50 {{ $selected_catalogo_precio_id == $cp->id ? 'bg-blue-50' : '' }}">
                                        <div>
                                            <p class="text-sm font-semibold text-gray-800">{{ $cp->producto->nombre ?? 'N/A' }} <span class="text-xs text-gray-500">({{ $cp->producto->color->nombre ?? 'Sin color' }})</span></p>
                                            <p class="text-xs text-green-600 font-bold">${{ number_format($cp->precio, 2) }}</p>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($selected_catalogo_precio_id == $cp->id)
                                                <input type="number" wire:model="cantidad_producto" min="1" class="w-16 text-sm border-gray-300 rounded-md shadow-sm">
                                                <button wire:click="addProductToOrder" class="bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 text-sm rounded-md shadow-sm font-semibold">Cargar</button>
                                            @else
                                                <button wire:click="selectCatalogoPrecio({{ $cp->id }})" class="text-blue-600 hover:underline text-sm font-medium">Seleccionar</button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @endif

                    <!-- Lista actual -->
                    <h4 class="font-bold text-gray-700 mb-2">Mobiliario Agregado</h4>
                    <div class="border rounded-md overflow-hidden">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs text-gray-500">Producto</th>
                                    <th class="px-4 py-2 text-right text-xs text-gray-500">Precio U.</th>
                                    <th class="px-4 py-2 text-center text-xs text-gray-500">Días Totales</th>
                                    <th class="px-4 py-2 text-center text-xs text-gray-500">Cantidad</th>
                                    <th class="px-4 py-2 text-right text-xs text-gray-500">Subtotal</th>
                                    @if($canEditProducts)
                                        <th class="px-4 py-2 text-center text-xs text-gray-500"></th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @php $acumulado = 0; @endphp
                                @forelse($cart_products as $idx => $op)
                                    @php 
                                        $precio = $op['precio'] ?? 0;
                                        $cantidad = $op['cantidad'] ?? 1;
                                        $subtl = $cantidad * $precio * $modal_dias_alquiler;
                                        $acumulado += $subtl;
                                    @endphp
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800">{{ $op['nombre'] ?? 'Desconocido' }}</td>
                                        <td class="px-4 py-2 text-sm text-right text-gray-600">${{ number_format($precio, 2) }} <span class="text-xs text-gray-400">/día</span></td>
                                        <td class="px-4 py-2 text-sm text-center text-gray-800">{{ $modal_dias_alquiler }}</td>
                                        <td class="px-4 py-2 text-sm text-center text-gray-800">{{ $cantidad }}</td>
                                        <td class="px-4 py-2 text-sm text-right font-semibold text-gray-800">${{ number_format($subtl, 2) }}</td>
                                        @if($canEditProducts)
                                            <td class="px-4 py-2 text-center">
                                                <button wire:click="removeProductFromOrder({{ $idx }})" class="text-red-500 hover:text-red-700">
                                                    <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </td>
                                        @endif
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-4 py-4 text-center text-gray-500 text-sm">Aún no hay mobiliario asignado a esta orden.</td>
                                    </tr>
                                @endforelse

                                @if(is_array($order_costos_adicionales) && count($order_costos_adicionales) > 0)
                                    <tr class="bg-yellow-100">
                                        <td colspan="6" class="px-4 py-2 font-bold text-yellow-800 text-xs uppercase">Costos Adicionales</td>
                                    </tr>
                                    @foreach($order_costos_adicionales as $c_idx => $costo)
                                        @php
                                            $monto = (float)($costo['monto'] ?? 0);
                                            $acumulado += $monto;
                                        @endphp
                                        <tr class="bg-yellow-50 hover:bg-yellow-100 transition-colors">
                                            <td colspan="3" class="px-4 py-2 text-sm text-gray-800">{{ $costo['concepto'] ?? 'Costo Extra' }}</td>
                                            <td class="px-4 py-2 text-sm text-right text-gray-500 font-bold">Extra</td>
                                            <td class="px-4 py-2 text-sm text-right font-semibold text-gray-800">${{ number_format($monto, 2) }}</td>
                                            @if($canEditProducts)
                                                <td class="px-4 py-2 text-center">
                                                    <button wire:click="removeCostoAdicionalFromOrder({{ $c_idx }})" class="text-red-500 hover:text-red-700" title="Eliminar Costo Adicional">
                                                        <svg class="h-5 w-5 inline" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </td>
                                            @endif
                                        </tr>
                                    @endforeach
                                @endif

                                @if($acumulado > 0)
                                    <tr class="bg-gray-50 border-t-2 border-gray-200">
                                        <td colspan="4" class="px-4 py-3 text-right font-bold text-gray-700">TOTAL ESTIMADO (INCLUYE EXTRAS):</td>
                                        <td class="px-4 py-3 text-right font-bold text-green-600 text-lg">${{ number_format($acumulado, 2) }}</td>
                                        @if($canEditProducts)
                                            <td></td>
                                        @endif
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    @if($canEditProducts)
                        <!-- Add Extra Cost Form -->
                        <div class="mt-6 bg-yellow-50 p-4 border border-yellow-200 rounded-md">
                            <h4 class="font-bold text-yellow-800 mb-2">Agregar Costo Adicional (Fletes, Maniobras, etc.)</h4>
                            <div class="flex flex-col md:flex-row md:items-end gap-4">
                                <div class="w-full md:w-1/2">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Concepto</label>
                                    <input type="text" wire:model.defer="new_costo_concepto" placeholder="Ej. Flete redondo" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                    @error('new_costo_concepto') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-1/3">
                                    <label class="block text-xs font-medium text-gray-700 mb-1">Monto ($)</label>
                                    <input type="number" step="0.01" wire:model.defer="new_costo_monto" placeholder="0.00" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-yellow-500 focus:ring-yellow-500 sm:text-sm">
                                    @error('new_costo_monto') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div class="w-full md:w-auto">
                                    <button wire:click="addCostoAdicionalToOrder" class="w-full bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 text-sm rounded-md shadow-sm font-semibold transition-colors">Añadir Costo</button>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <div class="bg-gray-50 border-t p-4 flex justify-end space-x-3">
                    <button wire:click="closeProductsModal" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded shadow-sm font-medium transition-colors">{{ $canEditProducts ? 'Cancelar' : 'Cerrar' }}</button>
                    @if($canEditProducts)
                        <button wire:click="saveProductsAndCosts" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm font-medium transition-colors">Confirmar Cambios</button>
                    @endif
                </div>
            </div>
        </div>
    @endif

    <!-- PAYMENT MODAL -->
    @if($showPaymentModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h3 class="text-xl font-bold text-gray-800">Registrar Pago</h3>
                    <button wire:click="closePaymentModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="processPayment">
                    <div class="p-6 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Monto a abonar *</label>
                            <input type="number" step="0.01" wire:model.defer="monto_a_pagar" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                            @error('monto_a_pagar') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Evidencia de Pago (Opcional)</label>
                            <input type="file" wire:model="evidencia_pago" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                            @error('evidencia_pago') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            <div wire:loading wire:target="evidencia_pago" class="text-sm text-gray-500 mt-1">Cargando archivo...</div>
                        </div>
                    </div>
                    <div class="bg-gray-50 border-t p-4 flex justify-end space-x-3">
                        <button type="button" wire:click="closePaymentModal" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded shadow-sm font-medium">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded shadow-sm font-medium flex items-center">
                            Guardar Pago
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- CANCEL MODAL -->
    @if($showCancelModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center">
                    <h3 class="text-xl font-bold text-red-600">Motivo de Cancelación / Devolución</h3>
                    <button wire:click="closeCancelModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="cancelOrder">
                    <div class="p-6">
                        <label class="block text-sm font-medium text-gray-700">Por favor, indique el por qué: *</label>
                        <textarea wire:model.defer="motivo_cancelacion" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500 sm:text-sm"></textarea>
                        @error('motivo_cancelacion') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div class="bg-gray-50 border-t p-4 flex justify-end space-x-3">
                        <button type="button" wire:click="closeCancelModal" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded shadow-sm font-medium">Cerrar</button>
                        <button type="submit" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white rounded shadow-sm font-medium">Confirmar Cancelación</button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- DETAILS MODAL -->
    @if($showDetailsModal && $selected_order)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-4xl overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Detalles de la Orden #{{ $selected_order->id }}</h3>
                    <button wire:click="closeDetailsModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <div class="p-6 max-h-[80vh] overflow-y-auto">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Sección Cliente -->
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2 border-b pb-1">Datos del Cliente</h4>
                            <p class="text-sm"><strong>Nombre:</strong> {{ $selected_order->cliente->persona->nombre ?? '' }} {{ $selected_order->cliente->persona->apellido ?? '' }}</p>
                            <p class="text-sm"><strong>Correo:</strong> {{ $selected_order->cliente->correo ?? 'N/A' }}</p>
                            <p class="text-sm"><strong>Teléfono:</strong> {{ $selected_order->cliente->telefonos->first()->numero ?? ($selected_order->cliente->telefonos->first()->telefono ?? 'N/A') }}</p>
                        </div>
                        <!-- Sección Fechas -->
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2 border-b pb-1">Fechas Relevantes</h4>
                            <p class="text-sm"><strong>Solicitada:</strong> {{ $selected_order->fecha_solicitada ? \Carbon\Carbon::parse($selected_order->fecha_solicitada)->format('d/m/Y H:i') : 'N/A' }}</p>
                            <p class="text-sm"><strong>Entrega Física:</strong> {{ $selected_order->fecha_entrega ? \Carbon\Carbon::parse($selected_order->fecha_entrega)->format('d/m/Y H:i') : 'N/A' }}</p>
                            <p class="text-sm"><strong>Prevista de Recep.:</strong> {{ $selected_order->fecha_recepcion ? \Carbon\Carbon::parse($selected_order->fecha_recepcion)->format('d/m/Y H:i') : 'N/A' }}</p>
                            <p class="text-sm"><strong>Status Actual:</strong> <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">{{ $selected_order->status->name ?? 'N/A' }}</span></p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <!-- Datos Adicionales -->
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2 border-b pb-1">Datos de Entrega</h4>
                            <p class="text-sm"><strong>Recibe:</strong> {{ $selected_order->recibe ?? 'N/A' }}</p>
                            <p class="text-sm"><strong>Chofer/Entrega:</strong> {{ $selected_order->entrega ?? 'N/A' }}</p>
                            @php
                                $dir = \App\Models\CatalagoCliente::with('direccion.colonia')->find($selected_order->direcciónes_clientes_id);
                            @endphp
                            @if($dir && $dir->direccion)
                                <p class="text-sm"><strong>Dirección:</strong> {{ $dir->direccion->calle ?? '' }} {{ $dir->direccion->entre_calles ? 'entre '.$dir->direccion->entre_calles : '' }}</p>
                                <p class="text-sm"><strong>Colonia:</strong> {{ $dir->direccion->colonia->localidad ?? '' }}, CP: {{ $dir->direccion->cp ?? '' }}</p>
                                <p class="text-sm"><strong>Ref:</strong> {{ $dir->direccion->referencia ?? 'N/A' }}</p>
                            @endif
                        </div>
                        <div>
                            <h4 class="font-bold text-gray-700 mb-2 border-b pb-1">Finanzas</h4>
                            <p class="text-sm"><strong>Método de Pago:</strong> {{ $selected_order->metodoPago->nombre ?? 'N/A' }}</p>
                            @php
                                $costos_adicionales_detalle = $selected_order->costos_adicionales ? json_decode($selected_order->costos_adicionales, true) : [];
                            @endphp
                            @if(is_array($costos_adicionales_detalle) && count($costos_adicionales_detalle) > 0)
                                <div class="my-2 p-2 bg-yellow-50 rounded border border-yellow-200">
                                    <p class="text-xs font-bold text-yellow-800 mb-1">Costos Adicionales:</p>
                                    @foreach($costos_adicionales_detalle as $costo)
                                        <div class="flex justify-between text-xs">
                                            <span>{{ $costo['concepto'] ?? 'Costo' }}</span>
                                            <span class="font-medium">${{ number_format((float)($costo['monto'] ?? 0), 2) }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            <p class="text-sm"><strong>Total:</strong> ${{ number_format($selected_order->total, 2) }}</p>
                            <p class="text-sm"><strong>Monto Pagado:</strong> ${{ number_format($selected_order->monto_pagado, 2) }}</p>
                            <p class="text-sm font-bold {{ max(0, $selected_order->total - $selected_order->monto_pagado) > 0 ? 'text-red-600' : 'text-green-600' }}"><strong>Saldo:</strong> ${{ number_format(max(0, $selected_order->total - $selected_order->monto_pagado), 2) }}</p>
                        </div>
                    </div>

                    <!-- Lista de Productos -->
                    <h4 class="font-bold text-gray-700 mb-2 border-b pb-1">Productos Alquilados</h4>
                    <div class="border rounded-md overflow-hidden bg-white mb-4">
                        @php
                            $dias_alquiler = 1;
                            if ($selected_order && $selected_order->fecha_entrega && $selected_order->fecha_recepcion) {
                                try {
                                    $f_inicio = \Carbon\Carbon::parse($selected_order->fecha_entrega)->startOfDay();
                                    $f_fin = \Carbon\Carbon::parse($selected_order->fecha_recepcion)->startOfDay();
                                    if (!$f_fin->lt($f_inicio)) {
                                        $dias_diff = $f_inicio->diffInDays($f_fin);
                                        $dias_alquiler = $dias_diff == 0 ? 1 : $dias_diff;
                                    }
                                } catch (\Exception $e) {}
                            }
                        @endphp
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase">Producto</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Precio U.</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Días</th>
                                    <th class="px-4 py-2 text-center text-xs font-medium text-gray-500 uppercase">Cantidad</th>
                                    <th class="px-4 py-2 text-right text-xs font-medium text-gray-500 uppercase">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse($selected_order->productos as $p_item)
                                    <tr>
                                        <td class="px-4 py-2 text-sm text-gray-800 font-medium">{{ $p_item->catalogoPrecio->producto->nombre ?? 'N/A' }} <span class="text-gray-500 text-xs">({{ $p_item->catalogoPrecio->producto->color->nombre ?? '' }})</span></td>
                                        <td class="px-4 py-2 text-sm text-right">${{ number_format($p_item->catalogoPrecio->precio ?? 0, 2) }}</td>
                                        <td class="px-4 py-2 text-sm text-center">{{ $dias_alquiler }}</td>
                                        <td class="px-4 py-2 text-sm text-center font-bold">{{ $p_item->cantidad }}</td>
                                        <td class="px-4 py-2 text-sm text-right font-medium">${{ number_format($p_item->cantidad * ($p_item->catalogoPrecio->precio ?? 0) * $dias_alquiler, 2) }}</td>
                                    </tr>
                                @empty
                                    <tr><td colspan="5" class="px-4 py-3 text-center text-sm text-gray-500">No hay productos en esta orden.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @if($selected_order->motivo_cancelacion)
                        <div class="mt-4 p-4 bg-red-50 border border-red-200 rounded-md">
                            <h4 class="font-bold text-red-800 mb-1 flex items-center">
                                <svg class="w-5 h-5 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Motivo de Cancelación / Devolución
                            </h4>
                            <p class="text-sm text-red-700">{{ $selected_order->motivo_cancelacion }}</p>
                        </div>
                    @endif
                </div>
                <div class="bg-gray-100 border-t p-4 flex justify-end">
                    <button wire:click="closeDetailsModal" class="px-6 py-2 bg-gray-600 hover:bg-gray-700 text-white rounded shadow-sm font-medium transition-colors">Cerrar</button>
                </div>
            </div>
        </div>
    @endif

    <!-- EDIT MODAL -->
    @if($showEditModal)
        <div class="fixed inset-0 z-50 overflow-y-auto bg-gray-900 bg-opacity-50 flex items-center justify-center p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-lg overflow-hidden">
                <div class="p-6 border-b flex justify-between items-center bg-gray-50">
                    <h3 class="text-xl font-bold text-gray-800">Editar Orden #{{ $selected_order_id }}</h3>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                </div>
                <form wire:submit.prevent="updateOrder">
                    <div class="p-6 space-y-4">
                        <div class="bg-blue-50 border border-blue-200 text-blue-800 text-sm p-3 rounded-md mb-4 shadow-sm">
                            ℹ️ Si modificas las fechas de entrega o recolección, <strong>el total de la orden será recalculado automáticamente</strong> basándose en la cantidad de días de renta.
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha de Entrega Física *</label>
                                <input type="datetime-local" wire:model.defer="edit_fecha_entrega" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('edit_fecha_entrega') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700">Fecha Prevista de Recolección *</label>
                                <input type="datetime-local" wire:model.defer="edit_fecha_recepcion" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                @error('edit_fecha_recepcion') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <label class="block text-sm font-medium text-gray-700">Dirección de Entrega *</label>
                            <select wire:model.defer="edit_catalogo_cliente_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 sm:text-sm">
                                <option value="">Seleccione una dirección...</option>
                                @foreach($edit_direcciones as $dir)
                                    <option value="{{ $dir->id }}">
                                        {{ $dir->direccion->calle ?? '' }} 
                                        {{ isset($dir->direccion->colonia->localidad) ? '- '.$dir->direccion->colonia->localidad : '' }}
                                    </option>
                                @endforeach
                            </select>
                            @error('edit_catalogo_cliente_id') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>
                    <div class="bg-gray-50 border-t p-4 flex justify-end space-x-3">
                        <button type="button" wire:click="closeEditModal" class="px-4 py-2 bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 rounded shadow-sm font-medium transition-colors">Cancelar</button>
                        <button type="submit" class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded shadow-sm font-medium transition-colors">Guardar Cambios</button>
                    </div>
                </form>
            </div>
        </div>
    @endif
</div>

