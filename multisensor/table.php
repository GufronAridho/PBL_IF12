<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Print & Auto Update Table</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            border-collapse: collapse;
            width: 90%; /* Increased width for better display */
            margin: 20px auto;
            background-color: white;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f2f2f2;
        }
        button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            float: right; /* Align button to the right */
        }
        button:hover {
            background-color: #45a049;
        }
        .back-link {
            margin-top: 20px;
        }
        .back-link a {
            color: #555;
            text-decoration: none;
        }
        .back-link a:hover {
            text-decoration: underline;
        }

        /* Style for printing */
        @media print {
            body {
                padding: 0;
            }
            table {
                margin: 0 auto;
            }
            button {
                display: none; /* Hide button when printing */
            }
        }
        h1 {
            text-align: center; /* Center align text */
        }
    </style>
</head>
<body>

    <h1>Data Monitoring</h1>

    <table id="myTable">
        <thead>
            <tr>
                <th>Id</th>
                <th>Ph</th>
                <th>Tds</th>
                <th>Temp</th>
                <th>Reading time</th>
            </tr>
        </thead>
        <tbody>
            <?php
                // Connect to your MySQL database
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "test2";

                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check the connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

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

                // Initial data fetch
                fetchData($conn);

                // Close the database connection
                $conn->close();
            ?>
        </tbody>
    </table>


    <button onclick="printTable()">Cetak Tabel</button>

    <div class="back-link">
        <a href="index.php" onclick="goBack()">Kembali ke Halaman Utama</a>
    </div>

    <script>
        // Fungsi untuk mencetak tabel
        function printTable() {
            window.print();
        }

        // Fungsi untuk kembali ke halaman utama
        function goBack() {
            window.history.back();
        }

        // Fungsi untuk pembaruan otomatis (hanya contoh sederhana)

        function updateTable() {
            // Fetch new data from the server using AJAX
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function () {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the table body with new data
                    document.getElementById('myTable').getElementsByTagName('tbody')[0].innerHTML = xhr.responseText;
                }
            };
            xhr.open('GET', 'fetch_data.php', true);
            xhr.send();
        }

        // Initial data fetch and auto-update every 5 seconds
        updateTable();
        setInterval(updateTable, 5000);
    </script>

</body>
</html>