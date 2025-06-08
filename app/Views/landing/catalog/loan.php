<?= $this->extend('landing/layout/template') ?>
<?= $this->section('content') ?>

<section class="py-20 bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="bg-white rounded-xl shadow-lg overflow-hidden">
            <div class="bg-gradient-to-r from-blue-600 to-green-600 px-6 py-4">
                <h1 class="text-2xl font-bold text-white">Form Peminjaman Buku</h1>
            </div>
            
            <div class="p-6">
                <!-- Tampilkan pesan error/success -->
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('error') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('success')): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        <?= session()->getFlashdata('success') ?>
                    </div>
                <?php endif; ?>

                <?php if (session()->getFlashdata('errors')): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        <ul class="list-disc list-inside">
                            <?php foreach (session()->getFlashdata('errors') as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Info Buku -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-3">Informasi Buku</h3>
                        <div class="space-y-2">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Judul:</span>
                                <span class="font-medium"><?= esc($book['title']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Pengarang:</span>
                                <span class="font-medium"><?= esc($book['author']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Penerbit:</span>
                                <span class="font-medium"><?= esc($book['publisher']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Tahun:</span>
                                <span class="font-medium"><?= esc($book['year_published']) ?></span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Stok:</span>
                                <span class="font-medium text-green-600"><?= esc($book['stock']) ?> tersedia</span>
                            </div>
                        </div>

                        <!-- Status Peminjaman Member -->
                        <?php if (isset($userLoan) && $userLoan): ?>
                            <div class="mt-4 p-3 bg-blue-50 border border-blue-200 rounded-md">
                                <h4 class="font-semibold text-blue-800 mb-2">Status Peminjaman Anda:</h4>
                                <div class="text-sm space-y-1">
                                    <div class="flex justify-between">
                                        <span>Tanggal Pinjam:</span>
                                        <span class="font-medium"><?= date('d/m/Y', strtotime($userLoan['loan_date'])) ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Tanggal Kembali:</span>
                                        <span class="font-medium"><?= date('d/m/Y', strtotime($userLoan['due_date'])) ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span>Status:</span>
                                        <span class="font-medium 
                                            <?= $userLoan['status'] == 'pending' ? 'text-yellow-600' : 
                                               ($userLoan['status'] == 'dipinjam' ? 'text-green-600' : 'text-blue-600') ?>">
                                            <?= ucfirst($userLoan['status']) ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Form Peminjaman atau Pengembalian -->
                    <div>
                        <?php if (isset($userLoan)): ?>
                            <!-- Form Pengembalian -->
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Pengembalian Buku</h3>
                            
                            
                            <?php if ($userLoan['status'] == 'dipinjam' ): ?>
                                <div class="bg-green-50 border border-green-200 rounded-md p-4 mb-4">
                                    <p class="text-green-800 mb-3">
                                        <i class="fas fa-check-circle mr-2"></i>
                                        Anda sedang meminjam buku ini. Klik tombol di bawah untuk mengembalikan.
                                    </p>
                                    
                                    <form action="/loan/return" method="post">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="loan_id" value="<?= $userLoan['id'] ?>">
                                        <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                        
                                        <button type="submit" 
                                                class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-4 rounded-lg transition duration-300 mb-3"
                                                onclick="return confirm('Apakah Anda yakin ingin mengembalikan buku ini?')">
                                            <i class="fas fa-undo mr-2"></i>
                                            Kembalikan Buku
                                        </button>
                                    </form>
                                </div>
                            <?php else: ?>
                                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-4 mb-4">
                                    <p class="text-yellow-800">
                                        <i class="fas fa-clock mr-2"></i>
                                        Permintaan peminjaman Anda sedang menunggu persetujuan staff.
                                    </p>
                                </div>
                            <?php endif; ?>
                            
                            <!-- Tombol Kembali untuk case sudah meminjam -->
                            <div class="mt-4">
                                <a href="/catalog" 
                                   class="w-full inline-block bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 text-center">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Lihat Buku Lainnya
                                </a>
                            </div>
                            
                        <?php else: ?>
                            <!-- Form Peminjaman -->
                            <h3 class="text-lg font-semibold text-gray-800 mb-3">Data Peminjaman</h3>
                            <form action="/loan/process" method="post" class="space-y-4">
                                <?= csrf_field() ?>
                                <input type="hidden" name="book_id" value="<?= $book['id'] ?>">
                                
                                <div>
                                    <label for="loan_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tanggal Pinjam <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                           id="loan_date" 
                                           name="loan_date" 
                                           value="<?= old('loan_date', date('Y-m-d')) ?>"
                                           min="<?= date('Y-m-d') ?>"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                           required>
                                </div>

                                <div>
                                    <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">
                                        Tanggal Kembali <span class="text-red-500">*</span>
                                    </label>
                                    <input type="date" 
                                           id="due_date" 
                                           name="due_date" 
                                           value="<?= old('due_date', date('Y-m-d', strtotime('+7 days'))) ?>"
                                           min="<?= date('Y-m-d', strtotime('+1 day')) ?>"
                                           max="<?= date('Y-m-d', strtotime('+14 days')) ?>"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                           required>
                                    <p class="text-sm text-gray-500 mt-1">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Maksimal 14 hari dari tanggal pinjam
                                    </p>
                                </div>

                                <div class="bg-yellow-50 border border-yellow-200 rounded-md p-3">
                                    <div class="flex">
                                        <i class="fas fa-info-circle text-yellow-600 mt-0.5 mr-2"></i>
                                        <div class="text-sm text-yellow-800">
                                            <p class="font-medium">Catatan Peminjaman:</p>
                                            <ul class="list-disc list-inside mt-1 space-y-1">
                                                <li>Maksimal peminjaman adalah 14 hari</li>
                                                <li>Denda keterlambatan Rp 1.000/hari</li>
                                                <li>Harap kembalikan buku dalam kondisi baik</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex gap-3 pt-4">
                                    <button type="submit" 
                                            class="flex-1 bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded-lg transition duration-300">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Submit Peminjaman
                                    </button>
                                    <a href="/catalog" 
                                       class="flex-1 bg-gray-500 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded-lg transition duration-300 text-center">
                                        <i class="fas fa-arrow-left mr-2"></i>
                                        Lihat Buku Lainnya
                                    </a>
                                </div>
                            </form>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Auto-set due date dengan validasi maksimal 14 hari
document.getElementById('loan_date')?.addEventListener('change', function() {
    const loanDate = new Date(this.value);
    const dueDateInput = document.getElementById('due_date');
    
    // Set default due date (7 hari setelah loan date)
    const defaultDueDate = new Date(loanDate.getTime() + (7 * 24 * 60 * 60 * 1000));
    
    // Set maksimal due date (14 hari setelah loan date)
    const maxDueDate = new Date(loanDate.getTime() + (14 * 24 * 60 * 60 * 1000));
    
    // Format tanggal untuk input
    const formatDate = (date) => {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');
        return `${year}-${month}-${day}`;
    };
    
    // Set nilai default dan maksimal
    dueDateInput.value = formatDate(defaultDueDate);
    dueDateInput.setAttribute('max', formatDate(maxDueDate));
    
    // Set minimal due date (1 hari setelah loan date)
    const minDueDate = new Date(loanDate.getTime() + (1 * 24 * 60 * 60 * 1000));
    dueDateInput.setAttribute('min', formatDate(minDueDate));
});

// Validasi saat due date diubah manual
document.getElementById('due_date')?.addEventListener('change', function() {
    const loanDateInput = document.getElementById('loan_date');
    const loanDate = new Date(loanDateInput.value);
    const dueDate = new Date(this.value);
    
    // Hitung selisih hari
    const diffTime = dueDate.getTime() - loanDate.getTime();
    const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
    
    if (diffDays > 14) {
        alert('Maksimal peminjaman adalah 14 hari!');
        // Reset ke maksimal 14 hari
        const maxDueDate = new Date(loanDate.getTime() + (14 * 24 * 60 * 60 * 1000));
        const year = maxDueDate.getFullYear();
        const month = String(maxDueDate.getMonth() + 1).padStart(2, '0');
        const day = String(maxDueDate.getDate()).padStart(2, '0');
        this.value = `${year}-${month}-${day}`;
    }
    
    if (diffDays < 1) {
        alert('Tanggal kembali minimal 1 hari setelah tanggal pinjam!');
        // Reset ke minimal 1 hari
        const minDueDate = new Date(loanDate.getTime() + (1 * 24 * 60 * 60 * 1000));
        const year = minDueDate.getFullYear();
        const month = String(minDueDate.getMonth() + 1).padStart(2, '0');
        const day = String(minDueDate.getDate()).padStart(2, '0');
        this.value = `${year}-${month}-${day}`;
    }
});

// Set initial max date saat halaman dimuat
document.addEventListener('DOMContentLoaded', function() {
    const loanDateInput = document.getElementById('loan_date');
    const dueDateInput = document.getElementById('due_date');
    
    if (loanDateInput && dueDateInput && loanDateInput.value) {
        const loanDate = new Date(loanDateInput.value);
        const maxDueDate = new Date(loanDate.getTime() + (14 * 24 * 60 * 60 * 1000));
        const minDueDate = new Date(loanDate.getTime() + (1 * 24 * 60 * 60 * 1000));
        
        const formatDate = (date) => {
            const year = date.getFullYear();
            const month = String(date.getMonth() + 1).padStart(2, '0');
            const day = String(date.getDate()).padStart(2, '0');
            return `${year}-${month}-${day}`;
        };
        
        dueDateInput.setAttribute('max', formatDate(maxDueDate));
        dueDateInput.setAttribute('min', formatDate(minDueDate));
    }
});
</script>

<?= $this->endSection() ?>