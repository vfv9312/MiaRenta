<div>
<section class="mt-16">

{{-- Carrusel de imagenes--}}
<div id="default-carousel" class="relative w-full" data-carousel="slide">
    <!-- Carousel wrapper -->
    <div class="relative h-56 overflow-hidden rounded-lg md:h-96">
         <!-- Item 1 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
            <!-- Texto 1 -->
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

        </div>
        <!-- Item 3 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 4 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
        </div>
        <!-- Item 5 -->
        <div class="hidden duration-700 ease-in-out" data-carousel-item>
            <img src="{{ asset('imagenes/carrusel/FONDO1.webp')}}" class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2" alt="...">
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

    <section>
            <!-- Hero Section -->
    <div class="relative flex flex-col items-center w-full px-4 py-24 md:flex-row"
    style="background-image: url('./storage/images/logos/bg_white.svg'); background-size: 200px 200px; background-repeat: repeat; background-position: center;">
    <div class="relative z-0 flex items-center justify-center w-3/4 mb-8 md:w-1/4 md:mb-0 ">
        <img src="{{asset('imagenes/logos/logoprueba.jpeg')}}" alt="Logo"
            class="hidden lg:block w-[500px] md:w-[640px] object-cover lg:rotate-90"">
    </div>
    <div class="relative z-10 w-full px-4 mb-8 text-left md:w-4/5 md:px-12 md:mb-0">
        <h2 class="text-[#8E1205] font-bold text-lg">¡Para tus eventos en Tuxtla Gutierrez!</h2>
        <h2 class="text-[#8E1205] font-bold text-lg mb-6">Donde cada evento es especial.</h2>
        <h3 class="text-4xl font-medium text-blue-800 md:text-5xl font-cursive">Mía Renta</h3>
        <p class="mt-4 text-gray-600">
Es un negocio familiar de renta de mobiliario que nacio en 2018,
        </p>
    </div>

    <div class="relative z-10 flex justify-center w-full p-6 md:w-1/2 md:justify-end">
        <div class="w-full max-w-sm overflow-hidden">
            <img src="{{asset('imagenes/logos/logoprueba.jpeg')}}" alt="logo" class="object-cover w-full h-full">
        </div>
    </div>
</div>
    </section>

    <section>


<div class="grid grid-cols-2 gap-4 md:grid-cols-4">
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-1.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-2.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-3.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-4.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-5.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-6.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-7.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-8.jpg" alt="">
        </div>
    </div>
    <div class="grid gap-4">
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-9.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-10.jpg" alt="">
        </div>
        <div>
            <img class="h-auto max-w-full rounded-lg" src="https://flowbite.s3.amazonaws.com/docs/gallery/masonry/image-11.jpg" alt="">
        </div>
    </div>
</div>

    </section>


</div>
