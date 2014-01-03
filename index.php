<style>
    table,td{
        border: 1px solid black;
    }
</style>

<?php
// Database class CRUD

include_once("server/dbMysqli.php");

$sql = dbMysqli::getInstance();

////insert
//$stmt = $sql->prepare(
//        'INSERT INTO einsatz (einsatz,ort) VALUES(?,?)'
//);
//
//// ss = string ($einsatz), string ($ort)
//$stmt->bind_param('ss', $einsatz, $ort);
//
//$einsatz = 'Einsatz Feb. 2013 Hh';
//$ort = 'Hamburg';
//
////update
//$stmt = $sql->prepare("UPDATE einsatz SET einsatz = ?,
//   ort = ?
//   WHERE einsatzId = ?");
//$stmt->bind_param('ssi', $einsatz, $ort, $einsatzId);
//$einsatz = "Einsatz Neumarkt März 2013";
//$ort = 'Neumarkt';
//$einsatzId = 1;
//
//// delete
//$stmt=$sql->prepare('Delete from einsatz where einsatzId=?');
//$stmt->bind_param('i',$id);
//
//$id=210;
// execute
//$stmt->execute();
//seelect
$result = $sql->query("select * from einsatz");
?>


<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="webclient/includes/jquery-ui-1.10.3.custom.css" />

        <script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyAWpvshYSBAJunGYz_mVqN06tYgLNsJXs8&sensor=false">
        </script>
        <script src="webclient/includes/jquery-1.9.1.js"></script>
        <script src="webclient/includes/jquery-ui-1.10.3.custom.min.js"></script>
        <meta charset="UTF-8">
        <title>Test Open Ecc</title>
        <style>

        </style>
        <script>
            function initialize()
            {
                var mapProp = {
                    center: new google.maps.LatLng(51.508742, -0.120850),
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                };
                var map = new google.maps.Map(document.getElementById("googleMap")
                        , mapProp);
            }

            google.maps.event.addDomListener(window, 'load', initialize);
            $(function() {
                $("#googleMap").dialog({
                    width: 600,
                    modal: true,
                    position: ['center', 500]});
                $("#einsatzliste").dialog({
                    width: 600,
                    height: 400,
                    modal: true,
//                    pos:'middle',20 (20px down from top)
                    position: ['right', 60]});
            });
        </script>
    </head>

    <body>
        <h1>Willkommen auf der Seite unserer Feuerwehr (Demo)</h1>
        <div id="einsatzliste" title="Einsatzliste">

            <table><tr><th>Nr</th><th>Einsatz</th><th>Ort</th></tr><?php
                /* Fetch the results of the query */
                while ($row = $result->fetch_assoc()) {
                    echo '<tr><td>' . $row['einsatzId'] . '</td><td>' . $row['einsatz'] . '</td><td>' . $row['ort'] . '</td></tr>';
                }
                ?></table>

        </div>

        <div id="googleMap" title="Karte" style="width:500px;height:380px;"></div>
        <?php
// put your code here
        ?>
    </body>
</html>
