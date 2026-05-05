<div class="py-24 px-4 sm:px-6 lg:px-8 bg-gray-50 dark:bg-black min-h-screen transition-colors duration-300">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="text-center mb-16">
            <h1
                class="text-4xl font-black text-gray-900 dark:text-white sm:text-5xl border-b-8 border-red-600 inline-block pb-4 rounded-b-xl">
                Solicitud de Facturación
            </h1>
            <p class="mt-8 text-xl text-gray-600 dark:text-gray-400 font-medium">
                Genera tu <span class="text-red-600 font-black">CFDI 4.0</span> de manera rápida y segura.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Instructions -->
            <div class="lg:col-span-1 space-y-8">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[2.5rem] shadow-sm p-8 border border-gray-100 dark:border-zinc-800 transition-all">
                    <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-8 flex items-center">
                        <div class="p-2 bg-red-600 rounded-lg text-white mr-4 shadow-lg shadow-red-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        Instrucciones
                    </h2>
                    <ul class="space-y-6 text-gray-600 dark:text-gray-400 leading-relaxed text-sm">
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">1</span>
                            <span>{{ $instruccion_1 }}</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">2</span>
                            <span>{{ $instruccion_2 }}</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">3</span>
                            <span>{{ $instruccion_3 }}</span>
                        </li>
                        <li class="flex items-start">
                            <span
                                class="bg-red-600 text-white rounded-lg w-6 h-6 flex items-center justify-center text-xs font-black mr-3 mt-0.5 flex-shrink-0">4</span>
                            <span>{{ $instruccion_4 }}</span>
                        </li>
                    </ul>
                </div>

                <!-- Simple FAQ/Alert -->
                <div class="bg-black dark:bg-zinc-900 rounded-[2rem] p-8 border border-white/5 shadow-2xl">
                    <p class="text-white text-sm font-medium">
                        <strong
                            class="text-red-600 block mb-2 uppercase tracking-widest text-xs">{{ $faq_title }}</strong>
                        {{ $faq_body }}
                    </p>
                </div>
            </div>

            <!-- Right Column: Form -->
            <div class="lg:col-span-2">
                <div
                    class="bg-white dark:bg-zinc-900 rounded-[3rem] shadow-2xl border border-gray-100 dark:border-zinc-800 overflow-hidden transition-all duration-300">
                    <div class="p-8 sm:p-14">
                        @if (session()->has('success'))
                            <div class="mb-8 p-4 bg-green-50 dark:bg-green-900/30 border-l-4 border-green-600 text-green-700 dark:text-green-400 rounded-r-xl font-medium">
                                {{ session('success') }}
                            </div>
                        @endif

                        <form wire:submit.prevent="save" class="space-y-8">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <!-- Número de Ticket -->
                                <div class="col-span-1">
                                    <label for="numero_ticket"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Número de Ticket</label>
                                    <input type="text" wire:model="numero_ticket" id="numero_ticket"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="Ej. TCK-12345">
                                    @error('numero_ticket') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- RFC -->
                                <div class="col-span-1">
                                    <label for="rfc"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">RFC</label>
                                    <input type="text" wire:model="rfc" id="rfc"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 uppercase placeholder-gray-400"
                                        placeholder="XAXX010101000">
                                    @error('rfc') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Razón Social -->
                                <div class="col-span-1">
                                    <label for="razon_social"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Razón
                                        Social</label>
                                    <input type="text" wire:model="razon_social" id="razon_social"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="Como aparece en su constancia">
                                    @error('razon_social') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Régimen Fiscal -->
                                <div class="col-span-1">
                                    <label for="regimen"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Régimen
                                        Fiscal</label>
                                    <select wire:model="regimen" id="regimen"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600">
                                        <option value="">Seleccione una opción</option>
                                        <option value="601">General de Ley Personas Morales</option>
                                        <option value="603">Personas Morales con Fines no Lucrativos</option>
                                        <option value="605">Sueldos e Ingresos Asimilados a Salarios</option>
                                        <option value="606">Arrendamiento</option>
                                        <option value="612">Personas Físicas con Actividades Empresariales</option>
                                        <option value="626">Régimen Simplificado de Confianza (RESICO)</option>
                                    </select>
                                    @error('regimen') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Uso de CFDI -->
                                <div class="col-span-1">
                                    <label for="uso_cfdi"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Uso
                                        de CFDI</label>
                                    <select wire:model="uso_cfdi" id="uso_cfdi"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600">
                                        <option value="">Seleccione una opción</option>
                                        <option value="G03">G03 - Gastos en general</option>
                                        <option value="S01">S01 - Sin efectos fiscales</option>
                                        <option value="CP01">CP01 - Pagos</option>
                                    </select>
                                    @error('uso_cfdi') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Código Postal -->
                                <div class="col-span-1">
                                    <label for="cp"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">CP
                                        Fiscal</label>
                                    <input type="text" wire:model="cp" id="cp"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="12345">
                                    @error('cp') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- Email para envío -->
                                <div class="col-span-1">
                                    <label for="email"
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Email
                                        de Envío</label>
                                    <input type="email" wire:model="email" id="email"
                                        class="block w-full px-6 py-4 rounded-2xl border-gray-100 dark:border-zinc-700 dark:bg-black dark:text-white focus:ring-red-600 placeholder-gray-400"
                                        placeholder="tu@email.com">
                                    @error('email') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- File: Constancia -->
                                <div class="col-span-1 md:col-span-2">
                                    <label
                                        class="block text-xs font-black text-gray-700 dark:text-gray-300 uppercase tracking-widest mb-3">Constancia
                                        de Situación Fiscal</label>
                                    <div
                                        class="relative mt-2 flex justify-center px-8 pt-10 pb-10 border-2 border-gray-200 dark:border-zinc-700 border-dashed rounded-[2rem] hover:border-red-600 cursor-pointer bg-gray-50 dark:bg-black/50 transition-all group overflow-hidden">
                                        <input type="file" wire:model="constancia" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="space-y-4 text-center z-0">
                                            @if ($constancia)
                                                <svg class="mx-auto h-12 w-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="flex text-sm text-gray-600 dark:text-gray-400 font-medium">
                                                    <span class="text-green-600 font-black">{{ $constancia->getClientOriginalName() }}</span>
                                                </div>
                                            @else
                                                <svg class="mx-auto h-12 w-12 text-gray-400 group-hover:text-red-600 transition-colors"
                                                    fill="none" stroke="currentColor" viewBox="0 0 48 48">
                                                    <path
                                                        d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02"
                                                        stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600 dark:text-gray-400">
                                                    <span class="text-red-600 font-black">Haz clic para subir archivo</span>
                                                </div>
                                            @endif
                                            <div wire:loading wire:target="constancia" class="text-xs text-brand-600 mt-2 font-black">
                                                Cargando archivo...
                                            </div>
                                        </div>
                                    </div>
                                    @error('constancia') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>

                                <!-- File: Nota -->
                                <div class="col-span-1 md:col-span-2">
                                    <label class="block text-sm font-semibold text-gray-700 mb-2">Adjuntar Nota de
                                        Renta</label>
                                    <div
                                        class="relative mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-xl hover:border-indigo-400 cursor-pointer bg-gray-50 transition-all overflow-hidden group">
                                        <input type="file" wire:model="nota" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" accept=".pdf,.jpg,.jpeg,.png">
                                        <div class="space-y-1 text-center z-0">
                                            @if ($nota)
                                                <svg class="mx-auto h-10 w-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <span class="text-green-600 font-medium">{{ $nota->getClientOriginalName() }}</span>
                                                </div>
                                            @else
                                                <svg class="mx-auto h-10 w-10 text-gray-400 group-hover:text-indigo-400 transition-colors" stroke="currentColor"
                                                    fill="none" viewBox="0 0 48 48">
                                                    <path d="M9 12h6m-6 4h12m-12 4h12M9 8h24v32H9V8z" stroke-width="2"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <div class="flex text-sm text-gray-600">
                                                    <span class="text-indigo-600 font-medium">Sube tu nota o ticket</span>
                                                </div>
                                            @endif
                                            <div wire:loading wire:target="nota" class="text-xs text-indigo-600 mt-2 font-black">
                                                Cargando archivo...
                                            </div>
                                        </div>
                                    </div>
                                    @error('nota') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="col-span-1 md:col-span-2 pt-10">
                                <button type="submit"
                                    class="w-full bg-red-600 text-white py-6 rounded-2xl font-black text-xl shadow-2xl hover:bg-red-700 transition-all transform hover:scale-[1.02] active:scale-95 shadow-red-600/30">
                                    <span wire:loading.remove wire:target="save">Enviar Solicitud</span>
                                    <span wire:loading wire:target="save">Enviando...</span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
