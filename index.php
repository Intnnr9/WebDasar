<?php
require_once 'koneksi.php';

// Ambil semua data materi untuk ditampilkan di home atau nav
$query = $pdo->query("SELECT * FROM materi");
$all_materi = $query->fetchAll(PDO::FETCH_ASSOC);

// Logika halaman
$halaman_sekarang = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WebMaster Academy</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

    <nav>
        <div class="logo"><a href="index.php">Web<span>Master</span></a></div>
        <ul>
            <li><a href="index.php">Home</a></li>
            <?php foreach($all_materi as $m): ?>
                <li><a href="index.php?page=<?= htmlspecialchars($m['slug']) ?>"><?= htmlspecialchars($m['judul']) ?></a></li>
            <?php endforeach; ?>
        </ul>
    </nav>

   <main class="main-content">
        <?php 
       if ($halaman_sekarang == 'home'): ?>
        <h2 class="section-title">Semua Materi</h2>
        <section class="grid">
            <?php foreach ($all_materi as $m): ?>
                <a href="index.php?page=<?= $m['slug'] ?>" class="card">
                    <div class="icon"><?= $m['ikon'] ?></div>
                    <h3><?= $m['judul'] ?></h3>
                    <p><?= $m['deskripsi'] ?></p>
                </a>
            <?php endforeach; 
        ?>
            <section class="grid">
                <?php foreach ($all_materi as $m): ?>
                    <a href="index.php?page=<?= htmlspecialchars($m['slug']) ?>" class="card">
                        <div class="icon"><?= $m['ikon'] ?></div>
                        <h3><?= htmlspecialchars($m['judul']) ?></h3>
                        <p><?= htmlspecialchars($m['deskripsi']) ?></p>
                    </a>
                <?php endforeach; ?>
            </section>
        <?php else: 
            // Ambil detail materi
            $stmt = $pdo->prepare("SELECT * FROM materi WHERE slug = ?");
            $stmt->execute([$halaman_sekarang]);
            $item = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($item): ?>
                <section class="detail-page">
                    <h1><?= htmlspecialchars($item['ikon']) . " " . htmlspecialchars($item['judul']) ?></h1>
                    <p><?= htmlspecialchars($item['deskripsi']) ?></p>
                    <h3>Materi Utama:</h3>
                    <ul>
                        <?php 
                        $list = explode(',', $item['detail_list']); 
                        foreach($list as $l): ?>
                            <li><?= htmlspecialchars(trim($l)) ?></li>
                        <?php endforeach; ?>
                    </ul>
                    <a href="index.php" class="btn">Kembali</a>
                </section>
            <?php else: ?>
                <p>Materi tidak ditemukan.</p>
            <?php endif; 
        endif; ?>
    </main>
</body>
</html>