
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<html>
	<head>
	    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <title> Phép tính trên phân số</title>
	    <style type="text/css">
	        /*body {  
	            background-color: #d24dff;
	        }*/
	        table{
	            background: #ffd94d;
	            border: 0 solid yellow;
	        }
            #kq{
	            background: #ffd94d;
	            border: 0 solid yellow;
                text-align: center;
	        }
	        thead{
	            background: #fff14d;    

	        }
	        #kq td {
	            color: black;
                font-size: 20;
                padding: 5;
                width: 20;

	        }
            td {
	            color: black;

	        }
	        h3{
	            font-family: verdana;
	            text-align: center;
	            /* text-anchor: middle; */
	            color: #ff8100;
	            font-size: medium;
	        }
            .tu{
                border-bottom: 1px black solid;
            }
	    </style>
	</head>
	<body>
		<?php

            class PhanSo{
                public $tuSo;
                public $mauSo;
                
                function RutGonPhanSo(){
                    $a = $this->tuSo;
                    $b = $this->mauSo;
                    while($b != 0) {
                        $temp = $a % $b;
                        $a = $b;
                        $b = $temp;
                    }
                    $this->tuSo /= $a;     
                    $this->mauSo /= $a;     
                }
                function CongPhanSo($phanSo){
                    $kq = new PhanSo();
                    $kq->tuSo = ($this->tuSo*$phanSo->mauSo + $this->mauSo*$phanSo->tuSo);
                    $kq->mauSo = $this->mauSo*$phanSo->mauSo;
                    return $kq;
                }
                function TruPhanSo($phanSo){
                    $kq = new PhanSo();
                    $kq->tuSo = ($this->tuSo*$phanSo->mauSo - $this->mauSo*$phanSo->tuSo);
                    $kq->mauSo = $this->mauSo*$phanSo->mauSo;
                    return $kq;
                }

                function NhanPhanSo($phanSo){
                    $kq = new PhanSo();
                    $kq->tuSo = $this->tuSo*$phanSo->tuSo;
                    $kq->mauSo = $this->mauSo*$phanSo->mauSo;
                    return $kq;
                }

                function ChiaPhanSo($phanSo){
                    $kq = new PhanSo();
                    $kq->tuSo = $this->tuSo*$phanSo->mauSo;
                    $kq->mauSo = $this->mauSo*$phanSo->tuSo;
                    return $kq;
                }
                

            }

			if(isset($_POST['tu1']))  
			    $tu1=trim($_POST['tu1']); 
			else $tu1="";
			if(isset($_POST['mau1'])) 
			    $mau1=trim($_POST['mau1']); 
			else $mau1="";	
			if(isset($_POST['tu2'])) 
			    $tu2=trim($_POST['tu2']); 
			else $tu2="";
			if(isset($_POST['mau2'])) 
			    $mau2=trim($_POST['mau2']); 
			else $mau2="";
            $ketqua = "";
			if(isset($_POST['kq']))
		        if (is_numeric($tu1) && is_numeric($tu2) && is_numeric($mau1) && is_numeric($mau2))  {
                    $ps1 = new PhanSo();
                    $ps1->tuSo = $tu1;
                    $ps1->mauSo = $mau1;

                    $ps2 = new PhanSo();
                    $ps2->tuSo = $tu2;
                    $ps2->mauSo = $mau2;

                    if(isset($_POST['radPT'])){
                        switch($_POST['radPT']){
                            case 'cong': 
                                $kq = $ps1->CongPhanSo($ps2);
                                $kq->RutGonPhanSo();
                                $ketqua = "Kết quả phép tính cộng: ";
                                $ketqua .="
                                <table id='kq'>
                                    <tr>
                                        <td class='tu'>$ps1->tuSo</td>
                                        <td rowspan='2'>+</td>
                                        <td class='tu'>$ps2->tuSo</td>
                                        <td rowspan='2'>=</td>
                                        <td class='tu'>$kq->tuSo</td>
                                    </tr>
                                    <tr>
                                        <td>$ps1->mauSo</td>
                                        <td>$ps2->mauSo</td>
                                        <td>$kq->mauSo</td>
                                    </tr>
                                </table>"
                                ;
                                break;
                            case 'tru': 
                                $kq = $ps1->TruPhanSo($ps2);
                                $kq->RutGonPhanSo();
                                $ketqua = "Kết quả phép tính trừ: ";
                                $ketqua .="
                                <table id='kq'>
                                    <tr>
                                        <td class='tu'>$ps1->tuSo</td>
                                        <td rowspan='2'>-</td>
                                        <td class='tu'>$ps2->tuSo</td>
                                        <td rowspan='2'>=</td>
                                        <td class='tu'>$kq->tuSo</td>
                                    </tr>
                                    <tr>
                                        <td>$ps1->mauSo</td>
                                        <td>$ps2->mauSo</td>
                                        <td>$kq->mauSo</td>
                                    </tr>
                                </table>"
                                ;
                                break;
                            case 'nhan': 
                                $kq = $ps1->NhanPhanSo($ps2);
                                $kq->RutGonPhanSo();
                                $ketqua = "Kết quả phép tính nhân: ";
                                $ketqua .="
                                <table id='kq'>
                                    <tr>
                                        <td class='tu'>$ps1->tuSo</td>
                                        <td rowspan='2'>x</td>
                                        <td class='tu'>$ps2->tuSo</td>
                                        <td rowspan='2'>=</td>
                                        <td class='tu'>$kq->tuSo</td>
                                    </tr>
                                    <tr>
                                        <td>$ps1->mauSo</td>
                                        <td>$ps2->mauSo</td>
                                        <td>$kq->mauSo</td>
                                    </tr>
                                </table>"
                                ;
                                break;
                            case 'chia': 
                                $kq = $ps1->ChiaPhanSo($ps2);
                                $kq->RutGonPhanSo();
                                $ketqua = "Kết quả phép tính chia: ";
                                $ketqua .="
                                <table id='kq'>
                                    <tr>
                                        <td class='tu'>$ps1->tuSo</td>
                                        <td rowspan='2'>&#247;</td>
                                        <td class='tu'>$ps2->tuSo</td>
                                        <td rowspan='2'>=</td>
                                        <td class='tu'>$kq->tuSo</td>
                                    </tr>
                                    <tr>
                                        <td>$ps1->mauSo</td>
                                        <td>$ps2->mauSo</td>
                                        <td>$kq->mauSo</td>
                                    </tr>
                                </table>"
                                ;
                                break;
                                
                        }
                    }
		        }
		        else {
                    echo "<font color='red'>Vui lòng nhập vào số! </font>"; 
            	} 
		?>
		<form align='center' action="" method="post">
			<table>
			    <thead>
			        <th colspan="3" align="center"><h3>Chọn các phép tính trên phân số</h3></th>
			    </thead>
			    <tr>
                    <td>Nhập phân số thứ 1:</td>
			        <td>Tử số: <input type="text" name="tu1" value="<?php  echo $tu1;?> "/></td>
                    <td>Mẫu số: <input type="text" name="mau1" value="<?php  echo $mau1;?> "/></td>
			    </tr>
                <tr>
                    <td>Nhập phân số thứ 2:</td>
			        <td>Tử số: <input type="text" name="tu2" value="<?php  echo $tu2;?> "/></td>
                    <td>Mẫu số: <input type="text" name="mau2" value="<?php  echo $mau2;?> "/></td>
			    </tr>
                <tr>
                    <td colspan="2" >
                        <fieldset>
                            <legend>Chọn phép tính</legend>
                            <input type="radio" name="radPT" value="cong" <?php if(isset($_POST['radPT']) && $_POST['radPT'] =="cong" ) echo "checked" ?> checked/>Cộng
                            <input type="radio" name="radPT" value="tru" <?php if(isset($_POST['radPT']) && $_POST['radPT'] =="tru" ) echo "checked" ?> />Trừ
                            <input type="radio" name="radPT" value="nhan" <?php if(isset($_POST['radPT']) && $_POST['radPT'] =="nhan" ) echo "checked" ?>/>Nhân
                            <input type="radio" name="radPT" value="chia" <?php if(isset($_POST['radPT']) && $_POST['radPT'] =="chia" ) echo "checked" ?>/>Chia
                        </fieldset>
                    </td>
                    <td  align="center"><input type="submit" value="Kết quả" name="kq" /></td>
                </tr>
                <tr>
                    <td>
                        <?php echo $ketqua;?>
                    </td>
                </tr>
			</table>
		</form>
        
	</body>
</html>

