<?php
$server = "localhost";
$username = "root";
$password = "";
$dbname = "tododb";

$conn = new mysqli($server, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection Failed " . $conn->connect_error);
}

$sql = "Select * from todolist";
$result = $conn->query($sql);

if (isset($_POST['tambah'])) {
    $aktif = "Aktif";
    $kegiatan = $_POST['kegiatan'];
    $simpan = "INSERT INTO todolist VALUES ('', '$kegiatan', '$aktif')";
    $query = mysqli_query($conn, $simpan);
    if ($query) {
        $msg = "Data Telah Disimpan";
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
        $conn->close();
        header("Refresh:0");
    } else {
        $msg = "Data Gagal Disimpan";
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
    }
}

if (isset($_POST['selesai'])) {
    $idkegiatan = $_POST['idkegiatan'];
    $selesai = "Selesai";
    $update = "UPDATE todolist SET status='$selesai' where idkegiatan = '$idkegiatan'";
    if ($conn->query($update) === TRUE) {
        $msg = "Kegiatan Selesai!";
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
        $conn->close();
        header("Refresh:0");
    } else {
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
    }
}

if (isset($_POST['hapus'])) {
    $idkegiatan = $_POST['idkegiatan'];
    $hapus = "DELETE FROM todolist WHERE idkegiatan = '$idkegiatan'";
    if ($conn->query($hapus) === TRUE) {
        $msg = "Data Berhasil Dihapus";
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
        $conn->close();
        header("Refresh:0");
    } else {
        $msg = "Data Gagal Dihapus";
        echo "<script type = 'text/javascript'>
            alert('$msg');
        </script>";
    }
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Aplikasi To-Do List</title>
</head>

<body>
    <article>
        <div class="container pt-3">
            <div class="card pt-3">
                <div class="form-group ml-3">
                    <form action="" method="POST">
                        <h1>Aplikasi To-Do List</h1>
                        <div class="form-row">
                            <div class="col">
                                <br><br>
                                <label for="Kegiatan">Masukkan Kegiatan </label>
                                <input type="text" name="kegiatan" id="kegiatan" class="form-control">
                            </div>
                            <div class="col pt-4 mt-2">
                                <br><br>
                                <input type="submit" value="Tambahkan" name="tambah" id="tambah" class="btn btn-primary">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="table-responsive-md m-3">
                    <h3>Daftar Kegiatan</h3>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th scope="col">Id Kegiatan</th>
                                <th scope="col">Kegiatan</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            while ($row = $result->fetch_assoc()) {
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $row['idkegiatan'] ?></th>
                                    <td><?php echo $row['kegiatan'] ?></td>
                                    <td>
                                        <?php if ($row['status'] == "Selesai") {
                                            echo $row['status'];
                                        } else {
                                        ?>
                                            <form action="" method="post">
                                                <input type="hidden" name="idkegiatan" id="idkegiatan" value="<?php echo $row['idkegiatan'] ?>">
                                                <input type="submit" value="Aktif" name="selesai" id="selesai" class="btn btn-info">
                                            </form>
                                        <?php } ?>
                                    </td>
                                    <td>
                                        <form action="" method="POST">
                                            <input type="hidden" name="idkegiatan" id="idkegiatan" value="<?php echo $row['idkegiatan'] ?>">
                                            <input type="submit" value="Hapus" name="hapus" id="hapus" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
    </article>
</body>

</html>