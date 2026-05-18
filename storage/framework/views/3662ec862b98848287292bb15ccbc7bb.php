<?php $__env->startSection('title', 'Government Schemes'); ?>

<?php $__env->startSection('content'); ?>
    <?php $currentUser = auth()->user(); ?>

    <?php if(session('success')): ?>
        <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            <span class="mr-2">✅</span><?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if($isOwner && !$ownerState): ?>
        <div class="mb-6 flex items-center justify-between rounded-2xl border border-amber-200 bg-amber-50 px-5 py-4 shadow-sm">
            <div class="text-sm font-medium text-amber-800">
                <span class="mr-2">⚠️</span>Complete your profile to receive state-specific government schemes.
            </div>
            <a href="<?php echo e(route('profile.edit')); ?>" class="text-xs font-bold uppercase tracking-wider text-amber-700 hover:text-amber-900 underline">Edit Profile</a>
        </div>
    <?php endif; ?>

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Government Support</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Government Schemes</h2>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-slate-600">Browse and apply for state and central government programs designed to support livestock farmers.</p>
        </div>

        <?php if($currentUser?->isAdmin()): ?>
            <a href="<?php echo e(route('schemes.create')); ?>" class="inline-flex shrink-0 items-center justify-center rounded-xl bg-sky-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500">
                Add New Scheme
            </a>
        <?php endif; ?>
    </div>

    <!-- Search & Filter Section -->
    <form method="GET" action="<?php echo e(route('schemes.index')); ?>" class="mb-8 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
        <div class="grid gap-4 md:grid-cols-5 md:items-end">
            <!-- Search -->
            <div class="md:col-span-2">
                <label for="search" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-500">Search</label>
                <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search schemes..." class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 placeholder-slate-400 transition focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20" />
            </div>

            <!-- Category Filter -->
            <div>
                <label for="category" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-500">Category</label>
                <select id="category" name="category" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">All Categories</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat); ?>" <?php if(request('category') === $cat): echo 'selected'; endif; ?>><?php echo e($cat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Type Filter -->
            <div>
                <label for="animal_type" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-500">Animal Type</label>
                <select id="animal_type" name="animal_type" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <option value="">All Animals</option>
                    <?php $__currentLoopData = $animalTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animalType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($animalType); ?>" <?php if(request('animal_type') === $animalType): echo 'selected'; endif; ?>><?php echo e($animalType); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            <!-- Scheme Type Filter -->
            <div>
                <label for="scheme_type" class="mb-1 block text-xs font-semibold uppercase tracking-wider text-slate-500">Govt Level</label>
                <select id="scheme_type" name="scheme_type" class="w-full rounded-xl border border-slate-300 bg-slate-50 px-3 py-2 text-sm text-slate-900 transition focus:border-sky-500 focus:bg-white focus:outline-none focus:ring-2 focus:ring-sky-500/20">
                    <?php if($isOwner): ?>
                        <option value="">All Relevant Schemes</option>
                        <option value="Central" <?php if(request('scheme_type') === 'Central'): echo 'selected'; endif; ?>>Central Schemes</option>
                        <option value="My State Schemes" <?php if(request('scheme_type') === 'My State Schemes'): echo 'selected'; endif; ?>>My State Schemes</option>
                    <?php else: ?>
                        <option value="">All Levels</option>
                        <option value="State" <?php if(request('scheme_type') === 'State'): echo 'selected'; endif; ?>>State</option>
                        <option value="Central" <?php if(request('scheme_type') === 'Central'): echo 'selected'; endif; ?>>Central</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="md:col-span-5 flex justify-end gap-3 pt-2">
                <a href="<?php echo e(route('schemes.index')); ?>" class="rounded-xl border border-slate-300 bg-white px-5 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">
                    Clear Filters
                </a>
                <button type="submit" class="rounded-xl bg-slate-900 px-5 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">
                    Apply Filters
                </button>
            </div>
        </div>
    </form>

    <!-- Schemes Grid -->
    <?php if($schemes->isEmpty()): ?>
        <div class="rounded-2xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <h3 class="text-xl font-bold text-slate-900">No schemes found</h3>
            <p class="mt-2 text-sm text-slate-600">No government schemes match your criteria at the moment.</p>
        </div>
    <?php else: ?>
        <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $schemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="flex flex-col rounded-2xl border border-slate-200 bg-white shadow-sm transition hover:shadow-md hover:border-sky-200 overflow-hidden">
                    <!-- Card Header -->
                    <div class="border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white px-5 py-4">
                        <div class="flex items-start justify-between gap-3 mb-2">
                            <span class="inline-flex rounded-full bg-sky-100 px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider text-sky-800">
                                <?php echo e($scheme->scheme_type === 'State' ? 'State Government' . ($scheme->state_name ? ' • ' . $scheme->state_name : '') : 'Central Government'); ?>

                            </span>
                            <?php if($scheme->deadline): ?>
                                <?php
                                    $daysLeft = now()->diffInDays($scheme->deadline, false);
                                    $deadlineClass = $daysLeft < 7 ? 'text-red-600 bg-red-50 border-red-200' : 'text-slate-600 bg-slate-50 border-slate-200';
                                ?>
                                <span class="inline-flex rounded-full border px-2.5 py-0.5 text-[10px] font-bold uppercase tracking-wider <?php echo e($deadlineClass); ?>">
                                    <?php if($daysLeft < 0): ?>
                                        Expired
                                    <?php else: ?>
                                        Ends <?php echo e($scheme->deadline->format('d M y')); ?>

                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-lg font-bold text-slate-900 leading-tight"><?php echo e($scheme->title); ?></h3>
                        <p class="mt-1 text-xs font-semibold text-sky-600"><?php echo e($scheme->category); ?></p>
                    </div>

                    <!-- Card Body -->
                    <div class="flex-1 p-5">
                        <p class="text-sm text-slate-600 line-clamp-3 mb-4"><?php echo e($scheme->description); ?></p>
                        
                        <div class="space-y-2 text-xs">
                            <?php if($scheme->animal_type): ?>
                                <div class="flex gap-2">
                                    <span class="font-semibold text-slate-900 min-w-[70px]">Eligible:</span>
                                    <span class="text-slate-600"><?php echo e($scheme->animal_type); ?></span>
                                </div>
                            <?php endif; ?>
                            <div class="flex gap-2">
                                <span class="font-semibold text-slate-900 min-w-[70px]">Benefits:</span>
                                <span class="text-slate-600 line-clamp-2"><?php echo e($scheme->benefits); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Card Footer -->
                    <div class="border-t border-slate-100 bg-slate-50 px-5 py-3 flex items-center justify-between gap-3">
                        <a href="<?php echo e(route('schemes.show', $scheme)); ?>" class="inline-flex items-center text-sm font-semibold text-sky-700 hover:text-sky-600">
                            View Details <span class="ml-1">→</span>
                        </a>

                        <?php if($currentUser?->isAdmin()): ?>
                            <div class="flex items-center gap-2">
                                <a href="<?php echo e(route('schemes.edit', $scheme)); ?>" class="rounded-lg border border-slate-200 bg-white px-3 py-1.5 text-xs font-semibold text-slate-700 hover:bg-slate-50">Edit</a>
                                <form method="POST" action="<?php echo e(route('schemes.destroy', $scheme)); ?>" onsubmit="return confirm('Delete this scheme?');" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="rounded-lg border border-red-200 bg-white px-3 py-1.5 text-xs font-semibold text-red-600 hover:bg-red-50">Delete</button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="mt-8">
            <?php echo e($schemes->links()); ?>

        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/schemes/index.blade.php ENDPATH**/ ?>