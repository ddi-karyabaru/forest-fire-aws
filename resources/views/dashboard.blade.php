<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Monitoring Kebakaran Hutan</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Chart.js untuk Grafik Tren -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FontAwesome untuk Ikon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-950 text-gray-100 font-sans min-h-screen pb-12">

    <div class="container mx-auto px-4 py-8 max-w-7xl">
        
        <!-- Header Dashboard -->
        <div class="flex flex-col md:flex-row justify-between items-center mb-8 border-b border-gray-800 pb-4">
            <div>
                <h1 class="text-3xl font-extrabold tracking-wide flex items-center gap-3">
                    <i class="fa-solid fa-fire-flame-curved text-red-500 animate-pulse"></i> 
                    <span>Buya Hamka <span class="text-red-500 text-lg font-normal">| EWS Forest Fire</span></span>
                </h1>
                <p class="text-gray-400 text-sm mt-1">Sistem Peringatan Dini Kebakaran Hutan Berbasis IoT & Real-Time Monitoring</p>
            </div>
            <div class="mt-4 md:mt-0 flex items-center gap-2 bg-gray-900 border border-gray-800 px-4 py-2 rounded-full shadow">
                <span class="w-3 h-3 bg-green-500 rounded-full animate-ping"></span>
                <span class="text-xs font-semibold text-gray-300">Live Server Connected</span>
            </div>
        </div>
        
        <!-- Status Utama (Banner Alert) -->
        <div id="status-card" class="p-5 rounded-2xl shadow-xl mb-8 text-center text-xl font-bold transition-all duration-500 ease-in-out bg-green-600 text-white flex items-center justify-center gap-3 border border-white/10">
            <i id="status-icon" class="fa-solid fa-shield-check text-2xl"></i>
            <span>Status Sistem: <span id="text-status" class="underline underline-offset-4">Memuat Data...</span></span>
        </div>

        <!-- Grid Kartu Sensor (4 Cards) -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Suhu Udara -->
            <div class="bg-gray-900/80 backdrop-blur p-6 rounded-2xl shadow-lg border border-gray-800 hover:border-red-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Suhu Udara</span>
                    <div class="p-3 bg-red-500/10 text-red-500 rounded-xl"><i class="fa-solid fa-temperature-high text-lg"></i></div>
                </div>
                <p class="text-4xl font-black tracking-tight"><span id="val-temp">--</span> <span class="text-lg font-medium text-gray-400">°C</span></p>
            </div>

            <!-- Kelembapan Udara -->
            <div class="bg-gray-900/80 backdrop-blur p-6 rounded-2xl shadow-lg border border-gray-800 hover:border-blue-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Kelembapan Udara</span>
                    <div class="p-3 bg-blue-500/10 text-blue-500 rounded-xl"><i class="fa-solid fa-droplet text-lg"></i></div>
                </div>
                <p class="text-4xl font-black tracking-tight"><span id="val-hum">--</span> <span class="text-lg font-medium text-gray-400">%</span></p>
            </div>

            <!-- Kelembapan Tanah -->
            <div class="bg-gray-900/80 backdrop-blur p-6 rounded-2xl shadow-lg border border-gray-800 hover:border-emerald-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Kelembapan Tanah</span>
                    <div class="p-3 bg-emerald-500/10 text-emerald-500 rounded-xl"><i class="fa-solid fa-seedling text-lg"></i></div>
                </div>
                <p class="text-4xl font-black tracking-tight"><span id="val-soil">--</span></p>
            </div>

            <!-- Kadar Asap MQ-2 -->
            <div class="bg-gray-900/80 backdrop-blur p-6 rounded-2xl shadow-lg border border-gray-800 hover:border-amber-500/50 transition-all duration-300 hover:-translate-y-1">
                <div class="flex justify-between items-start mb-4">
                    <span class="text-gray-400 text-xs font-bold uppercase tracking-wider">Kadar Asap (MQ-2)</span>
                    <div class="p-3 bg-amber-500/10 text-amber-500 rounded-xl"><i class="fa-solid fa-smog text-lg"></i></div>
                </div>
                <p class="text-4xl font-black tracking-tight"><span id="val-mq2">--</span> <span class="text-lg font-medium text-gray-400">ppm</span></p>
            </div>
        </div>

        <!-- GRAFIK TREN SEMUA SENSOR BERGERAK KE SAMPING -->
        <div class="bg-gray-900/80 backdrop-blur p-6 rounded-3xl shadow-xl border border-gray-800">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <div>
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <i class="fa-solid fa-chart-line text-blue-400"></i> Grafik Tren Seluruh Sensor Real-Time
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Memantau fluktuasi Suhu, Kelembapan Udara, Kelembapan Tanah, dan Asap MQ-2</p>
                </div>
                <div class="bg-gray-800/80 px-3 py-1.5 rounded-lg border border-gray-700 text-xs text-gray-300 font-medium">
                    Auto-refresh: 2 Detik (Geser ke Samping)
                </div>
            </div>
            <div style="position: relative; height: 380px; width: 100%;">
                <canvas id="sensorChart"></canvas>
            </div>
        </div>

    </div>
    <!-- GRAFIK KEDUA: RATA-RATA PER JAM (DI BAWAH) -->
        <div class="bg-gray-900/80 backdrop-blur p-6 rounded-3xl shadow-xl border border-gray-800 mt-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-2">
                <div>
                    <h2 class="text-xl font-bold flex items-center gap-2">
                        <i class="fa-solid fa-chart-area text-emerald-400"></i> Grafik Rata-Rata Sensor Per Jam (24 Jam Terakhir)
                    </h2>
                    <p class="text-xs text-gray-400 mt-0.5">Memantau tren historis dan fluktuasi jangka panjang secara periodik</p>
                </div>
                <div class="bg-gray-800/80 px-3 py-1.5 rounded-lg border border-gray-700 text-xs text-gray-300 font-medium">
                    Auto-refresh: Per 5 Menit
                </div>
            </div>
            <div style="position: relative; height: 350px; width: 100%;">
                <canvas id="hourlySensorChart"></canvas>
            </div>
        </div>

    <!-- Script AJAX & Chart.js dengan 4 Dataset Sensor -->
    <script>
        // 1. Inisialisasi Grafik Chart.js untuk 4 Sensor Sekaligus
        const ctx = document.getElementById('sensorChart').getContext('2d');
        const sensorChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Suhu Udara (°C)',
                        data: [],
                        borderColor: '#ef4444', // Merah
                        backgroundColor: 'rgba(239, 68, 68, 0.03)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#ef4444'
                    },
                    {
                        label: 'Kelembapan Udara (%)',
                        data: [],
                        borderColor: '#3b82f6', // Biru
                        backgroundColor: 'rgba(59, 130, 246, 0.03)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#3b82f6'
                    },
                    {
                        label: 'Kelembapan Tanah',
                        data: [],
                        borderColor: '#10b981', // Hijau
                        backgroundColor: 'rgba(16, 185, 129, 0.03)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#10b981'
                    },
                    {
                        label: 'Kadar Asap / MQ-2 (ppm)',
                        data: [],
                        borderColor: '#f59e0b', // Kuning/Amber
                        backgroundColor: 'rgba(245, 158, 11, 0.03)',
                        borderWidth: 2.5,
                        tension: 0.4,
                        pointRadius: 3,
                        pointBackgroundColor: '#f59e0b'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: '#9ca3af', font: { family: 'sans-serif', weight: '600' } }
                    }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#9ca3af' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af' }
                    }
                }
            }
        });

        // Fungsi Fetch Data Real-Time dengan Waktu Browser Real-Time
        function fetchData() {
            $.ajax({
                url: '/api/sensor/latest',
                method: 'GET',
                success: function(response) {
                    let logs = response.data || (Array.isArray(response) ? response : [response]);
                    
                    if(logs.length > 0) {
                        const latest = logs[logs.length - 1];

                        // Update Nilai pada Card
                        $('#val-temp').text(latest.temperature ?? '--');
                        $('#val-hum').text(latest.humidity ?? '--');
                        $('#val-soil').text(latest.soil_moisture ?? '--');
                        $('#val-mq2').text(latest.mq2_value ?? '--');
                        $('#text-status').text(latest.status_warning ?? 'Aman');

                        // MENGAMBIL WAKTU REAL-TIME DARI KOMPUTER/BROWSER SAAT DATA MASUK
                        let now = new Date();
                        let timeNow = now.toTimeString().substring(0, 8); // Format: "HH:mm:ss"
                        
                        // Cek titik waktu terakhir agar tidak duplikat, lalu push ke grafik
                        const lastLabel = sensorChart.data.labels[sensorChart.data.labels.length - 1];
                        
                        if (lastLabel !== timeNow) {
                            sensorChart.data.labels.push(timeNow);
                            sensorChart.data.datasets[0].data.push(latest.temperature);
                            sensorChart.data.datasets[1].data.push(latest.humidity);
                            sensorChart.data.datasets[2].data.push(latest.soil_moisture);
                            sensorChart.data.datasets[3].data.push(latest.mq2_value);

                            // Batasi maksimal 10 titik di layar agar grafik terus bergeser ke samping
                            if (sensorChart.data.labels.length > 10) {
                                sensorChart.data.labels.shift();
                                sensorChart.data.datasets[0].data.shift();
                                sensorChart.data.datasets[1].data.shift();
                                sensorChart.data.datasets[2].data.shift();
                                sensorChart.data.datasets[3].data.shift();
                            }

                            sensorChart.update();
                        }

                        // Atur Warna & Animasi pada Status Card Utama
                        let card = $('#status-card');
                        let icon = $('#status-icon');
                        card.removeClass('bg-green-600 bg-yellow-500 bg-orange-500 bg-red-600 animate-pulse');
                        
                        let statusText = (latest.status_warning || '').toUpperCase();

                        if(statusText.includes('DARURAT') || statusText.includes('BAHAYA')) {
                            card.addClass('bg-red-600 animate-pulse text-white');
                            icon.attr('class', 'fa-solid fa-triangle-exclamation text-2xl animate-bounce');
                        } else if(statusText.includes('HATI-HATI')) {
                            card.addClass('bg-orange-500 text-white');
                            icon.attr('class', 'fa-solid fa-circle-exclamation text-2xl');
                        } else if(statusText.includes('POTENSI')) {
                            card.addClass('bg-yellow-500 text-gray-950 font-bold');
                            icon.attr('class', 'fa-solid fa-triangle-exclamation text-2xl');
                        } else {
                            card.addClass('bg-green-600 text-white');
                            icon.attr('class', 'fa-solid fa-shield-check text-2xl');
                        }
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data:", error);
                }
            });
        }

        // 3. Jalankan fungsi saat pertama kali dibuka & set interval setiap 2 detik
        fetchData();
        setInterval(fetchData, 2000);

        // 1. Inisialisasi Grafik Kedua (Hourly Average Chart)
        const ctxHourly = document.getElementById('hourlySensorChart').getContext('2d');
        const hourlySensorChart = new Chart(ctxHourly, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Rata-rata Suhu (°C)',
                        data: [],
                        borderColor: '#ef4444',
                        backgroundColor: 'rgba(239, 68, 68, 0.05)',
                        borderWidth: 2.5,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Rata-rata Kelembapan Udara (%)',
                        data: [],
                        borderColor: '#3b82f6',
                        backgroundColor: 'rgba(59, 130, 246, 0.05)',
                        borderWidth: 2.5,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Rata-rata Kelembapan Tanah',
                        data: [],
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.05)',
                        borderWidth: 2.5,
                        tension: 0.3,
                        fill: true
                    },
                    {
                        label: 'Rata-rata Kadar Asap / MQ-2 (ppm)',
                        data: [],
                        borderColor: '#f59e0b',
                        backgroundColor: 'rgba(245, 158, 11, 0.05)',
                        borderWidth: 2.5,
                        tension: 0.3,
                        fill: true
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                        labels: { color: '#9ca3af', font: { family: 'sans-serif', weight: '600' } }
                    }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(255, 255, 255, 0.05)' },
                        ticks: { color: '#9ca3af' }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { color: '#9ca3af' }
                    }
                }
            }
        });

        // 2. Fungsi Mengambil Data Rata-Rata Per Jam dari API
        // Fungsi Mengambil Data Rata-Rata Per Jam dari API
        function fetchHourlyData() {
            $.ajax({
                url: '/api/sensor/hourly',
                method: 'GET',
                success: function(response) {
                    let logs = response.data || [];
                    
                    if(logs.length > 0) {
                        // Reset data grafik jam
                        hourlySensorChart.data.labels = [];
                        hourlySensorChart.data.datasets[0].data = [];
                        hourlySensorChart.data.datasets[1].data = [];
                        hourlySensorChart.data.datasets[2].data = [];
                        hourlySensorChart.data.datasets[3].data = [];

                        // Urutkan data berdasarkan waktu secara ascending (dari yang terlama ke terbaru)
                        logs.sort((a, b) => new Date(a.time_hour) - new Date(b.time_hour));

                        // Masukkan data hasil grouping per jam
                        logs.forEach(item => {
                            if (item.time_hour) {
                                // Ambil bagian jam dan menitnya saja, atau tanggal + jam yang rapi (contoh: "10:00")
                                // Jika format dari database "2026-10-13 10:00:00", indeks 11 sampai 15 adalah "10:00"
                                let hourLabel = item.time_hour.substring(11, 16); 
                                
                                // Jika ingin menyertakan tanggalnya juga supaya jelas, gunakan format: "13/10 10:00"
                                // let dateObj = new Date(item.time_hour);
                                // let hourLabel = (dateObj.getMonth() + 1) + '/' + dateObj.getDate() + ' ' + item.time_hour.substring(11, 16);

                                hourlySensorChart.data.labels.push(hourLabel);
                                hourlySensorChart.data.datasets[0].data.push(Math.round(item.avg_temperature * 10) / 10);
                                hourlySensorChart.data.datasets[1].data.push(Math.round(item.avg_humidity * 10) / 10);
                                hourlySensorChart.data.datasets[2].data.push(Math.round(item.avg_soil_moisture * 10) / 10);
                                hourlySensorChart.data.datasets[3].data.push(Math.round(item.avg_mq2_value * 10) / 10);
                            }
                        });

                        hourlySensorChart.update();
                    }
                },
                error: function(xhr, status, error) {
                    console.error("Gagal mengambil data rata-rata per jam:", error);
                }
            });
        }

        // Jalankan saat pertama kali halaman dimuat, dan perbarui setiap 5 menit (300000 ms)
        fetchHourlyData();
        setInterval(fetchHourlyData, 300000);
    </script>
</body>
</html>