<?php $this->layout('layout_exercise') ?>
<?php $this->section('content'); ?>
<?php
    $matran = array(
        'hang1' => array(1,2,3),
        'hang2' => array(4,5,6),
        'hang3' => array(7,8,9)
    );
    foreach($matran as $value){
        echo "<br>";
        foreach ($value as $giatri ) {
            echo " " . $giatri;
        }
    };
?>
</body>
</html>
<?php $this->end(); ?>
