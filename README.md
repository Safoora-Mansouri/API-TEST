Collecte de données météorologiques pour la prévision de la consommation d'énergie
Description du projet
Ce projet consiste à collecter des données météorologiques pour différentes villes en utilisant l'API OpenWeatherMap afin de prévoir la consommation d'énergie et d'anticiper les besoins énergétiques. Les données collectées, y compris la température, l'humidité et la pression, sont stockées dans une base de données MySQL pour une analyse future.

Fonctionnalités
•	Récupération des données météorologiques depuis l'API OpenWeatherMap.
•	Stockage des données météorologiques dans une base de données MySQL.
•	Récupération et affichage des données stockées.
Prérequis
•	PHP 7.x ou supérieur
•	Base de données MySQL
•	Clé API OpenWeatherMap
Configuration de la base de données
CREATE DATABASE weather_db;
USE weather_db;
CREATE TABLE weather_data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    city VARCHAR(100),
    temperature FLOAT,
    humidity FLOAT,
    feels_like FLOAT,
    pressure FLOAT,
    description VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

Installation
1.	Clonez le dépôt :
git clone https://github.com/votreutilisateur/weather-data.git
cd weather-data
2.	Configurez la base de données en utilisant le script SQL fourni ci-dessus.
3.	Configurez la connexion à votre base de données dans le script PHP.
4.	Remplacez le placeholder your_api_key dans le script PHP par votre clé API OpenWeatherMap.
5.	Exécutez le script PHP :
php weather.php
Utilisation
•	Le script récupère les données météorologiques pour la ville spécifiée, les stocke dans la base de données et affiche les données stockées.
