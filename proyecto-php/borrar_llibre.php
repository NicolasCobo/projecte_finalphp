<?php
require 'db.php';

// Llegim l'id de la URL i el convertim a enter
$id = intval($_GET['id'] ?? 0);

// Comprovam que l'id és vàlid
if ($id <= 0) {
    header('Location: llibres.php');
    exit;
}

// Executam el DELETE
$sql = "DELETE FROM Libros WHERE id = $id";
if (mysqli_query($conn, $sql)) {
    header('Location: llibres.php?borrat=1');
} else {
    // Error 1451 = no es pot esborrar per una restricció de clau forana
    if (mysqli_errno($conn) == 1451) {
        header('Location: llibres.php?error=te_prestecs');
    } else {
        // Altres errors inesperats
        $msg = urlencode(mysqli_error($conn));
        header('Location: llibres.php?error=' . $msg);
    }
}
exit;
