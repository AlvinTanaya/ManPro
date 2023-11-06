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

    <title>Warehouse Simulator</title>

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



        .formbold-main-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px;
            width: 100%;
        }

        .formbold-form-wrapper {
            margin: 0 auto;
            max-width: 700px;
            width: 100%;
            background: white;
        }

        .formbold-steps {
            padding-bottom: 18px;
            margin-bottom: 35px;
            border-bottom: 1px solid #DDE3EC;
        }

        .formbold-steps ul {
            padding: 0;
            margin: 0;
            list-style: none;
            display: flex;
            gap: 40px;
        }

        .formbold-steps li {
            display: flex;
            align-items: center;
            gap: 14px;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            color: #536387;
        }

        .formbold-steps li span {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #DDE3EC;
            border-radius: 50%;
            width: 36px;
            height: 36px;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            color: #536387;
        }

        .formbold-steps li.active {
            color: #07074D;
            ;
        }

        .formbold-steps li.active span {
            background: #198754;
            color: #FFFFFF;
        }

        .formbold-input-flex {
            display: flex;
            gap: 20px;
            margin-bottom: 22px;
        }

        .formbold-input-flex>div {
            width: 50%;
        }

        .formbold-form-input {
            width: 100%;
            padding: 13px 22px;
            border-radius: 5px;
            border: 1px solid #DDE3EC;
            background: #FFFFFF;
            font-weight: 500;
            font-size: 16px;
            color: #536387;
            outline: none;
            resize: none;
        }

        .formbold-form-input:focus {
            border-color: #198754;
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }

        .formbold-form-label {
            color: #07074D;
            font-weight: 500;
            font-size: 14px;
            line-height: 24px;
            display: block;
            margin-bottom: 10px;
        }

        .formbold-form-confirm {
            border-bottom: 1px solid #DDE3EC;
            padding-bottom: 35px;
        }

        .formbold-form-confirm p {
            font-size: 16px;
            line-height: 24px;
            color: #536387;
            margin-bottom: 22px;
            width: 75%;
        }

        .formbold-form-confirm>div {
            display: flex;
            gap: 15px;
        }

        .formbold-confirm-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #FFFFFF;
            border: 0.5px solid #DDE3EC;
            border-radius: 5px;
            font-size: 16px;
            line-height: 24px;
            color: #536387;
            cursor: pointer;
            padding: 10px 20px;
            transition: all .3s ease-in-out;
        }

        .formbold-confirm-btn {
            box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.12);
        }

        .formbold-confirm-btn.active {
            background: #198754;
            color: #FFFFFF;
        }

        .formbold-form-step-1,
        .formbold-form-step-2,
        .formbold-form-step-3 {
            display: none;
        }

        .formbold-form-step-1.active,
        .formbold-form-step-2.active,
        .formbold-form-step-3.active {
            display: block;
        }

        .formbold-form-btn-wrapper {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 25px;
            margin-top: 25px;
        }

        .formbold-back-btn {
            cursor: pointer;
            background: #FFFFFF;
            border: none;
            color: #07074D;
            font-weight: 500;
            font-size: 16px;
            line-height: 24px;
            display: none;
        }

        .formbold-back-btn.active {
            display: block;
        }

        .formbold-btn {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 16px;
            border-radius: 5px;
            padding: 10px 25px;
            border: none;
            font-weight: 500;
            background-color: #198754;
            color: white;
            cursor: pointer;
        }

        .formbold-btn:hover {
            box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.05);
        }

        .formbold-form-label {
            font-size: 18px;
        }

        .form-check-label {
            font-size: 18px;
        }

        .form-check-input {
            transform: scale(1.5);
            margin-right: 10px;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg bg-success py-3">
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
                            <button class="nav-link active " id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" onclick="redirectToIndex()" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" onclick="redirectToData()" style="color: black;">Data</button>
                            <button class="nav-link" id="simul-tab" data-bs-toggle="tab" data-bs-target="#simul" type="button" role="tab" aria-controls="simul" aria-selected="false" onclick="redirectToSimul()" style="color: black;">Simulation</button>
                            <button class="nav-link" id="timing-tab" data-bs-toggle="tab" data-bs-target="#timing" type="button" role="tab" aria-controls="timing" aria-selected="false" onclick="redirectToCompare()" style="color: black;">Compare</button>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </nav>

    <div class="formbold-main-wrapper">
        <!-- Author: FormBold Team -->
        <!-- Learn More: https://formbold.com -->
        <div class="formbold-form-wrapper">
            <form action="insert_data.php" method="POST" id="formLayout">
                <div class="formbold-steps">
                    <ul>
                        <li class="formbold-step-menu1 active">
                            <span>1</span>
                            Raw Data Information
                        </li>
                        <li class="formbold-step-menu2">
                            <span>2</span>
                            Truck Percentage
                        </li>
                        <li class="formbold-step-menu3">
                            <span>3</span>
                            Confirmation
                        </li>
                    </ul>
                </div>


                <div class="formbold-form-step-1 active">
                    <div>
                        <div>
                            <label for="SimulationName" class="formbold-form-label"> Raw Data Name <span style="color: red;">*</span></label>
                            <input type="text" name="simulationName" placeholder="Simulation One" id="simulationName" class="formbold-form-input" required />
                        </div>
                    </div>

                    <div class="formbold-input-flex">
                        <div>
                            <label for="areaAmount" class="formbold-form-label"> Area Amount <span style="color: red;">*</span> </label>
                            <input type="number" name="areaAmount" placeholder="3" id="areaAmount" class="formbold-form-input" required />
                        </div>
                        <div>
                            <label for="totalTruck" class="formbold-form-label"> Total Truck <span style="color: red;">*</span> </label>
                            <input type="number" name="totalTruck" placeholder="2" id="totalTruck" class="formbold-form-input" required />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="duration" class="formbold-form-label"> Duration(hours) <span style="color: red;">*</span></label>
                            <input type="duration" name="duration" id="duration" placeholder="24 hours" class="formbold-form-input" required />
                        </div>
                    </div>
                    <div>
                        <div>
                            <label for="truckContent" class="formbold-form-label"> Warehouse Amount <span style="color: red;">*</span> </label>
                            <input type="text" name="warehouseAmount" placeholder="4" id="warehouseAmount" class="formbold-form-input" required />
                        </div>
                    </div>
                </div>

                <div class="formbold-form-step-2">

                </div>

                <div class="formbold-form-step-3">
                    <div class="formbold-form-confirm">
                        <p>
                            Are you certain you want to submit these data?
                        </p>
                    </div>
                </div>
                <div class="formbold-form-btn-wrapper">
                    <button id="BACK" class="formbold-back-btn" identify="">
                        Back
                    </button>

                    <button id="button1" name="addData" type="submit" class="formbold-btn" onclick="submitFormData()">
                        Next Step
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1675_1807)">
                                <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1675_1807">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    </button>
                </div>
            </form>
        </div>
    </div>



    <!-- <div class="container p-4 shadowed-square">
        <form id="addDataForm" method="POST" action="insert_data.php">
            <h2>Input form</h2>
            <h6>Plese fill out the following information for the simulation</h6>
            <br>
            <div class="mb-3">
                <label for="inputNamaSimul" class="form-label">Simulation Name <span style="color: red;">*</span></label>
                <input name="namaSimulasi" type="text" class="form-control required-label" id="inputNamaSimul" required>
            </div>

            <div class="mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <label for "inputJumlahArea" class="form-label">Area Amount<span style="color: red;">*</span></label>
                        <input type="number" name="jumlahArea" class="form-control required-label" id="inputJumlahArea" required>
                    </div>
                    <div class="col-md-6">
                        <label for="inputTotalTruck" class="form-label">Total Truck<span style="color: red;">*</span></label>
                        <input type="number" name="jumlahTruck" class="form-control required-label" id="inputTotalTruck" required>
                    </div>
                </div>
                <button class="btn btn-success mt-3" type="button" id="button1">Set</button>
            </div>

            <div class="mb-3" id="result1">
            </div>

            <div class="mb-3">
                <label for="inputJumlahGudang" class="form-label">Warehouse Amount<span style="color: red;">*</span></label>
                <input type="number" name="jumlahGudang" class="form-control" id="inputJumlahGudang" required>
                <button class="btn btn-success mt-3" type="button" id="button2">Set</button>
            </div>

            <div id="result2">
                Content generated by JavaScript will be displayed here
            </div>

<div class="mb-3 pt-2">
                <label for="inputWaktuLoading" class="form-label">Loading Time<span style="color: red;">*</span></label>
                <input type="number" name="waktuLoading" class="form-control" id="inputWaktuLoading" required>
            </div>

            <div class="mb-3">
                <label for="inputDurasiSimul" class="form-label">Duration<span style="color: red;">*</span></label>
                <input type="number" name="durasiSimul" class="form-control" id="inputDurasiSimul" required>
            </div>
            <button type="button" class="btn btn-success" onclick="success()">Add</button>
        </form>
    </div> -->
    <script>
        var formData = {}
    </script>

    <!-- <script>
        function getFormValues() {
            console.log("getformvalue funct")
            var form = document.querySelector('.formbold-form-step-1.active');

            // var inputs = form.querySelectorAll('input');
            // for (var i = 0; i < inputs.length; i++) {
            //     var input = inputs[i];
            //     formData[input.name] = input.value;
            // }

            // for (var i = 0; i < formData['totalTruck']; i++) {}
        }
        // Call the function when a button is clicked (e.g., "Next Step" button)
        var nextButton = document.getElementById('button1');
        nextButton.addEventListener('click', getFormValues);
    </script> -->



    <script>
        // const form1 = document.getElementById('addDataForm');
        // const resultDiv1 = document.getElementById('result1');
        // const resultDiv2 = document.getElementById('result2');
        // const button1 = document.getElementById('button1');
        // const button2 = document.getElementById('button2');

        // button1.addEventListener('click', function() {
        //     functionForButton1();
        // });

        // button2.addEventListener('click', function() {
        //     functionForButton2();
        // });

        // function functionForButton1() {
        //     const jumlahArea = document.getElementById('inputJumlahArea').value;
        //     const jumlahTruck = document.getElementById('inputTotalTruck').value;

        //     // Create a variable to hold the content
        //     let newPageContent = `
        //         <div class="row">
        //             <div class="col-md-4 mb-3">
        //                 <label for="inputJarakAwal" class="form-label">Jarak Awal <span style="color: red;">*</span></label>
        //             </div>
        //             <div class="col-md-4 mb-3">
        //                 <label for="inputJarakAkhir" class="form-label">Jarak Akhir <span style="color: red;">*</span></label>
        //             </div>
        //             <div class="col-md-4 mb-3">
        //                 <label for="inputPresentaseTruck" class="form-label">Presentase Jumlah Truck <span style="color: red;">*</span></label>
        //             </div>
        //         </div>
        //     `;

        //     for (let i = 1; i <= jumlahArea; i++) {
        //         // Concatenate the content for each input
        //         newPageContent += `
        //             <div class="row">
        //                 <div class="col-md-4 mb-3">
        //                     <input type="number" name="jarakAwal${i}" class="form-control" id="inputJarakAwal${i}">
        //                 </div>

        //                 <div class="col-md-4 mb-3">
        //                     <input type="number" name="jarakAkhir${i}" class="form-control" id="inputJarakAkhir${i}">
        //                 </div>
        //                 <div class="col-md-3 mb-3 pe-0">
        //                     <input type="number" name="presentaseTruck${i}" class="form-control" id="inputPresentaseTruck${i}">
        //                 </div>
        //                 <div class="col-md-1 mb-3 ps-0">
        //                     <span class="input-group-text text-center" id="basic-addon2">%</span>
        //                 </div>
        //             </div>
        //         `;
        //     }

        //     // Display the new page content
        //     resultDiv1.innerHTML = newPageContent;
        // }

        // function functionForButton2() {
        //     const jumlahGudang = document.getElementById('inputJumlahGudang').value;
        //     const jumlahArea = document.getElementById('inputJumlahArea').value;

        //     // Create a variable to hold the content
        //     let newPageContent2 = `
        //         <h3>Choose Warehouse Specifity</h3>
        //     `;

        //     // Generate checkboxes based on jumlahGudang
        //     for (let i = 1; i <= jumlahGudang; i++) {
        //         newPageContent2 += `
        //             <b>Gudang ${i}</b>
        //         `;
        //         for (let j = 1; j <= jumlahArea; j++) {
        //             newPageContent2 += `
        //                 <div class="form-check">
        //                     <input class="form-check-input" type="checkbox" name="${i}khusus${j}">
        //                     <label class="form-check-label" for="${i}khusus${j}">
        //                         Area ${j}
        //                     </label>
        //                 </div>
        //             `;
        //         }
        //     }

        //     // Display the new page content
        //     resultDiv2.innerHTML = newPageContent2;
        // }
    </script>

    <script>
        function redirectToIndex() {
            // Redirect the user to index.php
            window.location.href = "index.php";
        }

        function success() {
            Swal.fire({
                title: 'Success!',
                text: 'Data has been saved!',
                icon: 'success',
                timer: 1000, // 5000 milliseconds (5 seconds)
                showConfirmButton: false, // To prevent users from closing it manually
            }).then(() => {
                document.getElementById("addDataForm").submit();
            });
        }

        // ini buat kalo nggak berhasil masuk datanya, tolong nti yang back end buatin ya thank you
        function failed() {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                timer: 1000,
            }).then(() => {
                location.reload();
            })
        }



        function redirectToData() {
            // Redirect the user to raw_data.php
            window.location.href = "raw_data.php";
        }

        function redirectToCompare() {
            // Redirect the user to compare.php
            window.location.href = "compare.php";
        }

        function redirectToSimul() {
            // Redirect the user to compare.php
            window.location.href = "simul.php";
        }


        const stepMenuOne = document.querySelector('.formbold-step-menu1')
        const stepMenuTwo = document.querySelector('.formbold-step-menu2')
        const stepMenuThree = document.querySelector('.formbold-step-menu3')

        const stepOne = document.querySelector('.formbold-form-step-1')
        const stepTwo = document.querySelector('.formbold-form-step-2')
        const stepThree = document.querySelector('.formbold-form-step-3')

        const formSubmitBtn = document.querySelector('.formbold-btn')

        const formBackBtn = document.querySelector('.formbold-back-btn')
        const backBtn = document.getElementById("BACK")

        formBackBtn.addEventListener("click", function(event) {

            var identify = document.getElementById("BACK").getAttribute("identify")
            if (identify == "btn1") {
                console.log("back 1")
                event.preventDefault()

                stepMenuOne.classList.add('active')
                stepMenuTwo.classList.remove('active')

                stepOne.classList.add('active')
                stepTwo.classList.remove('active')
                backBtn.setAttribute("identify", "")
                formBackBtn.classList.remove('active')
            } else if(identify == "btn2") {
                console.log("back 2")
                event.preventDefault()

                stepMenuTwo.classList.add('active')
                stepMenuThree.classList.remove('active')

                stepTwo.classList.add('active')
                stepThree.classList.remove('active')
                backBtn.setAttribute("identify", "btn1")
                formSubmitBtn.innerHTML = `Next Step
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_1675_1807)">
                                <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white" />
                            </g>
                            <defs>
                                <clipPath id="clip0_1675_1807">
                                    <rect width="16" height="16" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>`
            }


            // formBackBtn.classList.remove('active')

        })

        function submitFormData() {
            // formSubmitBtn.addEventListener("click", function(event){ 
            // event.preventDefault()
            console.log(stepMenuOne.className);
            console.log(stepMenuTwo.className);
            console.log(stepMenuThree.className);
            if (stepMenuOne.className == 'formbold-step-menu1 active') {
                event.preventDefault()
                const jumlahArea = document.getElementById('areaAmount').value;
                const totalTruck = document.getElementById('totalTruck').value;
                // let defaultTruckPercentage = 0
                // if(totalTruck >=jumlahArea){
                //     defaultTruckPercentage = totalTruck/
                // }

                let newPageContent = `
                <p>
                    Please specify the percentage, starting distance, and ending distance you would like to use for the simulation.
                </p>
                `;
                for (let i = 1; i <= jumlahArea; i++) {
                    // Concatenate the content for each input
                    newPageContent += `
                <div class="formbold-input-flex">
                        <div>
                            <label for="jarakAwal${i}" class="formbold-form-label">Start Distance <span style="color: red;">*</span></label>
                            <input name="jarakAwal${i}" type="number" placeholder="0"class="formbold-form-input" id="inputJarakAwal${i}" required>
                        </div>
                        <div>
                            <label for="jarakAkhir${i}" class="formbold-form-label">End Distance <span style="color: red;">*</span></label>
                            <input name="jarakAkhir${i}" type="number" placeholder="3" class="formbold-form-input" id="inputJarakAkhir${i}" required>
                        </div>
                        <div>
                            <label for="truckPercentage${i}" class="formbold-form-label">Truck Percentage(%) <span style="color: red;">*</span></label>
                            <input name="truckPercentage${i}" type="number" class="formbold-form-input" id="inputTruckPercentage${i}" required>
                        </div>
                    </div>
                `;
                }
                stepTwo.innerHTML = newPageContent;

                stepMenuOne.classList.remove('active')
                stepMenuTwo.classList.add('active')

                stepOne.classList.remove('active')
                stepTwo.classList.add('active')

                formBackBtn.classList.add('active')
                backBtn.setAttribute("identify", "btn1")


                console.log("-------------")
                console.log(stepMenuOne.className);
                console.log(stepMenuTwo.className);
                console.log(stepMenuThree.className);

                console.log("-------------")


            } else if (stepMenuTwo.className == 'formbold-step-menu2 active') {
                event.preventDefault()

                // const jumlahArea = document.getElementById('areaAmount').value;
                // const jumlahGudang = document.getElementById("warehouseAmount").value;

                // let newPageContent = `
                // `;
                // for (let i = 1; i <= jumlahGudang; i++) {
                //     //     newPageContent += `
                //     // <div>
                //     //         <label class="formbold-form-label"> Warehouse Specificity ${i} </label>
                //     // `;
                //     for (let j = 1; j <= jumlahArea; j++) {
                //         // Concatenate the content for each input
                //         newPageContent += `
                //             <div class="form-check">
                //                 <input class="form-check-input" type="checkbox" name="${i}warehouseSpecifity${j}" id="${i}warehouseSpecifity${j}">
                //                 <label class="form-check-label" for="${i}warehouseSpecifity${j}">Area ${j}</label>
                //             </div>
                //     `;
                //     }
                //     newPageContent += `
                //     </div>
                // `;
                // }
                // stepThree.innerHTML = newPageContent;
                stepMenuTwo.classList.remove('active')
                stepMenuThree.classList.add('active')

                stepTwo.classList.remove('active')
                stepThree.classList.add('active')

                formBackBtn.classList.add('active')
                backBtn.setAttribute("identify", "btn2")

                console.log("-------------")
                console.log(stepMenuOne.className);
                console.log(stepMenuTwo.className);
                console.log(stepMenuThree.className);

                console.log("-------------")


                // formBackBtn.addEventListener("click", function(event) {
                //     console.log("back 2")
                //     event.preventDefault()

                //     console.log("-------------")
                //     console.log(stepMenuOne.className);
                //     console.log(stepMenuTwo.className);
                //     console.log(stepMenuThree.className);

                //     console.log("-------------")
                //     stepMenuTwo.classList.add('active')
                //     stepMenuThree.classList.remove('active')

                //     stepTwo.classList.add('active')
                //     stepThree.classList.remove('active')

                //     formSubmitBtn.innerHTML = `Next Step
                //         <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                //             <g clip-path="url(#clip0_1675_1807)">
                //                 <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white" />
                //             </g>
                //             <defs>
                //                 <clipPath id="clip0_1675_1807">
                //                     <rect width="16" height="16" fill="white" />
                //                 </clipPath>
                //             </defs>
                //         </svg>`
                //     // formBackBtn.classList.remove('active')
                //     // step.classList.remove('active')

                // })

                // formBackBtn.classList.remove('active')
                formSubmitBtn.textContent = 'Submit'
            } else if (stepMenuThree.className == 'formbold-step-menu3 active') {
                // document.querySelector("form").submit()
                // formBackBtn.classList.remove('active')

                // formBackBtn.addEventListener("click", function(event) {
                //     console.log("back 2")
                //     event.preventDefault()

                //     console.log("-------------")
                //     console.log(stepMenuOne.className);
                //     console.log(stepMenuTwo.className);
                //     console.log(stepMenuThree.className);

                //     console.log("-------------")
                //     stepMenuTwo.classList.add('active')
                //     stepMenuThree.classList.remove('active')
                //     stepMenuOne.classList.remove('active')


                //     stepTwo.classList.add('active')
                //     stepThree.classList.remove('active')
                //     stepOne.classList.remove('active')

                //     formSubmitBtn.innerHTML = `Next Step
                //         <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                //             <g clip-path="url(#clip0_1675_1807)">
                //                 <path d="M10.7814 7.33312L7.20541 3.75712L8.14808 2.81445L13.3334 7.99979L8.14808 13.1851L7.20541 12.2425L10.7814 8.66645H2.66675V7.33312H10.7814Z" fill="white" />
                //             </g>
                //             <defs>
                //                 <clipPath id="clip0_1675_1807">
                //                     <rect width="16" height="16" fill="white" />
                //                 </clipPath>
                //             </defs>
                //         </svg>`
                //     // formBackBtn.classList.remove('active')
                //     // step.classList.remove('active')

                // })

                Swal.fire({
                    title: 'Success!',
                    text: 'Data has been saved!',
                    icon: 'success',
                    timer: 3000, // 5000 milliseconds (5 seconds)
                    showConfirmButton: false, // To prevent users from closing it manually
                }).then(() => {
                    document.querySelector("form").submit()
                });
            }


        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>