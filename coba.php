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
    <div class="container-fluid p-5">



        <form id="addDataForm" method="POST">
            <h1>
                Input User
            </h1>
            <div class="mb-3">
                <label for="inputNamaSimul" class="form-label">Nama Simulasi</label>
                <input name="namaSimulasi" type="text" class="form-control" id="inputNamaSimul">
            </div>
            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="inputJumlahArea" class="form-label">Jumlah Area</label>
                        <input type="number" name="jumlahArea" class="form-control" id="inputJumlahArea">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="inputTotalTruck" class="form-label">Total Truck</label>
                        <input type="number" name="jumlahTruck" class="form-control" id="inputTotalTruck">
                    </div>


                </div>
                <button class="btn btn-danger" type="button" id="button1">Button 1</button>


            </div>

            <div class="mb-3" id="result1">

            </div>

            <div class="mb-3">
                <label for="inputJumlahGudang" class="form-label">Jumlah Gudang</label>
                <input type="number" name="jumlahGudang" class="form-control" id="inputJumlahGudang">

                <button class="btn btn-primary mt-3" type="button" id="button2">Button 2</button>

            </div>

            <div id="result2">

            </div>

            <div class="mb-3 pt-2">
                <label for="inputWaktuLoading" class="form-label">Waktu Loading</label>
                <input type="number" name="waktuLoading" class="form-control" id="inputWaktuLoading">
            </div>

            <div class="mb-3">
                <label for="inputDurasiSimul" class="form-label">Durasi Simul</label>
                <input type="number" name="durasiSimul" class="form-control" id="inputDurasiSimul">
            </div>

            <button type="submit" class="btn btn-primary justify-content-end" name="addData">Add</button>
        </form>

    </div>


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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>