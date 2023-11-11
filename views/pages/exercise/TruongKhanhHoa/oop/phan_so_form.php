<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
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

    tr {
        line-height: 14px;
    }

    td {
        font-size: 20px;
    }
</style>
</head>

<body>
    <?php
    class PhanSoTKH
    {
        protected $tuso, $mauso;

        function __construct($tuso, $mauso)
        {
            $this->tuso = $tuso;
            $this->mauso = $mauso;
        }

        public function setTu($tuso)
        {
            $this->tuso = $tuso;
        }
        public function setMau($mauso)
        {
            $this->mauso = $mauso;
        }

        public function getTu()
        {
            return $this->tuso;
        }
        public function getMau()
        {
            return $this->mauso;
        }

        public function UCLN($a, $b)
        {
            while ($a != $b) {
                if ($a > $b) $a = $a - $b;
                else $b = $b - $a;
            }
            return $a;
        }

        public function rutGon()
        {
            $i = $this->UCLN($this->getTu(), $this->getMau());
            $this->setTu($this->getTu() / $i);
            $this->setMau($this->getMau() / $i);
        }

        public function congPS(PhanSoTKH $ps)
        {
            $a = ($this->getTu() * $ps->getMau()) + ($ps->getTu() * $this->getMau());
            $b = $ps->getMau() * $this->getMau();
            $phanso = new PhanSoTKH($a, $b);
            $phanso->rutGon();
            return $phanso;
        }

        public function truPS(PhanSoTKH $ps)
        {
            $a = ($this->getTu() * $ps->getMau()) - ($ps->getTu() * $this->getMau());
            $b = $ps->getMau() * $this->getMau();
            $phanso = new PhanSo($a, $b);
            $phanso->rutGon();
            return $phanso;
        }

        public function nhanPS(PhanSoTKH $ps)
        {
            $a = $ps->tuso * $this->tuso;
            $b = $ps->mauso * $this->mauso;
            $phanso = new PhanSo($a, $b);
            $phanso->rutGon();
            return $phanso;
        }

        public function chiaPS(PhanSoTKH $ps)
        {
            $a = $this->tuso * $ps->mauso;
            $b = $this->mauso * $ps->tuso;
            $phanso = new PhanSoTKH($a, $b);
            $phanso->rutGon();
            return $phanso;
        }
    }

    $str = NULL;
    if (isset($_POST['tuso1'])) $tuso1 = $_POST['tuso1'];
    else $tuso1 = "";
    if (isset($_POST['mauso1'])) $mauso1 = $_POST['mauso1'];
    else $mauso1 = "";
    if (isset($_POST['tuso2'])) $tuso2 = $_POST['tuso2'];
    else $tuso2 = "";
    if (isset($_POST['mauso2'])) $mauso2 = $_POST['mauso2'];
    else $mauso2 = "";
    if (isset($_POST['tinh'])) {
        if (is_numeric($tuso1) && is_numeric($tuso2) && is_numeric($mauso1) && is_numeric($mauso2)) {
            if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "cong") {
                $ps1 = new PhanSoTKH($tuso1, $mauso1);
                $ps2 = new PhanSoTKH($tuso2, $mauso2);
                $ketqua = $ps1->congPS($ps2);
                $pheptinh = "+";
            }
            if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "tru") {
                $ps1 = new PhanSoTKH($tuso1, $mauso1);
                $ps2 = new PhanSoTKH($tuso2, $mauso2);
                $ketqua = $ps1->truPS($ps2);
                $pheptinh = "-";
            }
            if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "nhan") {
                $ps1 = new PhanSoTKH($tuso1, $mauso1);
                $ps2 = new PhanSoTKH($tuso2, $mauso2);
                $ketqua = $ps1->nhanPS($ps2);
                $pheptinh = "x";
            }
            if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "chia") {
                $ps1 = new PhanSoTKH($tuso1, $mauso1);
                $ps2 = new PhanSoTKH($tuso2, $mauso2);
                $ketqua = $ps1->chiaPS($ps2);
                $pheptinh = "÷";
            }
        }
    } else {
        $ketqua = null;
        $pheptinh = "+";
    }
    ?>
    <form action="" method="post">
        <fieldset>
            <legend>Chọn các phép tính trên phân số</legend>
            <tr>
                <td>Nhập phân số thứ 1:</td>
                <td>
                    Tử số: <input type="text" name="tuso1" value="<?php if (isset($_POST['tuso1'])) echo $_POST['tuso1']; ?>" />
                    Mẫu số: <input type="text" name="mauso1" value="<?php if (isset($_POST['mauso1'])) echo $_POST['mauso1']; ?>" />
                </td>
            </tr>
            <br>
            <tr>
                <td>Nhập phân số thứ 2:</td>
                <td>
                    Tử số: <input type="text" name="tuso2" value="<?php if (isset($_POST['tuso2'])) echo $_POST['tuso2']; ?>" />
                    Mẫu số: <input type="text" name="mauso2" value="<?php if (isset($_POST['mauso2'])) echo $_POST['mauso2']; ?>" />
                </td>
            </tr>
            <table border='0'>
                <tr>
                    <td>Chọn phép tính:</td>
                    <td>
                        <input type="radio" name="pheptinh" value="cong" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "cong") echo 'checked' ?> checked />Cộng
                        <input type="radio" name="pheptinh" value="tru" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "tru") echo 'checked' ?> />Trừ
                        <input type="radio" name="pheptinh" value="nhan" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "nhan") echo 'checked' ?> />Nhân
                        <input type="radio" name="pheptinh" value="chia" <?php if (isset($_POST['pheptinh']) && ($_POST['pheptinh']) == "chia") echo 'checked' ?> />Chia
                    </td>
                </tr>

                <tr>
                    <td>Kết quả:</td>
                    <td>
                        <table align="center">
                            <tr align="center">
                                <td><?php echo $tuso1 ?></td>
                                <td></td>
                                <td><?php echo $tuso2 ?></td>
                                <td></td>
                                <td><?php
                                    if ($ketqua != null)
                                        echo $ketqua->getTu();
                                    else "";
                                    ?></td>
                            </tr>
                            <tr style="text-align: center;" align="center">
                                <td>━</td>
                                <td><?php echo $pheptinh ?></td>
                                <td>━</td>
                                <td style="padding-top: 4px;">=</td>
                                <td>━</td>
                            </tr>
                            <tr align="center">
                                <td><?php echo $mauso1 ?></td>
                                <td></td>
                                <td><?php echo $mauso2 ?></td>
                                <td></td>
                                <td><?php
                                    if ($ketqua != null)
                                        echo $ketqua->getMau();
                                    else "";
                                    ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" align="center"><input type="submit" name="tinh" value="Tính" /></td>
                </tr>
            </table>
        </fieldset>
    </form>
    <?php $this->end(); ?>