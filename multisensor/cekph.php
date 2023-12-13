<?php
    $conn = mysqli_connect("localhost", "root", "", "dbmultisensor");
    $sql = mysqli_query($conn, "select * from tb_sensor order by ID desc");
    $data = mysqli_fetch_array($sql);
    $ph = $data['ph'];

    if ($ph == "") $ph = 0;
    echo $ph;
?>
