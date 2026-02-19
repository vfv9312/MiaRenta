<footer
    class="mt-auto bg-gray-50 border-t border-gray-200 dark:bg-black dark:border-gray-800 transition-colors duration-300">
    <div class="w-full max-w-screen-xl p-8 mx-auto md:flex md:items-center md:justify-between">
        <div class="mb-6 md:mb-0">
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                <span class="self-center text-xl font-black whitespace-nowrap dark:text-white text-gray-900">
                    MÍA <span class="text-red-600">RENTA</span>
                </span>
            </a>
            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">© 2025 MÍA RENTA. Todos los derechos reservados.</p>
        </div>
        <ul class="flex flex-wrap items-center text-sm font-medium text-gray-600 dark:text-gray-400">
            <li>
                <a href="{{ route('factura') }}"
                    class="hover:text-red-600 dark:hover:text-red-500 me-6 transition-colors">Factura</a>
            </li>
            <li>
                <a href="{{ route('politica') }}"
                    class="hover:text-red-600 dark:hover:text-red-500 me-6 transition-colors">Privacidad</a>
            </li>
            <li>
                <a href="{{ route('reclamacion') }}"
                    class="hover:text-red-600 dark:hover:text-red-500 me-6 transition-colors">Reclamaciones</a>
            </li>
            <li>
                <a href="{{ route('login') }}"
                    class="inline-flex items-center px-4 py-2 text-xs font-bold text-white bg-gray-900 rounded-lg hover:bg-gray-800 dark:bg-red-600 dark:hover:bg-red-700 transition-all">
                    Admin
                </a>
            </li>
        </ul>
    </div>
</footer>
