<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <header class="mb-8 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-4">
                <a href="{{ route('configuracion') }}"
                    class="w-10 h-10 flex items-center justify-center rounded-xl bg-white dark:bg-gray-800 border border-gray-100 dark:border-gray-700 text-gray-500 hover:text-indigo-600 transition-all shadow-sm">
                    <i class="fas fa-arrow-left"></i>
                </a>
                <div>
                    <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Métodos de Pago</h1>
                    <nav class="flex text-sm text-gray-500 dark:text-gray-400 gap-2 mt-1">
                        <span>Configuración</span>
                        <i class="fas fa-chevron-right text-[10px] mt-1.5"></i>
                        <span class="text-indigo-600 dark:text-indigo-400 font-medium">Métodos de Pago</span>
                    </nav>
                </div>
            </div>

            <button wire:click="create"
                class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none group">
                <i class="fas fa-plus-circle transition-transform group-hover:rotate-90"></i>
                <span>Nuevo Método</span>
            </button>
        </header>

        <!-- Message -->
        @if (session()->has('message'))
            <div
                class="mb-6 p-4 bg-emerald-50 dark:bg-emerald-900/20 border-l-4 border-emerald-500 text-emerald-700 dark:text-emerald-400 shadow-sm rounded-r-lg flex items-center gap-3 animate-fade-in-down">
                <i class="fas fa-check-circle text-xl"></i>
                <span class="font-medium">{{ session('message') }}</span>
            </div>
        @endif

        <!-- Main Content -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <!-- Search and Filters -->
            <div class="p-6 border-b border-gray-100 dark:border-gray-700 bg-gray-50/50 dark:bg-gray-800/50">
                <div class="relative max-w-md">
                    <input wire:model.live="search" type="text"
                        class="w-full pl-12 pr-4 py-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all dark:text-white"
                        placeholder="Buscar por nombre...">
                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                        <i class="fas fa-search text-gray-400"></i>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-white dark:bg-gray-800">
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Metodo</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Estado</th>
                            <th class="px-6 py-4 text-xs font-bold text-gray-500 dark:text-gray-400 uppercase tracking-wider text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        @forelse ($metodos as $metodo)
                            <tr class="hover:bg-gray-50/50 dark:hover:bg-gray-700/30 transition-colors">
                                <td class="px-6 py-4 text-sm font-semibold text-gray-900 dark:text-white">
                                    {{ $metodo->nombre }}
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $colors = [
                                            1 => 'bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border-emerald-200 dark:border-emerald-800',
                                            2 => 'bg-amber-100 text-amber-700 dark:bg-amber-900/30 dark:text-amber-400 border-amber-200 dark:border-amber-800',
                                        ];
                                    @endphp
                                    <span class="px-2.5 py-1 rounded-lg text-xs font-bold border {{ $colors[$metodo->status_id] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $metodo->status->nombre }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <button wire:click="edit({{ $metodo->id }})"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 hover:bg-indigo-600 hover:text-white transition-all shadow-sm"
                                            title="Editar">
                                            <i class="fas fa-edit text-sm"></i>
                                        </button>
                                        <button wire:click="confirmDelete({{ $metodo->id }})"
                                            class="w-9 h-9 flex items-center justify-center rounded-lg bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-400 hover:bg-rose-600 hover:text-white transition-all shadow-sm"
                                            title="Eliminar">
                                            <i class="fas fa-trash-alt text-sm"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <div class="w-20 h-20 bg-gray-50 dark:bg-gray-900 rounded-full flex items-center justify-center mb-2">
                                            <i class="fas fa-money-check text-4xl text-gray-200 dark:text-gray-700"></i>
                                        </div>
                                        <p class="text-gray-500 dark:text-gray-400 font-medium text-lg">No se encontraron métodos de pago</p>
                                        <p class="text-gray-400 dark:text-gray-500 text-sm">Intenta con otro término de búsqueda o crea uno nuevo.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="p-6 border-t border-gray-100 dark:border-gray-700 bg-gray-50/30 dark:bg-gray-800/30">
                {{ $metodos->links() }}
            </div>
        </div>
    </div>

    <!-- Modal Form -->
    @if($isOpen)
        <div class="fixed inset-0 z-[60] overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity" wire:click="closeModal"></div>

                <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full border border-gray-100 dark:border-gray-700">
                    <div class="p-8">
                        <div class="flex items-center justify-between mb-8">
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white" id="modal-title">
                                {{ $item_id ? 'Editar Método de Pago' : 'Nuevo Método de Pago' }}
                            </h3>
                            <button wire:click="closeModal" class="text-gray-400 hover:text-gray-500 transition-colors">
                                <i class="fas fa-times text-xl"></i>
                            </button>
                        </div>

                        <form wire:submit.prevent="store" class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre del Método</label>
                                <input type="text" wire:model="nombre"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all dark:text-white"
                                    placeholder="Ej: Efectivo, Transferencia, etc.">
                                @error('nombre') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Estado</label>
                                <select wire:model="status_id"
                                    class="w-full px-4 py-3 bg-gray-50 dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-all dark:text-white">
                                    @foreach($statuses as $status)
                                        <option value="{{ $status->id }}">{{ $status->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('status_id') <span class="text-xs text-rose-500 mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-6 flex gap-3">
                                <button type="button" wire:click="closeModal"
                                    class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 font-bold rounded-xl transition-all">
                                    Cancelar
                                </button>
                                <button type="submit"
                                    class="flex-1 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-indigo-200 dark:shadow-none">
                                    {{ $item_id ? 'Actualizar' : 'Guardar' }}
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Delete Confirmation Modal -->
    @if($showDeleteModal)
        <div class="fixed inset-0 z-[60] overflow-y-auto">
            <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                <div class="fixed inset-0 bg-gray-500/75 dark:bg-gray-900/80 backdrop-blur-sm transition-opacity" wire:click="$set('showDeleteModal', false)"></div>
                <span class="hidden sm:inline-block sm:align-middle sm:h-screen">&#8203;</span>
                <div class="inline-block align-bottom bg-white dark:bg-gray-800 rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <div class="w-12 h-12 bg-rose-100 dark:bg-rose-900/30 rounded-xl flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-exclamation-triangle text-xl text-rose-600 dark:text-rose-400"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">¿Eliminar Método de Pago?</h3>
                                <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">Esta acción no se puede deshacer de forma directa.</p>
                            </div>
                        </div>

                        <div class="flex gap-3 mt-8">
                            <button wire:click="$set('showDeleteModal', false)"
                                class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 dark:bg-gray-700 dark:hover:bg-gray-600 text-gray-600 dark:text-gray-300 font-bold rounded-xl transition-all">
                                Cancelar
                            </button>
                            <button wire:click="delete"
                                class="flex-1 px-6 py-3 bg-rose-600 hover:bg-rose-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-rose-200 dark:shadow-none">
                                Sí, eliminar
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
