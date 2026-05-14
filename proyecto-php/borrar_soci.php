<?php
require 'db.php';

$id = intval($_GET['id'] ?? 0);
if ($id <= 0) { header('Location: index.php'); exit; }

$sql = "DELETE FROM Socios WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header('Location: index.php?borrat=1');
} else {
    if (mysqli_errno($conn) == 1451) {
        header('Location: index.php?error=te_prestecs');
    } else {
        $msg = urlencode(mysqli_error($conn));
        header('Location: index.php?error=' . $msg);
    }
}
exit;
