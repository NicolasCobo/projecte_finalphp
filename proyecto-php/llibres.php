<?php require 'db.php'; ?>

<?php
$sql = "SELECT id, titulo, autor, isbn, ano_publicacion AS 'Any publicació',
        num_ejemplares AS 'Nombre d\'exemplars'
        FROM Libros
        ORDER BY titulo ASC";
$res = mysqli_query($conn, $sql);
if (!$res) die('Error SQL: ' . mysqli_error($conn));

$missatge = '';
$tipus = 'ok';

if (isset($_GET['ok']))          $missatge = 'Llibre desat correctament!';
if (isset($_GET['borrat']))      $missatge = 'Llibre eliminat correctament!';
if (isset($_GET['actualitzat'])) $missatge = 'Llibre actualitzat correctament!';
if (isset($_GET['error'])) {
    $missatge = 'Error: ' . htmlspecialchars($_GET['error']);
    $tipus = 'error';
}
?>

<?php require 'header.php'; ?>

<h1>Llibres</h1>

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
<td><?php echo $fila['titulo']; ?></td>
<td><?php echo $fila['autor']; ?></td>
<td><?php echo $fila['isbn'] ?? '—'; ?></td>
<td><?php echo $fila['Any publicació'] ?? '—'; ?></td>
<td><?php echo $fila['Nombre d\'exemplars']; ?></td>

<td>
    <a href='editar_llibre.php?id=<?php echo $fila['id']; ?>' class='btn-editar'>&#9998;</a>
    <a href='borrar_llibre.php?id=<?php echo $fila['id']; ?>' class='btn-borrar'>&#10005;</a>
</td>
</tr>
<?php endwhile; ?>
</tbody>
</table>

<?php require 'footer.php'; ?>
