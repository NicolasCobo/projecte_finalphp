<?php
require 'db.php';
$error = '';

if (isset($_POST['id_socio'])) {

    $id_soci       = intval($_POST['id_socio']);
    $id_llibre     = intval($_POST['id_libro']);
    $data_prestec  = mysqli_real_escape_string($conn, trim($_POST['fecha_prestamo']));
    $data_prevista = mysqli_real_escape_string($conn, trim($_POST['fecha_devolucion_prevista']));

    $sql = "INSERT INTO Prestamos (fecha_prestamo, fecha_devolucion_prevista, fecha_devolucion_real, socio, libro)
            VALUES ('$data_prestec', '$data_prevista', NULL, $id_soci, $id_llibre)";

    if (!mysqli_query($conn, $sql)) {
        $error = mysqli_error($conn);
    } else {
        header('Location: prestecs.php?ok=1');
        exit;
    }
}
?>

<?php require 'header.php'; ?>

<h1>Nou préstec</h1>

<?php if ($error): ?>
<p class='mensaje-error'>Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action='nou_prestec.php' method='POST'>

<label>Data del préstec *</label><br>
<input type='date' name='fecha_prestamo' required><br><br>

<label>Data de devolució prevista *</label><br>
<input type='date' name='fecha_devolucion_prevista' required><br><br>

<label>ID soci *</label><br>
<input type='number' name='id_socio' min='1' required><br><br>

<label>ID llibre *</label><br>
<input type='number' name='id_libro' min='1' required><br><br>

<button type='submit'>Desar préstec</button>
<a href='prestecs.php'>Cancel·lar</a>

</form>

<?php require 'footer.php'; ?>