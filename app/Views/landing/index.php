<?= $this->extend('landing/layout/template') ?>

<?= $this->section('content') ?>

<!-- Hero Section -->
<section class="hero-gradient text-white py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8" data-aos="fade-up" >
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
            <div class="text-center lg:text-left">
                <h1 class="text-4xl md:text-6xl font-bold mb-6 leading-tight">
                    Temukan Dunia 
                    <span class="text-green-300">Pengetahuan</span>
                </h1>
                <p class="text-xl mb-8 text-gray-200 leading-relaxed">
                    Jelajahi ribuan koleksi buku digital terbaik dari berbagai kategori. 
                    Mulai petualangan literasi Anda bersama kami.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                    <a href="<?= site_url('catalog') ?>" 
                       class="bg-green-500 hover:bg-green-600 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 transform hover:scale-105">
                        <i class="fas fa-book-open mr-2"></i>
                        Jelajahi Katalog
                    </a>
                    <a href="#features" 
                       class="border-2 border-white text-white hover:bg-white hover:text-green-800 px-8 py-4 rounded-lg font-semibold text-lg transition duration-300">
                        <i class="fas fa-info-circle mr-2"></i>
                        Pelajari Lebih
                    </a>
                </div>
            </div>
            <div class="text-center">
                <img src="<?= base_url('assets/logo-vault-no-bg.png') ?>" 
                     alt="Koleksi Buku" 
                     class="w-full max-w-md mx-auto">
            </div>
        </div>
    </div>
</section>

<!-- Features Section -->
<section id="features" class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Mengapa Memilih Perpustakaan Digital Kami?
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                Kami menyediakan akses mudah ke ribuan buku berkualitas dengan fitur-fitur terdepan
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php
            $features = [
                ['icon' => 'book', 'color' => 'green', 'title' => 'Koleksi Lengkap', 'desc' => 'Ribuan buku dari berbagai genre dan kategori tersedia untuk Anda'],
                ['icon' => 'search', 'color' => 'blue', 'title' => 'Pencarian Mudah', 'desc' => 'Sistem pencarian canggih untuk menemukan buku favorit Anda dengan cepat'],
                ['icon' => 'mobile-alt', 'color' => 'purple', 'title' => 'Akses Mobile', 'desc' => 'Baca kapan saja, dimana saja melalui perangkat mobile Anda'],
                ['icon' => 'heart', 'color' => 'red', 'title' => 'Favorit Personal', 'desc' => 'Simpan dan kelola buku-buku favorit Anda dalam satu tempat'],
                ['icon' => 'star', 'color' => 'yellow', 'title' => 'Rating & Review', 'desc' => 'Baca review dan berikan rating untuk membantu pembaca lain'],
                ['icon' => 'clock', 'color' => 'indigo', 'title' => '24/7 Available', 'desc' => 'Layanan tersedia 24 jam setiap hari untuk kenyamanan Anda'],
            ];
            foreach ($features as $index => $f):
            ?>
            <div class="text-center p-8 bg-gray-50 rounded-xl card-hover" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                <div class="bg-<?= $f['color'] ?>-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-<?= $f['icon'] ?> text-2xl text-<?= $f['color'] ?>-600"></i>
                </div>
                <h3 class="text-xl font-bold text-primary mb-4"><?= $f['title'] ?></h3>
                <p class="text-gray-600"><?= $f['desc'] ?></p>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="py-20 bg-primary text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            <div data-aos="fade-up">
                <div class="text-4xl md:text-5xl font-bold mb-2 counter" data-target="100000" data-format="k">0</div>
                <div class="text-green-200">Koleksi Buku</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="100">
                <div class="text-4xl md:text-5xl font-bold mb-2 counter" data-target="5000" data-format="k">0</div>
                <div class="text-green-200">Pengguna Aktif</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="200">
                <div class="text-4xl md:text-5xl font-bold mb-2 counter" data-target="50" data-format="normal">0</div>
                <div class="text-green-200">Kategori</div>
            </div>
            <div data-aos="fade-up" data-aos-delay="300">
                <div class="text-4xl md:text-5xl font-bold mb-2">24/7</div>
                <div class="text-green-200">Support</div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Books Section -->
<section class="py-20 bg-gray-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-primary mb-4">
                Buku Populer
            </h2>
            <p class="text-xl text-gray-600">
                Buku-buku yang tersedia di perpustakaan kami
            </p>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $index => $book): ?>
                <div class="bg-white rounded-xl shadow-lg overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="<?= ($index + 1) * 100 ?>">
                    <div class="h-64 bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center">
                        <div class="text-center p-4">
                            <i class="fas fa-book text-6xl text-primary mb-4"></i>
                            <p class="text-sm text-gray-600">Cover Buku</p>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="font-bold text-lg text-primary mb-2 truncate" title="<?= esc($book['title']) ?>">
                            <?= esc($book['title']) ?>
                        </h3>
                        <p class="text-gray-600 mb-2 truncate" title="<?= esc($book['author']) ?>">
                            <?= esc($book['author']) ?>
                        </p>
                        <p class="text-sm text-gray-500 mb-4">
                            <?= esc($book['publisher']) ?> (<?= esc($book['year_published']) ?>)
                        </p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <span class="text-sm px-2 py-1 bg-<?= $book['status'] == 'available' ? 'green' : 'red' ?>-100 text-<?= $book['status'] == 'available' ? 'green' : 'red' ?>-800 rounded-full">
                                    <?= $book['status'] == '1' ? 'Tersedia' : 'Dipinjam' ?>
                                </span>
                                <span class="text-sm text-gray-600 ml-2">
                                    Stok: <?= esc($book['stock']) ?>
                                </span>
                            </div>
                        </div>
                        <div class="mt-4">
                            <?php if ($book['status'] == '1' && $book['stock'] > 0): ?>
                                <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-semibold transition duration-300">
                                    <i class="fas fa-book-reader mr-2"></i>
                                    Pinjam
                                </button>
                            <?php else: ?>
                                <button class="w-full bg-gray-400 text-white py-2 px-4 rounded-lg font-semibold cursor-not-allowed" disabled>
                                    <i class="fas fa-ban mr-2"></i>
                                    Tidak Tersedia
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-book-open text-6xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">Belum ada buku yang tersedia</p>
                    <p class="text-gray-400">Silakan kembali lagi nanti</p>
                </div>
            <?php endif; ?>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="<?= site_url('catalog') ?>" 
               class="bg-primary hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold text-lg transition duration-300 inline-block">
                Lihat Semua Buku
            </a>
        </div>
    </div>
</section>

<!-- CTA Section -->
<section class="py-20 bg-white" data-aos="fade-up">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <h2 class="text-3xl md:text-4xl font-bold text-primary mb-6">
            Siap Memulai Perjalanan Literasi Anda?
        </h2>
        <p class="text-xl text-gray-600 mb-8">
            Bergabunglah dengan ribuan pembaca lainnya dan temukan buku-buku terbaik
        </p>
        <a href="<?= site_url('catalog') ?>" 
           class="bg-green-500 hover:bg-green-600 text-white px-12 py-4 rounded-lg font-semibold text-xl transition duration-300 transform hover:scale-105 inline-block">
            <i class="fas fa-rocket mr-2"></i>
            Mulai Sekarang
        </a>
    </div>
</section>

<?= $this->endSection() ?>