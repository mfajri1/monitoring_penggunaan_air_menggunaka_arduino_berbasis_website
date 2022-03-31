<?php 
	include "config/koneksi.php";
	//baca data sensor
	$data1 = $_GET['data1'];
	$data2 = $_GET['data2'];
	$today = date("Y-m-d");
	$queryCekData = mysqli_query($konek, "SELECT * FROM t_pengguna WHERE tanggal= '$today' ");
	$cekData = mysqli_num_rows($queryCekData);
	if($cekData == 0 ){
		$peng = "penggunaan Air"; 
		$simpanData = mysqli_query($konek, "insert into t_pengguna(pengguna, daerah1, daerah2, tanggal)values('$peng', '$data1', '$data2', '$today')");
		if($simpanData)
			echo "Berhasil";
		else
			echo "Gagal";
	}else{
		$updNilai = mysqli_query($konek, "SELECT * FROM t_pengguna WHERE tanggal= '$today' ");
		$result = mysqli_fetch_array($updNilai);
		if($data1 != 0){
			$daerah1 = $result['daerah1'] + $data1;
			$daerah2 = $result['daerah2'];
			$peng = "penggunaan Air"; 
			$updateData = mysqli_query($konek, "UPDATE t_pengguna SET pengguna='$peng', daerah1='$daerah1', daerah2='$daerah2', tanggal='$today' WHERE tanggal='$today'");
			if($updateData)
				echo "Berhasil";
			else
				echo "Gagal";
		}
		if($data2 !=0){
			$daerah1 = $result['daerah1'];
			$daerah2 = $result['daerah2'] + $data2;
			$peng = "penggunaan Air"; 
			$updateData = mysqli_query($konek, "UPDATE t_pengguna SET pengguna='$peng', daerah1='$daerah1', daerah2='$daerah2', tanggal='$today' WHERE tanggal='$today'");
			if($updateData)
				echo "Berhasil";
			else
				echo "Gagal";
		}
		
		
	}
	
?>