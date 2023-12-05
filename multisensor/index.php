<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>PBL-IF12</title>
  <script type="text/javascript" src="jquery/jquery.min.js"></script> 
  <script type="text/javascript">
    $(document).ready(function(){
      setInterval(function(){
        $("#cekph").load("cekph.php")
        $("#cektds").load("cektds.php")
        $("#cektemp").load("cektemp.php")
      }, 5000); 
    });
  </script>
</head>

<body>
  <div class="container" style="text-align: center; margin-top: 200px">
    <h2>Water Quality Monitoring IoT</h2>
    <div style="display: flex;">
      <div class="card text-center" style="width: 33.3%;">
        <div class="card-header" style="font-size: 30px; font-weight: bold; background-color:aqua ">
          Ph Parameter
        </div>
        <div class="card-body">
          <h1><span id="cekph">0</span></h1>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>
      <div class="card text-center" style="width: 33.3%;">
        <div class="card-header" style="font-size: 30px; font-weight: bold; background-color: salmon;">
          TDS Parameter
        </div>
        <div class="card-body">
          <h1><span id="cektds">0</span></h1>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>
      <div class="card text-center" style="width: 33.3%;">
        <div class="card-header" style="font-size: 30px; font-weight: bold;background-color: greenyellow;">
          Temp Parameter
        </div>
        <div class="card-body">
          <h1><span id="cektemp">0</span></h1>
        </div>
        <div class="card-footer text-muted">
          2 days ago
        </div>
      </div>
    </div>
    <!--<div class="container">
        gambar
    </div>-->
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->

  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"
    integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"
    integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    crossorigin="anonymous"></script>
</body>

</html>