<div class="p-6 bg-gray-50 dark:bg-[#0f172a] min-h-screen">
    <div class="max-w-7xl mx-auto">
        <header class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 dark:text-white tracking-tight">Estadísticas de Órdenes</h1>
            <p class="mt-2 text-lg text-gray-600 dark:text-gray-400">Analiza el rendimiento y datos de tus alquileres.</p>
        </header>

        <!-- Filtros -->
        <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700 mb-8 flex flex-col sm:flex-row sm:items-end gap-4">
            <div class="w-full sm:w-auto">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha Inicio</label>
                <input type="date" wire:model="fecha_inicio" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="w-full sm:w-auto">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Fecha Fin</label>
                <input type="date" wire:model="fecha_fin" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
            </div>
            <div class="w-full sm:w-auto flex-1 max-w-sm">
                <label class="block text-sm font-bold text-gray-700 dark:text-gray-300 mb-2">Comparar Productos</label>
                <select multiple wire:model="productos_seleccionados" class="bg-gray-50 dark:bg-gray-700 border border-gray-200 dark:border-gray-600 text-gray-900 dark:text-white rounded-xl focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 h-12 text-sm" style="padding-top: 0.3rem;">
                    @foreach($todos_productos as $id => $nombre)
                        <option value="{{ $id }}">{{ $nombre }}</option>
                    @endforeach
                </select>
                <p class="text-xs text-gray-500 mt-1">Mantén Ctrl (Windows) o Cmd (Mac) para seleccionar varios.</p>
            </div>
            <div class="w-full sm:w-auto">
                <button wire:click="filtrar" class="w-full text-white bg-blue-600 hover:bg-blue-700 transition shadow-lg shadow-blue-200 dark:shadow-none focus:ring-4 focus:outline-none focus:ring-blue-300 font-bold rounded-xl text-sm px-6 py-3 text-center dark:focus:ring-blue-800">
                    <i class="fas fa-filter mr-2"></i> Aplicar Filtro
                </button>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8" wire:ignore>
            <!-- Ingresos por Mes -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-dollar-sign text-green-500 mr-2"></i> Ingresos Mensuales (Rentas Finalizadas)
                </h3>
                <div class="relative h-64">
                    <canvas id="ingresosMes"></canvas>
                </div>
            </div>

            <!-- Rentas por Mes -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-chart-line text-blue-500 mr-2"></i> Cantidad de Rentas por Mes
                </h3>
                <div class="relative h-64">
                    <canvas id="rentasMes"></canvas>
                </div>
            </div>
            
            <!-- Clientes Top -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-users text-purple-500 mr-2"></i> Top 5 Clientes (Más rentas)
                </h3>
                <div class="relative h-64">
                    <canvas id="clientesTop"></canvas>
                </div>
            </div>
            
            <!-- Colonias Top -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-map-marker-alt text-red-500 mr-2"></i> Top 5 Localidades/Colonias (Más rentas)
                </h3>
                <div class="relative h-64">
                    <canvas id="coloniasTop"></canvas>
                </div>
            </div>

            <!-- Productos Top -->
            <div class="bg-white dark:bg-gray-800 p-6 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700">
                <h3 class="text-lg font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                    <i class="fas fa-box-open text-indigo-500 mr-2"></i> Top 5 Productos (Más rentados)
                </h3>
                <div class="relative h-64">
                    <canvas id="productosTop"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Cargar Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Script de Inicialización -->
    <script>
        document.addEventListener('livewire:initialized', () => {
            const isDarkMode = document.documentElement.classList.contains('dark');
            Chart.defaults.color = isDarkMode ? '#9ca3af' : '#4b5563';
            Chart.defaults.font.family = "'Inter', sans-serif";

            let chartIngresos, chartRentas, chartClientes, chartColonias, chartProductos;

            function renderCharts(chartData) {
                if (chartIngresos) chartIngresos.destroy();
                if (chartRentas) chartRentas.destroy();
                if (chartClientes) chartClientes.destroy();
                if (chartColonias) chartColonias.destroy();
                if (chartProductos) chartProductos.destroy();

                const ctxIngresos = document.getElementById('ingresosMes').getContext('2d');
                chartIngresos = new Chart(ctxIngresos, {
                    type: 'bar',
                    data: {
                        labels: chartData.labelsDinero,
                        datasets: [{
                            label: 'Ingresos ($)',
                            data: chartData.dataDinero,
                            backgroundColor: 'rgba(34, 197, 94, 0.6)',
                            borderColor: 'rgba(34, 197, 94, 1)',
                            borderWidth: 1,
                            borderRadius: 6
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                const ctxRentas = document.getElementById('rentasMes').getContext('2d');
                chartRentas = new Chart(ctxRentas, {
                    type: 'line',
                    data: {
                        labels: chartData.labelsRentas,
                        datasets: [{
                            label: 'Número de Rentas',
                            data: chartData.dataRentas,
                            backgroundColor: 'rgba(59, 130, 246, 0.1)',
                            borderColor: 'rgba(59, 130, 246, 1)',
                            borderWidth: 2,
                            fill: true,
                            tension: 0.4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                const ctxClientes = document.getElementById('clientesTop').getContext('2d');
                chartClientes = new Chart(ctxClientes, {
                    type: 'doughnut',
                    data: {
                        labels: chartData.labelsClientes,
                        datasets: [{
                            data: chartData.dataClientes,
                            backgroundColor: [
                                'rgba(168, 85, 247, 0.7)',
                                'rgba(236, 72, 153, 0.7)',
                                'rgba(249, 115, 22, 0.7)',
                                'rgba(234, 179, 8, 0.7)',
                                'rgba(6, 182, 212, 0.7)'
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false, cutout: '65%' }
                });

                const ctxColonias = document.getElementById('coloniasTop').getContext('2d');
                chartColonias = new Chart(ctxColonias, {
                    type: 'pie',
                    data: {
                        labels: chartData.labelsColonias,
                        datasets: [{
                            data: chartData.dataColonias,
                            backgroundColor: [
                                'rgba(239, 68, 68, 0.7)',
                                'rgba(59, 130, 246, 0.7)',
                                'rgba(16, 185, 129, 0.7)',
                                'rgba(245, 158, 11, 0.7)',
                                'rgba(99, 102, 241, 0.7)'
                            ],
                            borderWidth: 0,
                            hoverOffset: 4
                        }]
                    },
                    options: { responsive: true, maintainAspectRatio: false }
                });

                const ctxProductos = document.getElementById('productosTop').getContext('2d');
                chartProductos = new Chart(ctxProductos, {
                    type: 'bar',
                    data: {
                        labels: chartData.labelsProductos,
                        datasets: [
                            {
                                label: 'Cantidad Rentada',
                                data: chartData.dataProductos,
                                backgroundColor: 'rgba(79, 70, 229, 0.6)',
                                borderColor: 'rgba(79, 70, 229, 1)',
                                borderWidth: 1,
                                borderRadius: 6,
                                yAxisID: 'y'
                            },
                            {
                                label: 'Dinero Ganado ($)',
                                data: chartData.dataDineroProductos,
                                backgroundColor: 'rgba(34, 197, 94, 0.6)',
                                borderColor: 'rgba(34, 197, 94, 1)',
                                borderWidth: 1,
                                borderRadius: 6,
                                yAxisID: 'y' // Usando el mismo eje, si prefieres escalas separadas puedes usar xAxisID: 'x2'
                            }
                        ]
                    },
                    options: { 
                        responsive: true, 
                        maintainAspectRatio: false,
                        indexAxis: 'y', // Hace que la gráfica de barras sea horizontal
                        plugins: {
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        let label = context.dataset.label || '';
                                        if (label) {
                                            label += ': ';
                                        }
                                        if (context.datasetIndex === 1) { // Si es Dinero Ganado
                                            label += '$' + Number(context.raw).toLocaleString('en-US', {minimumFractionDigits: 2, maximumFractionDigits: 2});
                                        } else {
                                            label += context.raw;
                                        }
                                        return label;
                                    }
                                }
                            }
                        },
                        scales: {
                            x: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            }

            // Render Inicial
            const initData = @json($chartData);
            renderCharts(initData);

            // Escuchar actualizaciones de Livewire (Filtro de fecha)
            Livewire.on('update-charts', (eventData) => {
                // eventData es generalmente un array con el primer elemento siendo el JSON enviado
                const updatedData = Array.isArray(eventData) ? eventData[0] : eventData;
                renderCharts(updatedData);
            });
        });
    </script>
</div>
