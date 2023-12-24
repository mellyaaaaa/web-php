<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "tugas3";

$connection = new mysqli($servername, $username, $password, $database);

$id = '';
$nama = '';
$harga = '';

$errorMessage = '';
$successMessage = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];

    do {
        if (empty($id) || empty($nama) || empty($harga)) {
            $errorMessage = "Tidak boleh kosong!";
            break;
        }

        $sql =  "INSERT INTO barang(id, nama, harga)" .
                "VALUES ('$id', '$nama', '$harga')";
        $result = $connection->query($sql);

        if (!$result) {
            $errorMessage = "Invalid query: " . $connection->error;
            break;
        }

        $id = '';
        $nama = '';
        $harga = '';

        $successMessage = "Barang berhasil ditambahkan";

        header("location: /Tugas PHP3/index.php");
        exit;

    }while(false);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Item</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container my-5">
        <h2>Item Baru</h2>

        <?php
        if (!empty($errorMessage) ) {
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert'>
                <strong>$errorMessage</strong>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        }
        ?>

        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">ID Barang</label>
                <div>
                    <input type="text" class="form-control" name="id" value="<?php echo $id; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nama Barang</label>
                <div>
                    <input type="text" class="form-control" name="nama" value="<?php echo $nama; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Harga</label>
                <div>
                    <input type="text" class="form-control" name="harga" value="<?php echo $harga; ?>">
                </div>
            </div>

            <?php
            if ( !empty($successMessage) ) {
                echo"
                <div class='row mb-3'>
                    <div class='offset-sm-3 col-sm-6'>
                        <div class='alert alert-success alert-dismissible fade show' role='alert'>
                            <strong>$successMessage</strong>
                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>
                    </div>
                </div>
                ";
            }
            ?>

            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="Submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="/Tugas PHP3/index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
</html>