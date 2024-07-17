<link rel="stylesheet" href="<?= base_url() . '/plugins/chart.js/Chart.min.css' ?>">
<script src="<?= base_url() . '/plugins/chart.js/Chart.bundle.min.js' ?>"></script>
<!-- <script src="https://cdn.jsdelivr.net/npm/chart.js"></script> -->

<canvas id="myChart2" style="height : 50 vh; width:80vh;"></canvas>

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
    var ctx = document.getElementById('myChart2').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'line',
        responsive: true,
        data: {
            labels: [<?= $tanggal ?>],
            datasets: [{
                label: 'Total Harga',
                backgroundColor: ['rgba(0, 0, 0, 0.1)'],

                borderColor: 'rgb(75, 192, 192)',
                // fill: false,
                data: [<?= $total; ?>],
                // tension: 0.1
            }]

        },
        duration: 1000
    })
</script>