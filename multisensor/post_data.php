<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "test2";

$api_key_value = "tPmAT5Ab3j7F9";

$api_key =  $ph = $tds = $temp = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") { 
    $api_key = test_input($_POST["api_key"]);
    if($api_key == $api_key_value) {
        $ph = test_input($_POST["ph"]);
        $tds = test_input($_POST["tds"]);
        $temp = test_input($_POST["temp"]);
        
        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        } 
        
        $sql = "INSERT INTO test (ph, tds, temp)
        VALUES ( '" . $ph . "', '" . $tds . "', '" . $temp . "')";
        
        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } 
        else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close();
    }
    else {
        echo "Wrong API Key provided.";
    }
}
else {
    echo "No data posted with HTTP POST.";
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}