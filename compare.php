<?php
require "ok2.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css"> -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>

    <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <script>
        $(document).ready(function() {

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

            $("#hasil-tab").click(function() {
                window.location.href = "hasil.php";
            });
        });
    </script>
</head>
<style>
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


    .row:not(:last-child) {
        border-bottom: 1px solid black;
    }

    .card {
        margin-bottom: 10px;
    }
</style>

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
                            <button class="nav-link" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Data</button>
                            <button class="nav-link" id="simul-tab" data-bs-toggle="tab" data-bs-target="#simul" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Simulation</button>
                            <button class="nav-link" id="hasil-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Hasil</button>
                            <button class="nav-link active" id="compare-tab" data-bs-toggle="tab" data-bs-target="#compare" type="button" role="tab" aria-controls="compare" aria-selected="false" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>




    <div class="container-fluid pt-3 pe-5 ps-5 pb-1">
        <form method="post">
            <div class="row mt-4" style="border-bottom: 1px solid black;">
                <div class="col-md-2 pb-3">
                    <h1>Compare</h1>
                </div>

                <div class="col-md-4 mt-2" style="padding-right: 2%;">
                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama1">
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
                    </div>
                </div>

                <div class="col-md-4 mt-2" style="padding-left: 2%; padding-right: 2%;">
                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama2">
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
                    </div>
                </div>

                <div class="col-md-2 mt-2" style="padding-left: 2%;">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit" style="width: 100%;">
                </div>
            </div>
        </form>



        <?php
        if (isset($_POST['submit']) && isset($_POST['nama1']) && isset($_POST['nama2']) && !empty($_POST['nama1']) && !empty($_POST['nama2'])) {
            $selected1 = $_POST['nama1'];
            $selected2 = $_POST['nama2'];

            $cek1 = mysqli_query($conn, "SELECT rawDataName FROM hasil where namaSimul = '$selected1'");
            $cek2 = mysqli_query($conn, "SELECT rawDataName FROM hasil where namaSimul = '$selected2'");

            if ($cek1 == $cek2) {
        ?>
                <!-- Gudang -->
                <div class="row mt-3 mb-3">
                    <div class="col-md-6 ps-0 pb-0 pt-2 pe-5">

                        <?php
                        $ambilData1 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected1'");
                        while ($data1 = mysqli_fetch_assoc($ambilData1)) {
                        ?>
                            <h4 class="m-0 pb-4" id="namaSimulasi1" style="display: flex; align-items: center; justify-content: center;">
                                <?= $data1['namaSimul']; ?>
                            </h4>
                            <table id="Gudang1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Truck per Gudang</th>
                                        <th>Sum Truck per Gudang</th>
                                        <th>Average Truck per Gudang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataIsiGudang1 = json_decode($data1['isiGudang']);
                                    $countID = 0;
                                    $sumTruck1 = [];

                                    $total = 0;
                                    $rataTruck1 = [];
                                    foreach ($dataIsiGudang1 as $subarray) {
                                        foreach ($subarray as $value) {
                                            $total++;
                                        }
                                    };

                                    foreach ($dataIsiGudang1 as $subarray) {
                                        $subarrayWithTruck = array_map(function ($item) {
                                            return 'Truck ' . $item;
                                        }, $subarray);

                                        $output = implode(', ', $subarrayWithTruck);
                                        $countID++;

                                        $countSum = 0;
                                        foreach ($subarray as $value) {
                                            $countSum++;
                                        }
                                        $sumTruck1[] = $countSum;

                                        $countAvg = 0;
                                        foreach ($subarray as $value) {
                                            $countAvg++;
                                        }
                                        $average1 = $countAvg / $total;
                                        $rataTruck1[] = $average1;

                                        echo '<tr>
                                                    <td>' . $countID . "</td>
                                                    <td>" . $output . "</td>
                                                    <td>" . $countSum . "</td>
                                                    <td>" . $average1 . "</td>
                                                    
                                                  </tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $sumOfTruck1 = array_sum($sumTruck1);
                                        echo "<th>" . $sumOfTruck1 . "</th>";
                                        ?>

                                        <?php
                                        $sumOfRataTruck1 = array_sum($rataTruck1);
                                        $totalavg = $sumOfRataTruck1 / count($rataTruck1);
                                        echo "<th>" . $totalavg . "</th>";
                                        ?>

                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minGudang1" style="display: flex;">
                                Minimum Jumlah Truck pada Gudang:
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
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
                                echo $cek;
                                ?>
                            </h5>

                            <h5 class="m-0 pb-4" id="maxGudang1" style="display: flex;">
                                Maximum Jumlah Truck pada Gudang:
                                <?php
                                $dataIsiGudang1 = json_decode($data1['isiGudang']);
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
                                echo $cek;
                                ?>
                            </h5>
                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-6 ps-5 pb-0 pt-2 pe-0">
                        <?php
                        $ambilData2 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected2'");
                        while ($data2 = mysqli_fetch_assoc($ambilData2)) {
                        ?>
                            <h4 class="m-0 pb-4" id="namaSimulasi2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                                <?= $data2['namaSimul']; ?>
                            </h4>
                            <table id="Gudang2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Truck per Gudang</th>
                                        <th>Sum Truck per Gudang</th>
                                        <th>Average Truck per Gudang</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                    $countID = 0;
                                    $sumTruck2 = [];

                                    $total = 0;
                                    $rataTruck2 = [];
                                    foreach ($dataIsiGudang2 as $subarray) {
                                        foreach ($subarray as $value) {
                                            $total++;
                                        }
                                    };

                                    foreach ($dataIsiGudang2 as $subarray) {
                                        $subarrayWithTruck = array_map(function ($item) {
                                            return 'Truck ' . $item;
                                        }, $subarray);

                                        $output = implode(', ', $subarrayWithTruck);
                                        $countID++;

                                        $countSum = 0;
                                        foreach ($subarray as $value) {
                                            $countSum++;
                                        }
                                        $sumTruck2[] = $countSum;

                                        $countAvg = 0;
                                        foreach ($subarray as $value) {
                                            $countAvg++;
                                        }
                                        $average2 = $countAvg / $total;
                                        $rataTruck2[] = $average2;

                                        echo '<tr>
                                                    <td>' . $countID . "</td>
                                                    <td>" . $output . "</td>
                                                    <td>" . $countSum . "</td>
                                                    <td>" . $average2 . "</td>
                                                    
                                                  </tr>";
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $sumOfTruck2 = array_sum($sumTruck2);
                                        echo "<th>" . $sumOfTruck2 . "</th>";
                                        ?>

                                        <?php
                                        $sumOfRataTruck2 = array_sum($rataTruck2);
                                        $totalavg = $sumOfRataTruck2 / count($rataTruck2);
                                        echo "<th>" . $totalavg . "</th>";
                                        ?>

                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minGudang2" style="display: flex;">
                                Minimum Jumlah Truck pada Gudang:
                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang2 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek > $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek;
                                ?>

                            </h5>

                            <h5 class="m-0 pb-4" id="maxGudang1" style="display: flex;">
                                Maximum Jumlah Truck pada Gudang:
                                <?php
                                $dataIsiGudang2 = json_decode($data2['isiGudang']);
                                $cek = 0;
                                foreach ($dataIsiGudang2 as $subarray) {
                                    $count = 0;
                                    foreach ($subarray as $value) {
                                        $count++;
                                    }

                                    if ($cek == 0 || $cek < $count) {
                                        $cek = $count;
                                    }
                                }
                                echo $cek;
                                ?>

                            </h5>


                        <?php
                        }
                        ?>
                    </div>

                </div>
                <div class="row mb-3">

                    <h4 class="pb-3 pt-2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                        Graphic
                    </h4>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8 pb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Truck per Gudang</p>
                                <canvas id="myChart7" style="width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Rata-rata Truck per Gudang</p>
                                <canvas id="myChart8" style="width:100%;"></canvas>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-2">

                    </div>
                </div>




                <!-- waktuOperasiGudang -->
                <div class="row mt-3 mb-3">
                    <h2 class="pt-2 pb-1" style="display: flex; align-items: center; justify-content: center;">Waktu Operasi Gudang </h2>
                    <div class="col-md-6 ps-0 pb-0 pt-2 pe-5">

                        <?php
                        $ambilData1 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected1'");
                        while ($data1 = mysqli_fetch_assoc($ambilData1)) {
                        ?>

                            <table id="waktuOperasiGudang1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Operasi Gudang</th>
                                        <th>Average Waktu Operasi Gudang</th>
                                        <th>Stdev Waktu Operasi Gudang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                    $individualAverages = [];
                                    $stdevValuesGudang = [];

                                    foreach ($dataOperasiGudang1 as $index => $value) {
                                        $arrayExcludingCurrentValue = $dataOperasiGudang1;
                                        unset($arrayExcludingCurrentValue[$index]);

                                        // Reindex the array
                                        $arrayExcludingCurrentValue = array_values($arrayExcludingCurrentValue);

                                        $meanValue = count($arrayExcludingCurrentValue) > 0 ? array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue) : 0;

                                        $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                            return pow($x - $meanValue, 2);
                                        }, $arrayExcludingCurrentValue);

                                        $meanSquaredDifferences = count($arrayExcludingCurrentValue) > 0 ? array_sum($squaredDifferences) / count($arrayExcludingCurrentValue) : 0;

                                        $stdevValue = sqrt($meanSquaredDifferences);

                                        // Update the arrays
                                        $individualAverages[] = $meanValue;
                                        $stdevValuesGudang[] = $stdevValue;

                                        echo '<tr>
                                            <td>' . ($index + 1) . '</td>
                                            <td>' . $dataOperasiGudang1[$index] . '</td>
                                            <td>' . $meanValue . '</td>
                                            <td>' . $stdevValue . '</td>
                                        </tr>';
                                    }
                                    ?>



                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                        $sum = array_sum($dataOperasiGudang1);
                                        echo "<th>" . $sum . "</th>";
                                        ?>
                                        <?php
                                        $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                        $rataRata2 = array_sum($dataOperasiGudang1) / count($dataOperasiGudang1);
                                        echo "<th>" . $rataRata2 . "</th>";
                                        ?>

                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minWaktuOperasiGudang1" style="display: flex;">
                                Minimum Waktu Operasi Gudang:
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $min = min($dataOperasiGudang1);
                                echo $min;
                                ?>

                            </h5>

                            <h5 class="m-0 pb-4" id="maxWaktuOperasiGudang1" style="display: flex;">
                                Maximum Waktu Operasi Gudang:
                                <?php
                                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                                $max = max($dataOperasiGudang1);
                                echo $max;
                                ?>

                            </h5>

                        <?php
                        }
                        ?>

                    </div>
                    <div class="col-md-6 ps-5 pb-0 pt-2 pe-0">
                        <?php
                        $ambilData2 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected2'");
                        while ($data2 = mysqli_fetch_assoc($ambilData2)) {
                        ?>

                            <table id="waktuOperasiGudang2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Operasi Gudang</th>
                                        <th>Average Waktu Operasi Gudang</th>
                                        <th>Stdev Waktu Operasi Gudang</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                    $individualAverages1 = [];
                                    $stdevValuesGudang2 = [];

                                    foreach ($dataOperasiGudang2 as $index => $value) {
                                        $arrayExcludingCurrentValue = $dataOperasiGudang2;
                                        unset($arrayExcludingCurrentValue[$index]);

                                        // Reindex the array
                                        $arrayExcludingCurrentValue = array_values($arrayExcludingCurrentValue);

                                        $meanValue = count($arrayExcludingCurrentValue) > 0 ? array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue) : 0;

                                        $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                            return pow($x - $meanValue, 2);
                                        }, $arrayExcludingCurrentValue);

                                        $meanSquaredDifferences = count($arrayExcludingCurrentValue) > 0 ? array_sum($squaredDifferences) / count($arrayExcludingCurrentValue) : 0;

                                        $stdevValue = sqrt($meanSquaredDifferences);

                                        // Update the arrays
                                        $individualAverages1[] = $meanValue;
                                        $stdevValuesGudang2[] = $stdevValue;

                                        echo '<tr>
                                            <td>' . ($index + 1) . '</td>
                                            <td>' . $dataOperasiGudang2[$index] . '</td>
                                            <td>' . $meanValue . '</td>
                                            <td>' . $stdevValue . '</td>
                                        </tr>';
                                    }
                                    ?>


                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $sum = array_sum($dataOperasiGudang2);
                                        echo "<th>" . $sum . "</th>";
                                        ?>
                                        <?php
                                        $rataRata2 = array_sum($dataOperasiGudang2) / count($dataOperasiGudang2);
                                        echo "<th>" . $rataRata2 . "</th>";
                                        ?>

                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minWaktuOperasiGudang2" style="display: flex;">
                                Minimum Waktu Operasi Gudang:
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $min = min($dataOperasiGudang2);
                                echo $min;
                                ?>

                            </h5>

                            <h5 class="m-0 pb-4" id="maxWaktuOperasiGudang2" style="display: flex;">
                                Maximum Waktu Operasi Gudang:
                                <?php
                                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);
                                $max = max($dataOperasiGudang2);
                                echo $max;
                                ?>

                            </h5>

                        <?php
                        }
                        ?>
                    </div>



                </div>
                <div class="row mb-3">
                    <h4 class="pb-3 pt-2" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                        Graphic
                    </h4>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8 pb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title"> Waktu Operasi Gudang</p>
                                <canvas id="myChart1" style="width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Rata-rata Waktu Operasi Gudang</p>
                                <canvas id="myChart2" style="width: 100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Stdev Waktu Operasi Gudang</p>
                                <canvas id="myChart3" style="width: 100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>



                <!-- WaktuAntriTruck -->
                <div class="row mt-3 mb-3">
                    <h2 class="pt-2 pb-1" style="display: flex; align-items: center; justify-content: center;">Waktu Antri Truck</h2>
                    <div class="col-md-6 ps-0 pb-0 pt-2 pe-5">
                        <?php
                        $ambilData1 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected1'");
                        while ($data1 = mysqli_fetch_assoc($ambilData1)) {
                        ?>

                            <table id="WaktuAntriTruck1" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Antri Truck</th>
                                        <th>Average Waktu Antri Truck</th>
                                        <th>Stdev Waktu Antri Truck</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk'], true);
                                    $individualAverages2 = [];
                                    $stdevValues = [];

                                    foreach ($dataWaktuAntriTruck1 as $index => $value) {
                                        $arrayExcludingCurrentValue = $dataWaktuAntriTruck1;
                                        unset($arrayExcludingCurrentValue[$index]);
                                        $average = count($arrayExcludingCurrentValue) > 0 ? array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue) : 0;
                                        $meanValue = array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue);
                                        $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                            return pow($x - $meanValue, 2);
                                        }, $arrayExcludingCurrentValue);
                                        $meanSquaredDifferences = count($arrayExcludingCurrentValue) > 0 ? array_sum($squaredDifferences) / count($arrayExcludingCurrentValue) : 0;
                                        $stdevValue = sqrt($meanSquaredDifferences);
                                        $stdevValues[] = $stdevValue;
                                        $individualAverages2[] = $average;

                                        echo '<tr>
                                                <td>' . ($index + 1) . '</td>
                                                <td>' . $dataWaktuAntriTruck1[$index] . '</td>
                                                <td>' . $average . '</td>
                                                <td>' . $stdevValue . '</td>
                                            </tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $sum = array_sum($dataWaktuAntriTruck1);
                                        echo "<th>" . $sum . "</th>";
                                        ?>
                                        <?php
                                        $rataRata2 = array_sum($dataWaktuAntriTruck1) / count($dataWaktuAntriTruck1);
                                        echo "<th>" . $rataRata2 . "</th>";
                                        ?>
                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minWaktuAntriTruk1" style="display: flex;">
                                Minimum Waktu Antri Truk:
                                <?php
                                $minValue = min($dataWaktuAntriTruck1);
                                echo $minValue;
                                ?>
                            </h5>

                            <h5 class="m-0 pb-4" id="maxWaktuAntriTruk1" style="display: flex;">
                                Maximum Waktu Antri Truk:
                                <?php
                                $maxValue = max($dataWaktuAntriTruck1);
                                echo $maxValue;
                                ?>
                            </h5>

                        <?php
                        }
                        ?>
                    </div>

                    <div class="col-md-6 ps-5 pb-0 pt-2 pe-0">
                        <?php
                        $ambilData2 = mysqli_query($conn, "SELECT * FROM hasil where namaSimul = '$selected2'");
                        while ($data2 = mysqli_fetch_assoc($ambilData2)) {
                        ?>

                            <table id="WaktuAntriTruck2" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Waktu Antri Truck</th>
                                        <th>Average Waktu Antri Truck</th>
                                        <th>Stdev Waktu Antri Truck</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk'], true);
                                    $individualAverages22 = [];
                                    $stdevValues2 = [];

                                    foreach ($dataWaktuAntriTruck2 as $index => $value) {
                                        $arrayExcludingCurrentValue = $dataWaktuAntriTruck2;
                                        unset($arrayExcludingCurrentValue[$index]);
                                        $average = count($arrayExcludingCurrentValue) > 0 ? array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue) : 0;
                                        $meanValue = array_sum($arrayExcludingCurrentValue) / count($arrayExcludingCurrentValue);
                                        $squaredDifferences = array_map(function ($x) use ($meanValue) {
                                            return pow($x - $meanValue, 2);
                                        }, $arrayExcludingCurrentValue);
                                        $meanSquaredDifferences = count($arrayExcludingCurrentValue) > 0 ? array_sum($squaredDifferences) / count($arrayExcludingCurrentValue) : 0;
                                        $stdevValue = sqrt($meanSquaredDifferences);
                                        $stdevValues2[] = $stdevValue;
                                        $individualAverages22[] = $average;
                                        echo '<tr>
                                            <td>' . ($index + 1) . '</td>
                                            <td>' . $dataWaktuAntriTruck2[$index] . '</td>
                                            <td>' . $average . '</td>
                                            <td>' . $stdevValue . '</td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th colspan="2">Total</th>
                                        <?php
                                        $sum = array_sum($dataWaktuAntriTruck2);
                                        echo "<th>" . $sum . "</th>";
                                        ?>
                                        <?php
                                        $rataRata2 = array_sum($dataWaktuAntriTruck2) / count($dataWaktuAntriTruck2);
                                        echo "<th>" . $rataRata2 . "</th>";
                                        ?>
                                    </tr>
                                </tfoot>
                            </table>

                            <h5 class="m-0 pb-2" id="minWaktuAntriTruk2" style="display: flex;">
                                Minimum Waktu Antri Truk:
                                <?php
                                $minValue = min($dataWaktuAntriTruck2);
                                echo $minValue;
                                ?>
                            </h5>

                            <h5 class="m-0 pb-4" id="maxWaktuAntriTruk2" style="display: flex;">
                                Maximum Waktu Antri Truk:
                                <?php
                                $maxValue = max($dataWaktuAntriTruck2);
                                echo $maxValue;
                                ?>
                            </h5>

                        <?php
                        }
                        ?>
                    </div>
                </div>
                <div class="row mb-3">
                    <h4 class="pb-3 pt-1" style="display: flex; align-items: center; justify-content: center; text-align: center;">
                        Graphic
                    </h4>
                    <div class="col-md-2">

                    </div>
                    <div class="col-md-8 pb-4">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Waktu Antri Truck</p>
                                <canvas id="myChart4" style="width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Rata-rata Waktu Antri Truck</p>
                                <canvas id="myChart5" style="width:100%;"></canvas>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <p class="card-title">Stdev Waktu Antri Truck</p>
                                <canvas id="myChart6" style="width:100%;"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">

                    </div>
                </div>










        <?php
                $selected1 = $_POST['nama1'];
                $selected2 = $_POST['nama2'];

                $fetchData1 = mysqli_query($conn, "SELECT * FROM hasil WHERE namaSimul = '$selected1'");
                $data1 = mysqli_fetch_assoc($fetchData1);

                $fetchData2 = mysqli_query($conn, "SELECT * FROM hasil WHERE namaSimul = '$selected2'");
                $data2 = mysqli_fetch_assoc($fetchData2);

                $dataOperasiGudang1 = json_decode($data1['waktuOperasiGudang']);
                $dataOperasiGudang2 = json_decode($data2['waktuOperasiGudang']);

                $dataWaktuAntriTruck1 = json_decode($data1['waktuAntriTruk']);
                $dataWaktuAntriTruck2 = json_decode($data2['waktuAntriTruk']);

                $dataIsiGudang1 = json_decode($data1['isiGudang']);
                $dataIsiGudang2 = json_decode($data2['isiGudang']);

                $maxGudang = count($dataOperasiGudang1);
                $xValuesGudang1 = array_map(function ($gudang) {
                    return 'Gudang ' . $gudang;
                }, range(1, $maxGudang));

                $maxTruck = count($dataWaktuAntriTruck1);
                $xValuesTruck1 = array_map(function ($truck) {
                    return 'Truck ' . $truck;
                }, range(1, $maxTruck));

                $countedArrayGudang1 = array_map('count', $dataIsiGudang1);
                $countedArrayGudang2 = array_map('count', $dataIsiGudang2);
            } else {
                echo
                '
        <script>
            alert("Jumlah data tidak sama. Mohon input jumlah data yang sama.");
            window.location.href="compare.php";
        </script>
        ';
            }
        }
        ?>


    </div>









    <script>
        //Waktu Operasi Gudang
        const xValuesGudang1 = <?= json_encode($xValuesGudang1) ?>;
        const chartDataGudang1 = <?= json_encode($dataOperasiGudang1) ?>;
        const chartDataGudang2 = <?= json_encode($dataOperasiGudang2) ?>;
        new Chart("myChart1", {
            type: "line",
            data: {
                labels: xValuesGudang1,
                datasets: [{
                    data: chartDataGudang1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation Data 1',
                }, {
                    data: chartDataGudang2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation Data 2',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });


        const rataData2Gudang = <?= json_encode($individualAverages) ?>;
        const rataData5Gudang = <?= json_encode($individualAverages1) ?>;
        new Chart("myChart2", {
            type: "line",
            data: {
                labels: xValuesGudang1,
                datasets: [{
                    data: rataData2Gudang,
                    borderColor: "blue",
                    fill: false,
                    label: 'Rata-rata Data 2 Line',
                }, {
                    data: rataData5Gudang,
                    borderColor: "yellow",
                    fill: false,
                    label: 'Rata-rata Data 5 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });

        const stdevData1Gudang = <?= json_encode($stdevValuesGudang) ?>;
        const stdevData3Gudang = <?= json_encode($stdevValuesGudang2) ?>;

        new Chart("myChart3", {
            type: "line",
            data: {
                labels: xValuesGudang1,
                datasets: [{
                    data: stdevData1Gudang,
                    borderColor: "blue",
                    fill: false,
                    label: 'stdev Data 1 Line',
                }, {
                    data: stdevData3Gudang,
                    borderColor: "yellow",
                    fill: false,
                    label: 'stdev Data 3 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });



        // waktu Antri Truck
        const xValuesTruck1 = <?= json_encode($xValuesTruck1) ?>;
        const chartDataTruck1 = <?= json_encode($dataWaktuAntriTruck1) ?>;
        const chartDataTruck2 = <?= json_encode($dataWaktuAntriTruck2) ?>;
        new Chart("myChart4", {
            type: "line",
            data: {
                labels: xValuesTruck1,
                datasets: [{
                    data: chartDataTruck1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation Data 1',
                }, {
                    data: chartDataTruck2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation Data 2',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });

        const rataData3 = <?= json_encode($individualAverages2) ?>;
        const rataData6 = <?= json_encode($individualAverages22) ?>;
        new Chart("myChart5", {
            type: "line",
            data: {
                labels: xValuesTruck1,
                datasets: [{
                    data: rataData3,
                    borderColor: "blue",
                    fill: false,
                    label: 'Rata-rata Data 1 Line',
                }, {
                    data: rataData6,
                    borderColor: "yellow",
                    fill: false,
                    label: 'Rata-rata Data 2 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });

        const stdevData2 = <?= json_encode($stdevValues) ?>;
        const stdevData4 = <?= json_encode($stdevValues2) ?>;
        new Chart("myChart6", {
            type: "line",
            data: {
                labels: xValuesTruck1,
                datasets: [{
                    data: stdevData2,
                    borderColor: "blue",
                    fill: false,
                    label: 'stdev Data 1 Line',
                }, {
                    data: stdevData4,
                    borderColor: "yellow",
                    fill: false,
                    label: 'stdev Data 2 Line',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });


        // Create the third chart for counted Gudang data
        const xValuesCountedGudang1 = <?= json_encode($xValuesGudang1) ?>;
        const chartDataCountedGudang1 = <?= json_encode($countedArrayGudang1) ?>;
        const chartDataCountedGudang2 = <?= json_encode($countedArrayGudang2) ?>;

        new Chart("myChart7", {
            type: "line",
            data: {
                labels: xValuesCountedGudang1,
                datasets: [{
                    data: chartDataCountedGudang1,
                    borderColor: "red",
                    fill: false,
                    label: 'Simulation Data 1',
                }, {
                    data: chartDataCountedGudang2,
                    borderColor: "green",
                    fill: false,
                    label: 'Simulation Data 2',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });

        const chartrataTruck1 = <?= json_encode($rataTruck1) ?>;
        const chartrataTruck2 = <?= json_encode($rataTruck2) ?>;
        new Chart("myChart8", {
            type: "line",
            data: {
                labels: xValuesCountedGudang1,
                datasets: [{
                    data: chartrataTruck1,
                    borderColor: "Blue",
                    fill: false,
                    label: 'Rata-rata Data 1',
                }, {
                    data: chartrataTruck2,
                    borderColor: "yellow",
                    fill: false,
                    label: 'Rata-rata Data 2',
                }]
            },
            options: {
                legend: {
                    display: true,
                    position: 'top',
                }
            }
        });
    </script>


</body>

</html>