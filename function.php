<?php 
// query untuk mengkoneksikan ke database, dan menyimpan kedalam variabel connect
$connect = mysqli_connect("localhost", "root", "", "data_barang");
function dataBarang($data){
    global $connect;
	// Menangkap data pada parameter data, lalu memasukkan kedalam variabel
	$no = htmlspecialchars($data["no"]);
	$wo = htmlspecialchars($data["wo"]);
	$nama_sa =$data["nama_sa"];
	$nama_barang = htmlspecialchars($data["nama_barang"]);

	// query untuk memunculkan no dari tabel data_salvage, dan menyimpan kedalam variabel noCheck
	$noCheck = mysqli_query($connect, "SELECT no FROM data_salvage WHERE no = '$no'");
	// jika data yang ada pada variabel noCheck, maka tampilkan no. polisi sudah ada. Lalu batalkan proses input data
	if(mysqli_fetch_assoc($noCheck)){
		echo "No. Polisi telah ada";
		return false;
	}

	// Query untuk input data barang
	$queryInput = "INSERT INTO data_salvage SET
					no = '$no',
					wo = '$wo',
					nama_sa = '$nama_sa',
					nama_barang = '$nama_barang'
					";
	// query untuk menginput data kedalam tabel menggunakan koneksi database dan queryInput
	mysqli_query($connect, $queryInput);
	// Mengembalikan nilai sesuai yang ada pada database
	return mysqli_affected_rows($connect);
}
?>