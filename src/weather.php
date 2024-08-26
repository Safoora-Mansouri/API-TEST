<?php

// Include the database configuration file
include 'db_config.php';

function fetchWeatherData($city, $api_key) {
    $api_url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}&units=metric";
    $response = file_get_contents($api_url);
    return json_decode($response, true);
}
/////////////////////////////////////////////////////////////////////////////

function extractWeatherInfo($data) {
    return [
        'temperature' => $data['main']['temp'],
        'description' => $data['weather'][0]['description'],
        'humidity' => $data['main']['humidity'],
        'feels_like' => $data['main']['feels_like'],
        'pressure' => $data['main']['pressure']
    ];
}

////////////////////////////////////////////////////////////////////////////////

function saveWeatherData($conn, $city, $weatherInfo) {
    $stmt = $conn->prepare("INSERT INTO weather_data (city, temperature, humidity, feels_like, pressure, description) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param(
        "sdddds",
        $city,
        $weatherInfo['temperature'],
        $weatherInfo['humidity'],
        $weatherInfo['feels_like'],
        $weatherInfo['pressure'],
        $weatherInfo['description']
    );
    $stmt->execute();
    $stmt->close();
}

/////////////////////////////////////////////////////////////////////////////////

function retrieveWeatherData($conn) {
    $sql = "SELECT * FROM weather_data";
    return $conn->query($sql);
}

/////////////////////////////////////////////////////////////////////////////

function displayWeatherData($result) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "City: " . $row["city"] .
                 " - Temperature: " . $row["temperature"] . "°C" .
                 " - Humidity: " . $row["humidity"] . "%" .
                 " - Feels Like: " . $row["feels_like"] . "°C" .
                 " - Pressure: " . $row["pressure"] . " hPa" .
                 " - Description: " . $row["description"] .
                 " - Date: " . $row["date"] . "<br>";
        }
    } else {
        echo "No data found";
    }
}

// Main code execution
$city = "Montreal";
$api_key = "3e2920e9ebd8a01af7cdd9887e8bb73a"; 

$data = fetchWeatherData($city, $api_key);
$weatherInfo = extractWeatherInfo($data);
saveWeatherData($conn, $city, $weatherInfo);

$result = retrieveWeatherData($conn);
displayWeatherData($result);

// Close the database connection
$conn->close();

?>