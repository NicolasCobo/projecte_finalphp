<?php
require 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

if (isset($_POST['nombre'])) {
    $nom       = mysqli_real_escape_string($conn, trim($_POST['nombre']));
    $telefon   = mysqli_real_escape_string($conn, trim($_POST['telefono']));
    $email     = mysqli_real_escape_string($conn, trim($_POST['email']));
    $data_alta = mysqli_real_escape_string($conn, trim($_POST['fecha_alta']));
    $actiu     = isset($_POST['activo']) ? 1 : 0;

    $sql = "UPDATE Socios
            SET nombre='$nom', telefono='$telefon', email='$email',
                fecha_alta='$data_alta', activo='$actiu'
            WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header('Location: index.php?actualitzat=1');
        exit;
    } else $error = mysqli_error($conn);
}

$sql = "SELECT * FROM Socios WHERE id=$id";
$res = mysqli_query($conn, $sql);
$soci = mysqli_fetch_assoc($res);
if (!$soci) { header('Location: index.php'); exit; }
?>

<?php require 'header.php'; ?>

<h1>Editar soci</h1>

<?php if (isset($error)): ?>
<p class='mensaje-error'>Error: <?php echo htmlspecialchars($error); ?></p>
<?php endif; ?>

<form action='editar_soci.php?id=<?php echo $id; ?>' method='POST'>
<label>Nom *</label><br>
<input type='text' name='nombre' value='<?php echo $soci['nombre']; ?>' required><br><br>

<label>Telèfon</label><br>
<input type='text' name='telefono' value='<?php echo $soci['telefono']; ?>'><br><br>

<label>Email</label><br>
<input type='email' name='email' value='<?php echo $soci['email']; ?>'><br><br>

<label>Data d'alta *</label><br>
<input type='date' name='fecha_alta' value='<?php echo $soci['fecha_alta']; ?>' required><br><br>

<label>Actiu</label><br>
<input type='checkbox' name='activo' <?php echo $soci['activo'] ? 'checked' : ''; ?>> 1=actiu, 0=baixa<br><br>

<button type='submit'>Desar canvis</button>
<a href='index.php'>Cancel·lar</a>
</form>

<?php require 'footer.php'; ?>
