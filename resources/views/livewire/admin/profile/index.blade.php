<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-4xl mx-auto space-y-6">
        <!-- Header -->
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Mi Perfil</h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Actualiza tu foto de perfil y tu contraseña.</p>
        </header>

        <!-- Profile Photo Mapping -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden">
            <div class="p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Información Pública</h3>
                
                @if (session()->has('message'))
                    <div class="mb-4 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                        <i class="fas fa-check-circle"></i>
                        <span class="font-medium text-sm">{{ session('message') }}</span>
                    </div>
                @endif
                
                <div class="flex items-center gap-6">
                    <!-- Photo preview -->
                    <div class="relative group">
                        @if ($photo)
                            <img src="{{ $photo->temporaryUrl() }}" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-indigo-100 dark:border-indigo-900">
                        @elseif(Auth::user()->profile_photo_path)
                            <img src="{{ asset('storage/' . Auth::user()->profile_photo_path) }}" class="w-24 h-24 rounded-full object-cover shadow-md border-2 border-indigo-100 dark:border-indigo-900">
                        @else
                            <div class="w-24 h-24 rounded-full flex items-center justify-center text-4xl text-indigo-700 dark:text-indigo-400 font-bold bg-indigo-100 dark:bg-indigo-900/50 shadow-md">
                                {{ substr(optional(Auth::user()->person)->nombre ?? 'U', 0, 1) }}
                            </div>
                        @endif
                        
                        <div wire:loading wire:target="photo" class="absolute inset-0 bg-white/70 dark:bg-gray-800/70 rounded-full flex items-center justify-center">
                            <i class="fas fa-spinner fa-spin text-indigo-600"></i>
                        </div>
                    </div>
                    
                    <!-- Upload Input -->
                    <div class="flex flex-col items-start gap-2">
                        <div class="text-sm text-gray-500 dark:text-gray-400 font-medium mb-1">Carga una nueva foto (Max 10MB)</div>
                        <input type="file" id="photo" wire:model="photo" class="hidden">
                        
                        <div class="flex items-center gap-3">
                            <label for="photo" class="cursor-pointer inline-flex items-center gap-2 px-4 py-2 bg-indigo-50 hover:bg-indigo-100 text-indigo-700 dark:bg-indigo-900/30 dark:hover:bg-indigo-900/50 dark:text-indigo-400 font-semibold rounded-lg transition-colors border border-indigo-200 dark:border-indigo-800">
                                <i class="fas fa-camera"></i> Subir Foto
                            </label>
                            
                            @if(Auth::user()->profile_photo_path)
                                <button type="button" wire:click="removePhoto" class="inline-flex items-center gap-2 px-4 py-2 text-red-600 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors font-medium">
                                    <i class="fas fa-trash-alt"></i> Remover
                                </button>
                            @endif
                        </div>
                        
                        @error('photo') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nombre Completo</label>
                        <div class="w-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl p-3 text-gray-900 dark:text-white cursor-not-allowed">
                            {{ optional(Auth::user()->person)->nombre ?? '' }} {{ optional(Auth::user()->person)->apellido ?? '' }}
                        </div>
                        <p class="text-xs text-gray-500 mt-1">Acude al área de Administración para actualizar.</p>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Correo Electrónico</label>
                        <div class="w-full bg-gray-50 dark:bg-gray-700/50 border border-gray-200 dark:border-gray-600 rounded-xl p-3 text-gray-900 dark:text-white cursor-not-allowed">
                            {{ Auth::user()->email }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Password Mapping -->
        <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden mt-6">
            <form wire:submit.prevent="updatePassword" class="p-6 sm:p-8">
                <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-4">Actualizar Contraseña</h3>
                
                @if (session()->has('message_password'))
                    <div class="mb-6 p-4 bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-xl flex items-center gap-3 text-green-700 dark:text-green-400">
                        <i class="fas fa-check-circle"></i>
                        <span class="font-medium text-sm">{{ session('message_password') }}</span>
                    </div>
                @endif
                
                <div class="space-y-4 max-w-lg">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Contraseña Actual *</label>
                        <input wire:model="current_password" type="password"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                        @error('current_password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Nueva Contraseña *</label>
                        <input wire:model="new_password" type="password"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                        @error('new_password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Confirmar Nueva Contraseña *</label>
                        <input wire:model="new_password_confirmation" type="password"
                            class="w-full bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 text-gray-900 dark:text-white p-2.5">
                    </div>
                </div>

                <div class="mt-8 flex justify-start">
                    <button type="submit" class="px-6 py-2.5 bg-gray-900 dark:bg-indigo-600 hover:bg-gray-800 dark:hover:bg-indigo-700 text-white font-bold rounded-xl transition-colors shadow-lg shadow-gray-200 dark:shadow-none flex items-center gap-2">
                        <i class="fas fa-save"></i> Guardar Contraseña
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
