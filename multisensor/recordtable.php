<!DOCTYPE HTML>
<html>

<head>
    <title>PWQMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/style2.css">
    <link rel="shortcut icon" type="image/png" href="images/logoo.jpg">
</head>

<body>
    <div class="topnav">
        <h3>PORTABLE WATER QUALITY MONITORING SYSTEM</h3>
    </div>

    <br>

    <h3 style="color: #0c6980;">HASIL RECORD DATA TABLE</h3>

    <table class="styled-table" id="table_id">
        <thead>
            <tr>
                <th>ID</th>
                <th>PH</th>
                <th>TDS (ppm)</th>
                <th>TEMPERATURE (°C)</th>
                <th>DATE (yyyy-mm-dd)</th>
            </tr>
        </thead>
        <tbody id="tbody_table_record">
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

            function fetchData($conn)
            {
                $sql = "SELECT * FROM tb_sensor";
                $result = $conn->query($sql);

                // Display data in the table
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {

                        echo '<tr>';

                        echo '<td class="bdr">' . $row["id"] . '</td>';
                        // Tambahkan logika if-else untuk setiap nilai $_GET yang diperlukan
                        echo '<td class="bdr">' . $row["ph"] . '</td>';
                        echo '<td class="bdr">' . $row["tds"] . '</td>';
                        echo '<td class="bdr">' . $row["temp"] . '</td>';
                        echo '<td class="bdr">' . $row["reading_time"] . '</td>';

                        echo '</tr>';
                    }
                }
            }

            // Initial data fetch
            fetchData($conn);

            // Close the database connection
            $conn->close();
            ?>
        </tbody>
    </table>

    <br>

    <div class="btn-group">
        <button class="button" id="btn_prev" onclick="prevPage()">Prev</button>
        <button class="button" id="btn_next" onclick="nextPage()">Next</button>
        <div
            style="display: inline-block; position:relative; border: 0px solid #e3e3e3; float: center; margin-left: 2px;;">
            <p style="position:relative; font-size: 14px;"> Table : <span id="page"></span></p>
        </div>
        <select name="number_of_rows" id="number_of_rows">
            <option value="10">10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <button class="button" id="btn_apply" onclick="apply_Number_of_Rows()">Apply</button>
        <button class="button" onclick="printTable()">Cetak Tabel</button>

    </div>

    <br>

    <script src="js/script2.js">

    </script>


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

    </script>

</body>

</html>