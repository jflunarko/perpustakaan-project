<!-- app/Views/landing/layout/template.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? $title : 'Perpustakaan Digital' ?></title>
    <meta name="description" content="<?= isset($meta_description) ? $meta_description : 'Perpustakaan Digital - Solusi terbaik untuk kebutuhan literasi Anda' ?>">
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- AOS CSS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <!-- Custom CSS -->
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, rgb(33,51,42) 0%, rgb(45,65,55) 100%);
        }
        
        .card-hover {
            transition: all 0.3s ease;
        }
        
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        
        .text-primary {
            color: rgb(33,51,42);
        }
        
        .bg-primary {
            background-color: rgb(33,51,42);
        }
        
        .border-primary {
            border-color: rgb(33,51,42);
        }
    </style>
</head>

<body class="bg-gray-50">
    <?= $this->include('landing/components/navbar') ?>
    
    <main>
        <?= $this->renderSection('content') ?>
    </main>
    
    <?= $this->include('landing/components/footer') ?>
    
    <!-- JavaScript -->
    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    
    <script>
        // Initialize AOS
        AOS.init({ 
            duration: 800, 
            once: true 
        });

        // Counter Animation Function
        function animateCounters() {
            const counters = document.querySelectorAll('.counter');
            
            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-target'));
                const format = counter.getAttribute('data-format') || 'normal';
                const duration = 2000; // 2 seconds
                const increment = target / (duration / 16); // 60fps
                let current = 0;
                
                const timer = setInterval(() => {
                    current += increment;
                    
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    
                    // Format the number based on data-format attribute
                    let displayValue;
                    if (format === 'k' && current >= 1000) {
                        displayValue = Math.floor(current / 1000) + 'K+';
                    } else if (format === 'm' && current >= 1000000) {
                        displayValue = Math.floor(current / 1000000) + 'M+';
                    } else {
                        displayValue = Math.floor(current).toLocaleString();
                    }
                    
                    counter.textContent = displayValue;
                }, 16);
            });
        }

        // Start counter animation when the stats section becomes visible
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounters();
                    observer.unobserve(entry.target); // Run only once
                }
            });
        }, {
            threshold: 0.3 // Trigger when 30% of the section is visible
        });

        // Initialize when DOM is loaded
        document.addEventListener('DOMContentLoaded', () => {
            // Observe the stats section for counter animation
            const statsSection = document.querySelector('.py-20.bg-primary');
            if (statsSection) {
                observer.observe(statsSection);
            }

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                });
            });
            
            // Add scroll effect to navbar
            window.addEventListener('scroll', function() {
                const navbar = document.querySelector('nav');
                if (navbar) {
                    if (window.scrollY > 100) {
                        navbar.classList.add('shadow-2xl');
                    } else {
                        navbar.classList.remove('shadow-2xl');
                    }
                }
            });
        });
    </script>
</body>
</html>