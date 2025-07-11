<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header -->
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">Daftar Member</h1>
            <p class="text-white/60">Kelola data anggota perpustakaan</p>
        </div>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-6">
                <?= session()->getFlashdata('message') ?>
            </div>
        <?php endif ?>

        <!-- Search + Tambah -->
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4 mb-6">
            <form action="/staff/member" method="get" class="flex-1">
                <input type="text" name="search" placeholder="Cari username, email, atau phone..."
                       value="<?= esc($search ?? '') ?>"
                       class="w-full bg-white/10 border border-white/20 text-white px-4 py-3 rounded-xl">
            </form>

            <a href="/staff/member/create" class="bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-xl">
                + Tambah Member
            </a>
        </div>

        <!-- Table -->
        <div class="bg-white/10 border border-white/20 rounded-xl overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-[rgb(25,41,32)] text-white uppercase text-sm">
                        <th class="px-6 py-4 text-left">Username</th>
                        <th class="px-6 py-4 text-left">Email</th>
                        <th class="px-6 py-4 text-left">Phone</th>
                        <th class="px-6 py-4 text-left">Alamat</th>
                        <th class="px-6 py-4 text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-white/10 text-white">
                    <?php if (empty($members)): ?>
                        <tr>
                            <td colspan="5" class="text-center py-8 text-white/60">Data member tidak ditemukan.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($members as $member): ?>
                            <tr class="hover:bg-white/5 transition">
                                <td class="px-6 py-4"><?= esc($member['username']) ?></td>
                                <td class="px-6 py-4"><?= esc($member['email']) ?></td>
                                <td class="px-6 py-4"><?= esc($member['phone']) ?></td>
                                <td class="px-6 py-4"><?= esc($member['address']) ?></td>
                                <td class="px-6 py-4">
                                    <div class="flex gap-2">
                                        <a href="/staff/member/edit/<?= $member['id'] ?>" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">Edit</a>
                                        <form action="/staff/member/delete/<?= $member['id'] ?>" method="post" onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                                            <?= csrf_field() ?>
                                            <button class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach ?>
                    <?php endif ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
