<?php
    $koneksi = mysqli_connect("localhost", "root", "", "dbmultisensor");
    $ph = $_GET['ph'];
    $tds = $_GET['tds'];
    $temp = $_GET['temp'];


    $save = mysqli_query($koneksi,"insert into tb_sensor(ph, tds, temp)values('$ph','$tds','$temp')");
    
    if($save)
        echo "Send Success";
    else
        echo "Send Failed";
?>