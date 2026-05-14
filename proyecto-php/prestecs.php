<?php require 'db.php'; ?>

<?php
$sql = "SELECT p.id,
        p.fecha_prestamo AS 'Data préstec',
        s.nombre AS 'Soci',
        l.titulo AS 'Llibre',
        p.fecha_devolucion_prevista AS 'Devolució prevista',
        p.fecha_devolucion_real AS 'Devolució real'
        FROM Prestamos p
        JOIN Socios s ON p.socio = s.id
        JOIN Libros l ON p.libro = l.id
        ORDER BY p.fecha_prestamo DESC";

$res = mysqli_query($conn, $sql);
if (!$res) die('Error SQL: ' . mysqli_error($conn));

$missatge = '';
$tipus = 'ok';

if (isset($_GET['ok']))              $missatge = 'Préstec desat correctament!';
if (isset($_GET['borrat']))          $missatge = 'Préstec eliminat correctament!';
if (isset($_GET['actualitzat']))     $missatge = 'Préstec actualitzat correctament!';
if (isset($_GET['error'])) {
    $missatge = 'Error: ' . htmlspecialchars($_GET['error']);
    $tipus = 'error';
}
?>

<?php require 'header.php'; ?>

<h1>Préstecs</h1>

<?php if ($missatge): ?>
<p class='mensaje-<?php echo $tipus; ?>'><?php echo $missatge; ?></p>
<?php endif; ?>

<table>
<thead>
<tr>
<?php
$camps = mysqli_fetch_fields($res);
foreach ($camps as $camp) {
    if ($camp->name === 'id') continue;
    echo "<th>{$camp->name}</th>";
}
?>
<th>Accions</th>
</tr>
</thead>

<tbody>
<?php while ($fila = mysqli_fetch_assoc($res)): ?>
<tr>
<td><?php echo $fila['Data préstec']; ?></td>
<td><?php echo $fila['Soci']; ?></td>
<td><?php echo $fila['Llibre']; ?></td>
<td><?php echo $fila['Devolució prevista']; ?></td>
<td><?php echo $fila['Devolució real'] ?? '—'; ?></td>

<td>
    <a href='retornar_prestec.php?id=<?php echo $fila['id']; ?>' class='btn-editar'>&#9998;</a>
    <a href='borrar_prestec.php?id=<?php echo $fila['id']; ?>' class='btn-borrar'>&#10005;</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php require 'footer.php'; ?>
