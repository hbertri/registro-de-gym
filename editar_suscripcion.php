<?php
require_once __DIR__ . '/includes/functions.php';
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit;
}
$suscripcion = obtenerSuscripcionPorId($_GET['id']);

if (!$suscripcion) {
    header("Location: index.php?mensaje=suscripcion no encontrado");
    exit;
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $count = actualizarSuscripcion($_GET['id'], $_POST['nombre'], $_POST['dni'], $_POST['fechaInscripcion'], $_POST['fechaVencimiento']);
    if ($count > 0) {
        header("Location: index.php?mensaje=Suscripcion actualizada con éxito");
        exit;
    } else {
        $error = "No se pudo actualizar la suscripcion.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Suscripción</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>

<body>
    <div class="container">
        <h1>Editar suscripción</h1>
        <hr>
        <?php if (isset($error)): ?>
            <div class="error"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="POST">
            <label>Nombre: <input type="text" name="nombre" value="<?php echo htmlspecialchars($suscripcion['nombre']); ?>" required></label>
            <label>Dni: <input name="dni" type="number" value="<?php echo htmlspecialchars($suscripcion['dni']); ?>" required></label>
            <label>Fecha de inscripción: <input type="date" name="fechaInscripcion" value="<?php echo formatDate($suscripcion['fechaInscripcion']); ?>" required></label>
            <label>Fecha de vencimiento: <input type="date" name="fechaVencimiento" value="<?php echo formatDate($suscripcion['fechaVencimiento']); ?>" required></label>
            <input type="submit" value="Actualizar Suscripcion">
        </form>
        <a href="index.php" class="button">Volver a la lista de suscripciones</a>
    </div>
</body>

</html>