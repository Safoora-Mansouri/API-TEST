-- Create the database
CREATE DATABASE IF NOT EXISTS weather_db;

-- Use the database
USE weather_db;

-- Create the weather_data table
CREATE TABLE IF NOT EXISTS weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100),
    temperature FLOAT,
    humidity FLOAT,
    feels_like FLOAT,
    pressure FLOAT,
    description VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);