<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">

<html>

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8">

<title>Tinh chu vi va dien tich</title>

<style>

fieldset {

  background-color: #eeeeee;

}



legend {

  background-color: gray;

  color: white;

  padding: 5px 10px;

}



input {

  margin: 5px;

}

</style>

</head>

<body>

<?php 

abstract class Hinh{

	protected $ten, $dodai;

	public function setTen($ten){

		$this->ten=$ten;

	}

	public function getTen(){

		return $this->ten;

	}

	public function setDodai($doDai){

		$this->dodai=$doDai;

	}

	public function getDodai(){

		return $this->dodai;

	}

	abstract public function tinh_CV();

	abstract public function tinh_DT();

}

class HinhTron extends Hinh{

	const PI=3.14;

	function tinh_CV(){

		return $this->dodai*2*self::PI;

	}

	function tinh_DT(){

		return pow($this->dodai,2)*self::PI;

	}

}

class HinhVuong extends Hinh{

	public function tinh_CV(){

		return $this->dodai*4;

	}

	public function tinh_DT(){

		return pow($this->dodai,2);

	}

}
class TamGiacDeu extends Hinh{
    public function tinh_CV(){
        return $this->dodai*3;
    }
    public function tinh_DT(){
        $p = ($this->dodai * 3) /2;
        return sqrt($p*pow($p - $this->dodai, 3));
    }
}
class TamGiacThuong extends Hinh{
    public function tinh_CV(){
        return $this->dodai + ($this->dodai * 2) + ($this->dodai  * 3);
    }
    public function tinh_DT(){
        $p = ($this->dodai + $this->dodai * 2 + $this->dodai *3)/2;
        return sqrt($p*($p-$this->dodai)*($p-$this->dodai+2)*($p-$this->dodai+3));
    }
}
class HinhChuNhat extends Hinh{
    public function tinh_CV(){
        return ($this->dodai + $this->dodai*2) * 2;
    }
    public function tinh_DT(){
        return $this->dodai * $this->dodai*2;
    }
}
$str=NULL;

if(isset($_POST['tinh'])){

	if(isset($_POST['hinh']) && ($_POST['hinh'])=="hv"){

		$hv=new HinhVuong();

		$hv->setTen($_POST['ten']);

		$hv->setDodai($_POST['dodai']);

		$str= "Diện tích của ".$hv->getTen()." là: ".$hv->tinh_DT()." \n".

		 		"Chu vi của ".$hv->getTen()." là: ".$hv->tinh_CV();

	}

	if(isset($_POST['hinh']) && ($_POST['hinh'])=="ht"){

		$ht=new HinhTron();

		$ht->setTen($_POST['ten']);

		$ht->setDodai($_POST['dodai']);

		$str= "Diện tích của ".$ht->getTen()." là: ".$ht->tinh_DT()." \n".

				"Chu vi của ".$ht->getTen()." là: ".$ht->tinh_CV();

	}
    if(isset($_POST['hinh']) && ($_POST['hinh'])=="htgd"){

		$htgd=new TamGiacDeu();

		$htgd->setTen($_POST['ten']);

		$htgd->setDodai($_POST['dodai']);

		$str= "Diện tích của ".$htgd->getTen()." là: ".$htgd->tinh_DT()." \n".

				"Chu vi của ".$htgd->getTen()." là: ".$htgd->tinh_CV();

	}
    if(isset($_POST['hinh']) && ($_POST['hinh'])=="htgt"){

		$htgt=new TamGiacThuong();

		$htgt->setTen($_POST['ten']);

		$htgt->setDodai($_POST['dodai']);

		$str= "Diện tích của ".$htgt->getTen()." là: ".$htgt->tinh_DT()." \n".

				"Chu vi của ".$htgt->getTen()." là: ".$htgt->tinh_CV();

	}
    if(isset($_POST['hinh']) && ($_POST['hinh'])=="hcn"){

		$hcn=new HinhChuNhat();

		$hcn->setTen($_POST['ten']);

		$hcn->setDodai($_POST['dodai']);

		$str= "Diện tích của hình tròn ".$hcn->getTen()." là: ".$hcn->tinh_DT()." \n".

				"Chu vi của hình tròn ".$hcn->getTen()." là: ".$hcn->tinh_CV();

	}
}

?>

<form action="" method="post">

<fieldset>

	<legend>Tính chu vi và diện tích các hình đơn giản</legend>

	<table border='0'>

		<tr>

			<td>Chọn hình</td>

			<td>
                <input type="radio" name="hinh" value="hv" 

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="hv") echo 'checked'?>/>Hình vuông

				<input type="radio" name="hinh" value="ht"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="ht") echo 'checked'?>/>Hình tròn

                <input type="radio" name="hinh" value="htgd"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="htgd") echo 'checked'?>/>Hình tam giac deu

                <input type="radio" name="hinh" value="htgt"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="htgt") echo 'checked'?>/>Hình tam giac thuong

                <input type="radio" name="hinh" value="hcn"

					<?php if(isset($_POST['hinh'])&&($_POST['hinh'])=="hcn") echo 'checked'?>/>Hình chu nhat
			</td>

		</tr>

		<tr>

			<td>Nhập tên:</td>

			<td><input type="text"  name="ten" value="<?php if(isset($_POST['ten'])) echo $_POST['ten'];?>"/></td>

		</tr>

		<tr>

			<td>Nhập độ dài:</td>

			<td><input type="text"  name="dodai" value="<?php if(isset($_POST['dodai'])) echo $_POST['dodai'];?>"/></td>

		</tr>

		<tr>
			<td>Kết quả:</td>

			<td><textarea name="ketqua" cols="70" rows="4" disabled="disabled"><?php echo $str;?></textarea></td>
		</tr>

		<tr>

			<td colspan="2" align="center"><input class="btn btn-success" type="submit" name="tinh" value="Tính"/></td>

		</tr>

	</table>

</fieldset>

</form>

</body>
<form action="" method="get">
<input class="btn btn-primary" style="margin-top:40px" type="submit" value="trở về">
</form>
</html>
<?php $this->end(); ?>