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

        img {
            border-radius: 50%;
        }
    </style>
</head>
<h1 style="text-align: center;">
    PONDOK PESANTREN DARUSSALAM
</h1>
<p style="text-align: center; margin: 0px 0px 0px 0px;">Jl. Sunan Bonang No.37 Rt. 03/06, Dusun I, Dukuhwaluh<br> Kec.Kembaran, Kabupaten Banyumas Jawa Tengah, (53182) <br>Telp:+62 812-1924-2180 (Muhammad Fajar), +62 859-4378-9518(Khafi)</p>
<hr style="margin-bottom: 20%;">

<body>
    <h2>Nama Pencetak : <?= session()->get('name'); ?></h2>
    <h2>Tanggal Cetak : <?= date('d-m-Y'); ?></h2>
    <table border="1" class="print">
        <thead>
            <tr>
                <th width="5%"><span class="names">No</span></th>
                <th><span class="names">Nama Santri</span></th>
                <th width="30%"><span class="names">Nama Pembayaran</span></th>
                <th><span class="names">Bulan</span></th>
                <th><span class="names">Jumlah Pemasukan</span></th>

            </tr>
        </thead>
        <tbody>
            <?php $i = 1;
            foreach ($pendapatan as $k) :
            ?>
                <tr>
                    <td width="5%"><?= $i++; ?></td>
                    <td><?= $k['nama_lengkap']; ?></td>
                    <td width="30%"><?= $k['nama_pembayaran']; ?></td>
                    <td><?= date('d-m-Y', strtotime($k["waktu"]));; ?></td>
                    <td align="right"><?= "Rp." . number_format($k['jumlah_bayar'], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
            <?php foreach ($Lunas as $L) : ?>
                <tr>
                    <td colspan="4"><span class="names">Jumlah</span></td>
                    <td align="right"><?= "Rp." . number_format($L['jumlah_bayar'], 2, ',', '.'); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>