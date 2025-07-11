<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-7xl mx-auto">
        <!-- Header -->
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-6 flex flex-col lg:flex-row justify-between items-start lg:items-center">
            <div>
                <h1 class="text-4xl font-bold text-white mb-2">Daftar Buku</h1>
                <p class="text-white/70">Kelola data buku perpustakaan</p>
            </div>
            <a href="/staff/book/create" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition mt-4 lg:mt-0">
                + Tambah Buku
            </a>
        </div>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-6">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <!-- Pencarian -->
        <form method="get" action="/staff/book" class="mb-6 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul / penulis / penerbit..."
                    class="w-full bg-white/10 border border-white/20 text-white rounded-lg px-4 py-3 pl-12 placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                <svg class="w-5 h-5 text-white/60 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
            <?php if (!empty($search)): ?>
                <div class="mt-3 flex gap-2">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Cari</button>
                    <a href="/staff/book" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">Reset</a>
                </div>
            <?php endif ?>
        </form>

        <!-- Table -->
        <div class="bg-white/10 border border-white/20 rounded-xl overflow-x-auto">
            <table class="min-w-full text-white">
                <thead class="bg-[rgb(25,41,32)]">
                    <tr>
                        <th class="px-6 py-4 text-left">Judul</th>
                        <th class="px-6 py-4 text-left">Penulis</th>
                        <th class="px-6 py-4 text-left">Penerbit</th>
                        <th class="px-6 py-4 text-left">Tahun</th>
                        <th class="px-6 py-4 text-left">Stok</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    <?php foreach ($books as $book): ?>
                        <tr class="hover:bg-white/5">
                            <td class="px-6 py-4"><?= esc($book['title']) ?></td>
                            <td class="px-6 py-4"><?= esc($book['author']) ?></td>
                            <td class="px-6 py-4"><?= esc($book['publisher']) ?></td>
                            <td class="px-6 py-4"><?= esc($book['year_published']) ?></td>
                            <td class="px-6 py-4"><?= esc($book['stock']) ?></td>
                            <td class="px-6 py-4 capitalize"><?= esc($book['status']) ?></td>
                            <td class="px-6 py-4">
                                <a href="/staff/book/edit/<?= $book['id'] ?>" class="text-blue-400 hover:underline mr-3">Edit</a>
                                <form action="/staff/book/delete/<?= $book['id'] ?>" method="post" class="inline" onsubmit="return confirm('Hapus buku ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php if (empty($books)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-white/60">Data buku tidak ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
