<?php
// require "function.php";
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

    <title>Manpro Simulation Truck</title>

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
                            <button class="nav-link active" id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" onclick="redirectToIndex()" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type "button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Data</button>
                            <button class="nav-link" id="timing-tab" data-bs-toggle="tab" data-bs-target="#timing" type="button" role="tab" aria-controls="timing" aria-selected="false" onclick="redirectToCompare()" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>


    <div class="container p-5">
        <form id="addDataForm" method="POST">
            <h1>Input Data</h1>
            <div class="mb-3">
                <label for="inputNamaSimul" class="form-label">Simulation Name</label>
                <input name="namaSimulasi" type="text" class="form-control" id="inputNamaSimul">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for="inputJumlahArea" class="form-label">Area Amount</label>
                        <input type="number" name="jumlahArea" class="form-control" id="inputJumlahArea">
                    </div>
                    <div class="col-md-6">
                        <label for="inputTotalTruck" class="form-label">Total Truck</label>
                        <input type="number" name="jumlahTruck" class="form-control" id="inputTotalTruck">
                    </div>
                </div>
                <button class="btn btn-primary mt-3" type="button" id="button1">Set</button>
            </div>


            <div class="mb-3" id="result1">
                <!-- Content generated by JavaScript will be displayed here -->
            </div>

            <div class="mb-3">
                <label for="inputJumlahGudang" class="form-label">Warehouse Amount</label>
                <input type="number" name="jumlahGudang" class="form-control" id="inputJumlahGudang">
                <button class="btn btn-primary mt-3" type="button" id="button2">Set</button>
            </div>

            <div id="result2">
                <!-- Content generated by JavaScript will be displayed here -->
            </div>

            <div class="mb-3 pt-2">
                <label for="inputWaktuLoading" class="form-label">Loading Time</label>
                <input type="number" name="waktuLoading" class="form-control" id="inputWaktuLoading">
            </div>

            <div class="mb-3">
                <label for="inputDurasiSimul" class="form-label">Duration</label>
                <input type="number" name="durasiSimul" class="form-control" id="inputDurasiSimul">
            </div>

            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>


    <!-- <script>
        const coba = document.getElementById('addDataForm"');
        coba.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior

            // Display an alert message
            alert("Edit barang gagal karena nama barang sudah ada! Mohon menginput nama barang yang baru!");

            // Redirect the user
            window.location.href = "coba.php";
        });
    </script> -->

    <script>
        const form1 = document.getElementById('addDataForm');
        const resultDiv1 = document.getElementById('result1');
        const resultDiv2 = document.getElementById('result2');
        const button1 = document.getElementById('button1');
        const button2 = document.getElementById('button2');

        button1.addEventListener('click', function() {
            functionForButton1();
        });

        button2.addEventListener('click', function() {
            functionForButton2();
        });

        function functionForButton1() {
            const jumlahArea = document.getElementById('inputJumlahArea').value;
            const jumlahTruck = document.getElementById('inputTotalTruck').value;

            // Create a variable to hold the content
            let newPageContent = `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="inputJarakAwal" class="form-label">Jarak Awal</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="inputJarakAkhir" class="form-label">Jarak Akhir</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="inputPresentaseTruck" class="form-label">Presentase Jumlah Truck</label>
                        </div>
                    </div>
                    `;

            for (let i = 1; i <= jumlahArea; i++) {
                // Concatenate the content for each input
                newPageContent += `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <input type="number" name="jarakAwal${i}" class="form-control" id="inputJarakAwal${i}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <input type="number" name="jarakAkhir${i}" class="form-control" id="inputJarakAkhir${i}">
                        </div>
                        <div class="col-md-3 mb-3 pe-0">
                            <input type="number" name="presentaseTruck${i}" class="form-control" id="inputPresentaseTruck${i}">
                            
                        </div>
                        <div class="col-md-1 mb-3 ps-0">
                            <span class="input-group-text text-center" id="basic-addon2">%</span>
                        </div>
                        
                    </div>
                `;
            }

            // Display the new page content
            resultDiv1.innerHTML = newPageContent;
        }

        function functionForButton2() {
            const jumlahGudang = document.getElementById('inputJumlahGudang').value;
            const jumlahArea = document.getElementById('inputJumlahArea').value;

            // Create a variable to hold the content
            let newPageContent2 = `
                        <h1>Pilih Kekhususan</h1>
                    `;

            // Generate checkboxes based on jumlahGudang
            for (let i = 1; i <= jumlahGudang; i++) {
                newPageContent2 += `
                        <b>Gudang ${i}</b>
                        `;
                for (let j = 1; j <= jumlahArea; j++) {
                    newPageContent2 += `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="${i}khusus${j}">
                                <label class="form-check-label" for="${i}khusus${j}">
                                    Area ${j}
                                </label>
                             </div>
                            `;
                }
            }

            // Display the new page content
            resultDiv2.innerHTML = newPageContent2;
        }
    </script>


    <!-- <script>
        const form1 = document.getElementById('addDataForm');
        const resultDiv1 = document.getElementById('result1');
        const resultDiv2 = document.getElementById('result2');

        form1.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent the default form submission behavior

            const formData = new FormData(this);
            const buttonValue = formData.get('button');

            if (buttonValue === 'button1') {
                functionForButton1();
            } else if (buttonValue === 'button2') {
                functionForButton2();
            } else {
                alert("Edit barang gagal karena nama barang sudah ada! Mohon menginput nama barang yang baru!");


                window.location.href = "coba.php";
            }

            function functionForButton1() {
                const jumlahArea = document.getElementById('inputJumlahArea').value;
                const jumlahTruck = document.getElementById('inputTotalTruck').value;

                // Create a variable to hold the content
                let newPageContent = `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="inputJarakAwal" class="form-label">Jarak Awal</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="inputJarakAkhir" class="form-label">Jarak Akhir</label>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="inputPresentaseTruck" class="form-label">Presentase Jumlah Truck</label>
                        </div>
                    </div>
                    `;

                for (let i = 1; i <= jumlahArea; i++) {
                    // Concatenate the content for each input
                    newPageContent += `
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <input type="number" name="jarakAwal${i}" class="form-control" id="inputJarakAwal${i}">
                        </div>

                        <div class="col-md-4 mb-3">
                            <input type="number" name="jarakAkhir${i}" class="form-control" id="inputJarakAkhir${i}">
                        </div>
                        <div class="col-md-3 mb-3 pe-0">
                            <input type="number" name="presentaseTruck${i}" class="form-control" id="inputPresentaseTruck${i}">
                            
                        </div>
                        <div class="col-md-1 mb-3 ps-0">
                            <span class="input-group-text text-center" id="basic-addon2">%</span>
                        </div>
                        
                    </div>
                `;
                }

                // Display the new page content
                resultDiv1.innerHTML = newPageContent;
            }

            function functionForButton2() {
                const jumlahGudang = document.getElementById('inputJumlahGudang').value;
                const jumlahArea = document.getElementById('inputJumlahArea').value;

                // Create a variable to hold the content
                let newPageContent2 = `
                        <h1>Pilih Kekhususan</h1>
                    `;

                // Generate checkboxes based on jumlahGudang
                for (let i = 1; i <= jumlahGudang; i++) {
                    newPageContent2 += `
                        <b>Gudang ${i}</b>
                        `;
                    for (let j = 1; j <= jumlahArea; j++) {
                        newPageContent2 += `
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="${i}khusus${j}">
                                <label class="form-check-label" for="${i}khusus${j}">
                                    Area ${j}
                                </label>
                             </div>
                            `;
                    }
                }

                // Display the new page content
                resultDiv2.innerHTML = newPageContent2;
            }


        });
    </script> -->
    <script>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>