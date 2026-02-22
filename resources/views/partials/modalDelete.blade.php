<div x-show="$wire.showDeleteModal" class="fixed inset-0 z-[999] overflow-y-auto" style="display: none;"
    x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
    x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
    x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0">

    <!-- Backdrop -->
    <div class="fixed inset-0 bg-gray-900/60 backdrop-blur-sm transition-opacity" aria-hidden="true"></div>

    <!-- Modal Content -->
    <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
        <div class="relative transform overflow-hidden rounded-2xl bg-white dark:bg-gray-800 text-left shadow-2xl transition-all sm:my-8 sm:w-full sm:max-w-md border border-gray-100 dark:border-gray-700"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95">

            <div class="p-8">
                <div class="flex flex-col items-center text-center">
                    <!-- Warning Icon Container -->
                    <div
                        class="mx-auto flex h-20 w-20 flex-shrink-0 items-center justify-center rounded-full bg-red-100 dark:bg-red-900/30 mb-6">
                        <i class="fas fa-exclamation-triangle text-3xl text-red-600 animate-pulse"></i>
                    </div>

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-white mb-2" id="modal-title">
                        ¿Confirmar Eliminación?
                    </h3>
                    <p class="text-gray-500 dark:text-gray-400 text-sm leading-relaxed">
                        Esta acción es permanente y no se podrá deshacer. El archivo se eliminará definitivamente de
                        nuestros servidores.
                    </p>
                </div>

                <div class="mt-8 flex flex-col sm:flex-row gap-3">
                    <!-- Cancel Button -->
                    <button type="button" wire:click="$set('showDeleteModal', false)"
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 rounded-xl bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-200 font-bold hover:bg-gray-200 dark:hover:bg-gray-600 transition-all duration-200">
                        Cancelar
                    </button>

                    <!-- Confirm Button -->
                    <button type="button" wire:click="delete({{ $public_gallery_id }})"
                        class="flex-1 inline-flex justify-center items-center px-6 py-3 rounded-xl bg-red-600 text-white font-bold hover:bg-red-700 shadow-lg shadow-red-200 dark:shadow-none transition-all duration-200">
                        <i class="fas fa-trash-alt mr-2"></i>
                        Eliminar
                    </button>
                </div>
            </div>

            <!-- Technical Detail (Optional hint) -->
            <div
                class="bg-gray-50 dark:bg-gray-900/50 px-8 py-4 border-t border-gray-100 dark:border-gray-800 flex justify-center italic text-[10px] text-gray-400">
                ID de referencia: #{{ $public_gallery_id }}
            </div>
        </div>
    </div>
</div>
