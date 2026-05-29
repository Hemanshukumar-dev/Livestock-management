<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
        <meta name="view-transition" content="same-origin" />

        <title><?php echo e(config('app.name', 'Livestock System')); ?></title>
        <meta name="description" content="Simple livestock management for everyday farmers.">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

        <style>
            body { font-family: 'Inter', system-ui, sans-serif; }
            
            /* View Transition Animations */
            ::view-transition-old(auth-panel),
            ::view-transition-new(auth-panel),
            ::view-transition-old(image-panel),
            ::view-transition-new(image-panel) {
                animation-duration: 0.6s;
                animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            }
        </style>
        
        <script>
            (function() {
                try {
                    var localTheme = localStorage.getItem('theme');
                    var systemDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
                    if (localTheme === 'dark' || (!localTheme && systemDark)) {
                        document.documentElement.classList.add('dark');
                    } else {
                        document.documentElement.classList.remove('dark');
                    }
                } catch (e) {}
            })();
        </script>
    </head>
    <body class="min-h-screen bg-bg-100 text-txt-100 antialiased selection:bg-primary-300/30 selection:text-primary-300 relative transition-colors duration-300">
        
        
        <div class="fixed inset-0 pointer-events-none z-0 overflow-hidden">
            <div class="absolute -top-[20%] -left-[10%] w-[60%] h-[60%] rounded-full bg-primary-300/20 blur-[120px] mix-blend-multiply dark:mix-blend-screen transition-colors"></div>
            <div class="absolute -bottom-[20%] -right-[10%] w-[60%] h-[60%] rounded-full bg-accent-200/15 blur-[120px] mix-blend-multiply dark:mix-blend-screen transition-colors"></div>
            <div class="absolute top-[20%] right-[20%] w-[40%] h-[40%] rounded-full bg-bg-200/20 blur-[100px] mix-blend-multiply dark:mix-blend-screen transition-colors"></div>
        </div>

        <main class="min-h-screen w-full flex items-center justify-center p-4 sm:p-6 lg:p-8 relative z-10">
            
            <div class="w-full max-w-[1200px] min-h-[700px] bg-bg-300/90 rounded-[24px] shadow-cinematic overflow-hidden flex flex-col lg:flex-row relative ring-1 ring-agri-border backdrop-blur-xl transition-all duration-300">
                <?php echo e($slot); ?>

            </div>
        </main>
        
        
        <div class="fixed top-4 right-4 z-50">
            <button type="button" id="theme-toggle" class="relative flex items-center justify-center w-10 h-10 rounded-full border border-bg-300 bg-bg-300/80 backdrop-blur text-txt-200 transition-colors hover:hover:bg-primary-100/20 hover:text-txt-100 outline-none overflow-hidden shadow-cinematic" aria-label="Toggle theme">
                <svg id="theme-toggle-light-icon" class="w-5 h-5 absolute transition-all duration-300 transform dark:-translate-y-8 dark:opacity-0 dark:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <svg id="theme-toggle-dark-icon" class="w-5 h-5 absolute transition-all duration-300 transform translate-y-8 opacity-0 -rotate-45 dark:translate-y-0 dark:opacity-100 dark:rotate-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
            </button>
        </div>
        
        <script>
            document.getElementById('theme-toggle')?.addEventListener('click', () => {
                const isDark = document.documentElement.classList.contains('dark');
                if (!isDark) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            });
        </script>

    </body>
</html>
<?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/components/auth-split-layout.blade.php ENDPATH**/ ?>