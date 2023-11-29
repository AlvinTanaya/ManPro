<?php 
$con = mysqli_connect('localhost', 'root', '', 'manpro2');
?>

<?php

// Random number generation and math functions
function getRandomFloat($min, $max, $decimalPlaces = 1)
{
    $randomValue = $min + mt_rand() / mt_getrandmax() * ($max - $min);
    return round($randomValue, $decimalPlaces);
}

function isWithinRange($value, $lower, $upper, $tolerance)
{
    return $value >= ($lower - $tolerance) && $value <= ($upper + $tolerance);
}

function convert_to_date($seconds)
{
    $day = 0;
    $hour = 0;
    $minute = 0;
    if ($seconds >=  86400){
        $day = (int) ($seconds / 86400);
        $seconds -= 86400 * $day;
    }
    if ($seconds >= 60 * 60){
        $hour = (int) ($seconds / 3600);
        $seconds -= 3600 * $hour;
    }
    if ($seconds >= 60){
        $minute = (int) ($seconds / 60);
        $seconds -= 60 * $minute;
    }

    $time = array((string)$day, (string)$hour, (string)$minute, (string)$seconds);

    for($i=0; $i<4; $i++){
        if(strlen($time[$i]) < 2){
            $time[$i] = "0".$time[$i];
        }
    }
    return ($time[0] . " " . $time[1] . ":" . $time[2] . ":" . $time[3]);
}

function convert_time_to_min($time)
{
    $day = (int)substr($time, 0, 2) * 60 * 24;
    $hour = (int)substr($time, 3, 5) * 60;
    $minute = (int)substr($time, 6, 8);
    $second = (int)substr($time, 9, 11) / 60;
    
    return (int)($day+ $hour + $minute + $second);
}

function convert_time_to_sec($time)
{
    $day = (int)substr($time, 0, 2) * 24 * 60 * 60;
    $hour = (int)substr($time, 3, 5) * 60 * 60;
    $minute = (int)substr($time, 6, 8) * 60;
    $second = (int)substr($time, 9, 11);
    
    return ($day+ $hour + $minute + $second);
}

function newTruk($id, $i, $jarak, $waktuLoading, $durasiSimulasi, $limit, $limitDelay){
    $delay = rand($limitDelay[0], $limitDelay[1]);
    $limitJarak = $jarak * 20;
    $limitApplied = FALSE;
    $randomTime = "";

    if ($limit){
        if ((($limitJarak * 60) + ($delay * 60)) < ($durasiSimulasi * 60 * 60)){
            $randomTime = (rand(0, ($durasiSimulasi * 60 * 60) - (($limitJarak * 60) + ($delay * 60))));
        }
        $limitApplied = TRUE;
    }
    else{
        $randomTime = (rand(0, ($durasiSimulasi * 60 * 60)));
    }

    $waktuSampaiInSeconds = ((int)$randomTime + ($jarak * 20 * 60) + ($delay * 60));
    
    return array(array($id, $i, $jarak, $waktuLoading, convert_to_date($randomTime),
    convert_to_date($waktuSampaiInSeconds), $delay), $limitApplied);
}


// Yang diminta dari input
$daftarJarak_limit = array(4, 10, 16, 25); // daftar jarak
$totalTruk = 10; // total semua truk jumlahnya berapa
$waktuLoading = array(60, 120); // limit buat random waktu loading dalam satuan menit
$persentaseTruk = array(2, 1, 3, 4); // persentase truk per area
$limitDelay = array(0, 180); // limit buat random delay truk
$durasiSimulasi = 10; // durasi lama simulasi
$limit_percentage = 80; // minimal berapa persen truk yang pasti datang


// untuk proses limit jarak
$daftarJarak = array();
for ($i=0; $i<count($daftarJarak_limit);$i++){
    if ($i == 0){
        $daftarJarak[] = array(1, $daftarJarak_limit[$i] + 1); 
    }
    else{
        $daftarJarak[] = array($daftarJarak_limit[$i - 1] + 1, $daftarJarak_limit[$i] + 1);
    }
}

// menentukan apakah total persentase melebihi input
$total = 0;
$simulasi = true;
foreach ($persentaseTruk as $percentage) {
    $total += $percentage;
}

if ($total > $totalTruk) {
    echo "Total truk melebihi input";
    $simulasi = false;
} elseif ($total < $totalTruk) {
    echo "Total truk kurang dari input";
    $simulasi = false;
}




// memasukkan nilai persentase ke array
$jumlahTruk = array();
foreach ($persentaseTruk as $percentage) {
    $jumlahTruk[] = $percentage;
}


// menghitung persentase
$percentage_num = round($limit_percentage * $totalTruk / 100);
$reachable_limit = 0;

for ($i=0; $i<count($daftarJarak_limit);$i++){
    if ($reachable_limit < $daftarJarak_limit[$i] * 20){
        $reachable_limit = $daftarJarak_limit[$i] * 20;
    }
    else{
        break;
    }
}

// proses randomize truk
$daftarTruk = array();
while (TRUE){
    $all_truk = array();
    $truk_count = $totalTruk;
    $temp_truk = array();
    $id = 1;
    $temp_num = $percentage_num;
    for ($i = 0; $i < count($jumlahTruk); $i++) {
        for ($j = 0; $j < $jumlahTruk[$i]; $j++) {
            $limit = FALSE;
            if($truk_count <= $temp_num){
                $limit = TRUE;
                $temp_num -= 1;
            }
            else{
                $random = rand(0,1);
                if ($random == 0){
                    $limit = TRUE;
                    $temp_num -= 1;
                }
            }
            $lowerBound = $daftarJarak[$i][0];
            $upperBound = $daftarJarak[$i][1];
            $jarak = getRandomFloat($lowerBound, $upperBound, 1);

            //$daftarTruk[] = new Truk($id, $i, $jarak, $waktuLoading, $durasiSimulasi, $limit, $limitDelay, $upperBound);

            $returnFunc = newTruk($id, $i, $jarak, rand($waktuLoading[0], $waktuLoading[1]), $durasiSimulasi, $limit, $limitDelay);
            $temp_truk[] = $returnFunc[0];
            $all_truk[] = $returnFunc[0];

            if ($limit != $returnFunc[1]){
                $temp_num ++;
            }
            $id++;
            $truk_count--;
        }
    }

    // check apakah truk sempat berangkat
    $truk_berangkat = array();
    $truk_tidak_berangkat = array();
    for ($i = 0; $i < count($temp_truk); $i++){
        $departure = convert_time_to_sec($temp_truk[$i][4]);
        if ($departure < $durasiSimulasi * 60 * 60){
            $truk_berangkat[] = $temp_truk[$i];
        }
        else{
            $truk_tidak_berangkat[] = $temp_truk[$i];
        }
    }

    // check apakah truk sempat sampai
    $truk_sampai = array();
    $truk_tidak_sampai = array();
    for ($i = 0; $i < count($truk_berangkat); $i++){
        $arrival = convert_time_to_sec($truk_berangkat[$i][5]);
        if ($arrival < $durasiSimulasi * 60 * 60){
            $truk_sampai[] = $truk_berangkat[$i];
        }
        else{
            $truk_tidak_sampai[] = $truk_berangkat[$i];
        }
    }

    // kalau data sudah mencukupi persentase maka tidak perlu mengulang randomize
    if (count($truk_sampai) >= $percentage_num){
        foreach ($truk_sampai as $truk){
            $daftarTruk[] = $truk;
        }
        break;
    }
}

echo "<h2>Daftar Truk yang sampai:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($daftarTruk as $truk) {
    echo "<tr>";
    echo "<td>" . $truk[0] . "</td>";
    echo "<td>" . $truk[1] . "</td>";
    echo "<td>" . $truk[2] . "</td>";
    echo "<td>" . $truk[3] . "</td>";
    echo "<td>" . $truk[4] . "</td>";
    echo "<td>" . $truk[2] * 20 . "</td>";
    echo "<td>" . $truk[6] . "</td>";
    echo "<td>" . $truk[5] . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";

echo "<h2>Daftar Truk tidak sampai:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($truk_tidak_sampai as $truk) {
    echo "<tr>";
    echo "<td>" . $truk[0] . "</td>";
    echo "<td>" . $truk[1] . "</td>";
    echo "<td>" . $truk[2] . "</td>";
    echo "<td>" . $truk[3] . "</td>";
    echo "<td>" . $truk[4] . "</td>";
    echo "<td>" . $truk[2] * 20 . "</td>";
    echo "<td>" . $truk[6] . "</td>";
    echo "<td>" . $truk[5] . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";

echo "<h2>Daftar Semua Truk:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($all_truk as $truk) {
    echo "<tr>";
    echo "<td>" . $truk[0] . "</td>";
    echo "<td>" . $truk[1] . "</td>";
    echo "<td>" . $truk[2] . "</td>";
    echo "<td>" . $truk[3] . "</td>";
    echo "<td>" . $truk[4] . "</td>";
    echo "<td>" . $truk[2] * 20 . "</td>";
    echo "<td>" . $truk[6] . "</td>";
    echo "<td>" . $truk[5] . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";


// Input Jumlah Gudang
$jumlahGudang = 4;
$kekhususan = array(
    array(1, 1, 1, 1),
    array(1, 0, 0, 0),
    array(0, 1, 0, 0),
    array(0, 0, 0, 1)
);

$kekhususanGudang = array();
for ($i=0; $i < count($kekhususan); $i++){
    $temp = array();
    for ($j=0; $j < count($kekhususan[$i]); $j++){
        if ($kekhususan[$i][$j] == 1){
            $temp[] = $j;
        }
    }
    $kekhususanGudang[] = $temp;
}