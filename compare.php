<?php
require "ok2.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

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


    .custom-border {
        border-right: 1px solid silver;
        border-top: 1px solid silver;
        border-bottom: 1px solid silver;
        padding-right: 10px;
    }

    .custom-border2 {
        border-top: 1px solid silver;
        border-bottom: 1px solid silver;
        padding-right: 10px;
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
                            <button class="nav-link active" id="compare-tab" data-bs-toggle="tab" data-bs-target="#compare" type="button" role="tab" aria-controls="compare" aria-selected="false" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>




    <div class="container-fluid pt-3 pe-5 ps-5 pb-1">

        <form method="post">
            <div class="row mt-4">

                <div class="col-md-2 pb-3">
                    <h1>Compare</h1>
                </div>


                <div class="col-md-3 ps-3 pb-3 pt-2 pe-3">
                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama1">
                            <option value="" disabled selected>Choose Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT nama FROM simul");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="<?= $data['nama']; ?>"><?= $data['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>

                </div>



                <div class="col-md-3 ps-3 pb-3 pt-2 pe-3">


                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama2">
                            <option value="" disabled selected>Choose Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT nama FROM simul");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="<?= $data['nama']; ?>"><?= $data['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>


                </div>



                <div class="col-md-3 ps-3 pb-3 pt-2">

                    <div style="display: flex; align-items: center;">
                        <select class="form-select" aria-label="Simulation Name" name="nama3">
                            <option value="" disabled selected>Choose Simulation Name</option>
                            <?php
                            $ambilSemuaNama = mysqli_query($conn, "SELECT nama FROM simul");
                            while ($data = mysqli_fetch_assoc($ambilSemuaNama)) {
                            ?>
                                <option value="<?= $data['nama']; ?>"><?= $data['nama']; ?></option>
                            <?php
                            }
                            ?>
                        </select>

                    </div>

                </div>
                <div class="col mt-2">
                    <input type="submit" name="submit" class="btn btn-success" value="Submit">
                </div>


            </div>
        </form>

        <?php
        if (isset($_POST['submit'])) {
            $selected1 = $_POST['nama1'];
            $selected2 = $_POST['nama2'];
            $selected3 = $_POST['nama3'];

            // Execute queries to retrieve and count the data
            $result1 = mysqli_query($conn, "SELECT * FROM gudang where namaSimul = '$selected1'");
            $result2 = mysqli_query($conn, "SELECT * FROM gudang where namaSimul = '$selected2'");
            $result3 = mysqli_query($conn, "SELECT * FROM gudang where namaSimul = '$selected3'");
            $result4 = mysqli_query($conn, "SELECT * FROM gudang where namaSimul = '$selected3'");

            $result5 = mysqli_query($conn, "SELECT * FROM simul where nama = '$selected1'");
            $result6 = mysqli_query($conn, "SELECT * FROM simul where nama = '$selected2'");
            $result7 = mysqli_query($conn, "SELECT * FROM simul where nama = '$selected3'");


            $count1 = mysqli_num_rows($result1);
            $count2 = mysqli_num_rows($result2);
            $count3 = mysqli_num_rows($result3);


            // Verify that the counts are equal
            if ($count1 == $count2 && $count2 == $count3 && $count1 == $count3) {
                $i = 1;
        ?>
                <div class="row">
                    <div class="col-md-2 pb-3 pt-2 custom-border">
                        <?php

                        while ($data = mysqli_fetch_assoc($result4)) {
                        ?>
                            <div class="row align-items-center">
                                <h1 class="m-0 mb-2">gudang <?= $i++; ?></h1>
                            </div>


                        <?php } ?>
                        <h1 class="m-0 mb-2">Waktu Loading</h1>
                    </div>

                    <div class="col-md-3 ps-3 pb-3 pt-2 pe-3 custom-border">
                        <?php


                        while ($data = mysqli_fetch_assoc($result1)) {
                        ?>
                            <h1 class="m-0 mb-2"><?= $data['isiGudang']; ?></h1>

                        <?php }

                        $waktu = mysqli_fetch_assoc($result5);
                        ?>

                        <h1 class="m-0 mb-2" id="waktuLoading1" value="<?= $waktu['waktuLoading']; ?>"><?= $waktu['waktuLoading']; ?></h1>


                    </div>

                    <div class="col-md-3 ps-3 pb-3 pt-2 pe-3 custom-border">
                        <?php
                        while ($data = mysqli_fetch_assoc($result2)) {
                        ?>
                            <h1 class="m-0 mb-2"><?= $data['isiGudang']; ?></h1>

                        <?php }

                        $waktu = mysqli_fetch_assoc($result6);
                        ?>

                        <h1 class="m-0 mb-2" id="waktuLoading2" value="<?= $waktu['waktuLoading']; ?>"><?= $waktu['waktuLoading']; ?></h1>

                    </div>

                    <div class="col-md-3 ps-3 pb-3 pt-2 custom-border2">
                        <?php
                        while ($data = mysqli_fetch_assoc($result3)) {
                        ?>
                            <h1 class="m-0 mb-2"><?= $data['isiGudang']; ?></h1>
                        <?php }

                        $waktu = mysqli_fetch_assoc($result7);
                        ?>

                        <h1 class="m-0 mb-2" id="waktuLoading3" value="<?= $waktu['waktuLoading']; ?>"><?= $waktu['waktuLoading']; ?></h1>

                    </div>

                </div>

                <div class="row mb-3 mt-5">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Loading Time</h5>
                                <canvas id="barPlot1" class="chart-container"></canvas>

                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Waiting Time</h5>
                                <canvas id="barPlot2" class="chart-container"></canvas>
                            </div>
                        </div>
                    </div> -->
                </div>
                <!-- <div class="row">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Truck Distance</h5>
                                <canvas id="barPlot3" class="chart-container"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Truck Content</h5>
                                <canvas id="barPlot4" class="chart-container"></canvas>
                            </div>
                        </div>
                    </div>
                </div> -->

        <?php
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



        <!-- <div class="row">
            <div class="col-md-2 mb-3 mt-2">
                <h1 class="m-0">Compare</h1>
            </div>
            <div id="verticalLine"></div>

            <div class="col-md-3 ms-3 mb-3 mt-2 me-3">

            </div>
            <div id="verticalLine"></div>

            <div class="col-md-3 ms-3 mb-3 mt-2 me-3">


            </div>
            <div id="verticalLine"></div>

            <div class="col-md-3 ms-3 mb-3 mt-2">


            </div>

            <div id="horizontalLine"></div>

        </div> -->



    </div>




    <script>
        var ctx1 = document.getElementById("barPlot1").getContext("2d");
        var barPlot1 = new Chart(ctx1, {
            type: "bar",
            data: {
                labels: ["Simulasi 1", "Simulasi 2", "Simulasi 3"],
                datasets: [{
                    label: "Loading Time (s)",
                    data: [],
                    backgroundColor: "#20c997",
                    borderWidth: 2,
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        display: true,
                        beginAtZero: true
                    },
                    y: {
                        display: true,
                        beginAtZero: true
                    }
                }
            }
        });

        // var ctx2 = document.getElementById("barPlot2").getContext("2d");
        // var barPlot2 = new Chart(ctx2, {
        //     type: "bar",
        //     data: {
        //         labels: [],
        //         datasets: [{
        //             label: "Waiting Time (s)",
        //             data: [],
        //             borderColor: "#198754",
        //             borderWidth: 2,
        //             fill: false
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         scales: {
        //             x: {
        //                 display: true,
        //                 beginAtZero: true
        //             },
        //             y: {
        //                 display: true,
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // var ctx3 = document.getElementById("barPlot3").getContext("2d");
        // var barPlot3 = new Chart(ctx3, {
        //     type: "bar",
        //     data: {
        //         labels: [],
        //         datasets: [{
        //             label: "Truck Distance (Km)",
        //             data: [],
        //             borderColor: "#198754",
        //             borderWidth: 2,
        //             fill: false
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         scales: {
        //             x: {
        //                 display: true,
        //                 beginAtZero: true
        //             },
        //             y: {
        //                 display: true,
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });

        // var ctx4 = document.getElementById("barPlot4").getContext("2d");
        // var barPlot4 = new Chart(ctx4, {
        //     type: "bar",
        //     data: {
        //         labels: [],
        //         datasets: [{
        //             label: "Truck Content (Kg)",
        //             data: [],
        //             borderColor: "#20c997",
        //             borderWidth: 2,
        //             fill: false
        //         }]
        //     },
        //     options: {
        //         responsive: true,
        //         scales: {
        //             x: {
        //                 display: true,
        //                 beginAtZero: true
        //             },
        //             y: {
        //                 display: true,
        //                 beginAtZero: true
        //             }
        //         }
        //     }
        // });


        const waktuLoadingIds = ["waktuLoading1", "waktuLoading2", "waktuLoading3"];
        const loadingTimeData = [];

        waktuLoadingIds.forEach((id, index) => {
            const waktuLoadingElement = document.getElementById(id);
            const loadingTimeDataAttribute = waktuLoadingElement.getAttribute("value");
            const loadingTimeDataArray = JSON.parse("[" + loadingTimeDataAttribute + "]");
            loadingTimeData[index] = loadingTimeDataArray;
        });

        barPlot1.data.datasets[0].data[0] = loadingTimeData[0];
        barPlot1.data.datasets[0].data[1] = loadingTimeData[1];
        barPlot1.data.datasets[0].data[2] = loadingTimeData[2];
        barPlot1.update();
    </script>
</body>

</html>