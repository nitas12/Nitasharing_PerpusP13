<?php

$server = "localhost";
$username = "root";
$password = "";
$database = "perpus";
$con = mysqli_connect($server,$username,$password) or die ("<h1> Koneksi Mysql Error : </h1>".mysqli_connect_error());
mysqli_select_db($con,$database) or die("<h1>Koneksi ke database Error : </h1>".mysqli_connect_error($con));

@$operasi = $_GET['operasi'];
switch($operasi) 
{
	case "view":
	$query_tampil = mysqli_query($con,"SELECT * FROM anggota") or die (mysqli_error($con));
	$data_array = array();
	while ($data = mysqli_fetch_assoc($query_tampil)) 
	{
		$data_array[]= $data;
	}
	echo json_encode($data_array);
	break;

	case "insert":
	
	@$nama_anggota = $_GET['nama_anggota'];
	@$gender = $_GET['gender'];
	@$no_telp = $_GET['no_telp'];
	@$alamat = $_GET['alamat'];
	@$email = $_GET['email'];
	@$password = $_GET['password'];
	@$username = $_GET['username'];

	$query_insert_data = mysqli_query($con,"INSERT INTO anggota (nama_anggota,gender,no_telp,alamat,email,password,username) values ('$nama_anggota','$gender','$no_telp','$alamat','$email','$password','$username')");
	if($query_insert_data) 
	{
		echo "Data Berhasil Disimpan";
	}
	else 
	{
		echo "Maaf Insert ke Dalam Database Error".mysqli_error($con);
	}
	break;

	case "ambil_by_id":
	$id_anggota = (int)$_GET['id_anggota'];

	$query_tampil = mysqli_query($con,"SELECT * FROM anggota WHERE id_anggota='$id_anggota'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil);
	echo "[".json_encode($data_array)."]";
	break;

	case "update":
	@$nama_anggota = $_GET['nama_anggota'];
	@$id_anggota = $_GET['id_anggota'];

	$query_update = mysqli_query($con,"UPDATE anggota SET nama_anggota='$nama_anggota' WHERE id_anggota='$id_anggota'");
	if($query_update)
	{
		echo "Update Data Berhasil";
	}
	else 
	{
		echo mysqli_error($con);
	}
	break;
	
	case "delete":
	@$id_anggota = $_GET['id_anggota'];
	$query_delete = mysqli_query($con,"DELETE FROM anggota WHERE id_anggota='$id_anggota'");
	if ($query_delete)
	{
		echo "Data Berhasil Dihapus";
	}
	else 
	{
		echo mysqli_error($con);
	}
	break;
	default;
	break;
}
