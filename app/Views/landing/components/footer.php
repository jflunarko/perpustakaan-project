<!-- app/Views/landing/components/footer.php -->
<footer class="bg-[rgb(33,51,42)] text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Company Info -->
            <div class="col-span-1 lg:col-span-2">
                <div class="mb-6">
                    <img class="h-40 mb-4" src="<?= base_url('assets/logo-vault-no-bg.png') ?>" alt="Logo Perpustakaan">
                </div>
                <p class="text-gray-300 max-w-md leading-relaxed">
                    Solusi terbaik untuk kebutuhan literasi digital Anda. Akses ribuan buku berkualitas kapan saja, dimana saja.
                </p>
            </div>
            
            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Link Cepat</h4>
                <ul class="space-y-2">
                    <li>
                        <a href="<?= site_url('/') ?>" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fas fa-home mr-2"></i>Beranda
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('catalog') ?>" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fas fa-book mr-2"></i>Katalog
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('about') ?>" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                        </a>
                    </li>
                    <li>
                        <a href="<?= site_url('contact') ?>" class="text-gray-300 hover:text-white transition duration-300">
                            <i class="fas fa-envelope mr-2"></i>Kontak
                        </a>
                    </li>
                </ul>
                <div class="flex space-x-6 mt-6">
                    <a href="#" class="text-gray-300 hover:text-green-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-facebook-f text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-green-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-twitter text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-green-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-instagram text-2xl"></i>
                    </a>
                    <a href="#" class="text-gray-300 hover:text-green-400 transition duration-300 transform hover:scale-110">
                        <i class="fab fa-linkedin-in text-2xl"></i>
                    </a>
                </div>
            </div>
            
            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4">Hubungi Kami</h4>
                <ul class="space-y-3">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-green-400"></i>
                        <span class="text-gray-300">
                            Jl. Pendidikan No. 123<br>
                            Medan, Sumatera Utara<br>
                            Indonesia 20112
                        </span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-green-400"></i>
                        <span class="text-gray-300">+62 812-3456-7890</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-green-400"></i>
                        <span class="text-gray-300">info@perpusdigital.com</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-clock mr-3 text-green-400"></i>
                        <span class="text-gray-300">24/7 Online</span>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Bottom Footer -->
    <div class="border-t border-green-700">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <div class="text-gray-300 text-sm mb-4 md:mb-0">
                    &copy; <?= date('Y') ?> Book Vault. All rights reserved.
                </div>
                <!-- <div class="flex space-x-6 text-sm">
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                        Kebijakan Privasi
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                        Syarat & Ketentuan
                    </a>
                    <a href="#" class="text-gray-300 hover:text-white transition duration-300">
                        FAQ
                    </a>
                </div> -->
            </div>
        </div>
    </div>
</footer>