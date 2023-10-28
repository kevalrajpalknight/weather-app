<!DOCTYPE html>
<html>
    <head>
        <title>Current Weather App</title>
        <link rel="stylesheet" type="text/css" href="style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" ></script>
    </head>
    <body>
<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the user's input (city name) from the form
    $city = $_POST['city'];

    // Replace 'YOUR_API_KEY' with your actual OpenWeatherMap API key
    $api_key = OPENWEATHER_API_KEY;
    $google_api_key = GOOGLE_API_KEY;

    // Create the API URL
    $api_url = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";

    // Fetch weather data from the API
    $weather_data = file_get_contents($api_url);

    // Convert the JSON response to an associative array
    $weather_info = json_decode($weather_data, true);

    // Display the weather information
    if ($weather_info) {
        echo '<div class="card">';
        echo '<div class="card-body">';
        echo '<div class="d-flex justify-content-center">';
        echo "<h2 class='card-title'>Weather in {$weather_info['name']}, {$weather_info['sys']['country']}</h2>";
        echo '<div id="weather-icon"></div>';
        echo '</div>';
        echo '<div class="card-text">';
        echo '<div class="row">';
        echo '<div class="col-md-6">';
        echo "<p><strong>Temperature:</strong> {$weather_info['main']['temp']} °C</p>";
        echo '</div>';
        echo '<div class="col-md-6">';
        echo "<p><strong>Condition:</strong> {$weather_info['weather'][0]['description']}</p>";
        echo '</div>';
        echo '<div class="col-md-6">';
        echo "<p><strong>Latitude:</strong> {$weather_info['coord']['lat']}</p>";
        echo '</div>';
        echo '<div class="col-md-6">';
        echo "<p><strong>Longitude:</strong> {$weather_info['coord']['lon']}</p>";
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
        
        echo '<div class="d-flex justify-content-center text-center">';
        echo '<div id="map" style="height: 500px;" class="mt-5 w-100"></div>';
        echo '</div>';

        // Include the JavaScript for displaying icons and Google Maps
        echo '
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key='.$google_api_key.'"></script>
        <script>
            $(document).ready(function() {
                // Update the HTML elements with weather data
                $("#city").text("'.$weather_info['name'].'");
                $("#country").text("'.$weather_info['sys']['country'].'");
                $("#temperature").text("'.$weather_info['main']['temp'].'");
                $("#condition").text("'.$weather_info['weather'][0]['description'].'");
                $("#latitude").text("'.$weather_info['coord']['lat'].'");
                $("#longitude").text("'.$weather_info['coord']['lon'].'");

                // Display weather condition icons for day and night
                var weatherIcon = $("<img>");
                if ("'.$weather_info['weather'][0]['icon'].'" && "'.$weather_info['weather'][0]['icon'].'".includes("d")) {
                    weatherIcon.attr("src", "day_icon.png");
                } else {
                    weatherIcon.attr("src", "night_icon.png");
                }
                $("#weather-icon").append(weatherIcon);

                // Display the Google Map
                var mapOptions = {
                    center: { lat: parseFloat("'.$weather_info['coord']['lat'].'"), lng: parseFloat("'.$weather_info['coord']['lon'].'") },
                    zoom: 10
                };
                var map = new google.maps.Map(document.getElementById("map"), mapOptions);
            });
        </script>';
    } else {
        echo "City not found.";
    }
}
?>

</body>
</html>