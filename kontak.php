<?php
date_default_timezone_set('Asia/Jakarta');

$name = trim((string)($_POST['nama'] ?? ''));
$email = trim((string)($_POST['email'] ?? ''));
$kontak = trim((string)($_POST['kontak'] ?? ''));
$message = trim((string)($_POST['pesan'] ?? ''));
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($name === '') {
        $errors[] = 'Nama wajib diisi.';
    }

    if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = 'Email tidak valid.';
    }

    if ($kontak === '') {
        $errors[] = 'Kontak wajib diisi.';
    }

    if ($message === '') {
        $errors[] = 'Pesan wajib diisi.';
    }

    if (empty($errors)) {
        $data = "\n---\nNama: $name\nEmail: $email\nKontak: $kontak\nPesan: $message\nWaktu: " . date('Y-m-d H:i:s') . "\n";

        $file = __DIR__ . '/kontak/messages.txt';
        $dir = dirname($file);

        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }

        file_put_contents($file, $data, FILE_APPEND | LOCK_EX);

        $success = true;
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Kontak - Portofolio Anggita</title>
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
            <h2>Hubungi Saya</h2>

            <?php if (!empty($errors)): ?>
                <div class="kartu">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li>
                                <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8'); ?>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            <?php elseif (isset($success) && $success): ?>
                <div class="kartu">
                    <p>
                        Pesan Anda berhasil dikirim.
                        Terima kasih,
                        <?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>!
                        Saya akan segera membalas melalui email Anda.
                    </p>
                </div>
            <?php endif; ?>

            <form action="kontak.php" method="POST">

                <label for="nama">Nama</label>
                <input
                    type="text"
                    id="nama"
                    name="nama"
                    value="<?= htmlspecialchars($name, ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="Masukkan nama kamu"
                    required
                >

                <label for="email">Email</label>
                <input
                    type="email"
                    id="email"
                    name="email"
                    value="<?= htmlspecialchars($email, ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="Masukkan email kamu"
                    required
                >

                <label for="kontak">Kontak</label>
                <input
                    type="text"
                    id="kontak"
                    name="kontak"
                    value="<?= htmlspecialchars($kontak, ENT_QUOTES, 'UTF-8'); ?>"
                    placeholder="Masukkan kontak kamu"
                    required
                >

                <label for="pesan">Pesan</label>
                <textarea
                    id="pesan"
                    name="pesan"
                    placeholder="Tulis pesan kamu"
                    required
                ><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8'); ?></textarea>

                <button type="submit" class="tombol">
                    Kirim Pesan
                </button>

            </form>

            <a href="index.html#beranda" class="tombol">
                ← Kembali ke Beranda
            </a>

        </section>
    </main>

    <footer>
        <p>&copy; 2026 Anggita Gisela | Portofolio Pribadi</p>
    </footer>

</body>
</html>