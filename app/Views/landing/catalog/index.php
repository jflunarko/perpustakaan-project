<?= $this->extend('landing/layout/template') ?>
<?= $this->section('content') ?>
<?php $view_type = $view_type ?? 'all'; ?>

<section class="py-20 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-primary">
                <?= $view_type === 'dipinjam' ? 'Buku yang Sedang Dipinjam' : 'Katalog Buku' ?>
            </h1>
            <p class="text-gray-600 text-lg mt-2">
                <?= $view_type === 'dipinjam' ? 'Daftar buku yang sedang Anda pinjam' : 'Temukan buku favorit Anda di sini' ?>
            </p>
        </div>

        <!-- Navigation Tabs (hanya tampil jika user sudah login) -->
        <?php if (session()->get('is_member_logged_in')): ?>
        <div class="flex justify-center mb-8">
            <div class="bg-gray-100 rounded-lg p-1 flex">
                <a href="/catalog" class="px-6 py-2 rounded-md font-medium transition-colors duration-200 <?= $view_type === 'all' ? 'bg-white text-primary shadow-sm' : 'text-gray-600 hover:text-primary' ?>">
                    <i class="fas fa-book mr-2"></i>Semua Buku
                </a>
                <a href="/catalog/borrowed" class="px-6 py-2 rounded-md font-medium transition-colors duration-200 <?= $view_type === 'dipinjam' ? 'bg-white text-primary shadow-sm' : 'text-gray-600 hover:text-primary' ?>">
                    <i class="fas fa-book-reader mr-2"></i>Sedang Dipinjam
                </a>
            </div>
        </div>
        <?php endif; ?>

        <!-- Tampilkan pesan success/error -->
        <?php if (session()->getFlashdata('success')): ?>
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-check-circle mr-2"></i>
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <i class="fas fa-exclamation-circle mr-2"></i>
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
            <?php if (!empty($books)): ?>
                <?php foreach ($books as $index => $book): ?>
                <div class="bg-white shadow-lg rounded-xl overflow-hidden card-hover" data-aos="fade-up" data-aos-delay="<?= $index * 100 ?>">
                    <div class="h-52 bg-gradient-to-br from-blue-100 to-green-100 flex items-center justify-center">
                        <i class="fas fa-book text-5xl text-primary"></i>
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-lg text-primary truncate" title="<?= esc($book['title']) ?>">
                            <?= esc($book['title']) ?>
                        </h3>
                        <p class="text-gray-600 truncate"><?= esc($book['author']) ?></p>
                        <p class="text-sm text-gray-500"><?= esc($book['publisher']) ?> (<?= esc($book['year_published']) ?>)</p>
                        
                        <?php if ($view_type === 'dipinjam'): ?>
                            <!-- Informasi khusus untuk buku yang sedang dipinjam -->
                            <div class="mt-3 space-y-2">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Status Pinjam:</span>
                                    <!-- Gunakan status dari tabel loans -->
                                    <span class="text-sm px-2 py-1 rounded-full 
                                        <?= $book['status'] === 'pending' ? 'bg-yellow-100 text-yellow-800' : 
                                           ($book['status'] === 'approved' ? 'bg-blue-100 text-blue-800' : 
                                           ($book['status'] === 'dipinjam' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800')) ?>">
                                        <?= ucfirst($book['status']) ?>
                                    </span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Tanggal Pinjam:</span>
                                    <span class="text-sm text-gray-800"><?= date('d/m/Y', strtotime($book['loan_date'])) ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-sm text-gray-600">Batas Kembali:</span>
                                    <span class="text-sm text-gray-800"><?= date('d/m/Y', strtotime($book['due_date'])) ?></span>
                                </div>
                            </div>
                        <?php else: ?>
                            <!-- Informasi untuk katalog semua buku -->
                            <div class="flex justify-between items-center mt-2">
                                <!-- Gunakan book_status untuk ketersediaan buku -->
                                <span class="text-sm px-2 py-1 rounded-full bg-<?= ($book['book_status'] ?? $book['status']) == '1' ? 'green' : 'red' ?>-100 text-<?= ($book['book_status'] ?? $book['status']) == '1' ? 'green' : 'red' ?>-800">
                                    <?= ($book['book_status'] ?? $book['status']) == '1' ? 'Tersedia' : 'Dipinjam' ?>
                                </span>
                                <span class="text-sm text-gray-600">Stok: <?= esc($book['stock']) ?></span>
                            </div>
                        <?php endif; ?>

                        <div class="mt-4">
                            <?php if ($view_type === 'dipinjam'): ?>
                                <!-- Tombol untuk buku yang sedang dipinjam -->
                                <!-- Gunakan status dari loans -->
                                <?php if ($book['status'] === 'dipinjam'): ?>
                                    <form method="POST" action="/loan/return">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="loan_id" value="<?= $book['id'] ?>">
                                        <input type="hidden" name="book_id" value="<?= $book['book_id'] ?>">
                                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-lg font-semibold transition duration-300" onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                            <i class="fas fa-undo mr-2"></i> Kembalikan
                                        </button>
                                    </form>
                                <?php elseif ($book['status'] === 'pending'): ?>
                                    <button class="w-full bg-yellow-500 text-white py-2 px-4 rounded-lg font-semibold cursor-not-allowed" disabled>
                                        <i class="fas fa-clock mr-2"></i> Menunggu Persetujuan
                                    </button>
                                <?php elseif ($book['status'] === 'approved'): ?>
                                    <button class="w-full bg-green-500 text-white py-2 px-4 rounded-lg font-semibold cursor-not-allowed" disabled>
                                        <i class="fas fa-check mr-2"></i> Disetujui
                                    </button>
                                <?php endif; ?>
                            <?php else: ?>
                                <!-- Tombol untuk katalog semua buku -->
                                <?php if (($book['book_status'] ?? $book['status']) == '1' && $book['stock'] > 0): ?>
                                    <a href="/loan/borrow/<?= $book['id'] ?>" class="block w-full bg-green-600 hover:bg-green-700 text-white py-2 px-4 rounded-lg font-semibold transition duration-300 text-center">
                                        <i class="fas fa-book-reader mr-2"></i> Pinjam
                                    </a>
                                <?php else: ?>
                                    <button class="w-full bg-gray-400 text-white py-2 px-4 rounded-lg font-semibold cursor-not-allowed" disabled>
                                        <i class="fas fa-ban mr-2"></i> Tidak Tersedia
                                    </button>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-full text-center py-12">
                    <i class="fas fa-book-open text-5xl text-gray-300 mb-4"></i>
                    <p class="text-xl text-gray-500">
                        <?= $view_type === 'dipinjam' ? 'Anda belum meminjam buku apapun' : 'Belum ada buku yang tersedia' ?>
                    </p>
                    <p class="text-gray-400">
                        <?= $view_type === 'dipinjam' ? 'Silakan pinjam buku dari katalog' : 'Silakan cek kembali nanti' ?>
                    </p>
                    <?php if ($view_type === 'dipinjam'): ?>
                        <a href="/catalog" class="inline-block mt-4 bg-primary hover:bg-primary-dark text-white px-6 py-2 rounded-lg font-semibold transition duration-300">
                            <i class="fas fa-book mr-2"></i> Lihat Katalog
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<?= $this->endSection() ?>