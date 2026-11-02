<?php
$keyword = trim((string)($_GET['q'] ?? ''));
$keywordLower = strtolower($keyword);

$database = [
    [
        'title' => 'Profil',
        'text' => 'Anggita Gisela adalah mahasiswa Sistem Informasi yang sedang belajar teknologi informasi dan pengembangan website.',
        'url' => '#tentang'
    ],
    [
        'title' => 'Pendidikan',
        'text' => 'Riwayat pendidikan saya dimulai dari SDN Palumbonsari 2, SMPN 1 Karawang Timur, SMKN 2 Karawang jurusan Manajemen Perkantoran, dan saat ini saya kuliah di STMIK Rosma dengan program Sistem Informasi.',
        'url' => '#pendidikan'
    ],
    [
        'title' => 'Keahlian',
        'text' => 'Keahlian saya meliputi Microsoft Office, HTML dasar, CSS dasar, dan administrasi.',
        'url' => '#keahlian'
    ],
    [
        'title' => 'Kontak',
        'text' => 'Pengunjung dapat menghubungi saya melalui form kontak atau melihat informasi kontak di bagian website.',
        'url' => '#kontak'
    ],
    [
        'title' => 'LinkedIn',
        'text' => 'Profil profesional saya tersedia di LinkedIn dan dapat diakses untuk melihat pengalaman dan aktivitas profesional.',
        'url' => 'https://www.linkedin.com/in/anggita-ghiseila-rahmawati-260b5b364/'
    ],
    [
        'title' => 'HTML dan CSS',
        'text' => 'Saya belajar HTML dan CSS dasar untuk membangun struktur dan tampilan website yang rapi dan nyaman dilihat.',
        'url' => '#beranda'
    ],
    [
        'title' => 'Administrasi',
        'text' => 'Saya juga memiliki kemampuan di bidang administrasi, termasuk dokumen dan tata kelola informasi.',
        'url' => '#keahlian'
    ]
];

$results = [];
if ($keyword !== '') {
    foreach ($database as $item) {
        $haystack = strtolower($item['title'] . ' ' . $item['text']);
        if (strpos($haystack, $keywordLower) !== false) {
            $results[] = $item;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Pencarian - Portofolio Anggita</title>
    <link rel="stylesheet" href="Assets/style.css">
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.html#beranda" class="logo">Anggita's Profile</a>
            <ul class="menu">
                <li><a href="index.html#beranda">Beranda</a></li>
                <li><a href="index.html#tentang">Tentang Saya</a></li>
                <li><a href="index.html#pendidikan">Pendidikan</a></li>
                <li><a href="index.html#keahlian">Keahlian</a></li>
                <li><a href="index.html#pencarian">Pencarian</a></li>
                <li><a href="index.html#kontak">Kontak</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="bagian">
            <h2>Hasil Pencarian</h2>

            <?php if ($keyword === ''): ?>
                <div class="kartu">
                    <p>Masukkan kata kunci untuk mencari informasi.</p>
                </div>
            <?php elseif (empty($results)): ?>
                <div class="kartu">
                    <p>Tidak ada hasil yang cocok untuk kata kunci: <strong><?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?></strong>.</p>
                    <a href="index.html#pencarian" class="tombol">Cari Lagi</a>
                </div>
            <?php else: ?>
                <p style="text-align:center; margin-bottom:20px;">Kata kunci: <strong><?= htmlspecialchars($keyword, ENT_QUOTES, 'UTF-8'); ?></strong></p>
                <?php foreach ($results as $item): ?>
                    <div class="kartu">
                        <h3><?= htmlspecialchars($item['title'], ENT_QUOTES, 'UTF-8'); ?></h3>
                        <p><?= htmlspecialchars($item['text'], ENT_QUOTES, 'UTF-8'); ?></p>
                        <?php if (substr($item['url'], 0, 1) === '#'): ?>
                            <a href="index.html<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>" class="tombol">Lihat Detail</a>
                        <?php else: ?>
                            <a href="<?= htmlspecialchars($item['url'], ENT_QUOTES, 'UTF-8'); ?>" target="_blank" rel="noopener noreferrer" class="tombol">Kunjungi</a>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>

            <div style="text-align:center; margin-top:25px;">
                <a href="index.html" class="tombol">Kembali ke Beranda</a>
            </div>
        </section>
    </main>

    <footer>
        <p>&copy; 2026 Anggita Gisela | Portofolio Pribadi</p>
    </footer>
</body>
</html>
