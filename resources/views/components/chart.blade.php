<div class="py-10">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex flex-col gap-10">
        <!-- Fila 1: Gráfico lineal de usuarios registrados -->
        <div class="bg-gradient-to-br from-[#fffde7] via-[#eaf6fb] to-[#f8fafc] rounded-3xl shadow-2xl p-8 flex flex-col items-center hover:scale-105 hover:shadow-3xl transition-transform duration-300 border border-[#ffe066] mb-8 relative overflow-hidden">
            <div class="absolute -top-8 -right-8 w-32 h-32 bg-[#FFD60A] opacity-10 rounded-full blur-2xl"></div>
            <div class="bg-[#FFD60A] rounded-full p-4 mb-4 shadow-lg border-4 border-white animate-pulse">
                <i class="fas fa-user-plus text-[#023E8A] text-3xl"></i>
            </div>
            <h3 class="text-xl font-extrabold text-[#023E8A] mb-2 tracking-wide text-center drop-shadow">Total Registered Users
            </h3>
            <div class="w-full h-64 flex items-center justify-center">
                <canvas id="chartRegistros"></canvas>
            </div>
        </div>

        <!-- Fila 2: Top Commenter y gráfico de comentarios -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Card: Top Commenter -->
            <div
                class="relative bg-gradient-to-br from-[#e0f7fa] via-[#f1f8fb] to-[#f8fafc] rounded-3xl shadow-2xl p-10 flex flex-col items-center justify-center transition-transform hover:scale-105 hover:shadow-3xl duration-300 border border-[#b6e0fe] overflow-hidden">
                <div class="absolute -top-8 -right-8 w-32 h-32 bg-[#48CAE4] opacity-10 rounded-full blur-2xl"></div>
                <div class="absolute -bottom-8 -left-8 w-32 h-32 bg-[#FFD60A] opacity-10 rounded-full blur-2xl"></div>
                <div class="bg-[#FFD60A] rounded-full p-5 mb-4 shadow-lg border-4 border-white animate-bounce">
                    <i class="fas fa-crown text-[#023E8A] text-4xl drop-shadow-lg"></i>
                </div>
                <h3 class="text-xl font-extrabold text-[#023E8A] mb-1 text-center tracking-wide drop-shadow">Top Commenter
                </h3>
                <div id="topUserName"
                    class="text-3xl font-black text-[#023E8A] mb-2 text-center drop-shadow-lg">[Username]
                </div>
                <div class="text-lg text-gray-600 mb-4 text-center">
                    <span
                        class="inline-block bg-[#48CAE4]/30 text-[#035388] font-bold px-4 py-1 rounded-full shadow">
                        Total comments: <span id="topUserTotal"
                            class="font-extrabold text-[#035388]">[Amount]</span>
                    </span>
                </div>
                <div class="w-full mt-6">
                    <h4 class="text-base font-semibold text-[#023E8A] mb-3 text-center tracking-wide">All users
                    </h4>
                    <div class="overflow-x-auto rounded-xl border border-[#e0e7ef] shadow-inner bg-white/80">
                        <table class="w-full text-sm text-left">
                            <thead class="bg-[#eaf6fb]">
                                <tr>
                                    <th class="py-2 px-3 font-semibold text-[#023E8A]">User</th>
                                    <th class="py-2 px-3 font-semibold text-[#023E8A] text-right">Total Comments
                                    </th>
                                </tr>
                            </thead>
                            <tbody id="usersCommentsList" class="divide-y divide-[#eaf6fb]"></tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Gráfico de comentarios -->
            <div class="bg-gradient-to-br from-[#e0f7fa] via-[#f1f8fb] to-[#f8fafc] rounded-3xl shadow-2xl p-10 flex flex-col items-center hover:scale-105 hover:shadow-3xl transition-transform duration-300 border border-[#b6e0fe]">
                <div class="bg-[#48CAE4] rounded-full p-4 mb-4 shadow-lg border-4 border-white animate-pulse">
                    <i class="fas fa-comments text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-[#023E8A] mb-2 tracking-wide text-center drop-shadow">Total Comments Per Date
                </h3>
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="chartComentarios"></canvas>
                </div>
            </div>
        </div>

        <!-- Fila 3: Gráfico circular y tarjeta de reacciones -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <!-- Gráfico circular de reacciones -->
            <div class="bg-gradient-to-br from-[#fff0f0] via-[#fbeee6] to-[#f8fafc] rounded-3xl shadow-2xl p-10 flex flex-col items-center hover:scale-105 hover:shadow-3xl transition-transform duration-300 border border-[#ffb3b3]">
                <div class="bg-[#FF6F61] rounded-full p-4 mb-4 shadow-lg border-4 border-white animate-pulse">
                    <i class="fas fa-fire text-white text-3xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-[#023E8A] mb-2 tracking-wide text-center drop-shadow">Reactions Overview
                </h3>
                <div class="w-full h-64 flex items-center justify-center">
                    <canvas id="chartReacciones"></canvas>
                </div>
            </div>
            <!-- Card: Información de cantidad de reacciones -->
            <div class="bg-gradient-to-br from-[#fff0f0] via-[#fbeee6] to-[#f8fafc] rounded-3xl shadow-2xl p-10 flex flex-col items-center justify-center hover:scale-105 hover:shadow-3xl transition-transform duration-300 border border-[#ffb3b3]">
                <div class="bg-[#FFD60A] rounded-full p-4 mb-4 shadow-lg border-4 border-white animate-bounce">
                    <i class="fas fa-bolt text-[#FF6F61] text-3xl"></i>
                </div>
                <h3 class="text-xl font-extrabold text-[#023E8A] mb-2 tracking-wide text-center drop-shadow">Total Number of Reactions
                </h3>
                <div class="text-2xl font-extrabold text-[#FF6F61] mb-2" id="totalReactions">[Amount]</div>
                <div class="text-gray-500">Sum of all reactions</div>
            </div>
        </div>

        <!-- Fila 4: Estadísticas -->
        <div class="bg-gradient-to-br from-[#eaf6fb] via-[#f1f8fb] to-[#fffde7] rounded-3xl shadow-2xl p-10 min-h-[300px] flex flex-col mt-8 border border-[#ffe066]">
            <h4 class="flex items-center gap-3 text-2xl font-extrabold text-[#023E8A] mb-6 tracking-wide drop-shadow">
                <span class="bg-[#FFD60A] p-2 rounded-full shadow">
                    <i class="fas fa-chart-bar text-[#023E8A] text-2xl"></i>
                </span>
                Dashboard Statistics
            </h4>
            <div class="flex flex-col md:flex-row gap-8 items-stretch justify-center">
                <!-- Tarjeta Records (Usuarios Registrados) -->
                <div class="flex-1 bg-white/90 rounded-2xl shadow-lg border border-[#FFD60A] p-6 flex flex-col items-center">
                    <div class="bg-[#FFD60A] rounded-full p-4 mb-3 shadow-lg border-4 border-white animate-pulse">
                        <i class="fas fa-user-plus text-[#023E8A] text-3xl"></i>
                    </div>
                    <h5 class="font-extrabold text-[#023E8A] mb-4 text-xl tracking-wide text-center drop-shadow">
                        Registered Users Overview
                    </h5>
                    <div id="statsRegistros" class="grid grid-cols-1 gap-3 w-full"></div>
                </div>
                <!-- Tarjeta Comments -->
                <div class="flex-1 bg-white/90 rounded-2xl shadow-lg border border-[#48CAE4] p-6 flex flex-col items-center">
                    <div class="bg-[#48CAE4] rounded-full p-4 mb-3 shadow-lg border-4 border-white animate-bounce">
                        <i class="fas fa-comment-dots text-white text-2xl"></i>
                    </div>
                    <h5 class="font-extrabold text-[#023E8A] mb-4 text-xl tracking-wide text-center drop-shadow">
                        Comments Overview
                    </h5>
                    <div id="statsComentarios" class="grid grid-cols-1 gap-3 w-full"></div>
                </div>
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
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        precision: 0,
                        callback: function(value) {
                            return Number.isInteger(value) ? value : null;
                        }
                    }
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
    // Gráfico de comentarios (datos desde API)
    fetch('https://apim-turismo.onrender.com/api/vw_totalcomments_date')
        .then(response => response.json())
        .then(data => {
            // Solo los últimos 30 registros (opcional)
            const ultimos30 = data.slice(-30);
            const labels = ultimos30.map(item => {
                const fecha = new Date(item.fecha);
                return fecha.toLocaleDateString('es-CO', {
                    day: '2-digit',
                    month: '2-digit',
                    year: '2-digit'
                });
            });
            const totals = ultimos30.map(item => item.total);

            new Chart(document.getElementById('chartComentarios'), {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Comentarios',
                        data: totals,
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
    // Usuario que más comenta
    fetch('https://apim-turismo.onrender.com/api/vw_totalcomments_users')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Suponiendo que el usuario con más comentarios es el primero
                const topUser = data[0];
                document.getElementById('topUserName').textContent = topUser.usuario ?? topUser.name ?? 'N/A';
                document.getElementById('topUserTotal').textContent = topUser.total ?? 0;
            }
        });
    fetch('https://apim-turismo.onrender.com/api/vw_totalcomments_users')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                // Usuario top
                const topUser = data[0];
                document.getElementById('topUserName').textContent = topUser.usuario ?? topUser.name ?? 'N/A';
                document.getElementById('topUserTotal').textContent = topUser.total ?? 0;

                // Lista de todos los usuarios
                let html = '';
                data.forEach(item => {
                    html += `<tr>
                        <td class="py-2 px-3">${item.usuario ?? item.name ?? 'N/A'}</td>
                        <td class="py-2 px-3 text-right font-semibold text-[#48CAE4]">${item.total ?? 0}</td>
                    </tr>`;
                });
                document.getElementById('usersCommentsList').innerHTML = html;
            }
        });
    // Estadísticas de registros
    fetch('https://apim-turismo.onrender.com/api/vw_logs_register')
        .then(response => response.json())
        .then(data => {
            const ultimos30 = data.slice(-30);
            const totals = ultimos30.map(item => item.total);
            if (totals.length > 0) {
                const sum = totals.reduce((a, b) => a + b, 0);
                const avg = (sum / totals.length).toFixed(2);
                const min = Math.min(...totals);
                const max = Math.max(...totals);
                document.getElementById('statsRegistros').innerHTML = `
                <div class="flex items-center gap-2">
                    <span class="bg-[#FFD60A]/20 text-[#FFD60A] font-semibold px-3 py-1 rounded-full">Average</span>
                    <span class="font-bold text-[#FFD60A]">${avg}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#48CAE4]/20 text-[#48CAE4] font-semibold px-3 py-1 rounded-full">Sum</span>
                    <span class="font-bold text-[#48CAE4]">${sum}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#023E8A]/10 text-[#023E8A] font-semibold px-3 py-1 rounded-full">Min</span>
                    <span class="font-bold text-[#023E8A]">${min}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#023E8A]/10 text-[#023E8A] font-semibold px-3 py-1 rounded-full">Max</span>
                    <span class="font-bold text-[#023E8A]">${max}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 font-semibold px-3 py-1 rounded-full">Count</span>
                    <span class="font-bold">${totals.length}</span>
                </div>
            `;
            }
        });

    // Estadísticas de comentarios
    fetch('https://apim-turismo.onrender.com/api/vw_totalcomments_date')
        .then(response => response.json())
        .then(data => {
            const ultimos30 = data.slice(-30);
            const totals = ultimos30.map(item => item.total);
            if (totals.length > 0) {
                const sum = totals.reduce((a, b) => a + b, 0);
                const avg = (sum / totals.length).toFixed(2);
                const min = Math.min(...totals);
                const max = Math.max(...totals);
                document.getElementById('statsComentarios').innerHTML = `
                <div class="flex items-center gap-2">
                     <span class="bg-[#FFD60A]/20 text-[#FFD60A] font-semibold px-3 py-1 rounded-full">Average</span>
                    <span class="font-bold text-[#FFD60A]">${avg}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#48CAE4]/20 text-[#48CAE4] font-semibold px-3 py-1 rounded-full">Sum</span>
                    <span class="font-bold text-[#48CAE4]">${sum}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#023E8A]/10 text-[#023E8A] font-semibold px-3 py-1 rounded-full">Min</span>
                    <span class="font-bold text-[#023E8A]">${min}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-[#023E8A]/10 text-[#023E8A] font-semibold px-3 py-1 rounded-full">Max</span>
                    <span class="font-bold text-[#023E8A]">${max}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="bg-gray-200 text-gray-700 font-semibold px-3 py-1 rounded-full">Count</span>
                    <span class="font-bold">${totals.length}</span>
                </div>
            `;
            }
        });
</script>
