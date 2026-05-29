<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo $__env->yieldContent('title', 'Livestock Management System'); ?></title>
    <meta name="description" content="Simple livestock management for everyday farmers. Track animals, health records, and ownership details without confusion.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>

    <style>
        body { font-family: 'Inter', 'Figtree', system-ui, sans-serif; }
        
        /* View Transition Custom Animations */
        ::view-transition-group(root) {
            animation-timing-function: cubic-bezier(0.4, 0, 0.2, 1);
            animation-duration: 0.7s;
        }
        ::view-transition-old(root),
        ::view-transition-new(root) {
            animation: none;
            mix-blend-mode: normal;
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
<body class="min-h-screen bg-bg-100 text-txt-100 font-sans antialiased selection:bg-primary-300/20 selection:text-txt-100 transition-colors duration-300">
    <?php $user = auth()->user(); ?>
    <div class="min-h-screen flex flex-col relative">
        
        
        <div class="fixed top-0 inset-x-0 z-50 px-4 pt-4 sm:pt-6 pb-2 pointer-events-none transition-all duration-300">
            <header class="mx-auto max-w-7xl pointer-events-auto rounded-full border border-bg-300 bg-bg-300/80 backdrop-blur-xl shadow-cinematic transition-all">
                <div class="flex items-center justify-between px-6 py-3 sm:px-8">
                    
                    <div class="flex items-center gap-2">
                        <a href="/" class="flex items-center gap-3 group">
                            <span class="text-2xl transition-transform duration-300 group-hover:scale-110 group-hover:rotate-3 filter drop-shadow-sm">🐄</span>
                            <h1 class="text-lg font-bold text-txt-100 tracking-wide">Livestock<span class="text-primary-300 opacity-90">System</span></h1>
                        </a>
                    </div>

                    
                    <nav class="hidden sm:flex items-center gap-1">
                        <?php if(auth()->guard()->check()): ?>
                            <?php if($user?->isAdmin()): ?>
                                <a href="<?php echo e(route('dashboard')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('dashboard') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Dashboard</a>
                                <a href="<?php echo e(route('owners.index')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('owners.index') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Owners</a>
                                <a href="<?php echo e(route('livestock.index')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('livestock.*') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Livestock</a>
                                <a href="<?php echo e(route('schemes.index')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('schemes.*') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Schemes</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('owner.dashboard')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('owner.dashboard') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">My Dashboard</a>
                                <a href="<?php echo e(route('livestock.index')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('livestock.index') || request()->routeIs('livestock.show') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">My Livestock</a>
                                <a href="<?php echo e(route('schemes.index')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('schemes.*') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Schemes</a>
                            <?php endif; ?>

                            
                            <div class="h-4 w-px bg-bg-300 mx-2"></div>

                            
                            <a href="<?php echo e(route('profile.edit')); ?>" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-txt-100 hover:hover:bg-primary-100/20 <?php echo e(request()->routeIs('profile.*') ? 'text-txt-100 bg-bg-200/20' : ''); ?>">Profile</a>

                            <form method="POST" action="<?php echo e(route('logout')); ?>" class="m-0 p-0 ml-1">
                                <?php echo csrf_field(); ?>
                                <button type="submit" class="rounded-full px-4 py-2 text-sm font-medium text-txt-200 transition-colors hover:text-status-danger hover:bg-status-danger/10">Log Out</button>
                            </form>
                        <?php else: ?>
                            <a href="<?php echo e(route('login')); ?>" class="rounded-full px-5 py-2 text-sm font-medium text-txt-200 transition-all hover:text-txt-100 hover:hover:bg-primary-100/20">Login</a>
                            <a href="<?php echo e(route('register')); ?>" class="group relative ml-1 inline-flex items-center justify-center px-6 py-2 bg-primary-200 text-white font-medium rounded-full overflow-hidden transition-all duration-300 hover:bg-primary-100 shadow-cinematic hover:shadow-cinematic-hover text-sm border border-primary-200/50">
                                <span class="absolute inset-0 w-full h-full bg-gradient-to-b from-white/10 to-transparent"></span>
                                <span class="relative">Create Account</span>
                            </a>
                        <?php endif; ?>

                        
                        <div class="h-4 w-px bg-bg-300 mx-2"></div>
                        <button type="button" id="theme-toggle" class="relative flex items-center justify-center w-10 h-10 rounded-full border border-bg-300 bg-bg-200/50 text-txt-200 transition-colors hover:hover:bg-primary-100/20 hover:text-txt-100 outline-none overflow-hidden group ml-1" aria-label="Toggle theme">
                            
                            <svg id="theme-toggle-light-icon" class="w-5 h-5 absolute transition-all duration-300 transform dark:-translate-y-8 dark:opacity-0 dark:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            
                            <svg id="theme-toggle-dark-icon" class="w-5 h-5 absolute transition-all duration-300 transform translate-y-8 opacity-0 -rotate-45 dark:translate-y-0 dark:opacity-100 dark:rotate-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>
                    </nav>

                    
                    <div class="sm:hidden flex items-center gap-3">
                        <button type="button" id="mobile-theme-toggle" class="relative flex items-center justify-center w-9 h-9 rounded-full border border-bg-300 bg-bg-200/50 text-txt-200 transition-colors outline-none overflow-hidden">
                            <svg class="w-4 h-4 absolute transition-all duration-300 transform dark:-translate-y-8 dark:opacity-0 dark:rotate-45 block dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                            <svg class="w-4 h-4 absolute transition-all duration-300 transform translate-y-8 opacity-0 -rotate-45 dark:translate-y-0 dark:opacity-100 dark:rotate-0 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        </button>
                        <button type="button" onclick="document.getElementById('mobile-nav').classList.toggle('hidden')" class="rounded-full border border-bg-300 bg-bg-200/50 p-2 text-txt-200 transition hover:hover:bg-primary-100/20">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/></svg>
                        </button>
                    </div>
                </div>
            </header>

            
            <div id="mobile-nav" class="hidden sm:hidden mx-auto max-w-7xl mt-2 pointer-events-auto rounded-2xl border border-bg-300 bg-bg-300/95 backdrop-blur-xl px-4 py-4 space-y-1 shadow-cinematic">
                <?php if(auth()->guard()->check()): ?>
                    <?php if($user?->isAdmin()): ?>
                        <a href="<?php echo e(route('dashboard')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">📊 Dashboard</a>
                        <a href="<?php echo e(route('owners.index')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">👥 Owners</a>
                        <a href="<?php echo e(route('livestock.index')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">🐄 Livestock</a>
                        <a href="<?php echo e(route('schemes.index')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">📜 Schemes</a>
                    <?php else: ?>
                        <a href="<?php echo e(route('owner.dashboard')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">📊 My Dashboard</a>
                        <a href="<?php echo e(route('livestock.index')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">🐄 My Livestock</a>
                        <a href="<?php echo e(route('schemes.index')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">📜 Schemes</a>
                    <?php endif; ?>

                    <div class="border-t border-bg-300 my-2"></div>

                    <a href="<?php echo e(route('profile.edit')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">⚙️ Profile</a>

                    <form method="POST" action="<?php echo e(route('logout')); ?>">
                        <?php echo csrf_field(); ?>
                        <button type="submit" class="w-full text-left block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:bg-status-danger/10 hover:text-status-danger">🚪 Log Out</button>
                    </form>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="block rounded-xl px-4 py-3 text-sm font-medium text-txt-200 transition hover:hover:bg-primary-100/20 hover:text-txt-100">Login</a>
                    <a href="<?php echo e(route('register')); ?>" class="block rounded-xl bg-primary-200 px-4 py-3 text-sm font-medium text-white transition hover:bg-primary-100 mt-2 text-center border border-primary-200/50">Create Account</a>
                <?php endif; ?>
            </div>
        </div>

        
        <?php if(request()->routeIs('welcome') || request()->is('/')): ?>
            <main class="<?php echo $__env->yieldContent('content_class', ''); ?> flex-1 flex flex-col">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        <?php else: ?>
            <main class="<?php echo $__env->yieldContent('content_class', 'mx-auto max-w-7xl px-4 pt-32 pb-10 sm:px-6 lg:px-8'); ?> flex-1 w-full">
                <?php echo $__env->yieldContent('content'); ?>
            </main>
        <?php endif; ?>
    </div>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const toggleButtons = [document.getElementById('theme-toggle'), document.getElementById('mobile-theme-toggle')];
            
            toggleButtons.forEach(btn => {
                if (!btn) return;
                btn.addEventListener('click', async (e) => {
                    const isDark = document.documentElement.classList.contains('dark');
                    
                    // Fallback for browsers that don't support view transitions
                    if (!document.startViewTransition) {
                        toggleTheme(!isDark);
                        return;
                    }

                    // Get click coordinates for radial wipe
                    const rect = btn.getBoundingClientRect();
                    const x = rect.left + rect.width / 2;
                    const y = rect.top + rect.height / 2;
                    const right = window.innerWidth - x;
                    const bottom = window.innerHeight - y;
                    const maxRadius = Math.hypot(Math.max(x, right), Math.max(y, bottom));

                    const transition = document.startViewTransition(() => {
                        toggleTheme(!isDark);
                    });

                    transition.ready.then(() => {
                        const clipPath = [
                            `circle(0px at ${x}px ${y}px)`,
                            `circle(${maxRadius}px at ${x}px ${y}px)`
                        ];
                        
                        document.documentElement.animate(
                            {
                                clipPath: isDark ? [...clipPath].reverse() : clipPath
                            },
                            {
                                duration: 700,
                                easing: 'ease-in-out',
                                pseudoElement: isDark ? '::view-transition-old(root)' : '::view-transition-new(root)'
                            }
                        );
                    });
                });
            });

            function toggleTheme(makeDark) {
                if (makeDark) {
                    document.documentElement.classList.add('dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.classList.remove('dark');
                    localStorage.setItem('theme', 'light');
                }
            }
        });
    </script>
</body>
</html>
<?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/layouts/app.blade.php ENDPATH**/ ?>