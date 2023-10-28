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

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <style>
        .page-item.active .page-link {
            background-color: #28a745 !important;
            color: white !important;
            border: 1px solid black;
        }

        .page-link {
            color: #28a745 !important;
        }

        .nav_left {
            background-color: #d1e7dd;
            border-top-left-radius: 48px;
            border-bottom-left-radius: 48px;
        }

        .nav-tabs .nav-link.active {
            background-color: transparent;
            border-color: transparent;
            border-top: 4px solid green;
            color: green;
            font-weight: bolder;
        }


        .nav-tabs .nav-link {
            border: none;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            margin: 0 30px 0 40px;
        }

        .nav-tabs {
            border-bottom: none;
        }

        .nav-link {
            padding: 1rem 0.5rem;
            color: #fff;
        }

        .nav-link:focus,
        .nav-link:hover {
            color: gray;
        }

        .search_input {
            width: 100%;
            border-radius: 10px;
            border: none;
            line-height: initial;
            padding-top: 4px;
            padding-bottom: 4px;
            color: #f19159;
        }

        .search_input:focus-visible {
            outline: none;
        }

        input.search_input::placeholder {
            color: #cfd2ec;
            vertical-align: middle;
        }

        .navbar-toggler {
            border: 3px solid #f19159;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(35, 76, 203, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

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

        .thead {
            align-content: center;

        }
    </style>
    <title>Manpro Simulation Truck</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success py-3 ">
        <div class="pe-lg-0 ps-lg-5 container-fluid justify-content-between">
            <a class="navbar-brand" href="index.php" style="color: #d1e7dd; font-weight: bolder;">
                <i class="fas fa-warehouse" style="margin-right: 10px;"></i> Warehouse Simulator
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <div class="nav_left d-lg-flex align-items-center">
                    <nav>
                        <div class="nav d-block d-lg-flex nav-tabs" id="nav-tab" role="tablist">
                            <button class="nav-link" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" onclick="redirectToIndex()" style="color: black;">Input</button>
                            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type "button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Data</button>
                            <button class="nav-link" id="timing-tab" data-bs-toggle="tab" data-bs-target="#timing" type="button" role="tab" aria-controls="timing" aria-selected="false" onclick="redirectToCompare()" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid pt-3 pe-5 ps-5 pb-1">
        <div class="container-fluid pt-3 pb-5">
            <h1>Data</h1>

            <div class="row mt-4 mb-3">
                <div class="col-md-4 mb-3">
                    <div class="rounded p-3 shadow">
                        <select class="form-select" aria-label="Simulation Name">
                            <option selected>Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT nama FROM simul");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="1"><?= $data['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="rounded p-3 shadow">
                        <select class="form-select" aria-label="Area">
                            <option selected>Area</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="rounded p-3 shadow">
                        <select class="form-select" aria-label="Specifity">
                            <option selected>Specifity</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
            </div>

            <table id="example" class="table table-bordered table-striped table-hover">
                <thead class="table-success thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Simulation Name</th>
                        <th>Loading Time</th>
                        <th>Duration</th>
                        <th>Start Distance</th>
                        <th>End Distance</th>
                        <th>Truck Content</th>
                        <th>Warehouse Name</th>
                        <th>Specifity</th>
                        <th>Warehouse Inventory</th>
                        <th>Truck Name</th>
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

            function redirectToIndex() {
                // Redirect the user to index.php
                window.location.href = "index.php";
            }

            function redirectToData() {
                // Redirect the user to index.php
                window.location.href = "raw_data.php";
            }

            function redirectToCompare() {
                // Redirect the user to index.php
                window.location.href = "compare.php";
            }
        </script>
</body>

</html>