<?php
// Include the database configuration file
include 'db_config.php';

// API endpoint and API key
$city = "Montreal";
$api_key = "your_api_key"; // Replace with your OpenWeatherMap API key
$api_url = "http://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$api_key}&units=metric";

// Fetch data from API
$response = file_get_contents($api_url);
$data = json_decode($response, true);

// Extract information from API response
$temperature = $data['main']['temp'];
$description = $data['weather'][0]['description'];
$humidity = $data['main']['humidity'];
$feels_like = $data['main']['feels_like'];
$pressure = $data['main']['pressure'];

// Insert data into the database
$stmt = $conn->prepare("INSERT INTO weather_data (city, temperature, humidity, feels_like, pressure, description) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("sdddds", $city, $temperature, $humidity, $feels_like, $pressure, $description);
$stmt->execute();
$stmt->close();

// Retrieve and display data from the database
$sql = "SELECT * FROM weather_data";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "City: " . $row["city"] . " - Temperature: " . $row["temperature"] . "°C - Humidity: " . $row["humidity"] . "% - Feels Like: " . $row["feels_like"] . "°C - Pressure: " . $row["pressure"] . " hPa - Description: " . $row["description"] . " - Date: " . $row["date"] . "<br>";
    }
} else {
    echo "No data found";
}

// Close the database connection
$conn->close();
?>