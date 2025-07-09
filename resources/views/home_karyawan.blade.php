@extends('layouts.app')
@section('content')
<div class="content-wrapper pb-5 pt-3">
    <section class="content pb-3">
        <div class="container-fluid">
            <hr>

            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <div class="col-md-5 col-sm-12 col-12 mb-3 float-left">
                        <div class="text-center">Statistik Kinerja Tahunan</div>
                        <canvas id="ChartKinerja" width="200" height="200"></canvas>

                    </div>
                    <div class="col-md-5 col-sm-12 col-12 mb-3 float-right">
                        <div class="text-center">Statistik Absensi Per Bulan</div>
                        <canvas id="AbsensiChart" width="200" height="200"></canvas>
                    </div>
                </div>
            </div>

        </div>
    </section>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
<script>
    $('.alert').fadeOut(7000);

    // Chart: Kinerja Tahunan
    var ctxKinerja = document.getElementById('ChartKinerja').getContext('2d');
    $.get("{{ url('/home/getKinerjaStaff') }}", function (data) {
        const monthLabels = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        // Map status dari backend ke label chart
        const statusMapLabel = {
            'kurang': 'Kurang',
            'cukup': 'Cukup',
            'baik': 'Baik',
            'sangatbaik': 'Sangat Baik'
        };

        // Warna background
        const statusColor = {
            'Kurang': 'rgba(255, 99, 132, 0.5)',         // Merah muda
            'Cukup': 'rgba(255, 206, 86, 0.5)',           // Kuning
            'Baik': 'rgba(54, 162, 235, 0.5)',            // Biru
            'Sangat Baik': 'rgba(0, 200, 83, 0.5)',       // Hijau
            'Tidak Ada': 'rgba(201, 203, 207, 0.5)'       // Abu-abu
        };

        // Warna border
        const statusBorderColor = {
            'Kurang': 'rgba(255, 99, 132, 1)',
            'Cukup': 'rgba(255, 206, 86, 1)',
            'Baik': 'rgba(54, 162, 235, 1)',
            'Sangat Baik': 'rgba(0, 200, 83, 1)',
            'Tidak Ada': 'rgba(201, 203, 207, 1)'
        };

        // Set default status tiap bulan ke 'Tidak Ada'
        const statusPerMonth = Array(12).fill('Tidak Ada');

        // Isi status berdasarkan data dari backend
        data.forEach(item => {
            const bulan = parseInt(item.month.split('-')[1], 10); // MM dari YYYY-MM
            const rawStatus = item.status.toLowerCase().replace(/\s+/g, ''); // hilangkan spasi
            const status = statusMapLabel[rawStatus] || 'Tidak Ada';
            statusPerMonth[bulan - 1] = status;
        });

        // Ambil warna untuk setiap bulan berdasarkan status
        const barColors = statusPerMonth.map(status => statusColor[status]);
        const borderColors = statusPerMonth.map(status => statusBorderColor[status]);

        // Render Chart
        new Chart(ctxKinerja, {
            type: 'bar',
            data: {
                labels: monthLabels,
                datasets: [{
                    label: 'Kinerja Bulanan',
                    data: statusPerMonth.map(() => 1), // dummy height 1
                    backgroundColor: barColors,
                    borderColor: borderColors,
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                tooltips: {
                    callbacks: {
                        label: function (tooltipItem) {
                            const index = tooltipItem.index;
                            return 'Status: ' + statusPerMonth[index];
                        }
                    }
                },
                legend: { display: false },
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1,
                            max: 1,
                            callback: () => '' // Sembunyikan angka di Y axis
                        }
                    }]
                }
            }
        });
    });

    // Chart: Absensi per Bulan
    var ctxAbsensi = document.getElementById('AbsensiChart').getContext('2d');
    $.get("{{ url('/home/getAbsensiByMonth') }}", function (data) {
        var labels = []; // bulan
        var statusList = {}; // status => {bulan => count}

        // Proses data ke statusList dan labels
        data.forEach(function (item) {
            let bulanFormat = new Date(item.bulan + '-01').toLocaleString('id-ID', { month: 'long', year: 'numeric' });

            if (!labels.includes(bulanFormat)) {
                labels.push(bulanFormat);
            }

            if (!statusList[item.status]) {
                statusList[item.status] = {};
            }

            statusList[item.status][bulanFormat] = item.total;
        });

        labels.sort(); // urutkan bulan

        var datasets = [];
        var colors = {
            'Present': 'rgba(75, 192, 192, 0.5)',
            'Permission': 'rgba(255, 206, 86, 0.5)',
            'Sick': 'rgba(54, 162, 235, 0.5)',
            'Alpha': 'rgba(255, 99, 132, 0.5)'
        };
        var borderColors = {
            'Present': 'rgba(75, 192, 192, 1)',
            'Permission': 'rgba(255, 206, 86, 1)',
            'Sick': 'rgba(54, 162, 235, 1)',
            'Alpha': 'rgba(255, 99, 132, 1)'
        };

        // Buat dataset per status
        Object.keys(statusList).forEach(function (status) {
            var dataPerBulan = labels.map(function (bulan) {
                return statusList[status][bulan] || 0;
            });

            datasets.push({
                label: status,
                data: dataPerBulan,
                backgroundColor: colors[status] || 'rgba(201, 203, 207, 0.5)',
                borderColor: borderColors[status] || 'rgba(201, 203, 207, 1)',
                borderWidth: 1
            });
        });

        new Chart(ctxAbsensi, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: datasets
            },
            options: {
                responsive: true,
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            precision: 0
                        }
                    }]
                }
            }
        });
    });
</script>
@endsection
