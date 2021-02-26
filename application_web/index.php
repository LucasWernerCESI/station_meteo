<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>La météo en temps réél</title>
        <link rel="stylesheet" href="app.css">
        <link rel="stylesheet" href="http://cdnjs.cloudflare.com/ajax/libs/weather-icons/2.0.10/css/weather-icons.min.css">
    </head>
    <body>
        <button type="button" id="testAPI">Click</button>
        <div id="test">

        <?php
        
            $curl = curl_init();

            $opts = [
                CURLOPT_URL => 'http://localhost/station_meteo/api/data/read.php',
                CURLOPT_RETURNTRANSFER => true,
            ];
            
            curl_setopt_array($curl, $opts);
            
            $response = json_decode(curl_exec($curl), true);

            var_dump($response);

            curl_close($curl);

        ?>

        </div>
        <section id="app">
            


        </section>

        <a href="http://jquery.com/">jQuery</a>
        <script src="jquery.js"></script>
        <script src="./app.js"></script>
    </body>
</html>