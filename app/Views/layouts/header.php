<!-- views/layouts/header.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Dashboard' ?></title>
    
    <!-- Tailwind CSS - Gunakan CDN untuk testing -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Atau gunakan file lokal jika sudah ada -->
    <!-- <link href="<?= base_url('css/tailwind.css') ?>" rel="stylesheet"> -->

    <!-- Custom Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Custom Styles -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .sidebar-bg {
            background-color: rgba(255, 255, 255, 0.04);
        }

        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-thumb {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background-color: rgba(255, 255, 255, 0.4);
        }
    </style>
</head>
<body class="bg-gray-900 text-white flex h-screen overflow-hidden">