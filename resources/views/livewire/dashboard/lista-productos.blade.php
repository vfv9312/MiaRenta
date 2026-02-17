<div class="bg-gray-50 min-h-screen pb-24">
    @push('css')
        <style>
            .product-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .product-card:hover {
                transform: translateY(-5px);
                box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            }

            .cart-float {
                transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
            }
        </style>
    @endpush

    {{-- Header de la Tienda --}}
    <section class="bg-blue-900 border-b border-blue-800 pt-32 pb-16 px-6">
        <div class="container mx-auto text-center">
            <h1 class="text-4xl font-extrabold text-white md:text-5xl mb-4 animate-fadeIn">
                Selecciona tu <span class="text-blue-400">Mobiliario</span>
            </h1>
            <p class="text-blue-100 text-lg max-w-2xl mx-auto">
                Arma tu paquete ideal y obtén una cotización inmediata. ¡Haz que tu evento sea inolvidable!
            </p>
        </div>
    </section>

    {{-- Filtros y Búsqueda --}}
    <div class="sticky top-20 z-30 bg-white/80 backdrop-blur-md border-b border-gray-200 shadow-sm py-4">
        <div class="container mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-4">
            {{-- Buscador --}}
            <div class="relative w-full md:w-96">
                <input type="text" wire:model.live="search" placeholder="¿Qué estás buscando? (ej. Silla, Mesa...)"
                    class="w-full pl-12 pr-4 py-3 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                <svg class="absolute left-4 top-1/2 -translate-y-1/2 w-5 h-5 text-gray-400" fill="none"
                    stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>

            {{-- Categorías --}}
            <div class="flex items-center space-x-2 overflow-x-auto pb-2 w-full md:w-auto scrollbar-hide">
                @foreach (['todos', 'sillas', 'mesas', 'manteleria', 'cristaleria'] as $cat)
                    <button wire:click="$set('category', '{{ $cat }}')"
                        class="px-6 py-2 rounded-full whitespace-nowrap font-medium transition-all {{ $category === $cat ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">
                        {{ ucfirst($cat) }}
                    </button>
                @endforeach
            </div>
        </div>
    </div>

    {{-- Grid de Productos --}}
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
            @forelse($filteredProducts as $product)
                <div
                    class="product-card bg-white rounded-3xl overflow-hidden border border-gray-100 shadow-sm animate-fadeInSlow">
                    <div class="relative h-64 overflow-hidden group">
                        <img src="{{ asset($product['image']) }}"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110"
                            alt="{{ $product['name'] }}">
                        <div
                            class="absolute top-4 right-4 bg-white/90 backdrop-blur-sm px-3 py-1 rounded-full font-bold text-blue-900 shadow-sm">
                            ${{ $product['price'] }} c/u
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $product['name'] }}</h3>
                        <p class="text-gray-500 text-sm mb-6 capitalize">{{ $product['category'] }}</p>

                        <div class="flex items-center justify-between">
                            <button wire:click="addToCart({{ $product['id'] }})"
                                class="flex-1 bg-blue-600 text-white font-bold py-3 px-4 rounded-xl hover:bg-blue-700 transition-colors flex items-center justify-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
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
                <div
                    class="bg-white/90 backdrop-blur-xl border border-blue-100 rounded-3xl shadow-2xl p-6 flex flex-col lg:flex-row items-center justify-between gap-6 max-w-5xl mx-auto">
                    {{-- Resumen de Items (Scroll horizontal) --}}
                    <div class="flex-1 w-full overflow-x-auto scrollbar-hide">
                        <div class="flex items-center space-x-6">
                            @foreach ($cart as $id => $item)
                                <div
                                    class="flex items-center space-x-3 whitespace-nowrap bg-blue-50/50 p-2 rounded-2xl border border-blue-100 pr-4">
                                    <div class="flex flex-col">
                                        <span
                                            class="font-bold text-gray-900 text-sm leading-tight">{{ $item['name'] }}</span>
                                        <div class="flex items-center space-x-2 mt-1">
                                            <button wire:click="removeFromCart({{ $id }})"
                                                class="w-6 h-6 flex items-center justify-center bg-white border border-blue-200 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">-</button>
                                            <span
                                                class="font-bold text-blue-600 text-xs">{{ $item['quantity'] }}</span>
                                            <button wire:click="addToCart({{ $id }})"
                                                class="w-6 h-6 flex items-center justify-center bg-white border border-blue-200 rounded-md text-blue-600 hover:bg-blue-600 hover:text-white transition-colors">+</button>
                                            <span
                                                class="text-xs text-gray-400 ml-2">${{ $item['price'] * $item['quantity'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Total y Acción --}}
                    <div
                        class="flex items-center space-x-8 w-full lg:w-auto border-t lg:border-t-0 lg:border-l border-gray-100 pt-4 lg:pt-0 lg:pl-8">
                        <div class="text-right">
                            <p class="text-xs text-gray-400 uppercase tracking-widest font-bold">Total Estimado</p>
                            <span
                                class="text-3xl font-black text-blue-900">${{ number_format($this->total, 2) }}</span>
                        </div>
                        <a href="https://wa.me/message/2FM4OVMRRIMIB1?text={{ urlencode('Hola, me interesa armar el siguiente paquete de mobiliario: ' . collect($cart)->map(fn($i) => "{$i['quantity']}x {$i['name']}")->implode(', ') . '. El total estimado es $' . number_format($this->total, 2)) }}"
                            target="_blank"
                            class="bg-blue-700 text-white font-black px-10 py-5 rounded-2xl hover:bg-blue-800 transition-all shadow-xl shadow-blue-200 text-lg flex items-center space-x-3 flex-1 lg:flex-none justify-center">
                            <span>¡Rentar Ahora!</span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
