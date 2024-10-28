<?php
    require_once __DIR__.'/../vendor/autoload.php';
    $mongoClient = new MongoDB\Client("mongodb+srv://Hbert:QXaAzAECo70LWRWW@cluster0.mojcz.mongodb.net/?retryWrites=true&w=majority&appName=Cluster0");
    $database = $mongoClient->selectDataBase('Gym');
    $tasksCollection = $database->suscripciones;
?>