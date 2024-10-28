<?php
require_once __DIR__ . '/includes/functions.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = crearSuscripcion($_POST['nombre'], $_POST['dni'], $_POST['fechaInscripcion'], $_POST['fechaVencimiento']);
    if ($id) {
        header("Location: index.php?mensaje=Suscripcion agregada con éxito");
        exit;
    } else {
        $error = "No se pudo crear la suscripción.";
    }
}
?>
<?php if (isset($error)): ?>
    <div class="error"><?php echo $error; ?></div>
<?php endif; ?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agregar Nueva Suscripción</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Agregar Nueva Suscripción</h1><hr>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" required></label>
            <label>Dni: <input type="number" name="dni" required></label>
            <label>Fecha de Inscripción: <input type="date" name="fechaInscripcion" required></label>
            <label>Fecha de vencimiento: <input type="date" name="fechaVencimiento" required></label>
            <input type="submit" value="Agregar Suscripción">
        </form>
        <a href="index.php" class="button">Volver a la lista de suscripciones</a>
    </div>
</body>

</html>