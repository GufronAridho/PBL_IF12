<?php
    // Connect to your MySQL database
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "dbmultisensor";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check the connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Fetch data and send it as a response
    fetchData($conn);

    // Close the database connection
    $conn->close();

    function fetchData($conn) {
        $sql = "SELECT * FROM test";
        $result = $conn->query($sql);

        // Display data in the table
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["id"] . "</td>";
                echo "<td>" . $row["ph"] . "</td>";
                echo "<td>" . $row["tds"] . "</td>";
                echo "<td>" . $row["temp"] . "</td>";
                echo "<td>" . $row["reading_time"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found</td></tr>";
        }
    }
?>
