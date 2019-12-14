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
	$query_tampil = mysqli_query($con,"SELECT * FROM admin") or die (mysqli_error($con));
	$data_array = array();
	while ($data = mysqli_fetch_assoc($query_tampil)) 
	{
		$data_array[]= $data;
	}
	echo json_encode($data_array);
	break;

	case "insert":
	
	@$nama_admin = $_GET['nama_admin'];
	@$username = $_GET['username'];
	@$password = $_GET['password'];

	$query_insert_data = mysqli_query($con,"INSERT INTO admin (nama_admin,username,password) values ('$nama_admin','$username',$password)");
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
	$id_admin = (int)$_GET['id_admin'];

	$query_tampil = mysqli_query($con,"SELECT * FROM admin WHERE id_admin='$id_admin'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil);
	echo "[".json_encode($data_array)."]";
	break;

	case "update":
	@$nama_admin = $_GET['nama_admin'];
	@$id_admin = $_GET['id_admin'];

	$query_update = mysqli_query($con,"UPDATE admin SET nama_admin='$nama_admin' WHERE id_admin='$id_admin'");
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
	@$id_admin = $_GET['id_admin'];
	$query_delete = mysqli_query($con,"DELETE FROM admin WHERE id_admin='$id_admin'");
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
