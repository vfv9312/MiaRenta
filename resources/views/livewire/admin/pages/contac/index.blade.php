<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Detalles de Contacto
                </h1>
                <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Gestiona los enlaces, correos y teléfonos de
                    contacto.</p>
            </div>
            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none hover:scale-105 active:scale-95">
                <i class="fas fa-plus"></i> Nuevo Contacto
            </button>
        </header>

        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                <i class="fas fa-check-circle"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Card Container -->
        <div
            class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Search & Actions -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <div class="relative max-w-md">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                    <input type="text" wire:model.live="search"
                        class="w-full pl-10 pr-4 py-2 border border-gray-200 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-700 text-gray-900 dark:text-white focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors"
                        placeholder="Buscar por recurso o tipo...">
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 dark:bg-gray-900/50">
                            <th
                                class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Tipo de Contacto</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Recurso / Valor</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">
                                Estado</th>
                            <th
                                class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">
                                Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($detalles as $detalle)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-lg bg-indigo-50 dark:bg-indigo-900/30 flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                                            <i class="{{ $detalle->catalagoTipo->tipo->icon ?? 'fas fa-link' }}"></i>
                                        </div>
                                        <div>
                                            <div class="font-bold text-gray-900 dark:text-white">
                                                {{ $detalle->catalagoTipo->nombre ?? 'N/A' }}</div>
                                            <div class="text-xs text-gray-500">
                                                {{ $detalle->catalagoTipo->tipo->name ?? 'N/A' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 dark:text-gray-300">{{ $detalle->recurso }}</div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 text-xs font-bold rounded-full {{ $detalle->status_id == 1 ? 'bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400' : 'bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400' }}">
                                        {{ $detalle->status->name ?? 'Activo' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $detalle->id }})"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors dark:hover:bg-blue-900/30"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $detalle->id }})"
                                            class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors dark:hover:bg-red-900/30"
                                            title="Eliminar">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500 dark:text-gray-400">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-address-book text-4xl text-gray-300 dark:text-gray-600"></i>
                                        <p class="text-lg font-medium">No se encontraron detalles de contacto</p>
                                        <p class="text-sm">Comienza agregando uno nuevo.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($detalles->hasPages())
                <div class="p-4 border-t border-gray-100 dark:border-gray-700">
                    {{ $detalles->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Modal Form -->
    @if ($isOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="closeModal"></div>
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-md w-full animate-in fade-in zoom-in duration-200">
                <div class="p-6 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">
                        {{ $item_id ? 'Editar Contacto' : 'Nuevo Contacto' }}
                    </h3>
                    <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 focus:outline-none">
                        <i class="fas fa-times text-lg"></i>
                    </button>
                </div>

                <form wire:submit.prevent="store" class="p-6">
                    <div class="space-y-5">
                        <!-- Tipo de Contacto -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Red Social /
                                Tipo</label>
                            <select wire:model="contacto_data_tipo_id"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                                <option value="">Seleccione un tipo...</option>
                                @foreach ($tipos as $tipo)
                                    <option value="{{ $tipo->id }}">{{ $tipo->nombre }}
                                        ({{ $tipo->tipo->name ?? '' }})</option>
                                @endforeach
                            </select>
                            @error('contacto_data_tipo_id')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Recurso -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Recurso (URL o
                                Teléfono)</label>
                            <input wire:model="recurso" type="text"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5"
                                placeholder="Ej: https://facebook.com/miarenta">
                            @error('recurso')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div>
                            <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Estado</label>
                            <select wire:model="status_id"
                                class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                                <option value="">Seleccione el estado...</option>
                                @foreach ($statuses as $status)
                                    <option value="{{ $status->id }}">{{ $status->name }}</option>
                                @endforeach
                            </select>
                            @error('status_id')
                                <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="mt-8 flex items-center justify-end gap-3">
                        <button type="button" wire:click="closeModal"
                            class="px-5 py-2.5 text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 font-medium rounded-xl transition-colors">Cancelar</button>
                        <button type="submit"
                            class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none flex items-center gap-2">
                            <i class="fas fa-save"></i> Guardar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if ($showDeleteModal)
        <div class="fixed inset-0 z-50 flex items-center justify-center p-4">
            <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" wire:click="$set('showDeleteModal', false)">
            </div>
            <div
                class="relative bg-white dark:bg-gray-800 rounded-2xl shadow-2xl max-w-sm w-full p-6 text-center animate-in fade-in zoom-in duration-200">
                <div
                    class="w-16 h-16 rounded-full bg-red-100 dark:bg-red-900/30 flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-exclamation-triangle text-2xl text-red-600 dark:text-red-400"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">¿Eliminar registro?</h3>
                <p class="text-gray-500 dark:text-gray-400 mb-6 font-medium">Esta acción no se puede deshacer.</p>

                <div class="flex items-center justify-center gap-3">
                    <button wire:click="$set('showDeleteModal', false)"
                        class="px-5 py-2.5 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 font-bold rounded-xl transition-colors w-full">
                        Cancelar
                    </button>
                    <button wire:click="delete"
                        class="px-5 py-2.5 bg-red-600 hover:bg-red-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-red-200 dark:shadow-none w-full">
                        Eliminar
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
