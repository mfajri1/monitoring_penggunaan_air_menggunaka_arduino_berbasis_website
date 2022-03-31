<?php 
    function generateRow(){
        $daerah = $_GET['stat'];
        $tawal = $_GET['tawal'];
        $takhir = $_GET['takhir'];
        include ('config/koneksi.php');
        $cek = mysqli_query($konek, "SELECT * FROM t_pengguna WHERE tanggal BETWEEN '$tawal' AND '$takhir'");
        if($daerah == "daerah1"){
            $no = 0;
            while($data = mysqli_fetch_array($cek)){
                $content = "";
                $content .= "
                    <tr>
                    <td>". $no++ ."</td>
                    <td>". $data['pengguna'] ."</td>
                    <td>". $data['daerah1'] ."</td>
                    <td>". $data['tanggal'] ."</td>
                    </tr>
                ";
            }
        }else{
            $no = 0;
            while($data = mysqli_fetch_array($cek)){
                $content = "";
                $content .= "
                    <tr>
                    <td>". $no++ ."</td>
                    <td>". $data['pengguna'] ."</td>
                    <td>". $data['daerah2'] ."</td>
                    <td>". $data['tanggal'] ."</td>
                    </tr>
                ";
            }
        }

        return $content;
    }
    ob_start();
    require_once('vendor/tcpdf_min/tcpdf.php');
    $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);  
    $pdf->SetCreator(PDF_CREATOR);  
    $pdf->SetTitle("Generated PDF using TCPDF");  
    $pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);  
    $pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));  
    $pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));  
    $pdf->SetDefaultMonospacedFont('helvetica');  
    $pdf->SetFooterMargin(PDF_MARGIN_FOOTER);  
    $pdf->SetMargins(PDF_MARGIN_LEFT, '10', PDF_MARGIN_RIGHT);  
    $pdf->setPrintHeader(false);  
    $pdf->setPrintFooter(false);  
    $pdf->SetAutoPageBreak(TRUE, 10);  
    $pdf->SetFont('helvetica', '', 11);  
    $pdf->AddPage();  

    $content = '';
    $content .= '
    <h2 align="center">Data Pengguna</h2>
    <table border="1" cellspacing="0" cellpadding="3">  
    <tr>  
    <th width="5%">No</th>
    <th width="40%">Pengguna</th>
    <th width="30%">Daerah</th>
    <th width="25%">Tanggal</th>
    </tr>  
    ';
    $content .= generateRow();  
    $content .= '</table>';  
    $pdf->writeHTML($content); 
    ob_clean(); 
    $pdf->Output('Pengguna.pdf', 'I');
?>