<?php
    $koneksi = mysqli_connect("localhost", "root", "", "dbmultisensor");
    $sql = mysqli_query($koneksi, "select * from tb_sensor order by ID desc");
    $data = mysqli_fetch_array($sql);
    $tds = $data['tds'];

    if ($tds == "") $tds = 0;
    echo $tds;
?>
