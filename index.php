<?php

// data array multi dimensi
$paltfrom = [
                "Sedan" => ['biaya_platform' => 10000, 'biayaperkilometer' => 5000],
                "Minivan" => ['biaya_platform' => 12000, 'biayaperkilometer' => 6000],
                "Minibus" => ['biaya_platform' => 15000, 'biayaperkilometer' => 10000],
                "Sepeda Motor" => ['biaya_platform' => 5000, 'biayaperkilometer' => 3000],
                "pickup" => ['biaya_platform' => 15000, 'biayaperkilometer' => 8000]
            ];

// data array satu dimensi
$kendaraan = (['Minibus', 'Minivan', 'Sepeda Motor', 'Pickup', 'Sedan']);

// menggunakan sort(ascending) untuk mengurutkan data array satu dimensi
sort($kendaraan);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Taxi Online</title>
    <!-- Menghubungkan dengan library/berkas CSS. -->
    <link rel="stylesheet" href="css/bootstrap.css">
</head>
<body>
   
    <div class="container mt-4" >
            <div class="row justify-content-center">
                <img src="img/logo.jpg" alt="" width="70px" height="70px">
                <h1 class="ml-3">Pemesanan Taxi Online</h1>
            </div> 
            <div class="card mt-4 p-4">
                <div class="card-body shadow-lg rounded-4 transparent-cards">
                    <form method="POST" action="" id="Form Pemesanan">
                        <div class="row mb-3">
                            <label for="nama" class="col-sm-2 col-form-label">Nama Pelangggan</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukan Nama" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="no_hp" class="col-sm-2 col-form-label">No Hp</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" id="no_hp" name="no_hp" placeholder="Masukan No Hp" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jenis_kendaraan" class="col-sm-2 col-form-label">Jenis Kendaraan</label>
                            <div class="col-sm-10 ">
                                <select class="form-select" id="jenis_kendaraan" name="jenis_kendaraan" aria-label="Default select example">
                                    <option selected>- Jenis Kendaran - </option>
                                    <?php
                                    // Menampilkan dropdown pilihan jenis kendaraan berdasarkan data pada array $kendaraan menggunakan perulangan.
                                    foreach ($kendaraan as $jenis) {
                                        
                                        echo "<option value='$jenis'>$jenis</option>";
                                    }
                                
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="jarak" class="col-sm-2 col-form-label">Jarak</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="jarak" name="jarak" placeholder="Masukan Jarak" required>
                            </div>
                        </div>

                            <button type="submit" name="submit" value="submit" class="btn btn-primary mb-3">Submit</button>
                        
                        </form>
                        
                        <?php
                            
                            if (isset($_POST['submit'])) {
                            
                            // 	Variabel $DataPesanan berisi data-data pemesanan dari form dalam bentuk array.
                            $DataPesanan= array(

                                'nama' => $_POST['nama'],
                                'no_hp' => $_POST['no_hp'],
                                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                                'jarak' => $_POST['jarak'],
                            );
                                
                              // Simpan jarak yang telah dimasukkan oleh pengguna dalam variabel $Jarak_Tempuh
                            $Jarak_Tempuh = $_POST['jarak'];

                            // Simpan biaya platform dan biaya sewa per kilometer dalam variabel $biayaPlatform dan $biaya_Perkilometer
                            $biayaPlatform = 0;
                            $biaya_Perkilometer = 0;

                            // Gunakan pencabangan untuk menentukan biaya platform dan biaya sewa per kilometer

                            if ($_POST['jenis_kendaraan'] == 'Sedan') {     // Mendefinisikan biaya platform berdasarkan jenis kendaraan
                                $biayaPlatform = 10000;
                            }elseif ($_POST['jenis_kendaraan'] == 'Minivan') {
                                $biayaPlatform = 12000;
                            }elseif ($_POST['jenis_kendaraan'] == "Minibus") {
                                $biayaPlatform = 15000;
                            }elseif ($_POST['jenis_kendaraan'] == "Sepeda Motor") {
                                $biayaPlatform = 5000;
                            }elseif ($_POST['jenis_kendaraan'] == "Pickup") {
                                $biayaPlatform = 15000;
                            }

                            if ($_POST['jenis_kendaraan'] == 'Sedan') {    // Mendefinisikan biaya sewa per kilometer berdasarkan jenis kendaraan
                                $biaya_Perkilometer = 5000;
                            }elseif ($_POST['jenis_kendaraan'] == 'Minivan') {
                                $biaya_Perkilometer = 6000;
                            }elseif ($_POST['jenis_kendaraan'] == 'Minibus') {
                                $biaya_Perkilometer = 10000;
                            }elseif ($_POST['jenis_kendaraan'] == 'Sepeda Motor') {
                                $biaya_Perkilometer = 3000;
                            }elseif ($_POST['jenis_kendaraan'] == 'Pickup') {
                                $biaya_Perkilometer = 8000;
                            }

                            // Buat fungsi hitungSewa untuk menghitung biaya sewa
                            // Fungsi ini menerima 3 parameter yaitu $Jarak_Tempuh, $biaya_Perkilometer, dan $biayaPlatform
                            function hitungSewa($Jarak_Tempuh, $biaya_Perkilometer, $biaya_platform){

                            return $biaya_platform + ($Jarak_Tempuh * $biaya_Perkilometer); // menghitung biaya sewa
                            }
                            // Simpan hasil perhitungan biaya sewa dalam variabel $biayaSewa
                            $biayaSewa = hitungSewa($Jarak_Tempuh, $biaya_Perkilometer, $biayaPlatform); // Biaya sewa yang harus dibayar oleh pelanggan

                            // Array data pemesanan yang akan disimpan dalam file JSON 
                            $DataPesanan = array(
                                'nama' => $_POST['nama'],
                                'no_hp' => $_POST['no_hp'],
                                'jenis_kendaraan' => $_POST['jenis_kendaraan'],
                                'jarak' => $_POST['jarak'],
                            );
                        
                            $jsonData = json_encode($DataPesanan); // Mengubah array menjadi JSON
                            file_put_contents('data/data.json', $jsonData); // Menyimpan data pemesanan dalam file JSON
                            
                            // Menampilkan data pemesanan yang telah disimpan dalam file JSON
                            echo "----------------- Pemesanan Taxi Online -----------------";
                            echo  " 

                            <br>
                            
                            <div class='container mt-2'>
                            
                                        <div class='row'>
                                            <!-- Menampilkan nama pelanggan. -->
                                            <div class='col-lg-2'>Nama Pelanggan:</div>
                                            <div class='col-lg-2'>".$DataPesanan['nama']."</div>
                                        </div>
                                        <div class='row'>
                                            <!-- Menampilkan nomor HP pelanggan. -->
                                            <div class='col-lg-2'>Nomor HP:</div>
                                            <div class='col-lg-2'>".$DataPesanan['no_hp']."</div>
                                        </div>
                                        <div class='row'>
                                            <!-- Menampilkan Jenis Kendaraan Taxi Online. -->
                                            <div class='col-lg-2'>Jenis Kendaraan:</div>
                                            <div class='col-lg-2'>".$DataPesanan['jenis_kendaraan']."</div>
                                        </div>
                                        <div class='row'>
                                            <!-- Menampilkan jumlah Jarak Tempuh. -->
                                            <div class='col-lg-2'>Jarak(km):</div>
                                            <div class='col-lg-2'>".$DataPesanan['jarak']." km</div>
                                        </div>
                                        <div class='row'>
                                            <!-- Menampilkan Total Tagihan. -->
                                            <div class='col-lg-2'>Total:</div>
                                            <div class='col-lg-2'>Rp".number_format($biayaSewa, 0, ".", ".").",-</div>
                                        </div> 
                                </div>
                            ";
                        }
                        
                        ?>
                        
            </div>
        </div>
    </div>

    <!-- Tabel Kendaraan -->

    <div class="d-flex justify-content-center mt-3">
    <div class="col-md-6">
            <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col"><center>Jenis Kendaran</center></th>
                <th scope="col"><center>Biaya Platform</center></th>
                <th scope="col"><center>Biaya PerkiloMeter</center></th>
                </tr>
            </thead>
            <tbody class="text-center">
            
                <?php
                foreach ($paltfrom as $key => $value) { // Menampilkan data array multi dimensi menggunakan perulangan foreach
                        echo "<tr>";
                        echo "<td>" . $key . "</td>" ;
                        echo "<td>" . $value['biaya_platform'] . "</td>" ;
                        echo "<td>". $value['biayaperkilometer']. "</td>" ;
                        echo "</tr>";
                }
                
                ?>
            </tbody>
            </table>
            </div>
        </div>

</body>
</html>