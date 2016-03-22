<!DOCTYPE html>
<html>
<head>
    <title>Navfriend</title>
</head>
<body style="bg-color:orange;margin:0px;margin-top:0px;" bgcolor="orange">

<script src="http://maps.googleapis.com/maps/api/js"></script>

<?php

function map()
{
echo '<script>';
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "maps";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM `markers`;";
$result = mysqli_query($conn, $sql);

    //prende la latitudine e la mette nel vettore lat
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    echo 'var lat = ['.$row["lat"];
    while($row = mysqli_fetch_assoc($result)) {
        echo ",".$row["lat"];
    }
    echo '];';
} else {
    echo "0 results";
}

    $result = mysqli_query($conn, $sql);
    //prende la longitudine e la mette nel vettore lng
if (mysqli_num_rows($result) > 0) {
    // output data of each row
    $row = mysqli_fetch_assoc($result);
    echo 'var lng = ['.$row["lng"];
    while($row = mysqli_fetch_assoc($result)) {
        echo ",".$row["lng"];
    }
    echo '];';
} else {
    echo "0 results";
}
mysqli_close($conn);
    
    //Per la mappa
    
echo '
function initialize() {
  var myLatLng = {lat: lat[0] , lng: lng[0]};
  var mapProp = {
    center:new google.maps.LatLng(myLatLng),
    zoom:10,
    mapTypeId:google.maps.MapTypeId.ROADMAP
  };
  var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

    for(var i=0;i<lat.length;i++)
    {
        var myLatLng = {lat:lat[i] , lng:lng[i] };
        var marker = new google.maps.Marker({
        position: myLatLng,
        map: map
        });
    }
    
}
google.maps.event.addDomListener(window, "load", initialize);

</script>';
}

map();
header( "refresh:2;" );


?>    

<div id="header" style="margin-top:60px;width:100%;height:20%;background-color:#ffc266;"> <center style="margin-top:60px"><h1>NAVFRIEND</h1></center> </div>
<div id="googleMap" style="width:100%;height:600px;">
 
</div>
<div id="menu" style="width:100%;height:20%;background-color:#ffc266;">
<div id="elem" style="display: inline-block;width:33%;height:100%;"><center><h3><a>Inizia viaggio</a></h3></center></div>
<div id="elem" style="display: inline-block;width:33%;height:100%;"><center><h3><a>Termina viaggio</a></h3></center></div>
<div id="elem" style="display: inline-block;width:33%;height:100%;"><center><h3><a>Info</a></h3></center></div>
</div>
</body>
</html>
