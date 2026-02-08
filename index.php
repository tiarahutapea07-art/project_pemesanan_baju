<!DOCTYPE html>
<html lang="id">
<head>
    <title>Sistem Pemesanan Baju</title>
</head>
<body>
    <h2>Form Pendaftaran Pembelian Baju</h2>
    <form method="POST" action="">
        Nama: <input type="text" name="nama" required><br><br>
        
        Jumlah: <input type="number" name="jumlah" min="1" required><br><br>
        
        Ukuran: 
        <select name="ukuran">
            <option value="S">S (Standar)</option>
            <option value="M">M (+5.000)</option>
            <option value="L">L (+10.000)</option>
            <option value="XL">XL (+15.000)</option>
        </select><br><br>

        Bahan: (Bisa pilih lebih dari satu)<br>
        <input type="checkbox" name="bahan[]" value="Katun"> Katun
        <input type="checkbox" name="bahan[]" value="Linen"> Linen
        <input type="checkbox" name="bahan[]" value="Rayon"> Rayon
        <input type="checkbox" name="bahan[]" value="Sutra"> Sutra
        <input type="checkbox" name="bahan[]" value="Spandex"> Spandex<br><br>

        <button type="submit" name="proses">Hitung Total</button>
    </form>

    <hr>

    <?php
    if (isset($_POST['proses'])) {
        $nama = $_POST['nama'];
        $qty = $_POST['jumlah'];
        $ukuran = $_POST['ukuran'];
        $bahan_terpilih = isset($_POST['bahan']) ? $_POST['bahan'] : [];

        // Logika Harga
        $harga_dasar = 110000;
        $tambahan_ukuran = 0;

        if ($ukuran == "M") $tambahan_ukuran = 5000;
        elseif ($ukuran == "L") $tambahan_ukuran = 10000;
        elseif ($ukuran == "XL") $tambahan_ukuran = 15000;

        $harga_per_pcs = $harga_dasar + $tambahan_ukuran;
        $total_bayar = $harga_per_pcs * $qty;

        // Tampilan Hasil
        echo "<h3>Detail Pesanan:</h3>";
        echo "Nama Pembeli: " . htmlspecialchars($nama) . "<br>";
        echo "Ukuran: " . $ukuran . "<br>";
        echo "Jumlah: " . $qty . " pcs<br>";
        echo "Bahan: " . (empty($bahan_terpilih) ? "-" : implode(", ", $bahan_terpilih)) . "<br>";
        echo "<strong>Total Bayar: Rp " . number_format($total_bayar, 0, ',', '.') . "</strong>";
    }
    ?>
</body>
</html>