<?= $this->extend('staff/components/layout') ?>
<?= $this->section('content') ?>

<div class="min-h-screen bg-[rgb(33,51,42)] p-6">
    <div class="max-w-6xl mx-auto">
        <!-- Header Section -->
        <div class="bg-white/10 rounded-xl border border-white/20 p-8 mb-8">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-4xl font-bold text-white mb-2">Kategori Buku</h1>
                    <p class="text-white/70">Kelola kategori buku perpustakaan</p>
                </div>
                <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                </div>
            </div>
        </div>

        <!-- Flash Message -->
        <?php if (session()->getFlashdata('message')): ?>
            <div class="bg-green-600 text-white px-6 py-4 rounded-xl mb-6">
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    <?= session()->getFlashdata('message') ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Search and Action Section -->
        <div class="mb-8 flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <!-- Search Form -->
            <div class="flex-1 max-w-md">
                <form method="GET" action="/staff/book-categories" class="relative">
                    <div class="relative">
                        <input type="text" 
                               name="search" 
                               value="<?= esc($search ?? '') ?>"
                               placeholder="Cari kategori berdasarkan nama..." 
                               class="w-full bg-white/10 border border-white/20 rounded-xl px-6 py-4 pl-12 text-white placeholder-white/50 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-colors">
                        <svg class="absolute left-4 top-1/2 transform -translate-y-1/2 w-5 h-5 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </div>
                    
                    <div class="flex gap-2 mt-3">
                        <button type="submit" 
                                class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                            Cari
                        </button>
                        
                        <?php if (!empty($search)): ?>
                            <a href="/staff/book-categories" 
                               class="inline-flex items-center bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition-colors">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                                Reset
                            </a>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <!-- Add Button -->
            <div>
                <a href="/staff/book-categories/create" 
                   class="inline-flex items-center bg-emerald-600 text-white px-8 py-4 rounded-xl hover:bg-emerald-700 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Tambah Kategori Baru
                </a>
            </div>
        </div>

        <!-- Search Results Info -->
        <?php if (!empty($search)): ?>
            <div class="mb-6 bg-blue-600/20 border border-blue-400/30 text-white px-6 py-4 rounded-xl">
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Hasil pencarian untuk "<strong><?= esc($search) ?></strong>" - 
                        Ditemukan <?= count($categories) ?> kategori
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Table Container -->
        <div class="bg-white/10 rounded-xl border border-white/20 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="bg-[rgb(25,41,32)] border-b border-white/20">
                            <th class="px-8 py-6 text-left text-sm font-bold text-white uppercase">
                                ID
                            </th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-white uppercase">
                                Nama Kategori
                            </th>
                            <th class="px-8 py-6 text-left text-sm font-bold text-white uppercase">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/10">
                        <?php if (empty($categories)): ?>
                            <tr>
                                <td colspan="3" class="px-8 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <svg class="w-16 h-16 text-white/30 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                        </svg>
                                        <p class="text-white/60 text-lg mb-2">
                                            <?= !empty($search) ? 'Tidak ada kategori yang ditemukan' : 'Belum ada kategori' ?>
                                        </p>
                                        <p class="text-white/40 text-sm">
                                            <?= !empty($search) ? 'Coba gunakan kata kunci yang berbeda' : 'Tambahkan kategori pertama Anda' ?>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($categories as $category): ?>
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="px-8 py-6">
                                        <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-white font-bold">
                                            <?= esc($category['id']) ?>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-white font-medium text-lg">
                                            <?php if (!empty($search)): ?>
                                                <?= str_ireplace($search, '<mark class="bg-yellow-400 text-black px-1 rounded">' . $search . '</mark>', esc($category['name'])) ?>
                                            <?php else: ?>
                                                <?= esc($category['name']) ?>
                                            <?php endif; ?>
                                        </span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center space-x-4">
                                            <a href="/staff/book-categories/edit/<?= $category['id'] ?>" 
                                               class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition-colors">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                            </a>
                                            <form action="/staff/book-categories/delete/<?= $category['id'] ?>" method="post" class="inline"
                                                  onsubmit="return confirm('Yakin ingin hapus kategori ini?')">
                                                <?= csrf_field() ?>
                                                <button type="submit" 
                                                        class="inline-flex items-center bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition-colors">
                                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                    </svg>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 text-center">
            <p class="text-white/70">Total <?= count($categories) ?> kategori tersedia</p>
        </div>
    </div>
</div>

<?= $this->endSection() ?>