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
	$query_tampil = mysqli_query($con,"SELECT * FROM buku") or die (mysqli_error($con));
	$data_array = array();
	while ($data = mysqli_fetch_assoc($query_tampil)) 
	{
		$data_array[]= $data;
	}
	echo json_encode($data_array);
	break;

	case "insert":
	
	@$id_kategori = $_GET['id_kategori'];
	@$judul_buku = $_GET['judul_buku'];
	@$pengarang = $_GET['pengarang'];
	@$thn_terbit = $_GET['thn_terbit'];
	@$penerbit = $_GET['penerbit'];
	@$isbn = $_GET['isbn'];
	@$jumlah_buku = $_GET['jumlah_buku'];
	@$lokasi = $_GET['lokasi'];
	@$gambar = $_GET['gambar'];
	@$tgl_input = $_GET['tgl_input'];
	@$status_buku = $_GET['status_buku'];

	$query_insert_data = mysqli_query($con,"INSERT INTO buku (id_kategori,judul_buku,pengarang,thn_terbit,penerbit,isbn,jumlah_buku,lokasi,gambar,tgl_input,status_buku) values ('$id_kategori','$judul_buku','$pengarang','$thn_terbit','$penerbit','$isbn','$jumlah_buku','$lokasi','gambar','$tgl_input','$status_buku')");
	if($query_insert_data) 
	{
		echo "Data Berhasil Disimpan";
	}
	else 
	{
		echo "Maaf Insert ke Dalam Database Error".mysqli_error($con);
	}
	break;

	case "get_by_id":
	$id_buku = (int)$_GET['id_buku'];

	$query_tampil = mysqli_query($con,"SELECT * FROM buku WHERE id_buku='$id_buku'") or die (mysqli_error($con));
	$data_array = array();
	$data_array = mysqli_fetch_assoc($query_tampil);
	echo "[".json_encode($data_array)."]";
	break;

	case "update":
	@$judul_buku = $_GET['judul_buku'];
	@$id_buku = $_GET['id_buku'];

	$query_update = mysqli_query($con,"UPDATE buku SET judul_buku='$judul_buku' WHERE id_buku='$id_buku'");
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
	@$id_buku = $_GET['id_buku'];
	$query_delete = mysqli_query($con,"DELETE FROM buku WHERE id_buku='$id_buku'");
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
