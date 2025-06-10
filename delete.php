<?php
include 'db.php';
$id = $_GET['id'];
$result = $conn->query("SELECT * FROM pets WHERE id=$id");
$pet = $result->fetch_assoc();

$conn->query("DELETE FROM pets WHERE id=$id");
echo "<script>alert('⚠️ {$pet['nama']} kabur dari kandang!'); window.location='index.php';</script>";
?>
