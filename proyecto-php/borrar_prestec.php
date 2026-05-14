<?php
require 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: prestecs.php'); exit; }

$sql = "DELETE FROM Prestamos WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header('Location: prestecs.php?borrat=1');
} else {
    $msg = urlencode(mysqli_error($conn));
    header("Location: prestecs.php?error=$msg");
}
exit;
