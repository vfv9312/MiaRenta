<div class="p-4 md:p-6 min-h-screen">
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-gray-800 dark:text-white flex items-center gap-2">
            <i class="fas fa-tachometer-alt text-blue-600"></i> Panel de Control
        </h2>
        <p class="text-gray-500 dark:text-gray-400 mt-1">Accesos rápidos a los módulos principales del sistema.</p>
    </div>

    <!-- Gestión de Rentas -->
    <div class="mb-10">
        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2 flex items-center gap-2">
            <i class="fas fa-handshake text-indigo-500"></i> Gestión de Rentas y Clientes
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('generar-orden') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-blue-50 dark:bg-gray-700 text-blue-600 dark:text-blue-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-blue-600 group-hover:text-white transition-colors">
                    <i class="fas fa-file-invoice-dollar"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Generar Orden</span>
            </a>

            <a href="{{ route('ordenes') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-indigo-50 dark:bg-gray-700 text-indigo-600 dark:text-indigo-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-indigo-600 group-hover:text-white transition-colors">
                    <i class="fas fa-list-alt"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Historial Órdenes</span>
            </a>

            <a href="{{ route('ordenes.estadisticas') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-green-50 dark:bg-gray-700 text-green-600 dark:text-green-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-green-600 group-hover:text-white transition-colors">
                    <i class="fas fa-chart-line"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Estadísticas</span>
            </a>

            <a href="{{ route('clientes') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-purple-50 dark:bg-gray-700 text-purple-600 dark:text-purple-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-purple-600 group-hover:text-white transition-colors">
                    <i class="fas fa-users"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Clientes</span>
            </a>
        </div>
    </div>

    <!-- Inventario -->
    <div class="mb-10">
        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2 flex items-center gap-2">
            <i class="fas fa-boxes text-orange-500"></i> Inventario de Mobiliario
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('productos') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-orange-50 dark:bg-gray-700 text-orange-600 dark:text-orange-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-orange-500 group-hover:text-white transition-colors">
                    <i class="fas fa-couch"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Productos</span>
            </a>

            <a href="{{ route('categorias') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-yellow-50 dark:bg-gray-700 text-yellow-600 dark:text-yellow-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <i class="fas fa-tags"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Categorías</span>
            </a>

            <a href="{{ route('tipos') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-yellow-50 dark:bg-gray-700 text-yellow-600 dark:text-yellow-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-yellow-500 group-hover:text-white transition-colors">
                    <i class="fas fa-shapes"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Tipos</span>
            </a>

            <a href="{{ route('reparaciones') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-red-50 dark:bg-gray-700 text-red-600 dark:text-red-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-red-500 group-hover:text-white transition-colors">
                    <i class="fas fa-tools"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Reparaciones</span>
            </a>
        </div>
    </div>

    <!-- Administración y Web -->
    <div class="mb-4">
        <h3 class="text-lg font-bold text-gray-700 dark:text-gray-300 mb-4 border-b border-gray-200 dark:border-gray-700 pb-2 flex items-center gap-2">
            <i class="fas fa-cogs text-gray-500"></i> Administración y Portal Web
        </h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <a href="{{ route('configuracion') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-gray-100 dark:bg-gray-700 text-gray-600 dark:text-gray-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-gray-600 group-hover:text-white transition-colors">
                    <i class="fas fa-cog"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Configuración</span>
            </a>

            <a href="{{ route('empleados') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-teal-50 dark:bg-gray-700 text-teal-600 dark:text-teal-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-teal-600 group-hover:text-white transition-colors">
                    <i class="fas fa-id-badge"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Empleados</span>
            </a>

            <a href="{{ route('usuarios') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-blue-50 dark:bg-gray-700 text-blue-800 dark:text-blue-300 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-blue-800 group-hover:text-white transition-colors">
                    <i class="fas fa-user-shield"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Usuarios</span>
            </a>

            <a href="{{ route('inicio.index') }}" class="flex flex-col items-center justify-center p-5 bg-white dark:bg-gray-800 rounded-xl shadow-sm hover:shadow-md border border-gray-100 dark:border-gray-700 transition-all hover:-translate-y-1 group">
                <div class="w-12 h-12 md:w-16 md:h-16 bg-pink-50 dark:bg-gray-700 text-pink-600 dark:text-pink-400 rounded-full flex items-center justify-center text-xl md:text-2xl mb-3 group-hover:bg-pink-600 group-hover:text-white transition-colors">
                    <i class="fas fa-globe"></i>
                </div>
                <span class="font-bold text-sm md:text-base text-gray-800 dark:text-white text-center">Páginas Web</span>
            </a>
        </div>
    </div>
</div>
