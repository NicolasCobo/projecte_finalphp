<?php
require 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: llibres.php'); exit; }

if (isset($_POST['titulo'])) {
    $titol          = mysqli_real_escape_string($conn, trim($_POST['titulo']));
    $autor          = mysqli_real_escape_string($conn, trim($_POST['autor']));
    $isbn           = mysqli_real_escape_string($conn, trim($_POST['isbn']));
    $any_publicacio = intval($_POST['ano_publicacion']);
    $num_exemplars  = intval($_POST['num_ejemplares']);

    $sql = "UPDATE Libros
            SET titulo='$titol', autor='$autor', isbn='$isbn',
                ano_publicacion=$any_publicacio, num_ejemplares=$num_exemplars
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header('Location: llibres.php?actualitzat=1');
        exit;
    } else $error = mysqli_error($conn);
}

$sql = "SELECT * FROM Libros WHERE id=$id";
$res = mysqli_query($conn, $sql);
$llibre = mysqli_fetch_assoc($res);
if (!$llibre) { header('Location: llibres.php'); exit; }
?>

<?php require 'header.php'; ?>

<h1>Editar llibre</h1>

<?php if (isset($error)): ?>
<p class='mensaje-error'>Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action='editar_llibre.php?id=<?php echo $id; ?>' method='POST'>

<label>Títol *</label><br>
<input type='text' name='titulo' value='<?php echo $llibre['titulo']; ?>' required><br><br>

<label>Autor *</label><br>
<input type='text' name='autor' value='<?php echo $llibre['autor']; ?>' required><br><br>

<label>ISBN</label><br>
<input type='text' name='isbn' value='<?php echo $llibre['isbn']; ?>'><br><br>

<label>Any de publicació</label><br>
<input type='number' name='ano_publicacion' min='1000' max='2100'
       value='<?php echo $llibre['ano_publicacion']; ?>'><br><br>

<label>Nombre d'exemplars *</label><br>
<input type='number' name='num_ejemplares' min='1'
       value='<?php echo $llibre['num_ejemplares']; ?>' required><br><br>

<button type='submit'>Desar canvis</button>
<a href='llibres.php'>Cancel·lar</a>

</form>

<?php require 'footer.php'; ?>
