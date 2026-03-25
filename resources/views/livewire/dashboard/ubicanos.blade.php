<div class="bg-white">
    @push('css')
        <style>
            @keyframes fadeInScale {
                from {
                    opacity: 0;
                    transform: scale(0.95);
                }

                to {
                    opacity: 1;
                    transform: scale(1);
                }
            }

            .animate-fadeInScale {
                animation: fadeInScale 0.6s ease-out forwards;
            }

            .social-card {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            .social-card:hover {
                transform: translateY(-8px);
            }
        </style>
    @endpush

    {{-- Banner Header --}}
    <section class="relative py-24 bg-black overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp') }}" class="object-cover w-full h-full opacity-30"
                alt="Mia Renta Ubicación">
            <div class="absolute inset-0 bg-gradient-to-t from-black via-black/40 to-transparent"></div>
        </div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h1 class="text-4xl font-black text-white md:text-7xl animate-fadeInUp">
                ¿Dónde <span class="text-red-600">Encontrarnos?</span>
            </h1>
            <p class="mt-6 text-xl text-gray-300 max-w-2xl mx-auto animate-fadeInUp delay-200">
                Estamos ubicados en el corazón de Tuxtla Gutiérrez, listos para brindarte la mejor atención.
            </p>
        </div>
    </section>

    {{-- Info y Mapa --}}
    <section class="py-24 dark:bg-black transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16 items-center">
                {{-- Tarjeta de Datos --}}
                <div class="lg:col-span-5 space-y-8 animate-slideInLeft text-center sm:text-left">
                    <div
                        class="p-10 bg-white dark:bg-zinc-900 rounded-[2.5rem] border border-gray-100 dark:border-zinc-800 shadow-2xl transition-all hover:shadow-red-500/10">
                        <div class="flex items-center justify-center sm:justify-start mb-8">
                            <div class="p-4 bg-red-600 rounded-2xl text-white shadow-lg shadow-red-500/30">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="ml-5 text-3xl font-black text-gray-900 dark:text-white">Visítanos</h2>
                        </div>
                        <address class="not-italic text-xl text-gray-700 dark:text-gray-400 leading-relaxed mb-10">
                            Calle Aguiluchos #291,<br>
                            Fracc. Las Aguilas, C.P. 29049<br>
                            <span class="font-black text-red-600">Tuxtla Gutiérrez, Chiapas.</span>
                        </address>
                        <div class="space-y-6">
                            <div
                                class="flex items-center space-x-4 text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-black/50 p-4 rounded-2xl">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span class="font-bold">Lunes a Domingo: 9 AM - 9 PM</span>
                            </div>
                            <div
                                class="flex items-center space-x-4 text-gray-600 dark:text-gray-300 bg-gray-50 dark:bg-black/50 p-4 rounded-2xl">
                                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span class="font-bold">+52 961 458 5559</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mapa --}}
                <div class="lg:col-span-7 animate-fadeInScale">
                    <div
                        class="relative overflow-hidden rounded-[3rem] shadow-2xl border-8 border-white dark:border-zinc-800 h-[600px] group">
                        <div id="map"
                            class="w-full h-full bg-gray-200 dark:bg-zinc-800 grayscale dark:invert transition-all duration-700 group-hover:grayscale-0 group-hover:invert-0">
                        </div>
                        <a href="https://www.google.com/maps/dir/?api=1&destination=16.784052885104977,-93.09114388534609"
                            target="_blank"
                            class="absolute bottom-8 right-8 px-10 py-5 bg-red-600 text-white font-black rounded-full shadow-2xl hover:bg-red-700 transition-all flex items-center space-x-3">
                            <span>Como llegar</span>
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Redes Sociales --}}
    <section class="py-24 bg-gray-50 dark:bg-zinc-900 overflow-hidden transition-colors duration-300">
        <div class="container px-6 mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-4xl font-black text-gray-900 dark:text-white md:text-5xl mb-6">Conecta con <span
                        class="text-red-600">Nosotros</span></h2>
                <div class="w-24 h-1.5 mx-auto bg-red-600 rounded-full mb-8"></div>
                <p class="text-lg text-gray-600 dark:text-gray-400 max-w-2xl mx-auto">Descubre nuestras últimas
                    tendencias y promociones exclusivas para tus eventos en Chiapas.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach ($socialNetworks as $social)
                    @php
                        $name = strtolower($social->catalagoTipo->nombre);
                        $colors = [
                            'facebook' => 'bg-red-50 group-hover:bg-[#1877F2] text-[#1877F2]',
                            'instagram' =>
                                'bg-pink-50 group-hover:bg-gradient-to-tr group-hover:from-[#f09433] group-hover:via-[#e6683c] group-hover:to-[#bc1888] text-[#E4405F]',
                            'tiktok' => 'bg-gray-100 group-hover:bg-black text-black',
                            'whatsapp' => 'bg-red-50 group-hover:bg-[#25D366] text-[#25D366]',
                        ];
                        $colorClass = $colors[$name] ?? 'bg-gray-50 group-hover:bg-red-600 text-red-600';
                        $hoverTextColor =
                            [
                                'facebook' => 'group-hover:text-[#1877F2]',
                                'instagram' => 'group-hover:text-[#E4405F]',
                                'tiktok' => 'group-hover:text-black',
                                'whatsapp' => 'group-hover:text-[#25D366]',
                            ][$name] ?? 'group-hover:text-red-600';
                    @endphp

                    <a href="{{ $social->recurso }}" target="_blank"
                        class="social-card group p-10 bg-white dark:bg-black rounded-[2.5rem] shadow-sm hover:shadow-2xl border border-gray-100 dark:border-zinc-800 text-center">
                        <div
                            class="w-20 h-20 mx-auto mb-8 rounded-3xl flex items-center justify-center transition-all duration-300 {{ explode(' ', $colorClass)[0] }} {{ explode(' ', $colorClass)[1] }}">
                            <div class="w-10 h-10 {{ explode(' ', $colorClass)[2] }} group-hover:text-white flex items-center justify-center">
                                @if (str_starts_with($social->catalagoTipo->imagen, 'storage/'))
                                    <img src="{{ asset($social->catalagoTipo->imagen) }}" class="w-full h-full object-contain filter group-hover:brightness-0 group-hover:invert transition-all duration-300">
                                @else
                                    {!! $social->catalagoTipo->imagen !!}
                                @endif
                            </div>
                        </div>
                        <span
                            class="font-black text-xl text-gray-900 dark:text-white {{ $hoverTextColor }}">{{ $social->catalagoTipo->nombre }}</span>
                    </a>
                @endforeach
            </div>

            </div>
        </div>
    </section>
</div>

@push('js')
    <script src="https://maps.googleapis.com/maps/api/js?key={{ config('google.maps_api_key') }}&callback=initMap" async
        defer></script>
    <script>
        function initMap() {
            var negocioUbicacion = {
                lat: 16.784052885104977,
                lng: -93.09114388534609
            };
            var mapOptions = {
                zoom: 16,
                center: negocioUbicacion,
                styles: [{
                        "featureType": "administrative",
                        "elementType": "labels.text.fill",
                        "stylers": [{
                            "color": "#444444"
                        }]
                    },
                    {
                        "featureType": "landscape",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#f2f2f2"
                        }]
                    },
                    {
                        "featureType": "poi",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "road",
                        "elementType": "all",
                        "stylers": [{
                            "saturation": -100
                        }, {
                            "lightness": 45
                        }]
                    },
                    {
                        "featureType": "road.highway",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "simplified"
                        }]
                    },
                    {
                        "featureType": "road.arterial",
                        "elementType": "labels.icon",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "transit",
                        "elementType": "all",
                        "stylers": [{
                            "visibility": "off"
                        }]
                    },
                    {
                        "featureType": "water",
                        "elementType": "all",
                        "stylers": [{
                            "color": "#46bcec"
                        }, {
                            "visibility": "on"
                        }]
                    }
                ],
                disableDefaultUI: true,
                zoomControl: true,
            };
            var map = new google.maps.Map(document.getElementById('map'), mapOptions);
            var marker = new google.maps.Marker({
                position: negocioUbicacion,
                map: map,
                icon: {
                    url: "{{ asset('imagenes/logos/Pin.png') }}",
                    // O cualquier imagen que prefieras
                    scaledSize: new google.maps.Size(100, 100), // Ajustar tamaño
                },
                title: 'MÍA RENTA',
                animation: google.maps.Animation.DROP

            });
            var infoContent = `
            <div style="padding: 10px; font-family: 'Inter', sans-serif;">
                <h3 style="margin: 0 0 5px 0; color: #1e3a8a; font-weight: bold;">Mía Renta</h3>
                <p style="margin: 0; color: #4b5563;">Nos encontramos aqui en Tuxtla Gutiérrez, Chiapas.</p>
            </div>
        `;
            var infoWindow = new google.maps.InfoWindow({
                content: infoContent
            });
            marker.addListener('click', function() {
                infoWindow.open(map, marker);
            });
        }
    </script>
@endpush
