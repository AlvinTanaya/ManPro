<?php
require "ok2.php";

?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <style>
        .table tbody tr th {
            text-align: left;
            font-weight: bold;
            background-color: #f0f0f0;
            padding: 8px;
        }

        .table tbody tr td {
            padding: 8px;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }
    </style>
    <title>Manpro Simulation Truck</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="coba.php">Manpro Simul</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" href="coba.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="lala.php">Compare</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="contaioner-fluid pt-5 pe-5 ps-5 pb-1">
        <h1>Compare</h1>
        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <?php
                    $ambilSemuaNama = mysqli_query($conn, "SELECT nama FROM simul");
                    while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                    ?>
                        <option value="1"> <?= $data['nama']; ?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <select class="form-select" aria-label="Default select example">
                    <option selected>Open this select menu</option>
                    <option value="1">One</option>
                    <option value="2">Two</option>
                    <option value="3">Three</option>
                </select>
            </div>
        </div>

    </div>

    <div class="contaioner-fluid pt-1 pe-5 ps-5 pb-5">
        <table id="example" class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>s
                    <th>Nama Simulasi</th>
                    <th>waktuLoading</th>
                    <th>durasiWaktu</th>
                    <th>jarakAwal</th>
                    <th>jarakAkhir</th>
                    <th>isiTruck</th>
                    <th>namaGudang</th>
                    <th>khusus</th>
                    <th>isiGudang</th>
                    <th>namaTruck</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $ambilsemuadata = mysqli_query($conn, "SELECT * FROM simul LEFT JOIN jarak ON simul.nama = jarak.namaSimul LEFT JOIN gudang ON simul.nama = gudang.namaSimul LEFT JOIN truck ON simul.nama = truck.namaSimul");
                $i = 1;
                while ($data = mysqli_fetch_assoc($ambilsemuadata)) {
                ?>

                    <tr>
                        <td><?= $i++; ?></td>
                        <td><?= $data['namaSimul']; ?></td>
                        <td><?= $data['waktuLoading']; ?></td>
                        <td><?= $data['durasi']; ?></td>
                        <td><?= $data['jarakAwal']; ?></td>
                        <td><?= $data['jarakAkhir']; ?></td>
                        <td><?= $data['isiTruck']; ?></td>
                        <td><?= $data['namaGudang']; ?></td>
                        <td><?= $data['khusus']; ?></td>
                        <td><?= $data['isiGudang']; ?></td>
                        <td><?= $data['namaTruck']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>





    <!-- Include jQuery and DataTables JavaScript -->
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- Include Bootstrap JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</body>

</html>