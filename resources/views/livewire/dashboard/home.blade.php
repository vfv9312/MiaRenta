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
                background: rgba(255, 255, 255, 0.7);
                backdrop-filter: blur(12px);
                border: 1px solid rgba(255, 255, 255, 0.2);
            }

            .dark .glass-effect {
                background: rgba(0, 0, 0, 0.6);
                border-color: rgba(255, 255, 255, 0.1);
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
                <img :src="'/' + slide.imagen" class="object-cover w-full h-full opacity-60" :alt="slide.image">
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
                            class="inline-block px-4 py-1 mb-6 text-xs font-bold tracking-wider text-white uppercase bg-red-600 rounded-full md:text-sm animate-fadeIn">
                            Tuxtla Gutiérrez, Chiapas
                        </span>

                        <h1 class="mb-4 text-3xl font-extrabold text-white md:text-7xl" x-html="slide.titulo"></h1>
                        <p class="max-w-2xl mx-auto mb-8 text-lg text-gray-200 md:text-xl" x-text="slide.descripcion">
                        </p>

                        <div
                            class="flex flex-col justify-center w-full space-y-4 sm:flex-row sm:space-y-0 sm:space-x-4">
                            <a :href="slide.boton_url"
                                class="px-8 py-3 text-base font-black text-white transition-all bg-red-600 rounded-full md:py-4 md:text-lg hover:bg-red-700 hover:shadow-2xl hover:shadow-red-500/50"
                                x-text="slide.boton_texto">
                            </a>
                            <a :href="slide.boton_url_two"
                                class="px-8 py-3 text-base font-black text-gray-900 transition-all bg-white rounded-full md:py-4 md:text-lg hover:bg-gray-100 hover:scale-105"
                                x-text="slide.boton_texto_two">
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
                <button @click="activeSlide = index" class="w-3 h-3 rounded-full transition-all duration-300"
                    :class="activeSlide === index ? 'bg-red-600 w-10' : 'bg-white/40'"></button>
            </template>
        </div>
    </section>

    {{-- Servicios --}}
    <section id="servicios" class="py-24 bg-white dark:bg-black transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white md:text-5xl">{{ $us->title }}</h2>
                <div class="w-24 h-1.5 mx-auto mt-6 bg-red-600 rounded-full"></div>
                <p class="mt-6 text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">{{ $us->subtitle }}</p>
            </div>

            <div class="grid grid-cols-1 gap-8 sm:grid-cols-2 lg:grid-cols-4">
                <!-- Servicio 1: Sillas -->
                <div
                    class="p-8 transition-all duration-300 service-card glass-effect rounded-3xl hover:shadow-2xl hover:-translate-y-2 group">
                    <a href="{{ $us->button_url_one }}">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 transition-all duration-300 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 service-icon">
                            <i class="{{ $us->icon }} text-red-600 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-black text-gray-900 dark:text-white">{{ $us->title_button_one }}
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">{{ $us->text_button_one }}</p>
                    </a>
                </div>

                <!-- Servicio 2: Mesas -->
                <div
                    class="p-8 transition-all duration-300 service-card glass-effect rounded-3xl hover:shadow-2xl hover:-translate-y-2 group">
                    <a href="{{ $us->button_url_two }}">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 transition-all duration-300 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 service-icon">
                            <i class="{{ $us->icon_two }} text-red-600 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-black text-gray-900 dark:text-white">{{ $us->title_button_two }}
                        </h3>

                        <p class="text-gray-600 dark:text-gray-400">{{ $us->text_button_two }}</p>
                    </a>
                </div>

                <!-- Servicio 3: Mantelería -->
                <div
                    class="p-8 transition-all duration-300 service-card glass-effect rounded-3xl hover:shadow-2xl hover:-translate-y-2 group">
                    <a href="{{ $us->button_url_three }}">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 transition-all duration-300 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 service-icon">
                            <i class="{{ $us->icon_three }} text-red-600 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-black text-gray-900 dark:text-white">{{ $us->title_button_three }}
                        </h3>

                        <p class="text-gray-600 dark:text-gray-400">{{ $us->text_button_three }}</p>
                    </a>
                </div>

                <!-- Servicio 4: Cristalería -->
                <div
                    class="p-8 transition-all duration-300 service-card glass-effect rounded-3xl hover:shadow-2xl hover:-translate-y-2 group">
                    <a href="{{ $us->button_url_four }}">
                        <div
                            class="flex items-center justify-center w-16 h-16 mb-6 transition-all duration-300 bg-red-50 dark:bg-red-900/20 rounded-2xl group-hover:bg-red-600 service-icon">
                            <i class="{{ $us->icon_four }} text-red-600 group-hover:text-white transition-colors"></i>
                        </div>
                        <h3 class="mb-3 text-xl font-black text-gray-900 dark:text-white">{{ $us->title_button_four }}
                        </h3>

                        <p class="text-gray-600 dark:text-gray-400">{{ $us->text_button_four }}</p>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- Info Section --}}
    <section class="py-24 bg-gray-50 dark:bg-zinc-900 overflow-hidden transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="flex flex-col items-center gap-16 lg:flex-row">
                <div class="w-full lg:w-1/2 animate-fadeIn">
                    <img src="{{ asset('imagenes/logos/logoprueba2.png') }}"
                        class="w-auto h-32 mb-10 dark:invert transition-all duration-500" alt="Mia Renta Logo">
                    <h2 class="mb-8 text-4xl font-black text-gray-900 dark:text-white leading-tight">Calidad y Servicio
                        en <span class="text-red-600">cada Detalle</span></h2>
                    <p class="mb-10 text-xl text-gray-600 dark:text-gray-400">
                        En **Mía Renta**, nos especializamos en brindar soluciones de mobiliario para eventos sociales y
                        corporativos en Tuxtla Gutiérrez. Nuestra prioridad es que tu evento sea perfecto, por eso
                        ofrecemos equipos mantenidos en excelentes condiciones.
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div
                            class="flex items-center space-x-4 p-4 bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800">
                            <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-bold">Entrega Puntual</span>
                        </div>
                        <div
                            class="flex items-center space-x-4 p-4 bg-white dark:bg-black rounded-2xl shadow-sm border border-gray-100 dark:border-zinc-800">
                            <div class="p-2 bg-red-50 dark:bg-red-900/20 rounded-lg">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-gray-700 dark:text-gray-300 font-bold">Equipos Sanitizados</span>
                        </div>
                    </div>
                </div>
                <div class="w-full lg:w-1/2">
                    <div
                        class="relative p-1 bg-gradient-to-tr from-red-600 to-black rounded-3xl shadow-2xl overflow-hidden group">
                        <div class="bg-white dark:bg-black p-10 rounded-[1.4rem] transition-colors duration-300">
                            <h3 class="mb-6 text-2xl font-black text-gray-900 dark:text-white">Pagos Seguros</h3>
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
                            <ul class="space-y-4 text-gray-600 dark:text-gray-400 font-medium">
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    <span>Efectivo y Transferencia</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    <span>Tarjetas de Crédito y Débito</span>
                                </li>
                                <li class="flex items-center space-x-2">
                                    <span class="w-2 h-2 bg-red-600 rounded-full"></span>
                                    <span>Pagos Digitales</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Galería --}}
    <section class="py-24 bg-white dark:bg-black transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="mb-16 text-center">
                <h2 class="text-3xl font-black text-gray-900 dark:text-white md:text-5xl">Nuestra Galería</h2>
                <div class="w-24 h-1.5 mx-auto mt-6 bg-red-600 rounded-full"></div>
            </div>

            <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
                @foreach ($images as $image)
                    <div class="overflow-hidden bg-gray-100 rounded-xl group">
                        <img class="object-cover w-full h-64 transition-transform duration-500 opacity-0 lazy-image group-hover:scale-110"
                            data-src="{{ asset($image->path) }}" alt="{{ $image->description }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Footer / Final CTA --}}
    <section class="py-24 text-white bg-black relative overflow-hidden">
        <div
            class="absolute inset-0 bg-[radial-gradient(circle_at_center,_var(--tw-gradient-stops))] from-red-900/40 via-transparent to-transparent opacity-50">
        </div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h2 class="mb-8 text-4xl md:text-6xl font-black">¿Listo para tu <span class="text-red-600">próximo
                    evento?</span></h2>
            <p class="mb-12 text-xl text-gray-400 max-w-2xl mx-auto">Contáctanos hoy mismo y descubre por qué somos la
                mejor opción en mobiliario.</p>
            <div class="flex flex-col justify-center space-y-4 sm:flex-row sm:space-y-0 sm:space-x-6">
                <a href="https://wa.me/message/2FM4OVMRRIMIB1"
                    class="flex items-center justify-center px-10 py-5 space-x-3 font-black transition-all bg-[#25D366] rounded-full hover:scale-105 active:scale-95 shadow-xl shadow-green-500/20">
                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.025 3.207l-.695 2.54 2.599-.682c.887.484 1.838.74 2.831.741h.005c3.182 0 5.768-2.586 5.769-5.766 0-3.18-2.586-5.766-5.766-5.766zm3.425 8.204c-.145.411-.848.791-1.164.845-.316.054-.606.079-1.39-.241-1.137-.464-2.103-1.423-2.657-2.179-.115-.157-.863-1.15-.863-2.193 0-1.043.545-1.556.738-1.769.193-.213.483-.341.677-.341.194 0 .387.001.554.009.176.008.411-.067.644.492.234.56.797 1.944.866 2.083.069.14.116.302.022.489-.094.187-.142.302-.284.468-.142.166-.299.37-.428.497-.145.142-.296.297-.128.585.168.287.747 1.233 1.602 1.993.708.629 1.303.824 1.59 1.002.287.178.455.152.624-.043.17-.194.721-.84.914-1.129.193-.289.387-.242.645-.145.258.096 1.639.773 1.921.916.282.142.469.213.539.333.071.12.071.696-.074 1.107z" />
                    </svg>
                    <span>WhatsApp</span>
                </a>
                <a href="https://www.facebook.com/share/1DRiQTMcWF/"
                    class="flex items-center justify-center px-10 py-5 space-x-3 font-black transition-all bg-[#1877F2] rounded-full hover:scale-105 active:scale-95 shadow-xl shadow-blue-500/20">
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
