<?php
require 'db.php';
$error = '';

if (isset($_POST['titulo'])) {
    $titol          = mysqli_real_escape_string($conn, trim($_POST['titulo']));
    $autor          = mysqli_real_escape_string($conn, trim($_POST['autor']));
    $isbn           = mysqli_real_escape_string($conn, trim($_POST['isbn']));
    $any_publicacio = intval($_POST['ano_publicacion']);
    $num_exemplars  = intval($_POST['num_ejemplares']);

    $sql = "INSERT INTO Libros (titulo, autor, isbn, ano_publicacion, num_ejemplares)
            VALUES ('$titol', '$autor', '$isbn', $any_publicacio, $num_exemplars)";

    if (!mysqli_query($conn, $sql)) {
        $error = mysqli_error($conn);
    } else {
        header('Location: llibres.php?ok=1');
        exit;
    }
}
?>

<?php require 'header.php'; ?>

<h1>Nou llibre</h1>

<?php if ($error): ?>
<p class='mensaje-error'>Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action='nou_llibre.php' method='POST'>

<label>Títol *</label><br>
<input type='text' name='titulo' required><br><br>

<label>Autor *</label><br>
<input type='text' name='autor' required><br><br>

<label>ISBN</label><br>
<input type='text' name='isbn'><br><br>

<label>Any de publicació</label><br>
<input type='number' name='ano_publicacion' min='1000' max='2100'><br><br>

<label>Nombre d'exemplars *</label><br>
<input type='number' name='num_ejemplares' min='1' value='1' required><br><br>

<button type='submit'>Desar llibre</button>
<a href='llibres.php'>Cancel·lar</a>

</form>

<?php require 'footer.php'; ?>
