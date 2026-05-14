<?php
require 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: prestecs.php'); exit; }

if (isset($_POST['fecha_devolucion_real'])) {
    $data_real = mysqli_real_escape_string($conn, trim($_POST['fecha_devolucion_real']));

    $sql = "UPDATE Prestamos
            SET fecha_devolucion_real='$data_real'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header('Location: prestecs.php?actualitzat=1');
        exit;
    } else $error = mysqli_error($conn);
}

$sql = "SELECT p.id, p.fecha_prestamo, p.fecha_devolucion_prevista,
               s.nombre AS soci, l.titulo AS llibre
        FROM Prestamos p
        JOIN Socios s ON p.socio = s.id
        JOIN Libros l ON p.libro = l.id
        WHERE p.id = $id";

$res = mysqli_query($conn, $sql);
$prestec = mysqli_fetch_assoc($res);
if (!$prestec) { header('Location: prestecs.php'); exit; }
?>

<?php require 'header.php'; ?>

<h1>Retornar préstec</h1>

<?php if (isset($error)): ?>
<p class='mensaje-error'>Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<p><strong>Soci:</strong> <?php echo htmlspecialchars($prestec['soci']); ?></p>
<p><strong>Llibre:</strong> <?php echo htmlspecialchars($prestec['llibre']); ?></p>
<p><strong>Data del préstec:</strong> <?php echo htmlspecialchars($prestec['fecha_prestamo']); ?></p>
<p><strong>Data de devolució prevista:</strong> <?php echo htmlspecialchars($prestec['fecha_devolucion_prevista']); ?></p>

<form action='retornar_prestec.php?id=<?php echo $id; ?>' method='POST'>

<label>Data de devolució real *</label><br>
<input type='date' name='fecha_devolucion_real'
       value='<?php echo date('Y-m-d'); ?>' required><br><br>

<button type='submit'>Confirmar devolució</button>
<a href='prestecs.php'>Cancel·lar</a>

</form>

<?php require 'footer.php'; ?>