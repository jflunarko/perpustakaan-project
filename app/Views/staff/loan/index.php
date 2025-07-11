<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-7xl mx-auto">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-white mb-1">Daftar Peminjaman</h1>
                <p class="text-white/60">Kelola data peminjaman buku</p>
            </div>
            <a href="/staff/loan/create" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700 transition">
                + Tambah Peminjaman
            </a>
        </div>

        <?php if (session()->getFlashdata('message')): ?>
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-6">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif; ?>

        <!-- Search -->
        <form method="get" action="/staff/loan" class="mb-6 max-w-md">
            <div class="relative">
                <input type="text" name="search" value="<?= esc($search ?? '') ?>" placeholder="Cari judul buku / nama member..."
                    class="w-full bg-white/10 border border-white/20 text-white rounded-lg px-4 py-3 pl-12 placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-emerald-500 transition">
                <svg class="w-5 h-5 text-white/60 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
            </div>
        </form>

        <div class="bg-white/10 border border-white/20 rounded-xl overflow-x-auto">
            <table class="min-w-full text-white">
                <thead class="bg-[rgb(25,41,32)]">
                    <tr>
                        <th class="px-6 py-4 text-left">Buku</th>
                        <th class="px-6 py-4 text-left">Member</th>
                        <th class="px-6 py-4 text-left">Tanggal Pinjam</th>
                        <th class="px-6 py-4 text-left">Jatuh Tempo</th>
                        <th class="px-6 py-4 text-left">Tanggal Kembali</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10">
                    <?php foreach ($loans as $loan): ?>
                        <tr class="hover:bg-white/5">
                            <td class="px-6 py-4"><?= esc($loan['book_title']) ?></td>
                            <td class="px-6 py-4"><?= esc($loan['member_name']) ?></td>
                            <td class="px-6 py-4"><?= esc($loan['loan_date']) ?></td>
                            <td class="px-6 py-4"><?= esc($loan['due_date']) ?></td>
                            <td class="px-6 py-4"><?= esc($loan['return_date'] ?? '-') ?></td>
                            <td class="px-6 py-4 capitalize"><?= esc($loan['status']) ?></td>
                            <td class="px-6 py-4">
                                <a href="/staff/loan/edit/<?= $loan['id'] ?>" class="text-blue-400 hover:underline mr-3">Edit</a>
                                <form action="/staff/loan/delete/<?= $loan['id'] ?>" method="post" class="inline" onsubmit="return confirm('Hapus data ini?')">
                                    <?= csrf_field() ?>
                                    <button type="submit" class="text-red-400 hover:underline">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                    <?php if (empty($loans)): ?>
                        <tr>
                            <td colspan="7" class="px-6 py-6 text-center text-white/60">Data peminjaman tidak ditemukan.</td>
                        </tr>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
