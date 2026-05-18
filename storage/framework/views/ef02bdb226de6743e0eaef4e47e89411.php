<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e(config('app.name', 'Livestock System')); ?></title>
        <meta name="description" content="Simple livestock management for everyday farmers.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            body { font-family: 'Inter', 'Figtree', system-ui, sans-serif; }
        </style>
    </head>
    <body class="min-h-screen bg-[#f8faf5] text-gray-800 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">

            
            <div class="mb-6 text-center">
                <a href="/" class="inline-flex items-center gap-2 group">
                    <span class="text-4xl transition group-hover:scale-110">🐄</span>
                    <span class="text-xl font-bold text-gray-800">Livestock System</span>
                </a>
            </div>

            
            <div class="w-full sm:max-w-md px-8 py-8 bg-white border border-slate-200 shadow-lg overflow-hidden rounded-3xl">
                <?php echo e($slot); ?>

            </div>

            
            <p class="mt-6 text-sm text-slate-500">
                &copy; <?php echo e(date('Y')); ?> Livestock Management System
            </p>
        </div>
    </body>
</html>
<?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/layouts/guest.blade.php ENDPATH**/ ?>