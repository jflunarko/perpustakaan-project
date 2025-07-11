<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white/10 border border-white/20 rounded-xl p-8 mb-6">
            <h1 class="text-3xl font-bold text-white mb-2">
                <?= isset($member) ? 'Edit Member' : 'Tambah Member' ?>
            </h1>
        </div>

        <div class="bg-white/10 border border-white/20 rounded-xl p-8">
            <form action="/staff/member/store" method="post" class="space-y-6">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($member['id'] ?? '') ?>">

                <div>
                    <label class="text-white mb-2 block">Username</label>
                    <input type="text" name="username" required
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg"
                        value="<?= esc($member['username'] ?? '') ?>">
                </div>

                <div>
                    <label class="text-white mb-2 block">Email</label>
                    <input type="email" name="email" required
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg"
                        value="<?= esc($member['email'] ?? '') ?>">
                </div>

                <div>
                    <label class="text-white mb-2 block">Phone</label>
                    <input type="text" name="phone"
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg"
                        value="<?= esc($member['phone'] ?? '') ?>">
                </div>

                <div>
                    <label class="text-white mb-2 block">Alamat</label>
                    <textarea name="address" rows="3"
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg"><?= esc($member['address'] ?? '') ?></textarea>
                </div>

                <?php if (!isset($member)): ?>
                <div>
                    <label class="text-white mb-2 block">Password</label>
                    <input type="password" name="password" required
                        class="w-full bg-white/10 text-white px-4 py-3 rounded-lg">
                </div>
                <?php endif; ?>

                <div class="pt-6 border-t border-white/20 flex justify-end gap-4">
                    <a href="/staff/member" class="bg-gray-600 text-white px-6 py-3 rounded-lg hover:bg-gray-700">Batal</a>
                    <button type="submit" class="bg-emerald-600 text-white px-6 py-3 rounded-lg hover:bg-emerald-700">
                        <?= isset($member) ? 'Perbarui' : 'Simpan' ?>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?= $this->endSection() ?>
