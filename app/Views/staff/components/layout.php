<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Staff Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="flex h-screen">
        <!-- Sidebar -->
        <?= $this->include('staff/components/side_bar') ?>

        <!-- Main Content -->
        <div class="flex-1 overflow-y-auto">
            <?= $this->renderSection('content') ?>
        </div>
    </div>
</body>
</html>
