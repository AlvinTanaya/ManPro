<?php 
$con = mysqli_connect('localhost', 'root', '', 'manpro2');
?>

<?php
// Random number generation and math functions
function getRandomInt($min, $max)
{
    return rand($min, $max);
}

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

function convert_time($time)
{
    $hour = (int)substr($time, 0, 2) * 60;
    $minute = (int)substr($time, 3, 5);
    $second = (int)substr($time, 6, 8) / 60;
    
    return ($hour + $minute + $second);
}

// Class to represent Gudang
class Gudang
{
    private $kriteria;
    private $waitList = array();
    private $currentWaktuTunggu = 0;
    private $totalWaktuTunggu = 0;
    private $daftarTruk = array();

    public function __construct($kriteria)
    {
        $this->kriteria = $kriteria;
    }

    public function cekWaitList()
    {
        if (count($this->waitList) > 0) {
            if ($this->currentWaktuTunggu < 60) {
                $this->loadingMuatan(array_shift($this->waitList));
            }
        }
    }

    public function loadingMuatan($truk)
    {
        $this->daftarTruk[] = $truk->getID();
        $this->currentWaktuTunggu += $truk->getWaktuLoading() * 60;
    }

    public function masukWaitList($truk)
    {
        $this->waitList[] = $truk;
        $this->totalWaktuTunggu += $truk->getWaktuLoading() * 60;
    }

    public function timeTick()
    {
        if ($this->currentWaktuTunggu > 0) $this->currentWaktuTunggu -= 60;
        if ($this->totalWaktuTunggu > 0) $this->totalWaktuTunggu -= 60;
    }

    public function getCurrentWaktuTunggu()
    {
        return $this->currentWaktuTunggu;
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
    private $kriteria;
    private $randomTime;
    private $delay;
    private $waktuSampai;
    private $arrived;

    public function __construct($id, $indexJarak, $jarak, $waktuLoading, $durasiSimulasi)
    {
        $this->id = $id;
        $this->indexJarak = $indexJarak;
        $this->jarak = $jarak;
        $this->waktuLoading = $waktuLoading;
        $this->arrived = FALSE;

        // Generate a random time within the specified range
        $this->randomTime = date("H:i:s", strtotime("00:00:00") + rand(0, $durasiSimulasi * 3600));
        $this->delay = getRandomInt(0, 180);

        $waktuSampaiInMinutes = strtotime($this->getRandomTime()) + $this->getTravelTime() * 60 + $this->getDelay() * 60;

        // Format 'Waktu Sampai' to 24-hour time
        $this->waktuSampai = date("H:i:s", $waktuSampaiInMinutes);
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

    public function getRandomTime()
    {
        return $this->randomTime;
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


// Input Range Jarak
// langsung ambil dari database
$daftarJarak = array(
    array(1, 5),
    array(5, 11),
    array(11, 17),
    array(17, 26)
);


// Input Total Truk, Loading Time, and Percentage
$totalTruk = 10;
$waktuLoading = 1; // waktu loading dalam satuan jam
$persentaseTruk = array(2, 1, 3, 4);
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

// Input Jumlah Gudang
$jumlahGudang = 4;

// Input Kekhususan Gudang
// $kekhususanGudang = array(
//     array(0, 1, 2, 3),
//     array(0),
//     array(1),
//     array(3)
// );
// tak convert jadi sesuai database
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

for ($i=0; $i < count($kekhususanGudang); $i++){
    $temp = "";
    for ($j=0; $j < count($kekhususanGudang[$i]); $j++){
        $temp .= (string)$kekhususanGudang[$i][$j];
        $temp .= " ";
    }
    echo($temp . "<br>");
}

// $kekhususanGudang = array(
//     array(0),
//     array(1),
//     array(2),
//     array(3)
// );

// Input Durasi Simulasi Di Jalankan (jam)
$durasiSimulasi = 10;

// Initialize an array to store Gudang objects
$daftarGudang = array();

// Add Gudang objects to the array
for ($i = 0; $i < $jumlahGudang; $i++) {
    $daftarGudang[] = new Gudang($kekhususanGudang[$i]);
}

// Determine the number of trucks for each category
$jumlahTruk = array();

foreach ($persentaseTruk as $percentage) {
    $jumlahTruk[] = $percentage;
}

// Initialize an array to store Truk objects
$daftarTruk = array();
$id = 1;

// Randomize truck distances based on their range
for ($i = 0; $i < count($jumlahTruk); $i++) {
    for ($j = 0; $j < $jumlahTruk[$i]; $j++) {
        $lowerBound = $daftarJarak[$i][0];
        $upperBound = $daftarJarak[$i][1];
        $jarak = getRandomFloat($lowerBound, $upperBound, 1);

        $daftarTruk[] = new Truk($id, $i, $jarak, $waktuLoading, $durasiSimulasi);
        $id++;
    }
}

// check apakah truk sempat berangkat
$truk_berangkat = array();
$truk_tidak_berangkat = array();
for ($i = 0; $i < count($daftarTruk); $i++){
    $departure = convert_time($daftarTruk[$i]->getRandomTime());
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
    $arrival = convert_time($truk_berangkat[$i]->getWaktuSampai());
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

// Run the simulation for the specified duration
$durasi = 0;
$daftarTolak = array();

while ($simulasi && $durasi < $durasiSimulasi) {
    // Check if there are trucks that have finished loading
    for ($i = 0; $i < count($daftarGudang); $i++) {
        $daftarGudang[$i]->cekWaitList();
    }

    // Check if any trucks have arrived
    $arrivalTruk = array();

    // for ($i = 0; $i < count($daftarTruk); $i++) {
    //     if ($daftarTruk[$i]->getJarak() == $durasi) {
    //         $arrivalTruk[] = $daftarTruk[$i];
    //     }
    // }

    for ($i = 0; $i < count($daftarTruk); $i++) {
        if ((convert_time($daftarTruk[$i]->getWaktuSampai()) < $durasi * 60) && !$daftarTruk[$i]->getStatus()){
            $arrivalTruk[] = $daftarTruk[$i];
            $daftarTruk[$i]->setStatus(TRUE);
        }
    }

    // Process the arrived trucks
    for ($i = 0; $i < count($arrivalTruk); $i++) {
        $jarak = $arrivalTruk[$i]->getJarak();
        $waktuTunggu = $durasiSimulasi;
        $indexGudang = null;

        for ($j = 0; $j < count($daftarGudang); $j++) {
            $temp = $daftarGudang[$j]->getCurrentWaktuTunggu() + $daftarGudang[$j]->getTotalWaktuTunggu();

            // Check if the truck's distance falls within the range of the warehouse criteria
            $tolerance = 0.1; // Adjust the tolerance as needed
            $lowerBound = $daftarJarak[$j][0];
            $upperBound = $daftarJarak[$j][1];

            if (isWithinRange($jarak, $lowerBound, $upperBound, $tolerance)) {
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
            // Set the delay for each truck
            $arrivalTruk[$i]->setDelay(getRandomInt(0, 180));

            $daftarGudang[$indexGudang]->loadingMuatan($arrivalTruk[$i]);
        } else {
            $daftarGudang[$indexGudang]->masukWaitList($arrivalTruk[$i]);
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
    echo "<td>" . $truk->getRandomTime() . "</td>";
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
    echo "<td>" . $truk->getRandomTime() . "</td>";
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
    echo "<td>" . $truk->getRandomTime() . "</td>";
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