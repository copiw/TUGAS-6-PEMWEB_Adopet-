<?php
include 'db.php';

// Tambah hewan
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nama = $_POST['nama'];
    $jenis = $_POST['jenis_hewan'];
    $umur = $_POST['umur'];
    $foto_name = $_FILES['foto']['name'];
    $foto_tmp = $_FILES['foto']['tmp_name'];

    $target = "uploads/" . basename($foto_name);
    move_uploaded_file($foto_tmp, $target);

    $conn->query("INSERT INTO pets (nama, jenis_hewan, umur, foto) VALUES ('$nama', '$jenis', $umur, '$foto_name')");
    header("Location: index.php");
}

$pets = $conn->query("SELECT * FROM pets");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Adopet! - Adopsi Hewan Virtual</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>🐾 Adopet! - Adopsi Hewan Virtual</h1>

    <form method="POST" enctype="multipart/form-data">
        <input type="text" name="nama" placeholder="Nama hewan (ex: Cilok)" required>
        <input type="text" name="jenis_hewan" placeholder="Jenis hewan" required>
        <input type="number" name="umur" placeholder="Umur" required>
        <input type="file" name="foto" accept="image/*" required>
        <button type="submit">Tambah Hewan 🐶</button>
    </form>

    <h2>🐕 Daftar Hewan</h2>
    <div class="grid">
        <?php while($row = $pets->fetch_assoc()): ?>
            <div class="card">
                <?php if ($row['foto']): ?>
                    <img src="uploads/<?= htmlspecialchars($row['foto']) ?>" alt="<?= htmlspecialchars($row['nama']) ?>">
                <?php else: ?>
                    <div class="placeholder">Tidak Ada Foto</div>
                <?php endif; ?>
                <h3><?= htmlspecialchars($row['nama']) ?></h3>
                <p><?= $row['jenis_hewan'] ?> | <?= $row['umur'] ?> tahun</p>
                <p>Status: <strong><?= $row['status'] ?></strong></p>
                <a href="edit.php?id=<?= $row['id'] ?>">Adopsi</a>
                <a href="delete.php?id=<?= $row['id'] ?>" onclick="return confirm('Apakah hewan ini kabur dari kandang? 😂')">Hapus</a>
            </div>
        <?php endwhile; ?>
    </div>
</body>
</html>
