<?php $__env->startSection('title', 'Owners'); ?>

<?php $__env->startSection('content'); ?>
    <?php $currentUser = auth()->user(); ?>

    <?php if(session('success')): ?>
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800 shadow-sm">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('credentials')): ?>
        <div class="mb-8 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-4 text-sm text-amber-900 shadow-sm">
            <p class="font-semibold">Owner credentials</p>
            <p class="mt-2">Email: <span class="font-mono"><?php echo e(session('credentials.email')); ?></span></p>
            <p>Password: <span class="font-mono"><?php echo e(session('credentials.password')); ?></span></p>
        </div>
    <?php endif; ?>

    <div class="mb-6 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Owner Records</p>
            <h2 class="mt-1 text-2xl font-bold tracking-tight text-txt-100">All owners and their livestock</h2>
            <p class="mt-1 max-w-2xl text-sm leading-6 text-txt-200">Browse owner profiles and the livestock attached to each owner from a single clean interface.</p>
        </div>

        <?php if($currentUser?->isAdmin()): ?>
            <a href="<?php echo e(route('owners.create')); ?>" class="inline-flex items-center justify-center rounded-full bg-sky-600 px-5 py-3 text-sm font-semibold text-white shadow-lg shadow-sky-600/20 transition hover:bg-sky-500">
                Add New Owner
            </a>
        <?php endif; ?>
    </div>

    <!-- Search & Filter Section -->
    <form method="GET" action="<?php echo e(route('owners.index')); ?>" class="mb-6 rounded-2xl border border-bg-300 bg-bg-100 p-5 shadow-sm">
        <div class="mb-4">
            <p class="text-sm font-semibold uppercase tracking-[0.15em] text-txt-200">Search & Filter</p>
        </div>
        
        <div class="grid gap-4 md:grid-cols-3 md:items-end">
            <!-- Search Input -->
            <div>
                <label for="search" class="block text-sm font-medium text-slate-700">Search by Owner Name</label>
                <input 
                    type="text" 
                    id="search"
                    name="search" 
                    value="<?php echo e($search ?? ''); ?>"
                    placeholder="Enter owner name..."
                    class="mt-2 w-full rounded-lg border border-bg-300 bg-bg-100 px-3 py-2 text-sm text-txt-100 placeholder-slate-400 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                />
            </div>

            <!-- Type Filter -->
            <div>
                <label for="type" class="block text-sm font-medium text-slate-700">Filter by Livestock Type</label>
                <select 
                    id="type"
                    name="type"
                    class="mt-2 w-full rounded-lg border border-bg-300 bg-bg-100 px-3 py-2 text-sm text-txt-100 transition focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-500/20"
                >
                    <option value="">All Types</option>
                    <?php $__empty_1 = true; $__currentLoopData = $livestockTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $livestockType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <option value="<?php echo e($livestockType); ?>" <?php if(($type ?? '') === $livestockType): echo 'selected'; endif; ?>>
                            <?php echo e($livestockType); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <option disabled>No livestock types available</option>
                    <?php endif; ?>
                </select>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <button 
                    type="submit"
                    class="flex-1 rounded-lg bg-sky-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-sky-500"
                >
                    Search
                </button>
                <a 
                    href="<?php echo e(route('owners.index')); ?>"
                    class="flex-1 rounded-lg border border-bg-300 bg-bg-100 px-4 py-2 text-center text-sm font-semibold text-slate-700 transition hover:border-slate-400 hover:bg-bg-200"
                >
                    Clear
                </a>
            </div>
        </div>
    </form>

    <?php $__empty_1 = true; $__currentLoopData = $owners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $owner): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <section class="mb-3 rounded-2xl border border-bg-300 bg-bg-100 p-4 shadow-sm transition hover:shadow-md hover:border-sky-200">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                <div class="flex-1">
                    <div class="flex items-center gap-3">
                        <h3 class="text-base font-bold text-txt-100"><?php echo e($owner->name); ?></h3>
                        <span class="rounded-full bg-sky-50 border border-sky-100 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-sky-700"><?php echo e($owner->owner_code); ?></span>
                    </div>
                    <div class="mt-1.5 flex flex-wrap items-center gap-x-4 gap-y-1 text-sm text-txt-200">
                        <span class="flex items-center gap-1"><span class="text-slate-400">📞</span> <?php echo e($owner->phone ?: 'No phone'); ?></span>
                        <span class="flex items-center gap-1"><span class="text-slate-400">📍</span> <?php echo e(Str::limit($owner->address ?: 'No address', 40)); ?></span>
                        <span class="flex items-center gap-1 font-semibold text-txt-100"><span class="text-sky-500">🐄</span> <?php echo e($owner->livestock->count()); ?> records</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 sm:shrink-0">
                    <a href="<?php echo e(route('livestock.index', ['owner_code' => $owner->owner_code])); ?>" class="inline-flex items-center justify-center rounded-xl bg-sky-50 px-3 py-1.5 text-xs font-semibold text-sky-700 transition hover:bg-sky-100">
                        View Livestock
                    </a>

                    <?php if($currentUser?->isAdmin() || ($currentUser?->isOwner() && $owner->user_id === $currentUser->id)): ?>
                        <a href="<?php echo e(route('owners.edit', $owner->id)); ?>" class="inline-flex items-center justify-center rounded-xl border border-bg-300 bg-bg-100 px-3 py-1.5 text-xs font-semibold text-slate-700 transition hover:bg-bg-200">
                            Edit
                        </a>

                        <form method="POST" action="<?php echo e(route('owners.destroy', $owner->id)); ?>" onsubmit="return confirm('Delete this owner and all related livestock?');" class="inline">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="inline-flex items-center justify-center rounded-xl border border-red-200 bg-red-50 px-3 py-1.5 text-xs font-semibold text-red-700 transition hover:bg-red-100">
                                Delete
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="rounded-2xl border border-dashed border-bg-300 bg-bg-100 px-6 py-12 text-center shadow-sm">
            <?php if($search || $type): ?>
                <h3 class="text-lg font-bold text-txt-100">No owners found</h3>
                <p class="mt-1 text-sm text-txt-200">No owners match your search or filter criteria. Try adjusting your filters.</p>
                <a href="<?php echo e(route('owners.index')); ?>" class="mt-4 inline-flex rounded-xl bg-bg-100 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Clear Filters</a>
            <?php else: ?>
                <h3 class="text-lg font-bold text-txt-100">No owners yet</h3>
                <p class="mt-1 text-sm text-txt-200">Create the first owner and livestock entry to start populating the database.</p>
                <a href="<?php echo e(route('owners.create')); ?>" class="mt-4 inline-flex rounded-xl bg-bg-100 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-700">Add New Owner</a>
            <?php endif; ?>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/owners/index.blade.php ENDPATH**/ ?>