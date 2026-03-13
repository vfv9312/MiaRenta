<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Reparaciones</h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona las reparaciones de tus productos.</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-plus"></i> Nueva Reparación
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
                        placeholder="Buscar por producto o descripción...">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Producto</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Cantidad</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Fecha Envío</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Reparados</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Costo</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($repairs as $repair)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $repair->producto->nombre ?? 'N/A' }}</div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400 truncate max-w-xs">{{ $repair->descripcion }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white font-medium">{{ $repair->cantidad }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-gray-900 dark:text-white">{{ $repair->fecha->format('d/m/Y') }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($repair->status_id == 5)
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400">
                                            <span class="w-2 h-2 rounded-full bg-amber-500 animate-pulse"></span>
                                            En Reparación
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                            <i class="fas fa-check-circle"></i>
                                            Reparado
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($repair->status_id == 4)
                                        <div class="text-gray-900 dark:text-white font-medium">
                                            {{ $repair->cantidad_reparada }} / {{ $repair->cantidad }}
                                        </div>
                                        <div class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $repair->fecha_reparacion ? $repair->fecha_reparacion->format('d/m/Y') : '' }}
                                        </div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @if ($repair->precio)
                                        <div class="text-green-600 dark:text-green-400 font-bold">${{ number_format($repair->precio, 2) }}</div>
                                    @else
                                        <span class="text-gray-400 dark:text-gray-600">—</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if ($repair->status_id == 5)
                                            <button wire:click="openRepairModal({{ $repair->id }})"
                                                class="p-2 text-green-600 hover:bg-green-50 rounded-lg transition-colors dark:hover:bg-green-900/30"
                                                title="Marcar como Reparado">
                                                <i class="fas fa-wrench"></i>
                                            </button>
                                            <button wire:click="edit({{ $repair->id }})"
                                                class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors dark:hover:bg-blue-900/30"
                                                title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                        @endif
                                        <button wire:click="confirmDelete({{ $repair->id }})"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors dark:hover:bg-red-900/30"
                                            title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-tools text-4xl text-gray-300 dark:text-gray-600"></i>
                                        <p class="text-lg font-medium">No se encontraron reparaciones</p>
                                        <p class="text-sm">Registra una nueva reparación para comenzar.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($repairs->hasPages())
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $repairs->links() }}
                </div>
            @endif
        </div>
    </div>

    {{-- ===================== MODAL: NUEVA REPARACIÓN ===================== --}}
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-lg w-full animate-in fade-in zoom-in duration-200 overflow-y-auto max-h-[90vh]">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between sticky top-0 bg-white dark:bg-gray-800 z-10">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $item_id ? 'Editar Reparación' : 'Registrar Nueva Reparación' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="{{ $item_id ? 'update' : 'store' }}" class="p-6 space-y-5">
                    <!-- Producto -->
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

                    <div class="grid grid-cols-2 gap-4">
                        <!-- Cantidad -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Cantidad a Reparar</label>
                            <input wire:model="cantidad" type="number" min="1"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Ej: 5">
                            @error('cantidad') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <!-- Fecha -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha de Envío</label>
                            <input wire:model="fecha" type="date"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                            @error('fecha') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <!-- Descripción -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Descripción del daño</label>
                        <textarea wire:model="descripcion" rows="3"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="Describe el daño o motivo de reparación..."></textarea>
                        @error('descripcion') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        <button type="button" wire:click="closeModal" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-save"></i>
                            {{ $item_id ? 'Actualizar' : 'Registrar Reparación' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===================== MODAL: MARCAR COMO REPARADO ===================== --}}
    @if ($showRepairModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeRepairModal"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-200">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        <i class="fas fa-wrench text-green-500 mr-2"></i> Completar Reparación
                    </h3>
                    <button wire:click="closeRepairModal" class="text-gray-400 hover:text-gray-500">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="markRepaired" class="p-6 space-y-5">
                    <!-- Cantidad Reparada -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">¿Cuántos se lograron reparar?</label>
                        <input wire:model="cantidad_reparada" type="number" min="0"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-white p-2.5"
                            placeholder="Ej: 3">
                        @error('cantidad_reparada') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Precio -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Costo de la Reparación</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">$</span>
                            </div>
                            <input wire:model="precio" type="number" step="0.01" min="0"
                                class="w-full pl-7 bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="0.00">
                        </div>
                        @error('precio') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <!-- Fecha Reparación -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha de Reparación</label>
                        <input wire:model="fecha_reparacion" type="date"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-green-500 text-gray-900 dark:text-white p-2.5">
                        @error('fecha_reparacion') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    <div class="pt-6 border-t border-gray-100 dark:border-gray-700 flex justify-end gap-3">
                        <button type="button" wire:click="closeRepairModal" class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">
                            Cancelar
                        </button>
                        <button type="submit" class="px-6 py-2.5 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-green-200 dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-check-circle"></i> Marcar como Reparado
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    {{-- ===================== MODAL: CONFIRMAR ELIMINACIÓN ===================== --}}
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="$set('showDeleteModal', false)"></div>
            <div class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center animate-in fade-in zoom-in duration-200">
                <div class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">¿Eliminar reparación?</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">Esta acción marcará el registro como eliminado.</p>
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
