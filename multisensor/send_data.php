<?php
    $konek = mysqli_connect("localhost", "root", "", "dbmultisensor");
    $ph = $_GET['ph'];
    $tds = $_GET['tds'];
    $temp = $_GET['temp'];

    //auto incrament
    mysqli_query($konek, "ALTER TABLE tb_sensor AUTO_INCREMENT=1");
    $save = mysqli_query($konek,"insert into tb_sensor(ph, tds, temp)values('$ph','$tds','$temp')");

    if($save)
        echo "Send Success";
    else
        echo "Send Failed";
?>
