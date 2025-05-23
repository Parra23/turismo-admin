<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
        <!-- Fila 1: Gráfico lineal de registros -->
        <div class="bg-white rounded-2xl shadow-lg p-6 flex flex-col items-center hover:shadow-2xl transition mb-8">
            <div class="bg-[#FFD60A] rounded-full p-3 mb-4">
                <i class="fas fa-user-plus text-[#023E8A] text-2xl"></i>
            </div>
            <h3 class="text-lg font-bold text-[#023E8A] mb-2">Records</h3>
            <div class="w-full h-64 flex items-center justify-center">
                <canvas id="chartRegistros"></canvas>
            </div>
        </div>
        <!-- Fila 2: Usuario más comenta y gráfico de comentarios -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card: Usuario que más comenta -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center hover:shadow-2xl transition">
                <div class="bg-[#48CAE4] rounded-full p-3 mb-4">
                    <i class="fas fa-user text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-[#023E8A] mb-2">User who has mentioned the most</h3>
                <div class="text-2xl font-extrabold text-gray-800 mb-2">[Username]</div>
                <div class="text-gray-500">Total comments: <span class="font-bold">[Amount]</span></div>
            </div>
            <!-- Gráfico de comentarios -->
            <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-2xl transition">
                <div class="bg-[#48CAE4] rounded-full p-3 mb-4">
                    <i class="fas fa-comments text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-[#023E8A] mb-2">Comments</h3>
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="chartComentarios"></canvas>
                </div>
            </div>
        </div>
        <!-- Fila 3: Gráfico circular y tarjeta de reacciones -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gráfico circular de reacciones -->
            <div class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center hover:shadow-2xl transition">
                <div class="bg-[#FF6F61] rounded-full p-3 mb-4">
                    <i class="fas fa-heart text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-[#023E8A] mb-2">Reactions</h3>
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="chartReacciones"></canvas>
                </div>
            </div>
            <!-- Card: Información de cantidad de reacciones -->
            <div
                class="bg-white rounded-2xl shadow-lg p-8 flex flex-col items-center justify-center hover:shadow-2xl transition">
                <div class="bg-[#FF6F61] rounded-full p-3 mb-4">
                    <i class="fas fa-info text-white text-2xl"></i>
                </div>
                <h3 class="text-lg font-bold text-[#023E8A] mb-2">Total number of reactions</h3>
                <div class="text-2xl font-extrabold text-gray-800 mb-2">[Amount]</div>
                <div class="text-gray-500">Sum of all reactions</div>
            </div>
        </div>
        <div class="bg-white rounded-2xl shadow-lg p-8 min-h-[300px] flex flex-col mt-8">
            <h4 class="text-xl font-bold text-[#023E8A] mb-4">Statistics</h4>
            <div class="flex-1 flex items-center justify-center text-gray-400 text-lg">
                [Here you can show statistics, tables or more graphics]
            </div>
        </div>
    </div>
</div>
{{-- Chart.js CDN --}}
<script>
    // Gráfico lineal de registros (datos desde API)
    const ctxRegistros = document.getElementById('chartRegistros').getContext('2d');
    const chartRegistros = new Chart(ctxRegistros, {
        type: 'line',
        data: {
            labels: [],
            datasets: [{
                label: 'Registros',
                data: [],
                backgroundColor: 'rgba(255, 214, 10, 0.2)',
                borderColor: '#FFD60A',
                borderWidth: 2,
                tension: 0.4,
                fill: true
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    fetch('https://apim-turismo.onrender.com/api/vw_logs_register')
        .then(response => response.json())
        .then(data => {
            // Solo los últimos 30 registros
            const ultimos30 = data.slice(-30);
            const labels = ultimos30.map(item => {
                const fecha = new Date(item.fecha);
                return fecha.toLocaleDateString('es-CO', {
                    day: '2-digit',
                    month: 'short',
                    year: '2-digit'
                });
            });
            const totals = ultimos30.map(item => item.total);

            chartRegistros.data.labels = labels;
            chartRegistros.data.datasets[0].data = totals;
            chartRegistros.update();
        });
    // Gráfico de comentarios (ejemplo estático)
    new Chart(document.getElementById('chartComentarios'), {
        type: 'bar',
        data: {
            labels: ['Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb', 'Dom'],
            datasets: [{
                label: 'Comentarios',
                data: [5, 9, 7, 8, 5, 4, 6],
                backgroundColor: '#48CAE4'
            }]
        },
        options: {
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
    // Gráfico de reacciones (ejemplo estático)
    new Chart(document.getElementById('chartReacciones'), {
        type: 'doughnut',
        data: {
            labels: ['Me gusta', 'Me encanta', 'Me asombra'],
            datasets: [{
                label: 'Reacciones',
                data: [120, 90, 30],
                backgroundColor: ['#FF6F61', '#FFD60A', '#48CAE4']
            }]
        },
        options: {
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>