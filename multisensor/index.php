<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Water Quality Monitoring IoT</title>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            setInterval(function () {
                // Load pH data from the PHP file
                $.get("cekph.php", function (data) {
                    $("#cekph").html(data);
                    var phValue = parseFloat(data);
                    updatePhClassification("phClassification", phValue, 4, 7, 14);
                });

                // Load TDS data from the PHP file
                $.get("cektds.php", function (data) {
                    $("#cektds").html(data);
                    var tdsValue = parseFloat(data);
                    updateTDSClassification("tdsClassification", tdsValue, 100, 300);
                });

                // Load temperature data from the PHP file
                $.get("cektemp.php", function (data) {
                    $("#cektemp").html(data);
                    var tempValue = parseFloat(data);
                    updateClassification("tempClassification", tempValue, 20, 30);
                });
            }, 5000);
        });

        function updatePhClassification(elementId, value, lowThreshold, mediumThreshold, highThreshold) {
            var classification = "";
            if (value < lowThreshold) {
                classification = "Asam";
            } else if (value >= lowThreshold && value <= mediumThreshold) {
                classification = "Normal";
            } else if (value > mediumThreshold && value < highThreshold) {
                classification = "Basa";
            } else {
                classification = "Out of Range";
            }
            $("#" + elementId).html(classification);
        }
        function updateClassification(elementId, value, lowThreshold, mediumThreshold, highThreshold) {
            var classification = "";
            if (value < lowThreshold) {
                classification = "Low";
            } else if (value >= lowThreshold && value <= mediumThreshold) {
                classification = "Medium";
            } else if (value > mediumThreshold && value < highThreshold) {
                classification = "High";
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
    </script>
</head>
<body>
    <div class="container" style="text-align: center; margin-top: 50px;">
        <h2>Water Quality Monitoring IoT</h2>
        <div style="display: flex;">
            <!-- pH Parameter -->
            <div class="card text-center" style="width: 33.3%;">
                <div class="card-header" style="font-size: 30px; font-weight: bold; background-color:aqua ">
                    pH Parameter
                </div>
                <div class="card-body">
                    <h1><span id="cekph">0</span></h1>

                </div>
                <div class="card-footer text-muted">
                <h2 id="phClassification"></h2> <!-- Display pH classification -->
                </div>
            </div>

            <!-- TDS Parameter -->
            <div class="card text-center" style="width: 33.3%;">
                <div class="card-header" style="font-size: 30px; font-weight: bold; background-color:salmon">
                    TDS Parameter
                </div>
                <div class="card-body">
                    <h1><span id="cektds">0</span></h1>

                </div>
                <div class="card-footer text-muted">
                <h2 id="tdsClassification"></h2> <!-- Display TDS classification -->
                </div>
            </div>

            <!-- Temperature Parameter -->
            <div class="card text-center" style="width: 33.3%;">
                <div class="card-header" style="font-size: 30px; font-weight: bold; background-color: greenyellow;">
                    Temp Parameter
                </div>
                <div class="card-body">
                    <h1><span id="cektemp">0</span></h1>

                </div>
                <div class="card-footer text-muted">
                <h2 id="tempClassification"></h2> <!-- Display temperature classification -->
                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
