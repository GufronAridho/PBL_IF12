<!DOCTYPE HTML>
<html>

<head>
    <title>PWQMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="icon" href="data:,">
    <link rel="shortcut icon" type="image/png" href="images/logoo.jpg">
    <link rel="stylesheet" href="style/style.css">
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setInterval(function () {
                // Load pH data from the PHP file
                $.get("cekph.php", function (data) {
                    $("#cekph").html(data);
                    var phValue = parseFloat(data);
                    updatePhClassification("phClassification", phValue, 3, 6, 7, 8, 11);
                });

                // Load TDS data from the PHP file
                $.get("cektds.php", function (data) {
                    $("#cektds").html(data);
                    var tdsValue = parseFloat(data);
                    updateTDSClassification("tdsClassification", tdsValue, 50, 500);
                });

                // Load temperature data from the PHP file
                $.get("cektemp.php", function (data) {
                    $("#cektemp").html(data);
                    var tempValue = parseFloat(data);
                    updateClassification("tempClassification", tempValue, 10, 20 , 30 , 40);
                }); 
            }, 2000);
        });

        function updatePhClassification(elementId, value, lowThreshold, slowThreshold, mediumThreshold, shighThreshold, highThreshold) {
            var classification = "";
            if (value < lowThreshold) {
                classification = "Strongly Acidic";
            } else if (value >= lowThreshold && value <= slowThreshold) {
                classification = "Weakly Acidic";
            } else if (value > slowThreshold && value <= mediumThreshold) {
                classification = "Normal";
            } else if (value > mediumThreshold && value <= shighThreshold) {
                classification = "Weakly Alkali";
            } else if (value > shighThreshold && value <= highThreshold) {
                classification = "Strongly Alkali";
            } else {
                classification = "Out of Range";
            }
            $("#" + elementId).html(classification);
        }
        function updateTDSClassification(elementId, value, lowThreshold, highThreshold) {
            var classification = "";
            if (value < lowThreshold) {
                classification = "Low TDS";
            } else if (value >= lowThreshold && value <= highThreshold) {
                classification = "Medium TDS";
            } else {
                classification = "High TDS";
            }
            $("#" + elementId).html(classification);
        }
        function updateClassification(elementId, value, lowThreshold, slowThreshold, mediumThreshold, highThreshold) {
            var classification = "";
            if (value < lowThreshold) {
                classification = "Freezing";
            } else if (value >= lowThreshold && value <= slowThreshold) {
                classification = "Cool Temp";
            } else if (value > slowThreshold && value <= mediumThreshold) {
                classification = "Moderate Temp";
            } else if (value > mediumThreshold && value <= highThreshold) {
                classification = "Warm Temp";
            } else if (value > highThreshold ) {
                classification = "Hot Temp";
            } else {
                classification = "Out of Range";
            }
            $("#" + elementId).html(classification);
        }
    </script>
</head>

<body>
    <div class="topnav">
        <h3>PORTABLE WATER QUALITY MONITORING SYSTEM</h3>
    </div>
    <br>
    <div class="content">
        <div class="cards">
            <div class="card">
                <div class="card header">
                    <h3 style="font-size: 1rem;">MONITORING</h3>
                </div>

                <h2 class="phColor"><i class="fas fa-tint"></i> PH</h2>
                <p class="phColor"><span class="reading"><span id="cekph">0</span>

                    </span>
                </p>
                <h2 class="tdsColor"><i class="fas fa-tint"></i> TDS</h2>
                <p class="tdsColor"><span class="reading"><span id="cektds">0</span>
                        pmm
                    </span></p>
                <h2 class="tempColor"><i class="fas fa-thermometer-half"></i> TEMP</h2>
                <p class="tempColor"><span class="reading"><span id="cektemp">0</span>
                        &deg;C
                    </span></p>
            </div>

            <div class="card">
                <div class="card header">
                    <h3 style="font-size: 1rem;">CRITERIA</h3>
                </div>

                <h2 class="phColor"><i class="fas fa-tint"></i> PH</h2>
                <p class="phColor"><span class="reading"><span id="phClassification">0</span>
                        
                    </span>
                </p>
                <h2 class="tdsColor"><i class="fas fa-tint"></i> TDS</h4>
                    <p class="tdsColor"><span class="reading"><span id="tdsClassification">0</span>
                            
                        </span></p>
                    <h2 class="tempColor"><i class="fas fa-thermometer-half"></i> TEMP</h2>
                    <p class="tempColor"><span class="reading"><span id="tempClassification">0</span>
                            
                        </span></p>
            </div>
        </div>
    </div>

    <br>

    <div class="content">
        <div class="cards">
            <div class="card header" style="border-radius: 15px;">
            <br>
                <button onclick="window.open('recordtable.php', '_blank');">Open Record Table</button>
                <h3 style="font-size: 0.7rem;"></h3>
            </div>
        </div>
    </div>
    <script src="js/script.js"></script>
</body>
</html>