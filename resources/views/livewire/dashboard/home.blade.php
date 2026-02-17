<div>
    @push('css')
        <style>
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateY(20px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .animate-fadeInUp {
                animation: fadeInUp 0.8s ease-out forwards;
            }

            .animate-fadeIn {
                animation: fadeIn 1s ease-out forwards;
            }

            .delay-200 {
                animation-delay: 0.2s;
            }

            .delay-400 {
                animation-delay: 0.4s;
            }

            .delay-600 {
                animation-delay: 0.6s;
            }

            .service-card:hover .service-icon {
                transform: scale(1.1) rotate(5deg);
            }

            .glass-effect {
                background: rgba(255, 255, 255, 0.8);
                backdrop-filter: blur(10px);
                border: 1px solid rgba(255, 255, 255, 0.3);
            }
        </style>
    @endpush

    @push('js')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const lazyImages = document.querySelectorAll('.lazy-image');
                const observer = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.add('opacity-100');
                            img.classList.remove('opacity-0');
                            observer.unobserve(img);
                        }
                    });
                });

                lazyImages.forEach(img => {
                    img.classList.add('transition-opacity', 'duration-1000', 'opacity-0');
                    observer.observe(img);
                });
            });
        </script>
    @endpush

    {{-- Hero Section con Carrusel --}}
    <section id="hero" class="relative h-[80vh] flex items-center justify-center overflow-hidden bg-gray-900"
        x-data="{
            activeSlide: 0,
            slides: @js($slides),
            next() { this.activeSlide = (this.activeSlide + 1) % this.slides.length },
            prev() { this.activeSlide = (this.activeSlide - 1 + this.slides.length) % this.slides.length },
            init() { setInterval(() => this.next(), 6000) }
        }">

        {{-- Slides --}}
        <template x-for="(slide, index) in slides" :key="index">
            <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-1000"
                x-transition:enter-start="opacity-0 transform scale-105"
                x-transition:enter-end="opacity-100 transform scale-100"
                x-transition:leave="transition ease-in duration-1000" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0" class="absolute inset-0 z-0">
                <img :src="'/' + slide.image" class="object-cover w-full h-full opacity-60" :alt="slide.title">
                <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900/80"></div>
            </div>
        </template>

        <div class="container relative z-10 px-6 mx-auto text-center">
            <div class="relative min-h-[400px] flex items-center justify-center">
                <template x-for="(slide, index) in slides" :key="index">
                    <div x-show="activeSlide === index" x-transition:enter="transition ease-out duration-700 delay-300"
                        x-transition:enter-start="opacity-0 translate-y-8"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        class="absolute inset-0 flex flex-col items-center justify-center py-12">

                        <span
                            class="inline-block px-4 py-1 mb-6 text-xs font-semibold tracking-wider text-white uppercase bg-blue-600 rounded-full md:text-sm">
                            Tuxtla Gutiérrez, Chiapas
                        </span>

                        <h1 class="mb-4 text-3xl font-extrabold text-white md:text-7xl" x-html="slide.title"></h1>
                        <p class="max-w-2xl mx-auto mb-8 text-lg text-gray-200 md:text-xl" x-text="slide.subtitle"></p>

                        <div
                            class="flex flex-col justify-center w-full space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <a :href="slide.button_link"
                                class="px-8 py-3 text-base font-bold text-white transition-all bg-blue-700 rounded-full md:py-4 md:text-lg hover:bg-blue-800 hover:shadow-2xl"
                                x-text="slide.button_text">
                            </a>
                            <a href="https://wa.me/message/2FM4OVMRRIMIB1"
                                class="px-8 py-3 text-base font-bold text-blue-900 transition-all bg-white rounded-full md:py-4 md:text-lg hover:bg-gray-100">
                                Contactar Ahora
                            </a>
                        </div>
                    </div>
                </template>
            </div>
        </div>

        {{-- Controles --}}
        <button @click="prev()"
            class="absolute z-20 p-2 text-white transition-all -translate-y-1/2 left-4 top-1/2 hover:bg-white/10 rounded-full">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button @click="next()"
            class="absolute z-20 p-2 text-white transition-all -translate-y-1/2 right-4 top-1/2 hover:bg-white/10 rounded-full">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>

        {{-- Indicadores --}}
        <div class="absolute bottom-8 left-1/2 z-20 flex -translate-x-1/2 space-x-3">
            <template x-for="(slide, index) in slides" :key="index">
                <button @click="activeSlide = index" class="w-3 h-3 rounded-full transition-all"
                    :class="activeSlide === index ? 'bg-blue-600 w-8' : 'bg-white/50'"></button>
            </template>
        </div>
    </section>

    {{-- Servicios --}}
    <section id="servicios" class="py-24 bg-white">
        <div class="container px-6 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">Nuestro Catálogo</h2>
                <div class="w-20 h-1 mx-auto mt-4 bg-blue-600"></div>
                <p class="mt-4 text-gray-600">Todo lo que necesitas para tu evento en un solo lugar.</p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Servicio 1: Sillas -->
                <div class="p-8 transition-all service-card glass-effect rounded-2xl hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-6 transition-transform bg-blue-100 rounded-xl service-icon">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900">Sillas</h3>
                    <p class="text-gray-600">Tiffany, madera, plástico y acojinadas. Modelos para cada estilo.</p>
                </div>

                <!-- Servicio 2: Mesas -->
                <div class="p-8 transition-all service-card glass-effect rounded-2xl hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-6 transition-transform bg-blue-100 rounded-xl service-icon">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16m-7 6h7"></path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900">Mesas</h3>
                    <p class="text-gray-600">Redondas, cuadradas y tablones para 4, 10 o más invitados.</p>
                </div>

                <!-- Servicio 3: Mantelería -->
                <div class="p-8 transition-all service-card glass-effect rounded-2xl hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-6 transition-transform bg-blue-100 rounded-xl service-icon">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900">Mantelería</h3>
                    <p class="text-gray-600">Manteles, fundas y moños en una amplia gama de colores.</p>
                </div>

                <!-- Servicio 4: Cristalería -->
                <div class="p-8 transition-all service-card glass-effect rounded-2xl hover:shadow-xl group">
                    <div
                        class="flex items-center justify-center w-16 h-16 mb-6 transition-transform bg-blue-100 rounded-xl service-icon">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="mb-2 text-xl font-bold text-gray-900">Cristalería</h3>
                    <p class="text-gray-600">Vasos, copas y accesorios premium para tu mesa.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <section class="py-24 bg-gray-50">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center gap-12 lg:flex-row">
                <div class="w-full lg:w-1/2">
                    <img src="{{ asset('imagenes/logos/logoprueba2.png') }}" class="w-auto h-32 mb-8"
                        alt="Mia Renta Logo">
                    <h2 class="mb-6 text-3xl font-bold text-gray-900">Calidad y Servicio en cada Detalle</h2>
                    <p class="mb-8 text-lg text-gray-600">
                        En **Mía Renta**, nos especializamos en brindar soluciones de mobiliario para eventos sociales y
                        corporativos en Tuxtla Gutiérrez. Nuestra prioridad es que tu evento sea perfecto, por eso
                        ofrecemos equipos mantenidos en excelentes condiciones.
                    </p>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Entrega Puntual</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Equipos Sanitizados</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Atención Personalizada</span>
                        </div>
                        <div class="flex items-center space-x-3">
                            <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span class="text-gray-700">Precios Competitivos</span>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div class="relative p-1 bg-gradient-to-tr from-blue-600 to-indigo-600 rounded-3xl shadow-2xl">
                        <div class="bg-white p-8 rounded-[1.4rem]">
                            <h3 class="mb-4 text-2xl font-bold text-gray-900">Aceptamos diversos métodos de pago</h3>
                            <div class="grid grid-cols-5 gap-4 mb-6">
                                <img src="{{ asset('imagenes/imagenes/visa.png') }}"
                                    class="w-auto h-12 grayscale hover:grayscale-0 transition-all" alt="Visa">
                                <img src="{{ asset('imagenes/imagenes/mastercard.png') }}"
                                    class="w-auto h-12 grayscale hover:grayscale-0 transition-all" alt="Mastercard">
                                <img src="{{ asset('imagenes/imagenes/amex.png') }}"
                                    class="w-auto h-12 grayscale hover:grayscale-0 transition-all" alt="AMEX">
                                <img src="{{ asset('imagenes/imagenes/efectivo.png') }}"
                                    class="w-auto h-12 grayscale hover:grayscale-0 transition-all" alt="Efectivo">
                                <img src="{{ asset('imagenes/imagenes/bitcoin.png') }}"
                                    class="w-auto h-12 grayscale hover:grayscale-0 transition-all" alt="Bitcoin">
                            </div>
                            <ul class="space-y-3 text-gray-600">
                                <li>• Efectivo y Transferencia</li>
                                <li>• Tarjetas de Crédito y Débito</li>
                                <li>• Pagos Digitales</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Galería --}}
    <section class="py-24 bg-white">
        <div class="container px-6 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl">Nuestros Eventos</h2>
                <div class="w-20 h-1 mx-auto mt-4 bg-blue-600"></div>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($images as $image)
                    <div class="overflow-hidden bg-gray-100 rounded-xl group">
                        <img class="object-cover w-full h-64 transition-transform duration-500 opacity-0 lazy-image group-hover:scale-110"
                            data-src="{{ asset('imagenes/imagenes/' . $image['src']) }}" alt="{{ $image['alt'] }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer / Final CTA --}}
    <section class="py-20 text-white bg-blue-900">
        <div class="container px-6 mx-auto text-center">
            <h2 class="mb-8 text-4xl font-bold">¿Listo para planear tu evento?</h2>
            <p class="mb-10 text-xl text-blue-100">Contáctanos hoy mismo y solicita una cotización sin compromiso.</p>
            <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6">
                <a href="https://wa.me/message/2FM4OVMRRIMIB1"
                    class="flex items-center justify-center px-8 py-4 space-x-2 font-bold transition-all bg-green-500 rounded-full hover:bg-green-600">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.025 3.207l-.695 2.54 2.599-.682c.887.484 1.838.74 2.831.741h.005c3.182 0 5.768-2.586 5.769-5.766 0-3.18-2.586-5.766-5.766-5.766zm3.425 8.204c-.145.411-.848.791-1.164.845-.316.054-.606.079-1.39-.241-1.137-.464-2.103-1.423-2.657-2.179-.115-.157-.863-1.15-.863-2.193 0-1.043.545-1.556.738-1.769.193-.213.483-.341.677-.341.194 0 .387.001.554.009.176.008.411-.067.644.492.234.56.797 1.944.866 2.083.069.14.116.302.022.489-.094.187-.142.302-.284.468-.142.166-.299.37-.428.497-.145.142-.296.297-.128.585.168.287.747 1.233 1.602 1.993.708.629 1.303.824 1.59 1.002.287.178.455.152.624-.043.17-.194.721-.84.914-1.129.193-.289.387-.242.645-.145.258.096 1.639.773 1.921.916.282.142.469.213.539.333.071.12.071.696-.074 1.107z" />
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/share/1DRiQTMcWF/"
                    class="flex items-center justify-center px-8 py-4 space-x-2 font-bold transition-all bg-blue-600 rounded-full hover:bg-blue-700">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                    </svg>
                    <span>Facebook</span>
                </a>
            </div>
        </div>
    </section>

</div>
