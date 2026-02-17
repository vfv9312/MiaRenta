<div class="min-h-[80vh] bg-white flex items-center justify-center px-6 overflow-hidden">
    @push('css')
        <style>
            @keyframes float {

                0%,
                100% {
                    transform: translateY(0) rotate(0);
                }

                50% {
                    transform: translateY(-20px) rotate(5deg);
                }
            }

            @keyframes search {

                0%,
                100% {
                    transform: translateX(-30px);
                }

                50% {
                    transform: translateX(30px);
                }
            }

            @keyframes chairFade {

                0%,
                100% {
                    opacity: 0.2;
                    transform: scale(0.8);
                }

                50% {
                    opacity: 0.5;
                    transform: scale(1.1);
                }
            }

            .animate-float {
                animation: float 4s ease-in-out infinite;
            }

            .animate-search {
                animation: search 3s ease-in-out infinite;
            }

            .animate-chair-ghost {
                animation: chairFade 3s ease-in-out infinite;
            }
        </style>
    @endpush

    <div class="max-w-2xl w-full text-center">
        {{-- Ilustración Animada --}}
        <div class="relative h-64 mb-12 flex items-center justify-center">
            {{-- Silla Fantasma (El objeto perdido) --}}
            <div class="absolute animate-chair-ghost text-blue-200">
                <svg class="w-48 h-48" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M7 13h10V7h3V3H4v4h3v6zm0 8h2v-6h6v6h2v-8H7v8z" />
                </svg>
            </div>

            {{-- Personaje buscando --}}
            <div class="relative z-10 animate-search">
                <div class="animate-float">
                    <svg class="w-32 h-32 text-blue-900" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                    </svg>
                </div>
            </div>

            {{-- Texto 404 Gigante de Fondo --}}
            <span
                class="absolute inset-0 flex items-center justify-center text-[15rem] font-black text-blue-50 opacity-10 select-none">
                404
            </span>
        </div>

        {{-- Mensaje --}}
        <h1 class="text-4xl font-extrabold text-gray-900 md:text-5xl mb-6">
            ¡Ups! Te quedaste <span class="text-blue-600">sin silla</span>
        </h1>
        <p class="text-xl text-gray-600 mb-10 max-w-lg mx-auto leading-relaxed">
            Parece que la página que buscas no está en la lista de invitados. No te preocupes, ¡tenemos lugar para ti en
            el inicio!
        </p>

        {{-- Acciones --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="{{ route('dashboard') }}"
                class="px-10 py-4 bg-blue-700 text-white font-bold rounded-full hover:bg-blue-800 transition-all hover:shadow-2xl flex items-center space-x-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6">
                    </path>
                </svg>
                <span>Volver al Inicio</span>
            </a>
            <a href="{{ route('dashboard') }}#servicios"
                class="px-10 py-4 bg-gray-100 text-gray-900 font-bold rounded-full hover:bg-gray-200 transition-all">
                Ver Mobiliario
            </a>
        </div>
    </div>
</div>
