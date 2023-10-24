<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
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
                            <button class="nav-link" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" onclick="redirectToIndex()" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type "button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Data</button>
                            <button class="nav-link active" id="compare-tab" data-bs-toggle="tab" data-bs-target="#compare" type "button" role="tab" aria-controls="compare" aria-selected="false" onclick="redirectToCompare()" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>


    <div class="container mt-5">
        <div class="row mb-3">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Loading Time</h5>
                        <canvas id="lineChart1" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Waiting Time</h5>
                        <canvas id="lineChart2" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Truck Distance</h5>
                        <canvas id="lineChart3" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Truck Content</h5>
                        <canvas id="lineChart4" class="chart-container"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <script>
        function generateRandomData(days, isKeuangan) {
            var data = [];
            for (var i = 0; i < days; i++) {
                // Generate larger values for Keuangan (data2)
                var value = isKeuangan ? Math.floor(Math.random() * 20) + 5 : Math.floor(Math.random() * 10) + 1;
                data.push(value);
            }
            return data;
        }

        var ctx1 = document.getElementById("lineChart1").getContext("2d");
        var lineChart1 = new Chart(ctx1, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Loading Time (s)",
                    data: [],
                    borderColor: "rgba(75, 192, 192, 1)",
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

        var ctx2 = document.getElementById("lineChart2").getContext("2d");
        var lineChart2 = new Chart(ctx2, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Waiting Time (s)",
                    data: [],
                    borderColor: "rgba(255, 99, 132, 1)",
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

        var ctx3 = document.getElementById("lineChart3").getContext("2d");
        var lineChart3 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Truck Distance (Km)",
                    data: [],
                    borderColor: "rgba(75, 192, 192, 1)",
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

        var ctx3 = document.getElementById("lineChart4").getContext("2d");
        var lineChart4 = new Chart(ctx3, {
            type: "line",
            data: {
                labels: [],
                datasets: [{
                    label: "Truck Content (Kg)",
                    data: [],
                    borderColor: "rgba(255, 99, 132, 1)",
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