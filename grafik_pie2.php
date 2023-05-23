<?php
include('koneksi2.php');
$data = mysqli_query($koneksi, "select * from tb_covid");
$nama_produk = array();
$jumlah_produk = array();
while ($row = mysqli_fetch_array($data)) {
    $nama_produk[] = $row['country'];

    $query = mysqli_query($koneksi, "select total_cases from tb_covid where id='" . $row['id'] . "'");
    $row = $query->fetch_array();
    $jumlah_produk[] = $row['total_cases'];
}
?>
<!doctype html>
<html>

<head>
    <title>Pie Chart</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>

<body>
    <div id="canvas-holder" style="width:80%">
        <canvas id="chart-area"></canvas>
    </div>
    <script>
        var config = {
    type: 'pie',
    data: {
        datasets: [{
            data: <?php echo json_encode($jumlah_produk); ?>,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(219, 0, 91, 0.2)',
                'rgba(0, 0, 0, 0.2)',
                'rgba(157, 178, 191, 0.2)',
                'rgba(247, 147, 39, 0.2)',
                'rgba(100, 56, 67, 0.2)',
                'rgba(131, 118, 79, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(219, 0, 91, 1)',
                'rgba(0, 0, 0, 1)',
                'rgba(157, 178, 191, 1)',
                'rgba(247, 147, 39, 1)',
                'rgba(100, 56, 67, 1)',
                'rgba(131, 118, 79, 1)'
            ],
            label: 'Presentase Penjualan Barang'
        }],
        labels: <?php echo json_encode($nama_produk); ?>
    },
    options: {
        responsive: true
    }
};

        window.onload = function() {
            var ctx = document.getElementById('chart-area').getContext('2d');
            window.myPie = new Chart(ctx, config);
        };
    </script>
</body>

</html>