<?php 
$semuaData = array();
$semuaData2 = array();
$stat = "";
if(isset($_POST['daerah']) && isset($_POST['tanggal_awal']) && isset($_POST['tanggal_akhir'])){
    $tanggalAwal = date('Y-m-d', strtotime($_POST['tanggal_awal']));
    $tanggalAkhir = date('Y-m-d', strtotime($_POST['tanggal_akhir']));

    $cek = mysqli_query($konek, "SELECT * FROM t_pengguna WHERE tanggal BETWEEN '$tanggalAwal' AND '$tanggalAkhir'");
    
    if($_POST['daerah'] == "daerah1"){
        $stat = "daerah1";
    }else{
        $stat = "daerah2";
    }    
}
?>
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Cetak Laporan
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
                        <div class="row">
                            <div class="col-sm-12">
                                <form method="POST">
                                    <!-- select -->
                                    <div class="row">
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Pilih Daerah</label>
                                                <select class="form-control" name="daerah">
                                                    <option value="">Pilih Daerah</option>
                                                    <option value="daerah1">Daerah 1</option>
                                                    <option value="daerah2">Daerah 2</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Tanggal Awal</label>
                                                <input type="date" class="form-control" name="tanggal_awal" id="tanggal">
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-group">
                                                <label>Tanggal Akhir</label>
                                                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal">
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <div class="form-group">
                                                <label class="mb-1" style="color:white">-</label>
                                                <button type="submit" class="btn btn-primary form-control">Pilih</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <?php 
                                if($stat == "daerah1"){?>
                                    <h4>Daerah 1</h4>
                                <?php }else if($stat == "daerah2"){?>
                                    <h4>Daerah 2</h4>
                                <?php }else{?>
                                    <h4></h4>
                                <?php } ?>
                                <table class="table table-bordered">
                                    <thead>
                                        <tr class="bg-primary">
                                            <th style="width: 10px; text-align: center">No.</th>
                                            <th style="width: 200px; text-align: center">Ket</th>
                                            <th style="width: 200px; text-align: center">Daerah</th>
                                            <th style="width: 200px; text-align: center">Tanggal</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                        if($stat == ""){?>
                                            <td colspan="4">Kosong</td>
                                        <?php }else if($stat == "daerah1"){
                                            $no = 0;
                                            while($data = mysqli_fetch_array($cek)){ ?>
                                                <tr>
                                                    <td> <?php echo $no++; ?> </td>
                                                    <td> <?php echo $data['pengguna']; ?> </td>
                                                    <td> <?php echo $data['daerah1']; ?> </td>
                                                    <td> <?php echo $data['tanggal']; ?> </td>
                                                </tr>
                                            <?php } 
                                        }else if ($stat == "daerah2"){
                                            $no = 0;
                                            while($data = mysqli_fetch_array($cek)){?>
                                                <tr>
                                                    <td> <?php echo $no++; ?> </td>
                                                    <td> <?php echo $data['pengguna']; ?> </td>
                                                    <td> <?php echo $data['daerah2']; ?> </td>
                                                    <td> <?php echo $data['tanggal']; ?> </td>
                                                </tr>
                                            <?php }  
                                        } ?>
                                    </tbody>
                                </table>
                                <a href="?p=cetak.php&stat=<?= $stat; ?>&tawal=<?= $tanggalAwal; ?>&takhir=<?= $tanggalAkhir; ?>" class="btn btn-success">Cetak</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>