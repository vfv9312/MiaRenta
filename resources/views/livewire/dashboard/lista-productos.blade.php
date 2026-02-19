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
                @foreach (['todos', 'sillas', 'mesas', 'manteleria', 'cristaleria'] as $cat)
                    <button wire:click="$set('category', '{{ $cat }}')"
                        class="px-8 py-3 rounded-full whitespace-nowrap font-black uppercase tracking-widest text-xs transition-all {{ $category === $cat ? 'bg-red-600 text-white shadow-xl shadow-red-500/20' : 'bg-white dark:bg-black text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-zinc-800 border border-gray-100 dark:border-zinc-800' }}">
                        {{ $cat }}
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
                        <img src="{{ asset($product['image']) }}"
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
        <div class="fixed bottom-0 left-0 right-0 z-50 p-4 animate-slideInUp">
            <div class="container mx-auto">
                <div class="fixed bottom-0 left-0 right-0 z-50 p-6 animate-slideInUp">
                    <div class="container mx-auto">
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
                                <div class="text-right">
                                    <p class="text-[10px] text-gray-500 uppercase tracking-[0.2em] font-black mb-1">
                                        Inversión Total</p>
                                    <span
                                        class="text-4xl font-black text-white">${{ number_format($this->total, 2) }}</span>
                                </div>
                                <a href="https://wa.me/9614585559?text={{ urlencode('Hola, me interesa armar el siguiente paquete de mobiliario: ' . collect($cart)->map(fn($i) => "{$i['quantity']}x {$i['name']}")->implode(', ') . '. El total estimado es $' . number_format($this->total, 2)) }}"
                                    target="_blank"
                                    class="bg-red-600 text-white font-black px-12 py-6 rounded-[2rem] hover:bg-red-700 transition-all shadow-2xl shadow-red-600/30 text-xl flex items-center space-x-4 flex-1 lg:flex-none justify-center group active:scale-95">
                                    <span>¡Rentar Ahora!</span>
                                    <svg class="w-6 h-6 transition-transform group-hover:translate-x-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
