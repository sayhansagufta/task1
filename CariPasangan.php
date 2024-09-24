<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cari Pasangan Penjumlahan</title>
</head>
<body>

<h2>Masukkan Array dan Target Penjumlahan</h2>


<form method="post">
    <label for="array">Masukkan angka-angka (pisahkan dengan koma):</label><br>
    <input type="text" id="array" name="array" placeholder="Contoh: 2,7,11,15"><br><br>
    
    <label for="target">Masukkan target penjumlahan:</label><br>
    <input type="number" id="target" name="target" placeholder="Contoh: 9"><br><br>
    
    <input type="submit" value="Cari Pasangan">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
    $array_input = $_POST['array'];
    $target = $_POST['target'];

   
    if (empty($array_input) || empty($target)) {
        echo "Silakan masukkan array dan target penjumlahan.";
    } else {
       
        $array = array_map('intval', explode(',', $array_input));

        function cariPasangan($array, $target) {
            if (empty($array)) {
                return "Array kosong, tidak ada pasangan yang bisa dicari.";
            }

            $result = [];


            for ($i = 0; $i < count($array) - 1; $i++) {
                for ($j = $i + 1; $j < count($array); $j++) {
                    if ($array[$i] + $array[$j] == $target) {
                        $result[] = [$i, $j]; 
                    }
                }
            }

            if (empty($result)) {
                return "Tidak ada pasangan indeks yang menghasilkan penjumlahan target.";
            }

            usort($result, function($a, $b) {
                if ($a[0] == $b[0]) {
                    return $a[1] - $b[1];
                }
                return $a[0] - $b[0];
            });

            return $result;
        }


        $hasil = cariPasangan($array, $target);

        if (is_string($hasil)) {

            echo $hasil;
        } else {

            echo "<h3>Pasangan Indeks yang Ditemukan:</h3>";
            foreach ($hasil as $pasangan) {
                echo "Indeks pasangan: (" . $pasangan[0] . ", " . $pasangan[1] . ")<br>";
            }
        }
    }
}
?>

</body>
</html>
