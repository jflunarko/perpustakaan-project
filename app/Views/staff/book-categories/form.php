<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-2xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white/10 rounded-xl border border-white/20 p-8 mb-8">
            <div class="flex items-center">
                <div class="w-16 h-16 bg-emerald-600 rounded-xl flex items-center justify-center mr-6">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-white mb-2">
                        <?= isset($category) ? 'Edit' : 'Tambah' ?> Kategori Buku
                    </h1>
                    <p class="text-white/70">
                        <?= isset($category) ? 'Perbarui informasi kategori' : 'Buat kategori buku baru' ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Form Container -->
        <div class="bg-white/10 rounded-xl border border-white/20 p-8">
            <form action="/staff/book-categories/store" method="post" class="space-y-8">
                <?= csrf_field() ?>
                <input type="hidden" name="id" value="<?= esc($category['id'] ?? '') ?>">

                <!-- Form Field -->
                <div class="space-y-4">
                    <label for="name" class="flex items-center text-white font-semibold text-lg">
                        <svg class="w-5 h-5 mr-3 text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                        </svg>
                        Nama Kategori
                    </label>
                    
                    <input type="text" 
                           name="name" 
                           id="name" 
                           class="w-full bg-white/10 border border-white/20 rounded-xl px-6 py-4 text-white placeholder-white/50 text-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors"
                           value="<?= esc($category['name'] ?? '') ?>" 
                           placeholder="Masukkan nama kategori buku..."
                           required>
                    
                    <p class="text-white/60 text-sm flex items-center">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        Contoh: Fiksi, Non-Fiksi, Sejarah, Teknologi, dll.
                    </p>
                </div>

                <!-- Action Buttons -->
                <div class="flex justify-end space-x-4 pt-6 border-t border-white/20">
                    <a href="/staff/book-categories" 
                       class="inline-flex items-center bg-gray-600 text-white px-8 py-4 rounded-xl hover:bg-gray-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Batal
                    </a>
                    
                    <button type="submit" 
                            class="inline-flex items-center bg-emerald-600 text-white px-8 py-4 rounded-xl hover:bg-emerald-700 transition-colors">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <?= isset($category) ? 'Perbarui' : 'Simpan' ?> Kategori
                    </button>
                </div>
            </form>
        </div>

        <!-- Additional Info -->
        <div class="mt-8 bg-white/5 rounded-xl border border-white/10 p-6">
            <div class="flex items-start">
                <div class="w-12 h-12 bg-blue-600 rounded-xl flex items-center justify-center mr-4">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div>
                    <h3 class="text-white font-semibold mb-2">Tips Pembuatan Kategori</h3>
                    <ul class="text-white/70 text-sm space-y-1">
                        <li>• Gunakan nama yang jelas dan mudah dipahami</li>
                        <li>• Hindari penggunaan karakter khusus</li>
                        <li>• Pastikan kategori tidak duplikat</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>