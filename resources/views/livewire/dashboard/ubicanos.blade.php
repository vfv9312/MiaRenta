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
    <section class="relative py-16 bg-gray-900 overflow-hidden">
        <div class="absolute inset-0 z-0">
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp') }}" class="object-cover w-full h-full opacity-30"
                alt="Mia Renta Ubicación">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/60 to-transparent"></div>
        </div>
        <div class="container relative z-10 px-6 mx-auto text-center">
            <h1 class="text-4xl font-extrabold text-white md:text-5xl animate-fadeInUp">
                ¿Dónde <span class="text-blue-500">Encontrarnos?</span>
            </h1>
            <p class="mt-4 text-lg text-gray-300 animate-fadeInUp delay-200">
                Estamos ubicados en el corazón de Tuxtla Gutiérrez, listos para atenderte.
            </p>
        </div>
    </section>

    {{-- Info y Mapa --}}
    <section class="py-20">
        <div class="container px-6 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-start">

                {{-- Tarjeta de Datos --}}
                <div class="lg:col-span-4 space-y-8 animate-slideInLeft text-center sm:text-left">
                    <div
                        class="p-8 bg-blue-50 rounded-3xl border border-blue-100 shadow-sm transition-all hover:shadow-md">
                        <div class="flex items-center justify-center sm:justify-start mb-6">
                            <div class="p-3 bg-blue-600 rounded-xl text-white">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <h2 class="ml-4 text-2xl font-bold text-gray-900">Visítanos</h2>
                        </div>
                        <address class="not-italic text-lg text-gray-700 leading-relaxed mb-6">
                            Calle Aguiluchos #291,<br>
                            Fracc. Las Aguilas, C.P. 29049<br>
                            <span class="font-bold text-blue-800">Tuxtla Gutiérrez, Chiapas.</span>
                        </address>
                        <div class="space-y-4">
                            <div class="flex items-center space-x-3 text-gray-600">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <span>Lunes a Domingo: 9 AM - 9 PM</span>
                            </div>
                            <div class="flex items-center space-x-3 text-gray-600">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <span>+52 961 458 5559</span>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Mapa --}}
                <div class="lg:col-span-8 animate-fadeInScale">
                    <div class="relative overflow-hidden rounded-3xl shadow-2xl border-4 border-white h-[500px]">
                        <div id="map" class="w-full h-full bg-gray-200"></div>
                        <a href="https://maps.google.com/?q=16.784052885104977,-93.09114388534609" target="_blank"
                            class="absolute bottom-6 right-6 px-6 py-3 bg-white text-blue-900 font-bold rounded-full shadow-lg hover:bg-gray-100 transition-all flex items-center space-x-2">
                            <span>Ver en Google Maps</span>
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M11 3a1 1 0 100 2h2.586l-6.293 6.293a1 1 0 101.414 1.414L15 6.414V9a1 1 0 102 0V4a1 1 0 00-1-1h-5z">
                                </path>
                                <path
                                    d="M5 5a2 2 0 00-2 2v8a2 2 0 002 2h8a2 2 0 002-2v-3a1 1 0 10-2 0v3H5V7h3a1 1 0 000-2H5z">
                                </path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Redes Sociales --}}
    <section class="py-20 bg-gray-50 overflow-hidden">
        <div class="container px-6 mx-auto">
            <div class="text-center mb-16">
                <h2 class="text-3xl font-bold text-gray-900 md:text-4xl mb-4">Síguenos en Redes</h2>
                <p class="text-gray-600 max-w-xl mx-auto">Mantente al tanto de nuestros nuevos montajes, promociones y
                    eventos especiales en Tuxtla.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">

                <!-- Facebook -->
                <a href="#"
                    class="social-card group p-8 bg-white rounded-3xl shadow-sm hover:shadow-xl text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-blue-100 rounded-2xl flex items-center justify-center group-hover:bg-[#1877F2] transition-colors duration-300">
                        <svg class="w-8 h-8 text-[#1877F2] group-hover:text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 group-hover:text-[#1877F2]">Facebook</span>
                </a>

                <!-- Instagram -->
                <a href="#"
                    class="social-card group p-8 bg-white rounded-3xl shadow-sm hover:shadow-xl text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-pink-50 rounded-2xl flex items-center justify-center group-hover:bg-gradient-to-tr group-hover:from-[#f09433] group-hover:via-[#e6683c] group-hover:to-[#bc1888] transition-colors duration-300">
                        <svg class="w-8 h-8 text-[#E4405F] group-hover:text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 group-hover:text-[#E4405F]">Instagram</span>
                </a>

                <!-- TikTok -->
                <a href="#"
                    class="social-card group p-8 bg-white rounded-3xl shadow-sm hover:shadow-xl text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-gray-100 rounded-2xl flex items-center justify-center group-hover:bg-black transition-colors duration-300">
                        <svg class="w-8 h-8 text-black group-hover:text-white" fill="currentColor" viewBox="0 0 24 24">
                            <path
                                d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1.04-.1z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 group-hover:text-black">TikTok</span>
                </a>

                <!-- WhatsApp -->
                <a href="https://wa.me/message/2FM4OVMRRIMIB1"
                    class="social-card group p-8 bg-white rounded-3xl shadow-sm hover:shadow-xl text-center">
                    <div
                        class="w-16 h-16 mx-auto mb-6 bg-green-50 rounded-2xl flex items-center justify-center group-hover:bg-[#25D366] transition-colors duration-300">
                        <svg class="w-8 h-8 text-[#25D366] group-hover:text-white" fill="currentColor"
                            viewBox="0 0 24 24">
                            <path
                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.675 1.439 5.662 1.439h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                        </svg>
                    </div>
                    <span class="font-bold text-gray-900 group-hover:text-[#25D366]">WhatsApp</span>
                </a>

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
                title: 'MÍA RENTA',
                animation: google.maps.Animation.DROP
            });
            var infoContent = `
            <div style="padding: 10px; font-family: 'Inter', sans-serif;">
                <h3 style="margin: 0 0 5px 0; color: #1e3a8a; font-weight: bold;">Mía Renta</h3>
                <p style="margin: 0; color: #4b5563;">Mobiliario elegante en Tuxtla.</p>
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
