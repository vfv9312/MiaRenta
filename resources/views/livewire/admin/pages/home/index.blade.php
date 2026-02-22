<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Administración de Inicio
            </h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Selecciona el apartado que deseas modificar de tu
                página principal.</p>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Banner / Carrusel -->
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-indigo-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                </div>
                <div class="p-8">
                    <div
                        class="w-14 h-14 bg-indigo-100 dark:bg-indigo-900/50 rounded-xl flex items-center justify-center mb-6 border border-indigo-200 dark:border-indigo-800">
                        <i class="fas fa-images text-2xl text-indigo-600 dark:text-indigo-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Banner de Home</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8">Administra las imágenes y
                        mensajes del carrusel principal que ven tus clientes al entrar.</p>
                    <a href="{{ route('inicio.banner') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-indigo-200 dark:shadow-none">
                        <span>Gestionar Banner</span>
                        <i class="fas fa-arrow-right text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Categorías -->
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-emerald-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                </div>
                <div class="p-8">
                    <div
                        class="w-14 h-14 bg-emerald-100 dark:bg-emerald-900/50 rounded-xl flex items-center justify-center mb-6 border border-emerald-200 dark:border-emerald-800">
                        <i class="fas fa-th-large text-2xl text-emerald-600 dark:text-emerald-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Categorías</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8">Modifica los textos,
                        títulos y descripciones de las secciones de categorías en el inicio.</p>
                    <a href="{{ route('inicio.catalog') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-emerald-200 dark:shadow-none">
                        <span>Editar Categorías</span>
                        <i class="fas fa-pen text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Footer -->
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                </div>
                <div class="p-8">
                    <div
                        class="w-14 h-14 bg-amber-100 dark:bg-amber-900/50 rounded-xl flex items-center justify-center mb-6 border border-amber-200 dark:border-amber-800">
                        <i class="fas fa-shoe-prints text-2xl text-amber-600 dark:text-amber-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Footer del Index</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8">Gestiona la información,
                        enlaces y avisos legales que aparecen en el pie de página.</p>
                    <a href="#"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-amber-600 hover:bg-amber-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-amber-200 dark:shadow-none">
                        <span>Gestionar Footer</span>
                        <i class="fas fa-external-link-alt text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Galeria -->
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 overflow-hidden transition-all duration-300 hover:shadow-xl hover:-translate-y-1">
                <div
                    class="absolute inset-0 bg-gradient-to-br from-amber-500/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                </div>
                <div class="p-8">
                    <div
                        class="w-14 h-14 bg-lime-100 dark:bg-lime-900/50 rounded-xl flex items-center justify-center mb-6 border border-lime-200 dark:border-lime-800">
                        <i class="fas fa-camera-retro text-2xl text-lime-600 dark:text-lime-400"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white mb-2">Galeria</h3>
                    <p class="text-gray-600 dark:text-gray-400 text-sm leading-relaxed mb-8">Gestiona las imagenes de la
                        galeria que aparecen en el pie de página.</p>
                    <a href="{{ route('inicio.galery') }}" wire:navigate
                        class="inline-flex items-center gap-2 px-6 py-3 bg-lime-600 hover:bg-lime-700 text-white font-semibold rounded-xl transition-colors shadow-lg shadow-lime-200 dark:shadow-none">
                        <span>Gestionar Galeria</span>
                        <i class="fas fa-images text-xs"></i>
                    </a>
                </div>
            </div>

            <!-- Otros Apartados (Placeholder) -->
            <div
                class="group relative bg-white dark:bg-gray-800 rounded-2xl border border-dashed border-gray-300 dark:border-gray-600 overflow-hidden transition-all duration-300 hover:bg-gray-100 dark:hover:bg-gray-700/50 flex flex-col items-center justify-center p-8 text-center">
                <div
                    class="w-12 h-12 bg-gray-100 dark:bg-gray-700 rounded-full flex items-center justify-center mb-4 text-gray-400">
                    <i class="fas fa-plus"></i>
                </div>
                <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Más apartados próximamente...</p>
            </div>
        </div>
    </div>
</div>
