<?php
// Random number generation and math functions
function getRandomInt($min, $max) {
    return rand($min, $max);
}

// Class to represent Gudang
class Gudang {
    private $kriteria;
    private $waitList = array();
    private $currentWaktuTunggu = 0;
    private $totalWaktuTunggu = 0;
    private $daftarTruk = array();

    public function __construct($kriteria) {
        $this->kriteria = $kriteria;
    }

    public function cekWaitList() {
        if (count($this->waitList) > 0) {
            if ($this->currentWaktuTunggu < 1) {
                $this->loadingMuatan(array_shift($this->waitList));
            }
        }
    }

    public function loadingMuatan($truk) {
        $this->daftarTruk[] = $truk->getID();
        $this->currentWaktuTunggu += $truk->getWaktuLoading();
    }

    public function masukWaitList($truk) {
        $this->waitList[] = $truk;
    }

    public function timeTick() {
        if ($this->currentWaktuTunggu > 0) $this->currentWaktuTunggu -= 1;
        if ($this->totalWaktuTunggu > 0) $this->totalWaktuTunggu -= 1;
    }

    public function getCurrentWaktuTunggu() {
        return $this->currentWaktuTunggu;
    }

    public function getTotalWaktuTunggu() {
        return $this->totalWaktuTunggu;
    }

    public function getKriteria() {
        return $this->kriteria;
    }

    public function getDaftarTruk() {
        return $this->daftarTruk;
    }
    

    // Add other methods and properties as needed
}



// Class to represent Truk
class Truk {
    private $id;
    private $indexJarak;
    private $jarak;
    private $waktuLoading;
    private $kriteria;

    public function __construct($id, $indexJarak, $jarak, $waktuLoading) {
        $this->id = $id;
        $this->indexJarak = $indexJarak;
        $this->jarak = $jarak;
        $this->waktuLoading = $waktuLoading;
    }

    public function getID() {
        return $this->id;
    }

    public function getIndexJarak() {
        return $this->indexJarak;
    }

    public function getWaktuLoading() {
        return $this->waktuLoading;
    }

    public function getJarak() {
        return $this->jarak;
    }

    public function getKriteria() {
        return $this->kriteria;
    }

    public function printInfo() {
        echo $this->id . " " . $this->indexJarak . " " . $this->jarak . " " . $this->waktuLoading . "<br>";
    }
}


// Input Range Jarak
$daftarJarak = array(
    array(1, 4),
    array(5, 10),
    array(11, 16),
    array(17, 25)
);

// Input Total Truk, Loading Time, and Percentage
$totalTruk = 10;
$waktuLoading = 3;
$persentaseTruk = array(20, 10, 30, 40);
$total = 0;
$simulasi = true;

foreach ($persentaseTruk as $percentage) {
    $total += $percentage;
}

if ($total > 100) {
    echo "Total persentase lebih dari 100%";
    $simulasi = false;
} elseif ($total < 100) {
    echo "Total persentase kurang dari 100%";
    $simulasi = false;
}

// Input Jumlah Gudang
$jumlahGudang = 4;

// Input Kekhususan Gudang
$kekhususanGudang = array(
    array(0, 1, 2, 3),
    array(0),
    array(1),
    array(3)
);

// Input Durasi Simulasi Di Jalankan
$durasiSimulasi = 50;

// Initialize an array to store Gudang objects
$daftarGudang = array();

// Add Gudang objects to the array
for ($i = 0; $i < $jumlahGudang; $i++) {
    $daftarGudang[] = new Gudang($kekhususanGudang[$i]);
}

// Determine the number of trucks for each category
$jumlahTruk = array();

foreach ($persentaseTruk as $percentage) {
    $jumlah = ($percentage / 100) * $totalTruk;
    if ($jumlah % 1 > 0.5) {
        $jumlah = floor($jumlah) + 1;
    } else {
        $jumlah = floor($jumlah);
    }
    $jumlahTruk[] = $jumlah;
}

// Initialize an array to store Truk objects
$daftarTruk = array();
$id = 1;

// Randomize truck distances based on their range
for ($i = 0; $i < count($jumlahTruk); $i++) {
    for ($j = 0; $j < $jumlahTruk[$i]; $j++) {
        $daftarTruk[] = new Truk($id, $i, getRandomInt($daftarJarak[$i][0], $daftarJarak[$i][1]), $waktuLoading);
        $id++;
    }
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

    for ($i = 0; $i < count($daftarTruk); $i++) {
        if ($daftarTruk[$i]->getJarak() == $durasi) {
            $arrivalTruk[] = $daftarTruk[$i];
        }
    }

    // Process the arrived trucks
    for ($i = 0; $i < count($arrivalTruk); $i++) {
        $jarak = $arrivalTruk[$i]->getIndexJarak();
        $waktuTunggu = $durasiSimulasi;
        $indexGudang = null;

        for ($j = 0; $j < count($daftarGudang); $j++) {
            $temp = $daftarGudang[$j]->getCurrentWaktuTunggu() + $daftarGudang[$j]->getTotalWaktuTunggu();

            if (in_array($jarak, $daftarGudang[$j]->getKriteria()) && $temp == 0) {
                $indexGudang = $j;
                $waktuTunggu = 0;
            } elseif (in_array($jarak, $daftarGudang[$j]->getKriteria())) {
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
        }
    }

    // Advance time for Gudang and the simulation duration
    for ($i = 0; $i < count($daftarGudang); $i++) {
        $daftarGudang[$i]->timeTick();
    }
    $durasi++;
}

// Print truck information
echo "Daftar Truk:<br>";
foreach ($daftarTruk as $truk) {
    $truk->printInfo();
}

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
foreach ($daftarGudang as $gudang) {
    echo implode(' ', $gudang->getDaftarTruk()) . "<br>";
}
