

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <span class="mb-2 inline-block rounded-full bg-indigo-50 px-3 py-1 text-xs font-semibold text-indigo-700 ring-1 ring-inset ring-indigo-700/10">Administrator Panel</span>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Admin Dashboard</h2>
            <p class="mt-1 text-sm text-slate-600">System-wide livestock management and analytics overview</p>
        </div>
        <a href="<?php echo e(route('owners.index')); ?>" class="inline-flex shrink-0 rounded-lg bg-slate-900 px-4 py-2 text-xs font-semibold text-white transition hover:bg-slate-800">
            View All Owners
        </a>
    </div>

    <!-- Main Stats Cards -->
    <div class="mb-4 grid gap-3 grid-cols-2 lg:grid-cols-4">
        <!-- Total Owners Card -->
        <div class="col-span-1 lg:col-span-2 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Total Owners</p>
                    <p class="text-2xl font-bold text-slate-900"><?php echo e($totalOwners); ?></p>
                </div>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-sky-50 text-sky-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 016-6H0a6 6 0 016 6z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Livestock Card -->
        <div class="col-span-1 lg:col-span-2 rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-[11px] font-medium uppercase tracking-wider text-slate-500">Total Livestock</p>
                    <p class="text-2xl font-bold text-slate-900"><?php echo e($totalLivestock); ?></p>
                </div>
                <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-lg bg-amber-50 text-amber-600">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Livestock by Type and Health Status -->
    <div class="grid gap-3 lg:grid-cols-2">
        <!-- Livestock by Type -->
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-slate-900">Livestock Types Distribution</h3>
            </div>

            <?php if($livestockByType->isNotEmpty()): ?>
                <div class="space-y-2.5">
                    <?php $__currentLoopData = $livestockByType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-end gap-3 text-sm">
                            <div class="flex-1">
                                <div class="flex justify-between mb-1">
                                    <span class="font-medium text-slate-700"><?php echo e($item->type); ?></span>
                                    <span class="text-slate-500 text-xs"><?php echo e($item->count); ?> (<?php echo e($totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0); ?>%)</span>
                                </div>
                                <div class="h-1.5 overflow-hidden rounded-full bg-slate-100">
                                    <div class="h-full rounded-full bg-gradient-to-r from-sky-400 to-sky-300" style="width: <?php echo e($totalLivestock ? ($item->count / $totalLivestock) * 100 : 0); ?>%"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-sm text-slate-500">No livestock data available yet.</p>
            <?php endif; ?>
        </div>

        <!-- Livestock by Health Status -->
        <div class="rounded-xl border border-slate-200 bg-white p-4 shadow-sm">
            <div class="mb-3">
                <h3 class="text-sm font-semibold text-slate-900">Health Status Overview</h3>
            </div>

            <?php if($livestockByStatus->isNotEmpty()): ?>
                <div class="space-y-2.5">
                    <?php $__currentLoopData = $livestockByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-sm">
                            <div class="flex items-center gap-2">
                                <?php
                                    $healthDot = match ($item->health_status) {
                                        'Healthy' => 'bg-emerald-500',
                                        'Sick' => 'bg-red-500',
                                        'Under Treatment' => 'bg-yellow-500',
                                        'Hospitalized' => 'bg-slate-500',
                                        'Injured' => 'bg-amber-500',
                                        default => 'bg-slate-300',
                                    };
                                ?>
                                <span class="h-2 w-2 rounded-full <?php echo e($healthDot); ?>"></span>
                                <span class="font-medium text-slate-700"><?php echo e($item->health_status); ?></span>
                            </div>
                            <div class="text-slate-600 text-xs font-medium">
                                <?php echo e($item->count); ?> <span class="text-slate-400 ml-1">(<?php echo e($totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0); ?>%)</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <p class="text-sm text-slate-500">No livestock data available yet.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Featured Schemes -->
    <div class="mt-4">
        <div class="mb-3 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-slate-900">Featured Schemes</h3>
            <a href="<?php echo e(route('schemes.index')); ?>" class="text-xs font-semibold text-sky-600 hover:text-sky-700">View All →</a>
        </div>
        
        <?php if($featuredSchemes->isEmpty()): ?>
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500">
                No schemes available.
            </div>
        <?php else: ?>
            <div class="grid gap-3 md:grid-cols-3">
                <?php $__currentLoopData = $featuredSchemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('schemes.show', $scheme)); ?>" class="group rounded-xl border border-slate-200 bg-white p-4 shadow-sm transition hover:border-sky-200 hover:shadow-md">
                        <div class="mb-2 flex items-center justify-between">
                            <span class="inline-flex rounded-full bg-sky-50 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-sky-700"><?php echo e($scheme->scheme_type); ?></span>
                            <span class="text-xs text-slate-500"><?php echo e($scheme->category); ?></span>
                        </div>
                        <h4 class="font-semibold text-slate-900 group-hover:text-sky-700 line-clamp-1"><?php echo e($scheme->title); ?></h4>
                        <p class="mt-1 text-xs text-slate-600 line-clamp-2"><?php echo e($scheme->description); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/dashboard/index.blade.php ENDPATH**/ ?>