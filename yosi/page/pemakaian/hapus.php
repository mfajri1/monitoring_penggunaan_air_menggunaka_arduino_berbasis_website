<?php

$id    = $_GET['id'];
$hapus = mysqli_query($konek, "DELETE FROM t_pengguna WHERE id_pengguna='$id'");

if ($hapus) {
    echo "<script>
            alert('Berhasil Menghapus Data Pengguna');
            window.location='index.php?p=page/pemakaian/pemakaian.php';
        </script>";
} else {
    echo "<script>
        alert('Error, Gagal Menghapus Data');
            window.location='index.php?p=page/pemakaian/pemakaian.php';
        </script>";
}
