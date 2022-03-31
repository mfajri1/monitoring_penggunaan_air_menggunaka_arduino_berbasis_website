<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Pemakaian
        </h1>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border text-center bg-primary"></div>
                    <div class="box-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr class="bg-primary">
                                    <th style="width: 10px; text-align: center">No.</th>
                                    <th style="width: 200px; text-align: center">Ket</th>
                                    <th style="width: 200px; text-align: center">Daerah 1</th>
                                    <th style="width: 200px; text-align: center">Daerah 2</th>
                                    <th style="width: 200px; text-align: center">Tanggal</th>
                                    <th style="width: 100px; text-align: center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
						        //koneksi ke database
						        // include "../../koneksi.php";
						        //baca data karyawan
						        $sql = mysqli_query($konek, "select * from t_pengguna");
						        $no = 0;
						        while($data = mysqli_fetch_array($sql)){
						            $no++;?>
                        
                                <tr>
                                    <td> <?php echo $no; ?> </td>
                                    <td> <?php echo $data['pengguna']; ?> </td>
                                    <td> <?php echo $data['daerah1']; ?> ml </td>
                                    <td> <?php echo $data['daerah2']; ?>  ml</td>
                                    <td> <?php echo $data['tanggal']; ?> </td>
                                    <td>
                                        <a href="?p=page/pemakaian/hapus.php&id=<?php echo $data['id_pengguna']; ?>">Hapus</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!--/.col (left) -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>