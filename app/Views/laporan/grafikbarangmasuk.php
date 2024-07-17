<link rel="stylesheet" href="<?= base_url() . '/plugins/chart.js/Chart.min.css' ?>">
<script src="<?= base_url() . '/plugins/chart.js/Chart.bundle.min.js' ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<canvas id="myChart" style="height : 50 vh; width:80vh;"></canvas>

<?php
$tanggal = "";
$total = "";

foreach ($grafik as $row) :
    $tgl = $row->tgl;


    $tanggal .= "'$tgl'" . ",";

    $totalHarga = $row->totalharga;
    $total .= "'$totalHarga'" . ",";

endforeach;
?>

<script>
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'bar',
        responsive: true,
        data: {
            labels: [<?= $tanggal ?>],
            datasets: [{
                label: 'Total Harga',
                backgroundColor: ['rgb(255, 99, 132)', 'rgb(14, 162, 235)', 'rgb(60, 179, 113)', 'rgb(255, 165, 0)', 'rgb(255, 99, 132)', 'rgb(14, 162, 235)', 'rgb(60, 179, 113)', 'rgb(255, 165, 0)'],
                borderColor: ['rgb(255, 99, 130)'],
                data: [<?= $total; ?>]
            }]

        },
        duration: 1000
    })
</script>