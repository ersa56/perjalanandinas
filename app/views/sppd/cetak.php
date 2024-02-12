<!-- views/sppd/cetak.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $data['title']; ?></title>
    <!-- Tambahkan CSS atau style sesuai kebutuhan -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        /* Tambahkan style cetakan sesuai kebutuhan */
    </style>
</head>
<body>
    <h2><?= $data['title']; ?></h2>
    <!-- Tambahkan konten cetakan sesuai kebutuhan -->
    <p>Nama Anggota Dewan: <?= $data['tb_sppd']['nama_anggota_dewan']; ?></p>
    <p>Kenderaan: <?= $data['tb_sppd']['jenis_transportasi']; ?></p>
    <p>Tujuan: <?= $data['tb_sppd']['tempat_tujuan']; ?></p>
    <p>Tanggal Berangkat: <?= date('d-m-Y', strtotime($data['tb_sppd']['tanggal_berangkat'])); ?></p>
    <!-- ... Tambahkan informasi lainnya sesuai kebutuhan -->
</body>
</html>
