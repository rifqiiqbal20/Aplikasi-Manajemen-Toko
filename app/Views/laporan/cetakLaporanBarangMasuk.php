<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Barang Masuk</title>
</head>

<body onload="window.print();">
    <table style="width: 100%; border-collapse:collapse; text-align:center;" border="1">
        <tr>
            <td>
                <table style="width:100%; text-align:center;" border="0">
                    <tr style="text-align:center;">
                        <td>
                            <h1>Toko Rifqi Putra</h1>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table style="width:100%; text-align:center;" border="0">
                    <tr style="text-align:center;">
                        <td>
                            <h3><u>Laporan Barang Masuk</u></h3><br>
                            Periode : <?= $tglawal . " s/d " . $tglakhir ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <br>
                            <center>
                                <table border="1" cellpadding="8" style="border-collapse:collapse; border:1px solid #000; text-align:center; width:80%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>No.Faktur</th>
                                            <th>Tanggal</th>
                                            <th>Nama Barang</th>
                                            <th>Satuan</th>
                                            <th>Supplier</th>
                                            <th>Jumlah</th>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $nomor = 1;
                                        $totalSeluruhHarga = 0;
                                        foreach ($datalaporan->getResultArray() as $row) :
                                            $totalSeluruhHarga += $row['totalharga']; // Menghapus tanda kutip di sekitar $totalharga
                                        ?>
                                            <tr>
                                                <td><?= $nomor++; ?></td>
                                                <td><?= $row['faktur'] ?></td>
                                                <td><?= $row['tglfaktur'] ?></td>
                                                <td><?= $row['brgnama'] ?></td>
                                                <td><?= $row['satnama'] ?></td>
                                                <td><?= $row['supnama'] ?></td>
                                                <td><?= $row['detjml'] ?></td>
                                                <td style="text-align:right;">
                                                    <?= number_format($row['totalharga'], 0, ",", ".") ?>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th colspan="7">
                                                Total Seluruh Harga
                                            </th>
                                            <td style="text-align:right;">
                                                <?= number_format($totalSeluruhHarga, 0, ",", ".") ?>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>

                            </center>
                            <br>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>