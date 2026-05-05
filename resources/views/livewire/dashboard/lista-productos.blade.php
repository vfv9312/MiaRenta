<div class="bg-gray-50 min-h-screen pb-24">
    @push('css')
        <style>
            .product-card {
                transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            }

            .product-card:hover {
                transform: translateY(-10px);
                box-shadow: 0 25px 50px -12px rgba(204, 0, 0, 0.15);
            }

            .cart-float {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .scrollbar-hide::-webkit-scrollbar {
                display: none;
            }

            .scrollbar-hide {
                -ms-overflow-style: none;
                scrollbar-width: none;
            }
        </style>
    @endpush

    {{-- Header de la Tienda --}}
    <section class="relative bg-black pt-32 pb-24 px-6 overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-b from-red-600/20 to-transparent"></div>
        <div class="container relative z-10 mx-auto text-center">
            <h1 class="text-4xl font-black text-white md:text-7xl mb-8 animate-fadeIn">
                Selecciona tu <span class="text-red-600">Mobiliario</span>
            </h1>
            <p class="text-gray-400 text-xl max-w-2xl mx-auto font-medium">
                Arma tu paquete ideal y obtén una cotización inmediata. <br class="hidden md:block">
                ¡Haz que tu evento sea <span class="text-white">espectacular</span>!
            </p>
        </div>
    </section>

    {{-- Filtros y Búsqueda --}}
    <div
        class="sticky top-20 z-30 bg-white/80 dark:bg-zinc-900/80 backdrop-blur-xl border-b border-gray-100 dark:border-zinc-800 shadow-sm py-6 transition-colors duration-300">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-6">
            {{-- Buscador --}}
            <div class="relative w-full md:w-[450px]">
                <input type="text" wire:model.live="search" placeholder="¿Qué estás buscando? (ej. Silla, Mesa...)"
                    class="w-full pl-14 pr-6 py-4 bg-gray-50 dark:bg-black border-none dark:text-white rounded-[2rem] focus:ring-2 focus:ring-red-600 transition-all text-lg shadow-inner">
                <svg class="absolute left-5 top-1/2 -translate-y-1/2 w-6 h-6 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            {{-- Categorías --}}
            <div class="flex items-center space-x-3 overflow-x-auto pb-2 w-full md:w-auto scrollbar-hide">
                <button wire:click="$set('category', 'todos')"
                    class="px-8 py-3 rounded-full whitespace-nowrap font-black uppercase tracking-widest text-xs transition-all {{ $category === 'todos' ? 'bg-red-600 text-white shadow-xl shadow-red-500/20' : 'bg-white dark:bg-black text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 border border-gray-100 dark:border-zinc-800' }}">
                    Todos
                </button>
                @foreach ($allCategories as $cat)
                    <button wire:click="$set('category', '{{ $cat->id }}')"
                        class="px-8 py-3 rounded-full whitespace-nowrap font-black uppercase tracking-widest text-xs transition-all {{ $category == $cat->id ? 'bg-red-600 text-white shadow-xl shadow-red-500/20' : 'bg-white dark:bg-black text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 border border-gray-100 dark:border-zinc-800' }}">
                        {{ $cat->nombre }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Grid de Productos --}}
    <div class="container mx-auto px-6 py-16 dark:bg-black transition-colors duration-300">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">
            @forelse($filteredProducts as $product)
                <div
                    class="product-card bg-white dark:bg-zinc-900 rounded-[2.5rem] overflow-hidden border border-gray-100 dark:border-zinc-800 shadow-sm animate-fadeInSlow">
                    <div class="relative h-72 overflow-hidden group">
                        <img src="{{ $product['image'] ?? asset('imagenes/placeholder.jpg') }}"
                            class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                            alt="{{ $product['name'] }}">
                        <div
                            class="absolute top-6 right-6 bg-white/95 dark:bg-black/95 backdrop-blur-md px-5 py-2 rounded-2xl font-black text-red-600 shadow-xl border border-white/20">
                            ${{ $product['price'] }} <span
                                class="text-[10px] text-gray-400 font-bold uppercase ml-1">c/u</span>
                        </div>
                    </div>
                    <div class="p-8">
                        <h3 class="text-2xl font-black text-gray-900 dark:text-white mb-2 leading-tight">
                            {{ $product['name'] }}</h3>
                        <p class="text-gray-400 font-bold text-xs uppercase tracking-widest mb-8">
                            {{ $product['category'] }}</p>

                        <div class="flex items-center justify-between">
                            <button wire:click="addToCart({{ $product['id'] }})"
                                class="w-full bg-red-600 text-white font-black py-4 px-6 rounded-2xl hover:bg-red-700 transition-all flex items-center justify-center space-x-3 shadow-lg shadow-red-500/20 active:scale-95">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                <span>Agregar</span>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full py-20 text-center">
                    <div class="mb-4 flex justify-center">
                        <svg class="w-20 h-20 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-bold text-gray-600">No encontramos lo que buscas</h3>
                    <p class="text-gray-400">Intenta con otra palabra o categoría.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Carrito / Panel de Mi Paquete (Solo visible si hay items) --}}
    @if (count($cart) > 0)
        {{-- Botón Flotante (Solo Móvil - Se muestra cuando el carrito NO está expandido) --}}
        <div class="fixed bottom-6 right-6 z-50 lg:hidden {{ $isCartExpanded ? 'hidden' : 'block' }}">
            <button wire:click="$set('isCartExpanded', true)"
                class="bg-red-600 text-white p-5 rounded-full shadow-2xl relative active:scale-95 transition-all transform hover:scale-110">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z">
                    </path>
                </svg>
                <span
                    class="absolute -top-2 -right-2 bg-black text-white text-xs font-black w-7 h-7 flex items-center justify-center rounded-full border-2 border-red-600">
                    {{ collect($cart)->sum('quantity') }}
                </span>
            </button>
        </div>

        {{-- Panel del Carrito --}}
        <div class="fixed bottom-0 left-0 right-0 z-50 p-4 animate-slideInUp {{ !$isCartExpanded ? 'hidden lg:block' : 'block' }}">
            <div class="container mx-auto relative">
                {{-- Botón Cerrar (Solo Móvil) --}}
                <button wire:click="$set('isCartExpanded', false)" 
                    class="lg:hidden absolute -top-4 right-4 bg-black text-white p-2 rounded-full border border-white/20 z-[60] shadow-xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>

                <div
                    class="bg-black/90 dark:bg-zinc-900/90 backdrop-blur-2xl border border-white/10 rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] p-6 lg:p-8 flex flex-col lg:flex-row items-center justify-between gap-8 max-w-6xl mx-auto ring-1 ring-white/10">
                    {{-- Resumen de Items (Scroll horizontal) --}}
                    <div class="flex-1 w-full overflow-x-auto scrollbar-hide">
                        <div class="flex items-center space-x-6">
                            @foreach ($cart as $id => $item)
                                <div
                                    class="flex items-center space-x-4 whitespace-nowrap bg-white/5 p-3 rounded-2xl border border-white/5 pr-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-black text-white text-sm tracking-wide leading-tight">{{ $item['name'] }}</span>
                                        <div class="flex items-center space-x-4 mt-2">
                                            <div
                                                class="flex items-center bg-black rounded-lg border border-white/10">
                                                <button wire:click="removeFromCart({{ $id }})"
                                                    class="w-8 h-8 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white transition-all font-black">-</button>
                                                <span
                                                    class="mx-3 font-black text-white text-xs">{{ $item['quantity'] }}</span>
                                                <button wire:click="addToCart({{ $id }})"
                                                    class="w-8 h-8 flex items-center justify-center text-red-500 hover:bg-red-600 hover:text-white transition-all font-black">+</button>
                                            </div>
                                            <span
                                                class="text-xs font-black text-red-600">${{ number_format($item['price'] * $item['quantity'], 2) }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Total y Acción --}}
                    <div
                        class="flex items-center space-x-10 w-full lg:w-auto border-t lg:border-t-0 lg:border-l border-white/10 pt-6 lg:pt-0 lg:pl-10">
                        <div class="text-right flex flex-col items-end">
                            <button wire:click="openImagePreview"
                                class="text-xs text-gray-400 hover:text-white underline mb-3 transition-colors">
                                Ver imágenes del pedido
                            </button>
                            <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] font-black mb-1">
                                Inversión Total</p>
                            <span class="text-4xl font-black text-white">${{ number_format($this->total, 2) }}</span>
                            <span class="text-[10px] text-gray-500 mt-1 font-bold">
                                {{ $dias_renta }} {{ $dias_renta == 1 ? 'día' : 'días' }} &bull; precio/día &times;
                                días
                            </span>
                        </div>
                        <button wire:click="openCheckout"
                            class="bg-red-600 text-white font-black px-12 py-6 rounded-[2rem] hover:bg-red-700 transition-all shadow-2xl shadow-red-600/30 text-xl flex items-center space-x-4 flex-1 lg:flex-none justify-center group active:scale-95">
                            <span>¡Rentar Ahora!</span>
                            <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- Checkout Modal --}}
    @if ($showCheckout)
        <div class="fixed inset-0 z-[100] flex items-center justify-center bg-black/60 backdrop-blur-sm p-4">
            <div class="bg-white dark:bg-zinc-900 rounded-[2rem] w-full max-w-lg shadow-2xl p-8 relative animate-fadeInUp border border-gray-100 dark:border-zinc-800">
                <button wire:click="closeCheckout" class="absolute top-6 right-6 text-gray-400 hover:text-red-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Detalles de tu Evento</h2>
                
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">A nombre de quien queda el pedido *</label>
                        <input type="text" wire:model="nombre" placeholder="Ej. Juan Pérez" class="w-full bg-gray-50 dark:bg-black border border-gray-200 dark:border-zinc-800 dark:text-white rounded-xl focus:ring-red-600 focus:border-red-600 px-4 py-3 transition">
                        @error('nombre') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Dirección del evento *</label>
                        <input type="text" wire:model="direccion" placeholder="Calle, Número, Colonia" class="w-full bg-gray-50 dark:bg-black border border-gray-200 dark:border-zinc-800 dark:text-white rounded-xl focus:ring-red-600 focus:border-red-600 px-4 py-3 transition">
                        @error('direccion') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Fecha y Hora requerida *</label>
                        <input type="datetime-local" wire:model="fecha_hora" class="w-full bg-gray-50 dark:bg-black border border-gray-200 dark:border-zinc-800 dark:text-white rounded-xl focus:ring-red-600 focus:border-red-600 px-4 py-3 transition">
                        @error('fecha_hora') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>

                    {{-- Dias de Renta --}}
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">¿Cuántos días lo necesitas? *</label>
                        <div class="flex items-center gap-4">
                            <button type="button" wire:click="decrementDias"
                                class="w-12 h-12 rounded-xl bg-red-600 hover:bg-red-700 text-white font-black text-xl flex items-center justify-center shadow-md shadow-red-500/20 active:scale-95 transition">
                                -
                            </button>
                            <div class="flex-1 text-center">
                                <span class="text-3xl font-black text-gray-900 dark:text-white">{{ $dias_renta }}</span>
                                <span class="text-sm text-gray-400 font-bold ml-2">{{ $dias_renta == 1 ? 'día' : 'días' }}</span>
                            </div>
                            <button type="button" wire:click="incrementDias"
                                class="w-12 h-12 rounded-xl bg-red-600 hover:bg-red-700 text-white font-black text-xl flex items-center justify-center shadow-md shadow-red-500/20 active:scale-95 transition">
                                +
                            </button>
                        </div>
                        <div class="mt-3 bg-red-50 dark:bg-red-950/30 rounded-xl p-3 border border-red-100 dark:border-red-900/50">
                            <p class="text-xs font-bold text-red-600 dark:text-red-400 text-center">
                                💰 Total estimado: <span class="text-base ml-1">${{ number_format($this->total, 2) }}</span>
                                <span class="text-gray-500 dark:text-gray-400 font-normal ml-1">({{ $dias_renta }} {{ $dias_renta == 1 ? 'día' : 'días' }})</span>
                            </p>
                        </div>
                        @error('dias_renta') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Celular alternativo (opcional)</label>
                        <input type="text" wire:model="celular" placeholder="10 dígitos" class="w-full bg-gray-50 dark:bg-black border border-gray-200 dark:border-zinc-800 dark:text-white rounded-xl focus:ring-red-600 focus:border-red-600 px-4 py-3 transition">
                        @error('celular') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-1">Método de pago *</label>
                        <select wire:model="metodo_pago" class="w-full bg-gray-50 dark:bg-black border border-gray-200 dark:border-zinc-800 dark:text-white rounded-xl focus:ring-red-600 focus:border-red-600 px-4 py-3 transition">
                            <option value="">Selecciona un método de pago</option>
                            <option value="efectivo">Efectivo</option>
                            <option value="transferencia">Transferencia</option>
                            @if($this->total > 700)
                                <option value="terminal">Llevar terminal</option>
                            @endif
                        </select>
                        @error('metodo_pago') <span class="text-red-500 text-xs font-bold mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="mt-8 flex gap-4">
                    <button wire:click="closeCheckout" class="flex-1 px-6 py-4 rounded-xl font-bold bg-gray-100 hover:bg-gray-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-gray-700 dark:text-gray-300 transition">Cancelar</button>
                    <button wire:click="processOrder" class="flex-1 px-6 py-4 rounded-xl font-bold bg-[#25D366] hover:bg-[#128C7E] text-white transition shadow-lg shadow-[#25D366]/30 flex items-center justify-center gap-2 text-sm sm:text-base">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.888-.788-1.489-1.761-1.662-2.06-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.82 9.82 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.88 11.88 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.82 11.82 0 0 0-3.48-8.413Z"/></svg>
                        Pedir en WhatsApp
                    </button>
                </div>
            </div>
        </div>
    @endif

    {{-- Image Preview Modal --}}
    @if ($showImagePreview)
        <div class="fixed inset-0 z-[110] flex items-center justify-center bg-black/80 backdrop-blur-sm p-4 animate-fadeInUp">
            <div class="bg-white dark:bg-zinc-900 rounded-[2rem] w-full max-w-4xl shadow-2xl p-8 relative border border-gray-100 dark:border-zinc-800">
                <button wire:click="closeImagePreview" class="absolute top-6 right-6 text-gray-400 hover:text-red-600 transition">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
                <h2 class="text-2xl font-black text-gray-900 dark:text-white mb-6">Imágenes de tu pedido</h2>
                
                @if(count($previewImages) > 0)
                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 max-h-[60vh] overflow-y-auto pr-2 custom-scrollbar">
                        @foreach($previewImages as $img)
                            <div class="rounded-2xl overflow-hidden border border-gray-200 dark:border-zinc-800 shadow-sm group">
                                <img src="{{ asset($img) }}" class="w-full h-56 object-cover transition-transform duration-500 group-hover:scale-110">
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="py-16 text-center">
                        <svg class="w-16 h-16 text-gray-300 dark:text-zinc-700 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <h3 class="text-xl font-bold text-gray-500 dark:text-gray-400">No hay imágenes disponibles</h3>
                        <p class="text-sm text-gray-400 mt-2">No encontramos fotos para los artículos de este paquete.</p>
                    </div>
                @endif

                <div class="mt-8 flex justify-end">
                    <button wire:click="closeImagePreview" class="px-8 py-3 rounded-xl font-bold bg-red-600 hover:bg-red-700 text-white transition shadow-lg shadow-red-500/30">Cerrar</button>
                </div>
            </div>
        </div>
    @endif
    
    <script>
        document.addEventListener('livewire:initialized', () => {
            Livewire.on('openUrl', (eventData) => {
                const data = Array.isArray(eventData) ? eventData[0] : eventData;
                window.open(data.url, '_blank');
            });
        });
    </script>
</div>
