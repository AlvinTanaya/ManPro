<?php 
$con = mysqli_connect('localhost', 'root', '', 'manpro2');

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

$rawData = 'Data10';
$sql1 = "SELECT * FROM simulasi RIGHT JOIN rawdata ON simulasi.rawDataName = rawdata.rawDataName WHERE simulasi.rawDataName = '$rawData'";
// mysqli_query($con, "SELECT rawData.totalTruk FROM hasil INNER JOIN rawData ON hasil.rawDataName = rawData.rawDataName WHERE hasil.namaSimul = '$selected1'");
$result = mysqli_query($con, $sql1);

// var_dump($result);

$data = mysqli_fetch_assoc($result);

// var_dump($data);

// $total = $data['persentaseTruk'];
// $data1 = json_decode($data['persentaseTruk']);
// var_dump($data1);
?>

<?php
$daftarJarak_limit = json_decode($data['rangeJarak'], true);
var_dump($daftarJarak_limit);
echo $daftarJarak_limit[1];

// $daftarJarak_limit = array(4, 10, 16, 25);
$daftarJarak = array();
for ($i=1; $i<=count($daftarJarak_limit);$i++){
    if ($i == 1){
        $daftarJarak[] = array(1, $daftarJarak_limit[$i]); 
    }
    else{
        $daftarJarak[] = array($daftarJarak_limit[$i - 1] + 1, $daftarJarak_limit[$i]);
    }
}

echo "<br> daftar jarak <br>";
for ($i=0;$i<count($daftarJarak);$i++){
    echo($daftarJarak[$i][0]. " " .$daftarJarak[$i][1]. "<br>");
}


// Input Total Truk, Loading Time, and Percentage
$totalTruk = $data['totalTruk'];
$waktuLoading = 60; // waktu loading dalam satuan menit
// $persentaseTruk = array(2, 1, 3, 4);
$total = 0;
$simulasi = true;
$limitDelay = array(0, 180);

// foreach ($persentaseTruk as $percentage) {
//     $total += $percentage;
// }

// if ($total > $totalTruk) {
//     echo "Total truk melebihi input";
//     $simulasi = false;
// } elseif ($total < $totalTruk) {
//     echo "Total truk kurang dari input";
//     $simulasi = false;
// }

// Input Jumlah Gudang
$jumlahGudang = $data['jumlahGudang'];
$kekhususan = json_decode($data['spekGudang'], true);

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


// Input Durasi Simulasi Di Jalankan (jam)
$durasiSimulasi = $data['durasi'];

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

// Class to represent Gudang
class Gudang
{
    private $kriteria;
    private $waitList = array();
    private $currentWaktuTunggu = 0;
    private $totalWaktuTunggu = 0;
    private $daftarTruk = array();
    private $waktuOperasi = 0;

    public function __construct($kriteria)
    {
        $this->kriteria = $kriteria;
    }

    public function cekWaitList()
    {
        if (count($this->waitList) > 0) {
            if ($this->currentWaktuTunggu < 1) {
                $truk = array_shift($this->waitList);
                $this->loadingMuatan($truk);
            }
        }
    }

    

    public function loadingMuatan($truk)
    {
        $this->daftarTruk[] = $truk->getID();
        $this->currentWaktuTunggu += $truk->getWaktuLoading();
        $this->waktuOperasi += $truk->getWaktuLoading();
    }

    public function masukWaitList($truk)
    {
        $this->waitList[] = $truk;
        $this->totalWaktuTunggu += $truk->getWaktuLoading();
    }

    public function timeTick()
    {
        if ($this->currentWaktuTunggu > 0) $this->currentWaktuTunggu -= 1;
        if ($this->totalWaktuTunggu > 0) $this->totalWaktuTunggu -= 1;
    }

    public function getCurrentWaktuTunggu()
    {
        return $this->currentWaktuTunggu;
    }

    public function getWaktuOperasi()
    {
        return $this->waktuOperasi;
    }

    public function getTotalWaktuTunggu()
    {
        return $this->totalWaktuTunggu;
    }

    public function getKriteria()
    {
        return $this->kriteria;
    }

    public function getDaftarTruk()
    {
        return $this->daftarTruk;
    }

    public function getWaitList()
    {
        return $this->waitList;
    }


    // Add other methods and properties as needed
}



// Class to represent Truk
class Truk
{
    private $id;
    private $indexJarak;
    private $jarak;
    private $waktuLoading;
    private $waktuBerangkat;
    private $delay;
    private $waktuSampai;
    private $arrived;

    public function __construct($id, $indexJarak, $jarak, $waktuLoading, $waktuBerangkat, $waktuSampai, $waktuDelay)
    {

        $this->id = $id;
        $this->indexJarak = $indexJarak;
        $this->jarak = $jarak;
        $this->waktuLoading = $waktuLoading;
        $this->arrived = FALSE;
        $this->waktuBerangkat = $waktuBerangkat;
        $this->waktuSampai = $waktuSampai;
        $this->delay = $waktuDelay;
    }

    public function setStatus($status)
    {
        $this->arrived = TRUE;
    }

    public function getStatus()
    {
        return $this->arrived;
    }

    public function setDelay($delay)
    {
        $this->delay = $delay;
    }

    public function getDelay()
    {
        return $this->delay;
    }

    public function getWaktuSampai()
    {
        return $this->waktuSampai;
    }


    public function getID()
    {
        return $this->id;
    }

    public function getIndexJarak()
    {
        return $this->indexJarak;
    }

    public function getWaktuLoading()
    {
        return $this->waktuLoading;
    }

    public function getJarak()
    {
        return $this->jarak;
    }

    public function getKriteria()
    {
        return $this->kriteria;
    }

    public function getWaktuBerangkat()
    {
        return $this->waktuBerangkat;
    }

    public function getTravelTime()
    {
        // Calculate travel time based on the criteria (20 minutes for every 1 jarak)
        return $this->jarak * 20;
    }

    public function printInfo()
    {
        echo $this->id . " " . $this->indexJarak . " " . $this->jarak . " " . $this->waktuLoading . " " . $this->randomTime . "<br>";
    }
}

// $contoh_truk = array(
//     // index truk, index jarak, jarak, waktuLoading, waktu Berangkat, waktu perjalanan, delay, waktu sampai 
//     array(1, 0, 2.7, 60, "00 00:02:16", 54, 62, "00 01:58:16"),
//     array(2, 0, 4.7, 60, "00 01:16:07", 94, 10, "00 03:00:07"),
//     array(3, 1, 9.1, 60, "00 07:42:29", 182, 26, "00 11:10:29"),
//     array(4, 2, 15.7, 60, "00 02:45:50", 314, 60, "00 08:59:50"),
//     array(5, 2, 11.5, 60, "00 00:33:14", 230, 172, "00 07:15:14"),
//     array(6, 2, 15.5, 60, "00 01:09:22", 310, 81, "00 07:40:22"),
//     array(7, 3, 18.7, 60, "00 03:04:45", 374, 38, "00 09:56:45"),
//     array(8, 3, 24.8, 60, "00 00:00:00", 496, 157, "00 10:53:00"),
//     array(9, 3, 18.1, 60, "00 03:39:04", 362, 8, "00 09:49:04"),
//     array(10, 3, 19, 60, "00 00:31:36", 380, 91, "00 08:22:36"),
// );

$contoh_truk = json_decode($data['detailTruk'], true);
var_dump($contoh_truk);

// Initialize an array to store Gudang objects
$daftarGudang = array();

// Add Gudang objects to the array
for ($i = 0; $i < $jumlahGudang; $i++) {
    $daftarGudang[] = new Gudang($kekhususanGudang[$i]);
}

echo "<br>______<br>";
$daftarTruk = array();
for ($i=1; $i<=count($contoh_truk); $i++){
    $daftarTruk[] = new Truk($i, $contoh_truk[$i][0], $contoh_truk[$i][1], $contoh_truk[$i][2] * 60, 
    $contoh_truk[$i][3], $contoh_truk[$i][5], $contoh_truk[$i][4]);
}

var_dump($daftarTruk);

// check apakah truk sempat berangkat
$truk_berangkat = array();
$truk_tidak_berangkat = array();
for ($i = 0; $i < count($daftarTruk); $i++){
    $departure = convert_time_to_min($daftarTruk[$i]->getWaktuBerangkat());
    if ($departure < $durasiSimulasi * 60){
        $truk_berangkat[] = $daftarTruk[$i];
    }
    else{
        $truk_tidak_berangkat[] = $daftarTruk[$i];
    }
}

// check apakah truk sempat sampai
$truk_sampai = array();
$truk_tidak_sampai = array();
for ($i = 0; $i < count($truk_berangkat); $i++){
    $arrival = convert_time_to_min($truk_berangkat[$i]->getWaktuSampai());
    if ($arrival < $durasiSimulasi * 60){
        $truk_sampai[] = $truk_berangkat[$i];
    }
    else{
        $truk_tidak_sampai[] = $truk_berangkat[$i];
    }
}

$daftarTruk = array();

foreach ($truk_sampai as $truk){
    $daftarTruk[] = $truk;
}

$daftarWaktuTunggu = array();
foreach ($truk_sampai as $truk){
    $daftarWaktuTunggu[] = 0;
}

// Run the simulation for the specified duration
$durasi = 0;
$daftarTolak = array();

while ($simulasi && $durasi < $durasiSimulasi * 60 + 1) {
    // Check if there are trucks that have finished loading
    for ($i = 0; $i < count($daftarGudang); $i++) {
        $daftarGudang[$i]->cekWaitList();
    }

    // Check if any trucks have arrived
    $arrivalTruk = array();

    for ($i = 0; $i < count($daftarTruk); $i++) {
        if ((convert_time_to_min($daftarTruk[$i]->getWaktuSampai()) < $durasi) && !$daftarTruk[$i]->getStatus()){
            $arrivalTruk[] = $daftarTruk[$i];
            $daftarTruk[$i]->setStatus(TRUE);
        }
    }

    // Process the arrived trucks
    for ($i = 0; $i < count($arrivalTruk); $i++) {
        $jarak = (int) $arrivalTruk[$i]->getIndexJarak();
        $waktuTunggu = $durasiSimulasi;
        $indexGudang = null;

        for ($j = 0; $j < count($daftarGudang); $j++) {
            if (in_array($jarak, $daftarGudang[$j]->getKriteria())){
                $temp = $daftarGudang[$j]->getCurrentWaktuTunggu() + $daftarGudang[$j]->getTotalWaktuTunggu();
                if ($waktuTunggu > $temp) {
                    $indexGudang = $j;
                    $waktuTunggu = $temp;
                }
            }
        }

        if ($indexGudang === null) {
            $daftarTolak[] = $arrivalTruk[$i];
        } elseif ($indexGudang !== null && $waktuTunggu == 0) {
            $daftarGudang[$indexGudang]->loadingMuatan($arrivalTruk[$i]);
        } else {
            $daftarGudang[$indexGudang]->masukWaitList($arrivalTruk[$i]);
            $daftarWaktuTunggu[$i] = $waktuTunggu;
        }
    }


    // Advance time for Gudang and the simulation duration
    for ($i = 0; $i < count($daftarGudang); $i++) {
        $daftarGudang[$i]->timeTick();
    }
    $durasi++;
}

echo "<h2>Daftar Truk:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($daftarTruk as $truk) {
    echo "<tr>";
    echo "<td>" . $truk->getID() . "</td>";
    echo "<td>" . $truk->getIndexJarak() . "</td>";
    echo "<td>" . $truk->getJarak() . "</td>";
    echo "<td>" . $truk->getWaktuLoading() . "</td>";
    echo "<td>" . $truk->getWaktuBerangkat() . "</td>";
    echo "<td>" . $truk->getTravelTime() . "</td>";
    echo "<td>" . $truk->getDelay() . "</td>";
    echo "<td>" . $truk->getWaktuSampai() . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";

echo "<h2>Daftar Truk tidak berangkat:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($truk_tidak_berangkat as $truk) {
    echo "<tr>";
    echo "<td>" . $truk->getID() . "</td>";
    echo "<td>" . $truk->getIndexJarak() . "</td>";
    echo "<td>" . $truk->getJarak() . "</td>";
    echo "<td>" . $truk->getWaktuLoading() . "</td>";
    echo "<td>" . $truk->getWaktuBerangkat() . "</td>";
    echo "<td>" . $truk->getTravelTime() . "</td>";
    echo "<td>" . $truk->getDelay() . "</td>";
    echo "<td>" . $truk->getWaktuSampai() . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";

echo "<h2>Daftar Truk tidak sampai:</h2>";
echo "<table border='1'>";
echo "<tr><th>ID</th><th>Index Jarak</th><th>Jarak</th><th>Waktu Loading</th><th>Waktu Berangkat</th><th>Travel Time (min)</th><th>Delay (min)</th><th>Waktu Sampai</th></tr>";

foreach ($truk_tidak_sampai as $truk) {
    echo "<tr>";
    echo "<td>" . $truk->getID() . "</td>";
    echo "<td>" . $truk->getIndexJarak() . "</td>";
    echo "<td>" . $truk->getJarak() . "</td>";
    echo "<td>" . $truk->getWaktuLoading() . "</td>";
    echo "<td>" . $truk->getWaktuBerangkat() . "</td>";
    echo "<td>" . $truk->getTravelTime() . "</td>";
    echo "<td>" . $truk->getDelay() . "</td>";
    echo "<td>" . $truk->getWaktuSampai() . "</td>";  // New 'Waktu Sampai' column
    echo "</tr>";
}

echo "</table>";

// Create an instance of the Gudang class and specify the kriteria
$gudang = new Gudang($kekhususanGudang);

// Access the daftarTruk property using the getDaftarTruk() method
$daftarTruk = $gudang->getDaftarTruk();

// Now, you can work with the $daftarTruk array as needed
foreach ($daftarTruk as $truk) {
    // Do something with each $truk object
    $truk->printInfo();
}


// Print the list of trucks in each warehouse
echo "Daftar Isi Gudang:<br>";
$count = 1;
foreach ($daftarGudang as $gudang) {
    echo("Gudang ke " . (string)$count . " : ");
    $truk = $gudang->getDaftarTruk();
    foreach ($truk as $i){
        echo($i . " ");
    }
    echo("<br>");
    $count++;
    //echo implode(' ', $gudang->getDaftarTruk()) . "<br>";
}

echo "Truk masih dalam waiting list:<br>";
$count = 1;
foreach ($daftarGudang as $gudang){
    echo("Gudang ke " . (string)$count . " : ");
    $list = $gudang->getWaitList();
    for ($i = 0; $i<count($list); $i++){
        echo ($list[$i] . " ");
    }
    echo("<br>");
    $count++;
}

echo "Waktu Operasi Gudang :<br>";
$daftarWaktuOperasiGudang = array();
$count = 1;
foreach ($daftarGudang as $gudang){
    echo("Gudang ke " . (string)$count . " : ");
    echo $gudang->getWaktuOperasi() . "<br>";
    $daftarWaktuOperasiGudangArray[] = $gudang->getWaktuOperasi();
    $count++;
}

echo "Waktu Tunggu Truk :<br>";
var_dump($daftarWaktuTunggu);

$daftarIsiGudangArray = array();
foreach ($daftarGudang as $gudang) {
    $daftarIsiGudangArray[] = $gudang->getDaftarTruk();
}

// var_dump($daftarWaktuTunggu);
echo "<br>";
// var_dump($daftarIsiGudangArray);

// var_dump($daftarWaktuTunggu);

// $sqlInsert = "INSERT INTO hasil (namaSimul, daftarIsiGudang, waktuOperasiGudang, waktuAntriTruk, rawDataName) VALUES ('Cobaba', '$daftarIsiGudangArray', $waktuOperasi, '$daftarWaktuTunggu', '$rawData')";
$sqlInsert = "INSERT INTO hasil (namaSimul, isiGudang, waktuOperasiGudang, waktuAntriTruk, rawDataName) VALUES (?, ?, ?, ?, ?)";


$stmt = mysqli_prepare($con, $sqlInsert);
if ($stmt) {
    $namaSimul = "Coba Simulasi"; // Replace this with the actual simulation name
    $waktuOperasiGudang = json_encode($daftarWaktuOperasiGudangArray);
    $daftarWaktuTunggu = json_encode($daftarWaktuTunggu);
    $daftarIsiGudang = json_encode($daftarIsiGudangArray);
    $rawDataName = $rawData; // Replace this with the actual rawDataName

    mysqli_query($con, "INSERT INTO hasil (namaSimul, isiGudang, waktuOperasiGudang, waktuAntriTruk, rawDataName) VALUES ('$namaSimul', '$daftarIsiGudang', '$waktuOperasiGudang', '$daftarWaktuTunggu', '$rawDataName')");
} else {
    echo "Statement preparation failed: " . mysqli_error($con);
}