<div>
@push('css')
<style>
    .lazy-image {
        border: 2px solid red; /* Borde rojo antes de cargar */
    }

    .lazy-image.loaded {
        border: 2px solid green; /* Borde verde después de cargar */
    }
</style>
@endpush
@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const lazyImages = document.querySelectorAll('.lazy-image');

        const observer = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src; // Carga la imagen
                    img.classList.add('loaded'); // Agrega la clase "loaded"
                    observer.unobserve(img); // Deja de observar la imagen
                }
            });
        });

        lazyImages.forEach(img => {
            observer.observe(img); // Observa cada imagen
        });
    });
</script>
@endpush
    {{-- Carrusel de imagenes--}}
<section>
    {{-- Carrusel de imagenes--}}
        <div id="default-carousel" class="relative w-full" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <!-- Texto 1 -->
                        <!-- Capa overlay semitransparente -->
            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div> <
                    <div
                    class="relative z-10 flex flex-col items-center space-y-6 text-center text-white animate-fade-in">
                    <p
                        class="text-lg tracking-widest uppercase delay-100 sm:text-xl md:text-2xl opacity-90 animate-slide-down">
                        Mia Renta | Renta de mesas, siilas, manteles y mas.
                    </p>
                    <h1 class="text-4xl font-bold leading-tight delay-200 sm:text-5xl md:text-6xl animate-scale-up">
                        Bienvenido a <span class="text-[#FFDD57]">Mia Renta</span>
                    </h1>
                    <a href="/platillos"
                        class="text-center py-2 px-6 text-white bg-[#052c8e8c] rounded-full text-lg font-medium shadow-lg hover:scale-105 transition-transform duration-300 hover:bg-[#224ab1af] animate-slide-up delay-300">
                        Descubre lo que puedes conseguir para tu evento
                    </a>
                </div>

                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Capa overlay semitransparente -->
            <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div> <
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <!-- Capa overlay semitransparente -->
                    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div> <
                </div>
                <!-- Item 4 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                        <!-- Capa overlay semitransparente -->
                    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div> <
                </div>
                <!-- Item 5 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
                    <!-- Capa overlay semitransparente -->
                    <div class="absolute top-0 left-0 w-full h-full bg-black opacity-50"></div> <
                </div>
            </div>
            <!-- Slider indicators -->
            <div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2 rtl:space-x-reverse">
                <button type="button" class="w-3 h-3 rounded-full" aria-current="true" aria-label="Slide 1" data-carousel-slide-to="0"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 4" data-carousel-slide-to="3"></button>
                <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 5" data-carousel-slide-to="4"></button>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer start-0 group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Anterior</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer end-0 group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Siguiente</span>
                </span>
            </button>
        </div>
</section>
{{--Intrucciones--}}
<section>
            <!-- Hero Section -->
        <div class="relative flex flex-col items-center w-full px-4 py-24 md:flex-row"
        style="background-image: url('./storage/images/logos/bg_white.svg'); background-size: 200px 200px; background-repeat: repeat; background-position: center;">

        <div class="relative z-10 w-full px-4 mb-8 text-left md:w-4/5 md:px-12 md:mb-0">
        <h2 class="text-[#8E1205] font-bold text-lg">¡Para tus eventos en Tuxtla Gutierrez!</h2>
        {{-- <h2 class="text-[#8E1205] font-bold text-lg mb-6">🔊Puedes soclicitar una orden aqui!👋🏽.</h2> --}}
        {{-- <h3 class="text-4xl font-medium text-blue-800 md:text-5xl font-cursive">Mía Renta</h3> --}}
        <img src="{{asset('imagenes/logos/logoprueba2.png')}}" class="w-auto h-44">
        <p class="mt-4 text-gray-600">
            Contamos con :
        </p>
        <ul class="pl-5 list-none">
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Mantelería</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Cristalería</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Sillas de madera, plastico y acoginadas</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Mesas cuadradas para 4 personas</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Mesas redondas para 10 personas</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Mesas tablon para 10 personas</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Sillas infantiles de plastico</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Mesas infantiles para 10 niños</li>
          </ul>

          <h1 class="text-[#8E1205] font-bold text-lg mb-6">Metodos de pago</h1>
            <div class="flex">
                <img src="{{asset('imagenes/imagenes/visa.png')}}" class="w-auto h-10 ">
                <img src="{{asset('imagenes/imagenes/mastercard.png')}}" class="w-auto h-10 ">
                <img src="{{asset('imagenes/imagenes/amex.png')}}" class="w-auto h-10 ">
                <img src="{{asset('imagenes/imagenes/efectivo.png')}}" class="w-auto h-10 ">
                <img src="{{asset('imagenes/imagenes/bitcoin.png')}}" class="w-auto h-10 ">
            </div>
          <ul class="pl-5 list-none">
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Efectivo</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Tarjeta de Credito o Debito (AMEX, VISA, MASTERCARD)</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Transferencias</li>
            <li class="before:content-['✓'] before:text-green-500 before:font-bold before:mr-2">Bitcoin</li>
          </ul>
        </div>


        <div class="relative z-10 flex justify-center w-full p-6 md:w-1/2 md:justify-end">
        <div class="w-full max-w-sm overflow-hidden">
        <!-- From Uiverse.io by Smit-Prajapati card -->
        <div class="parent">
            <div class="card">
                <div class="logo">
                    <span class="circle circle1"></span>
                    <span class="circle circle2"></span>
                    <span class="circle circle3"></span>
                    <span class="circle circle4"></span>
                    <span class="circle circle5">
                        <object data="{{ asset('imagenes/logos/logoprueba3.svg') }}" type="image/svg+xml" class="w-24 h-24">
                        </object>
                    </span>

                </div>
                <div class="glass"></div>
                <div class="content">
                    <span class="title">MÍA RENTA</span>
                    <span class="text">Siguenos en nuestras redes sociales y encuentra promociones</span>
                </div>
                <div class="bottom">

                    <div class="social-buttons-container">
                        <a class="social-button .social-button1" href="https://www.facebook.com/share/1DRiQTMcWF/">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-facebook" viewBox="0 0 16 16">
                                <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951"/>
                            </svg></a>
                        <a class="social-button .social-button2" href="https://wa.me/message/2FM4OVMRRIMIB1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
                                <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
                            </svg>
                        </a>
                        <a class="social-button .social-button3" href="">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tiktok" viewBox="0 0 16 16">
                                <path d="M9 0h1.98c.144.715.54 1.617 1.235 2.512C12.895 3.389 13.797 4 15 4v2c-1.753 0-3.07-.814-4-1.829V11a5 5 0 1 1-5-5v2a3 3 0 1 0 3 3z"/>
                            </svg>
                        </a>
                    </div>
                    <div class="view-more">
                        <button class="view-more-button">
                        <object data="{{ asset('imagenes/logos/logoprueba3.svg') }}" type="image/svg+xml" class="w-20 h-20">
                        </button>
                        </object>
                    </div>
                </div>
            </div>
        </div>
        </div>
        </div>
        </div>
</section>


{{-- Galería de imágenes --}}
<section class="mt-16 md:mt-16">
    <div class="grid grid-cols-2 gap-4 md:grid-cols-4">
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/0.jpeg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/2.jpg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/3.jpg') }}" alt="" loading="lazy">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/4.jpg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/6.jpg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/5.jpg') }}" alt="" loading="lazy">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/7.jpeg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/8.jpg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/9.jpg') }}" alt="" loading="lazy">
            </div>
        </div>
        <div class="grid gap-4">
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/12.jpg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/10.jpeg') }}" alt="" loading="lazy">
            </div>
            <div>
                <img class="h-auto max-w-full rounded-lg lazy-image" data-src="{{ asset('imagenes/imagenes/11.jpeg') }}" alt="" loading="lazy">
            </div>
        </div>
    </div>
</section>

<link href="{{ asset('css/card1.css') }}" rel="stylesheet">

</div>

