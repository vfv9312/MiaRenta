<div>
    {{-- ─── CABECERA ──────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
        <div>
            <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Facturas Solicitadas</h2>
            <p class="text-sm text-gray-500 dark:text-gray-400 mt-0.5">Gestiona las solicitudes de facturación recibidas</p>
        </div>
    </div>

    {{-- ─── FILTROS ────────────────────────────────────────── --}}
    <div class="flex flex-col sm:flex-row gap-3 mb-5">
        <div class="relative flex-1">
            <span class="absolute inset-y-0 left-3 flex items-center text-gray-400 pointer-events-none">
                <i class="bi bi-search"></i>
            </span>
            <input wire:model.live.debounce.400ms="search"
                   type="text"
                   placeholder="Buscar por ticket, RFC, razón social o email…"
                   class="w-full pl-9 pr-4 py-2.5 text-sm border border-gray-300 rounded-xl dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
        </div>
        <select wire:model.live="filtroEstatus"
                class="text-sm border border-gray-300 rounded-xl px-3 py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:text-white focus:ring-2 focus:ring-indigo-500">
            <option value="">Todos los estatus</option>
            <option value="pendiente">Pendiente</option>
            <option value="enviada">Enviada</option>
        </select>
    </div>

    {{-- ─── TABLA ──────────────────────────────────────────── --}}
    <div class="overflow-x-auto rounded-2xl shadow-sm border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left text-gray-600 dark:text-gray-300">
            <thead class="text-xs uppercase bg-gray-50 dark:bg-gray-700 text-gray-500 dark:text-gray-400">
                <tr>
                    <th class="px-4 py-3"># Ticket</th>
                    <th class="px-4 py-3">RFC / Razón Social</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3 text-center">Documentos</th>
                    <th class="px-4 py-3 text-center">Estatus</th>
                    <th class="px-4 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 dark:divide-gray-700 bg-white dark:bg-gray-800">
                @forelse ($facturas as $f)
                <tr wire:key="fac-{{ $f->id }}" class="hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">
                    <td class="px-4 py-3 font-semibold text-gray-800 dark:text-white whitespace-nowrap">
                        {{ $f->numero_ticket }}
                    </td>
                    <td class="px-4 py-3">
                        <div class="font-medium text-gray-800 dark:text-white">{{ $f->razon_social }}</div>
                        <div class="text-xs text-gray-400">{{ $f->rfc }}</div>
                    </td>
                    <td class="px-4 py-3 text-gray-600 dark:text-gray-300">{{ $f->email }}</td>

                    {{-- Documentos del cliente --}}
                    <td class="px-4 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            @if($f->constancia_path)
                                <a href="{{ asset($f->constancia_path) }}" target="_blank"
                                   title="Constancia fiscal"
                                   class="inline-flex items-center gap-1 text-xs px-2 py-1 bg-blue-100 text-blue-700 rounded-lg hover:bg-blue-200 transition dark:bg-blue-900/40 dark:text-blue-300">
                                    <i class="bi bi-file-earmark-pdf"></i> Constancia
                                </a>
                            @endif
                            @if($f->nota_path)
                                <a href="{{ asset($f->nota_path) }}" target="_blank"
                                   title="Nota / comprobante"
                                   class="inline-flex items-center gap-1 text-xs px-2 py-1 bg-purple-100 text-purple-700 rounded-lg hover:bg-purple-200 transition dark:bg-purple-900/40 dark:text-purple-300">
                                    <i class="bi bi-receipt"></i> Nota
                                </a>
                            @endif
                            @if(!$f->constancia_path && !$f->nota_path)
                                <span class="text-xs text-gray-400">—</span>
                            @endif
                        </div>
                    </td>

                    {{-- Estatus --}}
                    <td class="px-4 py-3 text-center">
                        @if($f->estatus === 'enviada')
                            <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                                <i class="bi bi-check-circle-fill"></i> Enviada
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300">
                                <i class="bi bi-clock-fill"></i> Pendiente
                            </span>
                        @endif
                    </td>

                    {{-- Acciones --}}
                    <td class="px-4 py-3 text-center">
                        <button wire:click="abrirModal({{ $f->id }})"
                                class="inline-flex items-center gap-1 text-xs px-3 py-1.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition font-medium">
                            <i class="bi bi-folder2-open"></i> Gestionar
                        </button>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-4 py-10 text-center text-gray-400 dark:text-gray-500">
                        <i class="bi bi-inbox text-3xl block mb-2"></i>
                        No se encontraron solicitudes de factura.
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Paginación --}}
    <div class="mt-4">
        {{ $facturas->links() }}
    </div>

    {{-- ─── MODAL DE GESTIÓN ───────────────────────────────── --}}
    @if($modalAbierto && $facturaItem)
    <div class="fixed inset-0 z-50 flex items-center justify-center bg-black/60 backdrop-blur-sm p-4"
         x-data x-on:keydown.escape.window="$wire.cerrarModal()">
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto">

            {{-- Header modal --}}
            <div class="flex items-center justify-between px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div>
                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                        Solicitud #{{ $facturaItem->numero_ticket }}
                    </h3>
                    <p class="text-xs text-gray-400 dark:text-gray-500">{{ $facturaItem->razon_social }}</p>
                </div>
                <button wire:click="cerrarModal"
                        class="text-gray-400 hover:text-gray-600 dark:hover:text-white transition p-1 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                    <i class="bi bi-x-lg text-lg"></i>
                </button>
            </div>

            <div class="px-6 py-5 space-y-6">

                {{-- Datos fiscales --}}
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">RFC</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $facturaItem->rfc }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Razón Social</p>
                        <p class="text-sm font-medium text-gray-800 dark:text-white">{{ $facturaItem->razon_social }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Régimen</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $facturaItem->regimen }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Uso CFDI</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $facturaItem->uso_cfdi }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">C.P.</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300">{{ $facturaItem->cp }}</p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-1">Email</p>
                        <p class="text-sm text-gray-700 dark:text-gray-300 break-all">{{ $facturaItem->email }}</p>
                    </div>
                </div>

                {{-- Documentos del cliente --}}
                <div>
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Documentos enviados por el cliente</p>
                    <div class="flex flex-wrap gap-3">
                        @if($facturaItem->constancia_path)
                            <a href="{{ asset($facturaItem->constancia_path) }}" target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 border border-blue-200 text-blue-700 rounded-xl hover:bg-blue-100 transition text-sm font-medium dark:bg-blue-900/30 dark:border-blue-700 dark:text-blue-300">
                                <i class="bi bi-file-earmark-pdf-fill text-base"></i>
                                Constancia Fiscal
                                <i class="bi bi-box-arrow-up-right text-xs opacity-60"></i>
                            </a>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-400 rounded-xl text-sm dark:bg-gray-700">
                                <i class="bi bi-file-earmark-x"></i> Sin constancia
                            </span>
                        @endif

                        @if($facturaItem->nota_path)
                            <a href="{{ asset($facturaItem->nota_path) }}" target="_blank"
                               class="inline-flex items-center gap-2 px-4 py-2.5 bg-purple-50 border border-purple-200 text-purple-700 rounded-xl hover:bg-purple-100 transition text-sm font-medium dark:bg-purple-900/30 dark:border-purple-700 dark:text-purple-300">
                                <i class="bi bi-receipt text-base"></i>
                                Nota / Comprobante
                                <i class="bi bi-box-arrow-up-right text-xs opacity-60"></i>
                            </a>
                        @else
                            <span class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 text-gray-400 rounded-xl text-sm dark:bg-gray-700">
                                <i class="bi bi-receipt-cutoff"></i> Sin nota
                            </span>
                        @endif
                    </div>
                </div>

                {{-- Factura generada --}}
                <div class="bg-gray-50 dark:bg-gray-700/50 rounded-xl p-4 border border-gray-200 dark:border-gray-600">
                    <p class="text-xs font-semibold text-gray-400 uppercase tracking-wide mb-3">Factura a entregar</p>

                    @if($facturaItem->factura_path)
                        <div class="flex items-center gap-3 mb-4">
                            <i class="bi bi-file-check-fill text-green-500 text-2xl"></i>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-800 dark:text-white">Factura cargada</p>
                                <p class="text-xs text-gray-400 truncate">{{ basename($facturaItem->factura_path) }}</p>
                            </div>
                            <a href="{{ asset($facturaItem->factura_path) }}" target="_blank"
                               class="shrink-0 text-xs px-3 py-1.5 bg-green-100 text-green-700 rounded-lg hover:bg-green-200 transition dark:bg-green-900/40 dark:text-green-300">
                                <i class="bi bi-eye"></i> Ver
                            </a>
                        </div>
                    @else
                        <p class="text-sm text-gray-400 italic mb-3">Aún no se ha subido la factura.</p>
                    @endif

                    {{-- Upload --}}
                    <div>
                        <label class="block text-xs font-medium text-gray-600 dark:text-gray-300 mb-1.5">
                            {{ $facturaItem->factura_path ? 'Reemplazar factura' : 'Subir factura' }}
                        </label>
                        <input wire:model="nuevaFactura" type="file" accept=".pdf,.xml,.zip"
                               class="block w-full text-sm text-gray-500 file:mr-3 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 dark:text-gray-400 dark:file:bg-indigo-900/40 dark:file:text-indigo-300">
                        @error('nuevaFactura')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                        <div wire:loading wire:target="nuevaFactura" class="text-xs text-indigo-500 mt-1 flex items-center gap-1">
                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24" fill="none"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"/><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"/></svg>
                            Procesando…
                        </div>
                    </div>

                    <button wire:click="subirFactura"
                            wire:loading.attr="disabled"
                            wire:target="subirFactura"
                            class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 disabled:opacity-60 text-white rounded-xl text-sm font-medium transition">
                        <span wire:loading.remove wire:target="subirFactura"><i class="bi bi-cloud-arrow-up"></i> Guardar factura</span>
                        <span wire:loading wire:target="subirFactura">Guardando…</span>
                    </button>
                </div>

                {{-- Estatus y botones de envío --}}
                <div class="border-t border-gray-200 dark:border-gray-700 pt-5">
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div class="flex items-center gap-2">
                            <span class="text-sm font-medium text-gray-600 dark:text-gray-300">Estatus actual:</span>
                            @if($facturaItem->estatus === 'enviada')
                                <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full bg-green-100 text-green-700 dark:bg-green-900/40 dark:text-green-300">
                                    <i class="bi bi-check-circle-fill"></i> Factura enviada
                                </span>
                            @else
                                <span class="inline-flex items-center gap-1 text-xs font-bold px-3 py-1 rounded-full bg-yellow-100 text-yellow-700 dark:bg-yellow-900/40 dark:text-yellow-300">
                                    <i class="bi bi-clock-fill"></i> Pendiente
                                </span>
                            @endif
                        </div>

                        @if($facturaItem->factura_path)
                        <div class="flex flex-wrap gap-2">
                            {{-- WhatsApp --}}
                            @php
                                $telefono = preg_replace('/\D/', '', $facturaItem->email ?? '');
                                $waMsg = urlencode("Hola, te enviamos la factura solicitada (Ticket: {$facturaItem->numero_ticket}). Puedes descargarla en: " . asset($facturaItem->factura_path));
                                $waUrl = "https://wa.me/?text={$waMsg}";
                            @endphp
                            <a href="{{ $waUrl }}" target="_blank"
                               wire:click="marcarComoEnviada({{ $facturaItem->id }})"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-green-500 hover:bg-green-600 text-white rounded-xl text-sm font-semibold transition shadow-sm">
                                <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 00-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.890-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                </svg>
                                WhatsApp
                            </a>

                            {{-- Email --}}
                            @php
                                $mailSubject = urlencode("Factura solicitada - Ticket {$facturaItem->numero_ticket}");
                                $mailBody    = urlencode("Hola,\n\nAdjuntamos la factura correspondiente al ticket {$facturaItem->numero_ticket}.\n\nSaludos,\nEquipo MíaRenta");
                                $mailUrl     = "mailto:{$facturaItem->email}?subject={$mailSubject}&body={$mailBody}";
                            @endphp
                            <a href="{{ $mailUrl }}"
                               wire:click="marcarComoEnviada({{ $facturaItem->id }})"
                               class="inline-flex items-center gap-2 px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-xl text-sm font-semibold transition shadow-sm">
                                <i class="bi bi-envelope-fill"></i>
                                Enviar por Email
                            </a>
                        </div>
                        @else
                            <p class="text-xs text-gray-400 italic">Sube la factura para poder enviarla.</p>
                        @endif
                    </div>
                </div>

            </div>{{-- /body modal --}}
        </div>
    </div>
    @endif

</div>
