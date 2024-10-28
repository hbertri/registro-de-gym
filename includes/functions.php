<?php
    require_once __DIR__ .'/../config/database.php';

    function obtenerSuscripciones() {
        global $tasksCollection;
        return $tasksCollection->find();
    }

    function formatDate($date) {
        return $date->toDateTime()->format('Y-m-d');
    }
    function sanitizeInput($input) {
        $input = htmlspecialchars(strip_tags(trim($input)));
        if (is_numeric($input)) {
            $input = max(0, $input);
        }
        return $input;
    }
    function crearSuscripcion($nombre, $dni, $fechaInscripcion, $fechaVencimiento) {
        global $tasksCollection;
        $resultado = $tasksCollection->insertOne([
            'nombre' => sanitizeInput($nombre),
            'dni' => sanitizeInput($dni),
            'fechaInscripcion' => new MongoDB\BSON\UTCDateTime(strtotime($fechaInscripcion) * 1000),
            'fechaVencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaVencimiento) * 1000),
            // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
        ]);
        return $resultado->getInsertedId();
    }
    function obtenerSuscripcionPorId($id) {
        global $tasksCollection;
        return $tasksCollection->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
    }
    function actualizarSuscripcion($id, $nombre, $dni, $fechaInscripcion, $fechaVencimiento) {
        global $tasksCollection;
        $resultado = $tasksCollection->updateOne(
            ['_id' => new MongoDB\BSON\ObjectId($id)],
            ['$set' => [
                'nombre' => sanitizeInput($nombre),
                'dni' => sanitizeInput($dni),
                'fechaInscripcion' => new MongoDB\BSON\UTCDateTime(strtotime($fechaInscripcion) * 1000),
                'fechaVencimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaVencimiento) * 1000),
                // 'fechaNacimiento' => new MongoDB\BSON\UTCDateTime(strtotime($fechaNacimiento) * 1000),
            ]]
        );
        return $resultado->getModifiedCount();
    }
    function eliminarSuscripcion($id) {
        global $tasksCollection;
        $resultado = $tasksCollection->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
        return $resultado->getDeletedCount();
    }
    
?>