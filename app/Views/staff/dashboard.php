<?= $this->extend('staff/components/layout') ?>

<?= $this->section('title') ?>Dashboard - Staff<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">Dashboard</h1>
            <p class="text-white/60">Selamat datang kembali di sistem perpustakaan</p>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
            <div class="bg-white/10 border border-white/20 rounded-xl p-6">
                <p class="text-white/70 mb-2">Total Buku</p>
                <h2 class="text-white text-3xl font-bold"><?= esc($totalBooks) ?></h2>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-xl p-6">
                <p class="text-white/70 mb-2">Total Kategori</p>
                <h2 class="text-white text-3xl font-bold"><?= esc($totalCategories) ?></h2>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-xl p-6">
                <p class="text-white/70 mb-2">Total Member</p>
                <h2 class="text-white text-3xl font-bold"><?= esc($totalMembers) ?></h2>
            </div>
            <div class="bg-white/10 border border-white/20 rounded-xl p-6">
                <p class="text-white/70 mb-2">Peminjaman Aktif</p>
                <h2 class="text-white text-3xl font-bold"><?= esc($activeLoans) ?></h2>
            </div>
        </div>

        <!-- Last 5 Loans -->
        <div class="bg-white/10 border border-white/20 rounded-xl p-6">
            <h2 class="text-white text-xl font-semibold mb-4">Peminjaman Terbaru</h2>
            <div class="overflow-x-auto">
                <table class="w-full text-white">
                    <thead>
                        <tr class="bg-[rgb(25,41,32)] text-white uppercase text-sm">
                            <th class="px-4 py-3 text-left">Buku</th>
                            <th class="px-4 py-3 text-left">Member</th>
                            <th class="px-4 py-3 text-left">Tanggal Pinjam</th>
                            <th class="px-4 py-3 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10 text-white">
                        <?php if (empty($recentLoans)): ?>
                            <tr>
                                <td colspan="4" class="text-center py-6 text-white/60">Belum ada data peminjaman.</td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($recentLoans as $loan): ?>
                                <tr>
                                    <td class="px-4 py-3"><?= esc($loan['book_title']) ?></td>
                                    <td class="px-4 py-3"><?= esc($loan['member_username']) ?></td>
                                    <td class="px-4 py-3"><?= esc(date('d M Y', strtotime($loan['loan_date']))) ?></td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-3 py-1 rounded-full text-sm 
                                            <?= $loan['status'] == 'dipinjam' ? 'bg-yellow-500/30 text-yellow-400' : 'bg-green-500/30 text-green-400' ?>">
                                            <?= ucfirst($loan['status']) ?>
                                        </span>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
