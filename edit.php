<?php
include 'db.php';
$id = $_GET['id'];

$result = $conn->query("SELECT * FROM pets WHERE id=$id");
$data = $result->fetch_assoc();

if ($data['status'] === 'tersedia') {
    $conn->query("UPDATE pets SET status='diadopsi' WHERE id=$id");
    echo "<script>alert('🎉 {$data['nama']} sudah punya rumah baru!'); window.location='index.php';</script>";
} else {
    echo "<script>alert('😅 {$data['nama']} sudah diadopsi sebelumnya!'); window.location='index.php';</script>";
}
?>
