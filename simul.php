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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.6/css/dataTables.bootstrap5.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"> -->
    <script>
    var $jq = jQuery.noConflict();
    $jq(document).ready(function() {

        $jq("#index-tab").click(function() {
            window.location.href = "index.php";
        });

        $jq("#data-tab").click(function() {
            window.location.href = "raw_data.php";
        });

        $jq("#compare-tab").click(function() {
            window.location.href = "compare.php";
        });

        $jq("#simul-tab").click(function() {
            window.location.href = "simul.php";
        });
    });
</script>
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
                            <button class="nav-link " id="index-tab" data-bs-toggle="tab" data-bs-target="#index" type="button" role="tab" aria-controls="home" aria-selected="false" style="color: black;">Input</button>
                            <button class="nav-link" id="data-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Data</button>
                            <button class="nav-link active" id="simul-tab" data-bs-toggle="tab" data-bs-target="#data" type="button" role="tab" aria-controls="data" aria-selected="false" style="color: black;">Simulation</button>
                            <button class="nav-link" id="compare-tab" data-bs-toggle="tab" data-bs-target="#timing" type="button" role="tab" aria-controls="timing" aria-selected="false" style="color: black;">Compare</button>
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
            <form action="insert_simul.php" method="POST" id="formLayout">
                <div class="formbold-steps">
                    <ul>
                        <li class="formbold-step-menu1 active">
                            <span>1</span>
                            Choose
                        </li>
                        <li class="formbold-step-menu2">
                            <span>2</span>
                            Warehouse Specifity
                        </li>
                        <li class="formbold-step-menu3">
                            <span>3</span>
                            Confirmation page
                        </li>
                    </ul>
                </div>


                <div class="formbold-form-step-1 active">
                    <div>
                        <div>
                            <label for="SimulationName" class="formbold-form-label"> Simulation Name <span style="color: red;">*</span></label>
                            <input type="text" name="simulationName" placeholder="Simulation One" id="simulationName" class="formbold-form-input" required />
                        </div>

                        <div>
                            <label for="RawDataName" class="formbold-form-label"> Raw Data Name <span style="color: red;">*</span></label>
                            <select name="RawDataName" placeholder="Choose Raw Data Name" id="RawDataName" class="formbold-form-input">
                                <?php
                                    include('ok2.php');
                                    $namaRawData = mysqli_query($conn, "Select * from rawdata");
                                    while($c = mysqli_fetch_array($namaRawData)){
                                ?>
                                <option value ="<?php echo $c['id'] ?>"> <?php echo $c['rawDataName'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div>
                        <div>
                            <label for="truckContent" class="formbold-form-label"> Warehouse Amount <span style="color: red;">*</span> </label>
                            <input type="text" name="warehouseAmount" placeholder="4" id="warehouseAmount" class="formbold-form-input" required />
                        </div>
                    </div>
                    </div>

                </div>

                <div class="formbold-form-step-2">

                </div>

                <div class="formbold-form-step-3">

                </div>

                <div class="formbold-form-btn-wrapper">
                    <button class="formbold-back-btn">
                        Back
                    </button>

                    <button id="button1" name="addSimul" type="submit" class="formbold-btn" onclick="submitFormData()">
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
</body>

<script>
    function redirectToIndex() {
        // Redirect the user to raw_data.php
        window.location.href = "index.php";
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

    function submitFormData() {
        // formSubmitBtn.addEventListener("click", function(event){ 
        // event.preventDefault()
        if (stepMenuOne.className == 'formbold-step-menu1 active') {
            event.preventDefault()
            // const jumlahArea = document.getElementById('areaAmount').value;
            // let defaultTruckPercentage = 0

            // let newPageContent = `
            //     `;
            // for (let i = 1; i <= jumlahArea; i++) {
            //     // Concatenate the content for each input
            //     newPageContent += `
            //     <div class="formbold-input-flex">
            //             <div>
            //                 <label for="jarakAwal${i}" class="formbold-form-label">Jarak Awal <span style="color: red;">*</span></label>
            //                 <input name="jarakAwal${i}" type="number" placeholder="0"class="formbold-form-input" id="inputJarakAwal${i}" required>
            //             </div>
            //             <div>
            //                 <label for="jarakAkhir${i}" class="formbold-form-label">Jarak Akhir <span style="color: red;">*</span></label>
            //                 <input name="jarakAkhir${i}" type="number" placeholder="3" class="formbold-form-input" id="inputJarakAkhir${i}" required>
            //             </div>
            //             <div>
            //                 <label for="truckPercentage${i}" class="formbold-form-label">Truck Percentage(%) <span style="color: red;">*</span></label>
            //                 <input name="truckPercentage${i}" type="number" class="formbold-form-input" id="inputTruckPercentage${i}" required>
            //             </div>
            //         </div>
            //     `;
            // }
            // stepTwo.innerHTML = newPageContent;

            const optionData = document.getElementById('RawDataName').value;
            // console.log(optionData);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'takeData.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            var data = 'optionData=' + encodeURIComponent(optionData);

            // Send the request
            var jumarea = 0
            xhr.send(data);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Handle the response from PHP if needed
                    jumarea = xhr.responseText;
                    console.log(jumarea);
                    const jumlahGudang = document.getElementById("warehouseAmount").value;

                    let newPageContent = `
                    `;
                    for (let i = 1; i <= jumlahGudang; i++) {
                        newPageContent += `
                        <div>
                                <label class="formbold-form-label"> Warehouse Specificity ${i} </label>
                        `;
                        for (let j = 1; j <= jumarea; j++) {
                            // Concatenate the content for each input
                            newPageContent += `
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="${i}warehouseSpecifity${j}" id="${i}warehouseSpecifity${j}">
                                    <label class="form-check-label" for="${i}warehouseSpecifity${j}">Area ${j}</label>
                                </div>
                        `;
                        }
                        newPageContent += `
                        </div>
                    `;
                    }
                    stepTwo.innerHTML = newPageContent;
                }
            };
            // const jumlahArea = <?php
            //                         $jumarea = mysqli_query($conn, "Select * from rawdata");
            //                         $idarea = ?> optionData<?php;
            //                         echo $idarea;
            //                         while ($c =  mysqli_fetch_array($jumarea)){
            //                             echo $c['jumlahArea'];
            //                         }
            //                     ?>;
            // console.log(jumlahArea);
            // const jumlahGudang = document.getElementById("warehouseAmount").value;

            // let newPageContent = `
            // `;
            // for (let i = 1; i <= jumlahGudang; i++) {
            //     newPageContent += `
            //     <div>
            //             <label class="formbold-form-label"> Warehouse Specificity ${i} </label>
            //     `;
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
            // stepTwo.innerHTML = newPageContent;

            stepMenuOne.classList.remove('active')
            stepMenuTwo.classList.add('active')

            stepOne.classList.remove('active')
            stepTwo.classList.add('active')

            formBackBtn.classList.add('active')
            formBackBtn.addEventListener("click", function(event) {
                event.preventDefault()

                stepMenuOne.classList.add('active')
                stepMenuTwo.classList.remove('active')

                stepOne.classList.add('active')
                stepTwo.classList.remove('active')

                formBackBtn.classList.remove('active')

            })

        } else if (stepMenuTwo.className == 'formbold-step-menu2 active') {
            let newPageContent = `
                    <div class="formbold-form-confirm">
                        <p>
                            Are you certain you want to submit these data?
                        </p>
                    </div>
                `;
            event.preventDefault()
            // const jumlahArea = document.getElementById('areaAmount').value;
            // const jumlahGudang = document.getElementById("warehouseAmount").value;

            // let newPageContent = `
            // `;
            // for (let i = 1; i <= jumlahGudang; i++) {
            //     newPageContent += `
            //     <div>
            //             <label class="formbold-form-label"> Warehouse Specificity ${i} </label>
            //     `;
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

            formBackBtn.classList.remove('active')
            formSubmitBtn.textContent = 'Submit'
        } else if (stepMenuThree.className == 'formbold-step-menu3 active') {
            // document.querySelector("form").submit()
            Swal.fire({
                title: 'Success!',
                text: 'Data has been saved!',
                icon: 'success',
                timer: 1000, // 5000 milliseconds (5 seconds)
                showConfirmButton: false, // To prevent users from closing it manually
            }).then(() => {
                document.querySelector("form").submit()
            });
        }
    }
</script>

</html>