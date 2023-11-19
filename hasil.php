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
        <h1>Hasil</h1>

        <div class="row mt-4 mb-3">
            <div class="col-md-4 mb-3">
                <div class="rounded p-3 shadow">
                    <form method="post">
                        <div style="display: flex; align-items: center;">
                            <select class="form-select" aria-label="Simulation Name" name="simulationName">
                                <option value="" disabled selected>Choose Simulation Name</option>
                                <?php
                                $ambilSemuaNama = mysqli_query($conn, "SELECT namaSimul FROM hasil");
                                while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                                ?>
                                    <option value="<?= $data['namaSimul']; ?>"><?= $data['namaSimul']; ?></option>
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
                    if (isset($_POST['submit']) && isset($_POST['simulationName'])) {
                        $selected = $_POST['simulationName'];
                        $ambilSemuaData = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected'");
                        while ($data = mysqli_fetch_assoc($ambilSemuaData)) {
                    ?>
                            <h1>Nama Raw Data:</h1>
                            <h2><?= $data['rawDataName']; ?></h2>

                            <h1>Nama Simulasi:</h1>
                            <h2><?= $data['namaSimul']; ?></h2>

                            <h1>Isi Gudang:</h1>
                            <?php
                            $dataGudang = json_decode($data['isiGudang']);

                            foreach ($dataGudang as $index => $gudang) {
                                echo "Gudang " . ($index + 1) . ": ";

                                $truckStrings = array_map(function ($truckNumber) {
                                    return "Truck " . $truckNumber;
                                }, $gudang);

                                echo implode(", ", $truckStrings) . "<br>";
                            }
                            ?>

                            <h1>Sum Jumlah Truck per Gudang:</h1>
                            <?php
                            $dataIsiGudang = json_decode($data['isiGudang']);
                            $sumTruck = [];
                            $index = 0;
                            foreach ($dataIsiGudang as $subarray) {
                                $count = 0;
                                foreach ($subarray as $value) {
                                    $count++;
                                }
                                $index++;
                                $sumTruck[] = $count;
                                echo "Gudang " . $index . ":" . $count . "<br>";
                            }
                            ?>

                            <h1>Rata-rata Jumlah Truck per Gudang:</h1>
                            <?php
                            $dataIsiGudang = json_decode($data['isiGudang']);
                            $total = 0;
                            $rataTruck = [];

                            foreach ($dataIsiGudang as $subarray) {
                                foreach ($subarray as $value) {
                                    $total++;
                                }
                            }
                            $index = 0;
                            foreach ($dataIsiGudang as $subarray) {
                                $count = 0;
                                foreach ($subarray as $value) {
                                    $count++;
                                }
                                $index++;
                                $average = $count / $total;
                                $rataTruck1[] = $average;
                                echo "Gudang " . $index . ":" . $average . "<br>";
                            }
                            ?>

                            <h1>Min Jumlah Truck per Gudang:</h1>
                            <?php
                            $dataIsiGudang1 = json_decode($data['isiGudang']);
                            $cek = 0;
                            foreach ($dataIsiGudang1 as $subarray) {
                                $count = 0;
                                foreach ($subarray as $value) {
                                    $count++;
                                }

                                if ($cek == 0 || $cek > $count) {
                                    $cek = $count;
                                }
                            }
                            echo $cek . "<br>";
                            ?>

                            <h1>Max Jumlah Truck per Gudang:</h1>
                            <?php
                            $dataIsiGudang1 = json_decode($data['isiGudang']);
                            $cek = 0;
                            foreach ($dataIsiGudang1 as $subarray) {
                                $count = 0;
                                foreach ($subarray as $value) {
                                    $count++;
                                }

                                if ($cek == 0 || $cek < $count) {
                                    $cek = $count;
                                }
                            }
                            echo $cek . "<br>";
                            ?>



                            <h1>Waktu Operasi Gudang:</h1>
                            <?php
                            $waktuOperasiArray = json_decode($data['waktuOperasiGudang']);

                            foreach ($waktuOperasiArray as $index => $waktuOperasi) {
                                echo "Waktu Operasi Gudang " . ($index + 1) . ": " . $waktuOperasi . "<br>";
                            }
                            ?>

                            <h1>Sum Jumlah Waktu Operasi Gudang:</h1>
                            <?php
                            $dataOperasiGudang1 = json_decode($data['waktuOperasiGudang']);
                            $sum = array_sum($dataOperasiGudang1);
                            echo $sum . "<br>";
                            ?>

                            <h1>Rata-rata Jumlah Waktu Operasi Gudang:</h1>
                            <?php
                            $dataOperasiGudang1 = json_decode($data['waktuOperasiGudang']);
                            $rataRata2 = array_sum($dataOperasiGudang1) / count($dataOperasiGudang1);
                            echo $rataRata2 . "<br>";
                            ?>

                            <h1>Min Jumlah Waktu Operasi Gudang:</h1>
                            <?php
                            $dataOperasiGudang1 = json_decode($data['waktuOperasiGudang']);
                            $min = min($dataOperasiGudang1);
                            echo $min . "<br>";
                            ?>

                            <h1>Max Jumlah Waktu Operasi Gudang:</h1>
                            <?php
                            $dataOperasiGudang1 = json_decode($data['waktuOperasiGudang']);
                            $max = max($dataOperasiGudang1);
                            echo $max . "<br>";
                            ?>

                            <h1>Stdev Jumlah Waktu Operasi Gudang:</h1>
                            <?php
                            $dataOperasiGudang1 = json_decode($data['waktuOperasiGudang']);

                            $rataRata = array_sum($dataOperasiGudang1) / count($dataOperasiGudang1);

                            $selisihKuadrat = array_map(function ($x) use ($rataRata) {
                                return pow($x - $rataRata, 2);
                            }, $dataOperasiGudang1);

                            $rataSelisihKuadrat = array_sum($selisihKuadrat) / count($dataOperasiGudang1);

                            $standardDeviasi1 = sqrt($rataSelisihKuadrat);

                            echo $standardDeviasi1 . "<br>";
                            ?>


                            <h1>Waktu Antri Truck:</h1>
                            <?php
                            $waktuAntriArray = json_decode($data['waktuAntriTruk']);
                            foreach ($waktuAntriArray  as $index => $waktuAntri) {
                                echo "Waktu Antri Truck " . ($index + 1) . ": " . $waktuAntri . "<br>";
                            }
                            ?>

                            <h1>Sum Jumlah Waktu Antri Truck:</h1>
                            <?php
                            $dataWaktuAntriTruck1 = json_decode($data['waktuAntriTruk']);
                            $sumValue = array_sum($dataWaktuAntriTruck1);
                            echo $sumValue . "<br>";
                            ?>

                            <h1>Rata-rata Jumlah Waktu Antri Truck</h1>
                            <?php
                            $dataWaktuAntriTruck1 = json_decode($data['waktuAntriTruk']);
                            $rataRata3 = array_sum($dataWaktuAntriTruck1) / count($dataWaktuAntriTruck1);
                            echo $rataRata3 . "<br>";
                            ?>

                            <h1>Min Jumlah Waktu Antri Truck:</h1>
                            <?php
                            $dataWaktuAntriTruck1 = json_decode($data['waktuAntriTruk']);
                            $minValue = min($dataWaktuAntriTruck1);
                            echo $minValue . "<br>";
                            ?>

                            <h1>Max Jumlah Waktu Antri Truck:</h1>
                            <?php
                            $dataWaktuAntriTruck1 = json_decode($data['waktuAntriTruk']);
                            $maxValue = max($dataWaktuAntriTruck1);
                            echo $maxValue . "<br>";
                            ?>

                            <h1>Stdev Jumlah Waktu Operasi Gudang:</h1>

                            <?php
                            $dataWaktuAntriTruck1 = json_decode($data['waktuAntriTruk'], true);

                            $meanValue = array_sum($dataWaktuAntriTruck1) / count($dataWaktuAntriTruck1);

                            $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                return pow($x - $meanValue, 2);
                            }, $dataWaktuAntriTruck1);

                            $meanSquaredDifferences = array_sum($squaredDifferences) / count($dataWaktuAntriTruck1);

                            $stdevValue2 = sqrt($meanSquaredDifferences);

                            echo $stdevValue2 . "<br>";
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