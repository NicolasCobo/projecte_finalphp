<?php
require 'db.php';
$missatge = '';
$tipus = '';

if (isset($_POST['nombre'])) {
    $nom       = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $telefon   = mysqli_real_escape_string($conn, trim($_POST['telefono']));
    $email     = mysqli_real_escape_string($conn, trim($_POST['email']));
    $data_alta = mysqli_real_escape_string($conn, trim($_POST['fecha_alta']));
    $actiu     = isset($_POST['activo']) ? 1 : 0;

    $sql = "INSERT INTO Socios (nombre, telefono, email, fecha_alta, activo)
            VALUES ('$nom', '$telefon', '$email', '$data_alta', '$actiu')";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?ok=1');
        exit;
    } else {
        $missatge = "Error en desar: " . mysqli_error($conn);
        $tipus = "error";
    }
}
?>

<?php require 'header.php'; ?>

<h1>Nou soci</h1>

<?php if ($missatge): ?>
<p class='mensaje-<?php echo $tipus; ?>'><?php echo $missatge; ?></p>
<?php endif; ?>

<form action='nou_soci.php' method='POST'>
<label>Nom *</label><br>
<input type='text' name='nombre' required><br><br>

<label>Telèfon</label><br>
<input type='text' name='telefono'><br><br>

<label>Email</label><br>
<input type='email' name='email'><br><br>

<label>Data d'alta *</label><br>
<input type='date' name='fecha_alta' required><br><br>

<label>Actiu</label><br>
<input type='checkbox' name='activo' checked> 1=actiu, 0=baixa<br><br>

<button type='submit'>Desar soci</button>
<a href='index.php'>Cancel·lar</a>
</form>

<?php require 'footer.php'; ?>
