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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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

        .navbar-toggler {
            border: 3px solid #f19159;
        }

        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba(35, 76, 203, 0.8)' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* .shadowed-square {
            margin-top: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        } */

        /* .container {
            max-width: 800px;
        } */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

        h2 {
            margin-bottom: 20px;
        }
    </style>

    <title>Manpro Simulation Truck</title>
    <script>
        $(document).ready(function() {
            // $('#example').DataTable({
            //     searching: false
            // });

            $("#index-tab").click(function() {
                window.location.href = "index.php";
            });

            $("#data-tab").click(function() {
                window.location.href = "raw_data.php";
            });

            $("#compare-tab").click(function() {
                window.location.href = "compare.php";
            });

            $("#simul-tab").click(function() {
                window.location.href = "simul.php";
            });

        });
    </script>
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
                            <button class="nav-link active" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Data</button>
                            <button class="nav-link" id="simul-tab" data-bs-toggle="tab" data-bs-target="#simul" type="button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Simulation</button>
                            <button class="nav-link" id="compare-tab" data-bs-toggle="tab" data-bs-target="#timing" type="button" role="tab" aria-controls="timing" aria-selected="false" onclick="redirectToCompare()" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>


    <div class="container-fluid pt-3 pe-5 ps-5 pb-1">
        <h1>Data</h1>

        <div class="row mt-4 mb-3">
            <div class="col-md-4 mb-3">
                <div class="rounded p-3 shadow">
                    <form method="post">
                        <div style="display: flex; align-items: center;">
                            <select class="form-select" aria-label="Raw Data Name" name="rawDataName">
                                <option value="" disabled selected>Choose Raw Data Name</option>
                                <?php
                                $ambilSemuaNama = mysqli_query($conn, "SELECT rawDataName FROM rawdata");
                                while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                                ?>
                                    <option value="<?= $data['rawDataName']; ?>"><?= $data['rawDataName']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                            <input type="submit" name="submit" class="btn btn-success ms-3" value="Search">

                        </div>
                    </form>
                </div>

            </div>


        </div>

        <div class="container-fluid p-0">
            <div class="row mt-4">
                <div class="col-md-6">

                    <?php
                    if (isset($_POST['submit']) && isset($_POST['rawDataName'])) {
                        $selected = $_POST['rawDataName'];
                        $ambilSemuaData = mysqli_query($conn, "SELECT * FROM rawdata where rawDataName = '$selected'");
                        while ($data = mysqli_fetch_assoc($ambilSemuaData)) {
                    ?>
                            <h1>Nama Raw Data:</h1>
                            <h2><?= $data['rawDataName']; ?></h2>


                            <h1>Jumlah Area: </h1>
                            <h2><?= $data['jumlahArea']; ?></h2>

                            <h1>Range Jarak:</h1>
                            <?php
                            $jsonString = $data['rangeJarak'];
                            $decodedData = json_decode($jsonString, true);

                            $index = 0;
                            $awal = 0;
                            if (is_array($decodedData)) {
                                foreach ($decodedData as $value) {
                                    echo "<h2>Area $index: $awal - $value</h2>";
                                    $index++;
                                    $awal = $value += 1;
                                }
                            }
                            ?>

                            <h1>Total Jumlah Truck:</h1>
                            <h2><?= $data['totalTruk']; ?></h2>

                            <h1>Durasi waktu Simulasi:</h1>
                            <h2><?= $data['durasi']; ?></h2>


                            <h1>Jumlah Truck:</h1>
                            <?php
                            $jsonString = $data['persentaseTruk'];
                            $decodedData = json_decode($jsonString, true);

                            $index = 0;
                            if (is_array($decodedData)) {
                                foreach ($decodedData as $value) {

                                    echo "<h2>Area $index: $value</h2>";
                                    $index++;
                                }
                            }
                            ?>


                            <h1 style='margin-top: 50px'>Detail Truck:</h1>

                            <?php
                            $jsonString = $data['detailTruk'];
                            $truckDetails = json_decode($jsonString, true);

                            echo '<table class="table" id="truckDetailsTable">';
                            echo '<thead>';
                            echo '<tr>';
                            echo '<th>Truck Number</th>';
                            echo '<th>Index Area</th>';
                            echo '<th>Jarak</th>';
                            echo '<th>Durasi Waktu Perjalanan</th>';
                            echo '<th>Waktu Berangkat</th>';
                            echo '<th>Waktu Delay</th>';
                            echo '<th>Waktu Sampai</th>';
                            echo '</tr>';
                            echo '</thead>';
                            echo '<tbody>';

                            foreach ($truckDetails as $truckNumber => $truckData) {
                                echo '<tr>';
                                echo "<td>Truck $truckNumber</td>";
                                echo "<td>{$truckData[0]}</td>";
                                echo "<td>{$truckData[1]}</td>";
                                echo "<td>{$truckData[2]}</td>";
                                echo "<td>{$truckData[3]}</td>";
                                echo "<td>{$truckData[4]}</td>";
                                echo "<td>{$truckData[5]}</td>";
                                echo '</tr>';
                            }

                            echo '</tbody>';
                            echo '</table>';
                            ?>




                    <?php
                        }
                    } else {
                    }



                    ?>
                </div>
            </div>
        </div>




        <script>
            $(document).ready(function() {
                $('#truckDetailsTable').DataTable();
            });
        </script>
        <!-- Include jQuery and DataTables JavaScript -->
        <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

        <!-- Include Bootstrap JavaScript -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous" defer></script>
</body>

</html>