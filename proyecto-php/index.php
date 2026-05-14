<?php
require 'db.php';

$sql = "SELECT id, nombre, telefono, email, fecha_alta, activo
        FROM Socios
        ORDER BY nombre";
$res = mysqli_query($conn, $sql);
if (!$res) die("Error SQL: " . mysqli_error($conn));

$missatge = '';
$tipus = 'ok';

if (isset($_GET['ok']))          $missatge = 'Soci desat correctament!';
if (isset($_GET['borrat']))      $missatge = 'Soci eliminat correctament!';
if (isset($_GET['actualitzat'])) $missatge = 'Soci actualitzat correctament!';
if (isset($_GET['error'])) {
    $missatge = 'No s’ha pogut eliminar: ' . htmlspecialchars($_GET['error']);
    $tipus = 'error';
}
?>

<?php require 'header.php'; ?>

<h1>Socis</h1>

<?php if ($missatge): ?>
<p class='mensaje-<?php echo $tipus; ?>'><?php echo $missatge; ?></p>
<?php endif; ?>

<table>
<thead>
<tr>
<?php
$camps = mysqli_fetch_fields($res);
foreach ($camps as $camp) echo "<th>{$camp->name}</th>";
?>
<th>Accions</th>
</tr>
</thead>

<tbody>
<?php while ($fila = mysqli_fetch_assoc($res)): ?>
<tr>
<?php foreach ($fila as $valor) echo "<td>$valor</td>"; ?>

<td>
    <a href='editar_soci.php?id=<?php echo $fila['id']; ?>' class='btn-editar'>&#9998;</a>
    <a href='borrar_soci.php?id=<?php echo $fila['id']; ?>' class='btn-borrar'>&#10005;</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php require 'footer.php'; ?>
