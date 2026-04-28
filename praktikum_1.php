<?php
require_once 'koneksi.php';

// 1. Ambil semua data materi dari database
$query = $pdo->query("SELECT * FROM materi");
$all_materi = $query->fetchAll(PDO::FETCH_ASSOC);

// 2. Logika penentuan halaman
$halaman_sekarang = isset($_GET['page']) ? $_GET['page'] : 'home';
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mastering HTML & CSS | Space Syntax</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
</head>
<body>

   <nav>
    <div class="logo">
        <a href="praktikum_1.php" style="text-decoration:none; color:inherit;">Web<span>Master</span></a>
    </div>
    <ul>
        <li><a href="praktikum_1.php">Home</a></li>
        
        <?php if (!empty($all_materi)): ?>
            <?php foreach($all_materi as $m): ?>
                <li>
                    <a href="praktikum_1.php?page=<?= htmlspecialchars($m['slug']) ?>">
                        <?= htmlspecialchars($m['judul']) ?>
                    </a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        
        <li><a href="praktikum_1.php#about">Tentang</a></li>
    </ul>
</nav>

    <main>
        <?php if ($halaman_sekarang == 'home'): ?>
            <section id="home" class="hero">
                <div class="hero-content">
                    <h1>Bangun Dunia Digitalmu dengan <span class="highlight">HTML & CSS</span></h1>
                    <p>Langkah pertama menjadi developer profesional dimulai dari sini.</p>
                    <a href="#learn" class="btn">Mulai Belajar</a>
                </div>
                <div class="hero-image">
                    <img src="https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=600&q=80" alt="Coding Image">
                </div>
            </section>

            <section id="learn" class="cards-container">
                <h2 class="section-title">Apa yang Akan Kamu Pelajari?</h2>
                <div class="grid">
                    <?php foreach ($all_materi as $m): ?>
                        <a href="praktikum_1.php?page=<?= $m['slug'] ?>" class="card" style="text-decoration: none; color: inherit;">
                            <div class="icon"><?= $m['ikon'] ?></div>
                            <h3><?= $m['judul'] ?></h3>
                            <p><?= $m['deskripsi'] ?></p>
                            <span class="btn-sm">Pelajari Sekarang &rarr;</span>
                        </a>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php else: ?>
            <?php 
                $stmt = $pdo->prepare("SELECT * FROM materi WHERE slug = ?");
                $stmt->execute([$halaman_sekarang]);
                $item = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($item): 
            ?>
                <section class="detail-page" style="padding: 100px 10%;">
                    <div class="detail-header" style="text-align: center; margin-bottom: 30px;">
                        <span style="font-size: 80px;"><?= $item['ikon'] ?></span>
                        <h1><?= $item['judul'] ?></h1>
                    </div>
                    <div class="detail-content" style="background: white; padding: 40px; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                        <p style="font-size: 1.2rem; margin-bottom: 20px;"><?= $item['deskripsi'] ?></p>
                        <h3>Sub Materi:</h3>
                        <ul style="margin: 20px 0; padding-left: 20px;">
                            <?php 
                            $list = explode(',', $item['detail_list']); 
                            foreach($list as $l) echo "<li style='margin-bottom: 10px;'>".trim($l)."</li>";
                            ?>
                        </ul>
                        <a href="praktikum_1.php" class="btn">Kembali ke Beranda</a>
                    </div>
                </section>
            <?php else: ?>
                <section style="padding: 100px; text-align: center;">
                    <h2>Materi tidak ditemukan!</h2>
                    <a href="praktikum_1.php">Kembali</a>
                </section>
            <?php endif; ?>
        <?php endif; ?>
    </main>

    <?php if ($halaman_sekarang == 'home'): ?>
  <section id="about" class="about-section">
        <div class="about-container">
            <div class="about-text">
                <h2 class="section-title">Kenapa Harus Belajar Web?</h2>
                <p>
                    Di era digital saat ini, kemampuan membangun website bukan lagi sekadar hobi, melainkan <strong>superpower</strong>. 
                    HTML adalah kerangka berpikir, sedangkan CSS adalah jiwa seni dari sebuah karya digital.
                </p>
                <div class="stats">
                    <div class="stat-item">
                        <h4>100%</h4>
                        <p>Fundamental</p>
                    </div>
                    <div class="stat-item">
                        <h4>∞</h4>
                        <p>Kreativitas</p>
                    </div>
                </div>
                <p class="description">
                    Kami di <strong>WebMaster</strong> percaya bahwa siapa pun bisa menjadi arsitek web. 
                    Misi kami adalah menyederhanakan konsep yang rumit menjadi langkah-langkah visual yang mudah dipahami oleh pemula sekalipun.
                </p>
            </div>
            <div class="about-visual">
                <div class="code-window">
                    <div class="dots">
                        <span class="dot red"></span>
                        <span class="dot yellow"></span>
                        <span class="dot green"></span>
                    </div>
                    <pre>
<code><span class="tag">&lt;style&gt;</span>
  <span class="selector">.passion</span> {
    <span class="prop">display</span>: flex;
    <span class="prop">future</span>: bright;
  }
<span class="tag">&lt;/style&gt;</span></code>
                    </pre>
                </div>
            </div>
        </div>
    </section>
    <?php endif; ?>

    <footer>
        <p>&copy; <?php echo date("Y"); ?> WebMaster Academy</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>