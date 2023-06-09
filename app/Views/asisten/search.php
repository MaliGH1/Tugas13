<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari data</title>
</head>

<body>
    <div class="container">
        <h1>CARI ASISTEN PRAKTIKUM</h1>
        <form action="/asisten/search" method="post">
            <?= csrf_field() ?>
            Search: <input type="text" name="key" ?>
            <input type="submit" name="submit" value="Search" />
        </form>

        <?php
        if (!empty($hasil)) {
            echo "<h1>Hasil Pencarian </h1>";
            echo "Nama: " . $hasil['NAMA'];
            echo "<br>Praktikum: " . $hasil['PRAKTIKUM'];
            echo "<br>IPK: " . $hasil['IPK'];
        }
        ?>
        <div class="mt-3">
            <a href="/AsistenController/AsistenView" class="btn btn-primary">Kembali</a>
        </div>
    </div>
</body>

</html>