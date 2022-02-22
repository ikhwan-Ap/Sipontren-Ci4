<html>

<head>
    <style>
        .print {
            margin: auto;
            width: 100%;
            height: 100%;
        }

        .h2 {
            text-align: center;
        }

        .h3 {
            text-align: right;
        }

        .names {
            font-weight: bold;
        }
    </style>
</head>
<h2 class="h2"><?= $title; ?></h2>


<body>
    <table border="1" class="print">
        <thead>
            <tr>
                <th width="5%"><span class="names">No</span></th>
                <th width="45%"><span class="names">Nama Pembayaran</span></th>
                <th><span class="names">Bulan</span></th>
                <th><span class="names">Jumlah Pemasukan</span></th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($data as $k) :

            ?>
                <tr>
                    <td width="5%"><?= $i++; ?></td>
                    <td width="45%"><?= $k['nama_pengeluaran']; ?></td>
                    <td><?= date('d-m-Y', strtotime($k["waktu_pengeluaran"]));; ?></td>
                    <td><?= $k['jumlah_pengeluaran']; ?></td>
                </tr>

            <?php endforeach; ?>
            <?php foreach ($pengeluaran as $L) : ?>
                <tr>
                    <td colspan="3"><span class="names">Jumlah</span></td>
                    <td><?= $L['jumlah_pengeluaran']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>