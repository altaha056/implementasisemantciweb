<html>
    <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
        <link rel="icon" href="nachos.png">
        <title>Kebutuhan</title>
    </head>
    <body>
        <div class = "jumbotron">
        <div class="container-full-bg">
        <h1 class="text-center mb-5">Daftar Kebutuhan</h1>
            <div class="row mt-5">
        <?php

            require_once("sparqllib.php");
					$db = sparql_connect( "http://localhost:3030/kebutuhan/sparql" );
					if( !$db ) { print sparql_errno() . ": " . sparql_error(). "\n"; exit; }

            $sparql = "prefix su: <http://www.w3.org/2006/vcard/ns#> 
            prefix pr: <http://www.snee.com/hr/> 

            SELECT ?merek ?produsen ?negara ?gambar
            WHERE {
              ?o pr:merek ?merek.
              ?o pr:produsen ?produsen.
              ?o pr:negara ?negara.
              ?o pr:gambar ?gambar.
            }";

            $result = sparql_query ($sparql);
            $fields = sparql_field_array ($result);

            while ($row = sparql_fetch_array($result))
            {
                print "<div class='col-sm mt-5'>";
                print "<div class='card' style='width:18rem;'>";
                print "<img src='$row[gambar]' class='card-img-top'>";
                print "<div class='card-body'>";
                print "<h5 class='card-title'>$row[merek]</h5>";
                print "<p class='card-text'>$row[produsen]</p>";
                print "<p class='card-text'>$row[negara]</p>";
                print "</div>";
                print "</div>";
                print "</div>";
            }
        ?>
            
            </div></div></div>
    </body>
</html>
