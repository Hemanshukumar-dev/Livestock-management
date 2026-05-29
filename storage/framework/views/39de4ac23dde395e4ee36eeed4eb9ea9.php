<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-8 flex flex-col sm:flex-row sm:items-end justify-between gap-4">
        <div>
            <span class="mb-2 inline-block rounded-full bg-primary-300/10 px-3 py-1 text-xs font-semibold text-primary-300 ring-1 ring-inset ring-agri-teal/20">Administrator Panel</span>
            <h2 class="mt-1 text-3xl font-bold tracking-tight text-txt-100">Admin Dashboard</h2>
            <p class="mt-1 text-sm text-txt-200">System-wide livestock management and analytics overview</p>
        </div>
        <a href="<?php echo e(route('owners.index')); ?>" class="inline-flex shrink-0 rounded-lg bg-bg-200 px-4 py-2.5 text-xs font-semibold text-txt-100 transition hover:hover:bg-primary-100/20 border border-bg-300 shadow-cinematic">
            View All Owners
        </a>
    </div>

    <!-- Main Stats Cards -->
    <div class="mb-8 grid gap-6 grid-cols-2 lg:grid-cols-4">
        <!-- Total Owners Card -->
        <div class="col-span-1 lg:col-span-2 rounded-2xl border border-bg-300 bg-bg-300 p-6 shadow-cinematic transition-all hover:shadow-cinematic-hover hover:-translate-y-1">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium uppercase tracking-widest text-txt-200">Total Owners</p>
                    <p class="text-4xl font-bold text-txt-100 mt-2"><?php echo e($totalOwners); ?></p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl hover:bg-primary-100/20 text-txt-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.856-1.487M15 10a3 3 0 11-6 0 3 3 0 016 0zM6 20h12a6 6 0 016-6H0a6 6 0 016 6z" />
                    </svg>
                </div>
            </div>
        </div>

        <!-- Total Livestock Card -->
        <div class="col-span-1 lg:col-span-2 rounded-2xl border border-bg-300 bg-bg-300 p-6 shadow-cinematic transition-all hover:shadow-cinematic-hover hover:-translate-y-1">
            <div class="flex items-center justify-between gap-3">
                <div>
                    <p class="text-xs font-medium uppercase tracking-widest text-txt-200">Total Livestock</p>
                    <p class="text-4xl font-bold text-txt-100 mt-2"><?php echo e($totalLivestock); ?></p>
                </div>
                <div class="flex h-12 w-12 shrink-0 items-center justify-center rounded-xl hover:bg-primary-100/20 text-txt-200">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C6.5 6.253 2 10.998 2 17s4.5 10.747 10 10.747c5.5 0 10-4.998 10-10.747S17.5 6.253 12 6.253z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    <!-- Livestock by Type and Health Status -->
    <div class="grid gap-6 lg:grid-cols-2 mb-8">
        <!-- Livestock by Type -->
        <div class="rounded-2xl border border-bg-300 bg-bg-300 p-6 shadow-cinematic">
            <div class="mb-5 border-b border-bg-300 pb-3">
                <h3 class="text-base font-semibold text-txt-100">Livestock Types Distribution</h3>
            </div>

            <?php if($livestockByType->isNotEmpty()): ?>
                <div class="space-y-4">
                    <?php $__currentLoopData = $livestockByType; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-end gap-3 text-sm">
                            <div class="flex-1">
                                <div class="flex justify-between mb-1.5">
                                    <span class="font-medium text-txt-100"><?php echo e($item->type); ?></span>
                                    <span class="text-txt-200 text-xs"><?php echo e($item->count); ?> (<?php echo e($totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0); ?>%)</span>
                                </div>
                                <div class="h-1.5 overflow-hidden rounded-full hover:bg-primary-100/20">
                                    <div class="h-full rounded-full bg-gradient-to-r from-primary-300 to-primary-200" style="width: <?php echo e($totalLivestock ? ($item->count / $totalLivestock) * 100 : 0); ?>%"></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="rounded-xl hover:bg-primary-100/20 p-6 text-center text-sm text-txt-200 border border-bg-300">
                    No livestock data available yet.
                </div>
            <?php endif; ?>
        </div>

        <!-- Livestock by Health Status -->
        <div class="rounded-2xl border border-bg-300 bg-bg-300 p-6 shadow-cinematic">
            <div class="mb-5 border-b border-bg-300 pb-3">
                <h3 class="text-base font-semibold text-txt-100">Health Status Overview</h3>
            </div>

            <?php if($livestockByStatus->isNotEmpty()): ?>
                <div class="space-y-3">
                    <?php $__currentLoopData = $livestockByStatus; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex items-center justify-between text-sm rounded-xl p-3 bg-bg-300 border border-bg-300 transition-colors hover:hover:bg-primary-100/20">
                            <div class="flex items-center gap-3">
                                <?php
                                    $healthDot = match ($item->health_status) {
                                        'Healthy' => 'bg-status-success',
                                        'Sick' => 'bg-status-danger',
                                        'Under Treatment' => 'bg-status-warning',
                                        'Hospitalized' => 'bg-txt-200',
                                        'Injured' => 'bg-status-warning',
                                        default => 'bg-txt-200',
                                    };
                                ?>
                                <span class="h-2.5 w-2.5 rounded-full <?php echo e($healthDot); ?> shadow-sm"></span>
                                <span class="font-medium text-txt-100"><?php echo e($item->health_status); ?></span>
                            </div>
                            <div class="text-txt-100 text-sm font-bold">
                                <?php echo e($item->count); ?> <span class="text-txt-200 ml-1 font-normal text-xs">(<?php echo e($totalLivestock ? round(($item->count / $totalLivestock) * 100) : 0); ?>%)</span>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="rounded-xl hover:bg-primary-100/20 p-6 text-center text-sm text-txt-200 border border-bg-300">
                    No livestock data available yet.
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Featured Schemes -->
    <div class="mt-4">
        <div class="mb-5 flex items-center justify-between border-b border-bg-300 pb-3">
            <h3 class="text-base font-semibold text-txt-100">Featured Schemes</h3>
            <a href="<?php echo e(route('schemes.index')); ?>" class="text-xs font-semibold text-primary-300 hover:text-primary-200 transition-colors">View All →</a>
        </div>
        
        <?php if($featuredSchemes->isEmpty()): ?>
            <div class="rounded-xl hover:bg-primary-100/20 p-8 text-center text-sm text-txt-200 border border-bg-300">
                No schemes available.
            </div>
        <?php else: ?>
            <div class="grid gap-6 md:grid-cols-3">
                <?php $__currentLoopData = $featuredSchemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('schemes.show', $scheme)); ?>" class="group block rounded-2xl border border-bg-300 bg-bg-300 p-5 shadow-cinematic transition-all duration-300 hover:-translate-y-1 hover:shadow-cinematic-hover hover:border-primary-300/50">
                        <div class="mb-4 flex items-center justify-between">
                            <span class="inline-flex rounded-full bg-primary-200 px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider text-bg-100"><?php echo e($scheme->scheme_type); ?></span>
                            <span class="text-xs font-medium text-txt-200"><?php echo e($scheme->category); ?></span>
                        </div>
                        <h4 class="text-lg font-bold text-txt-100 group-hover:text-primary-300 transition-colors line-clamp-1 mb-2"><?php echo e($scheme->title); ?></h4>
                        <p class="text-sm font-light text-txt-200 line-clamp-2 leading-relaxed"><?php echo e($scheme->description); ?></p>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/dashboard/index.blade.php ENDPATH**/ ?>