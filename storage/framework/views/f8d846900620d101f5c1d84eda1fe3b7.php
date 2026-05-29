<?php $__env->startSection('title', $scheme->title); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex items-center justify-between">
        <a href="<?php echo e(route('schemes.index')); ?>" class="inline-flex items-center text-sm font-semibold text-slate-500 hover:text-sky-700">
            ← Back to Schemes
        </a>
        <?php if(auth()->user()?->isAdmin()): ?>
            <div class="flex gap-2">
                <a href="<?php echo e(route('schemes.edit', $scheme)); ?>" class="rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-700 hover:bg-slate-50">Edit Scheme</a>
                <form method="POST" action="<?php echo e(route('schemes.destroy', $scheme)); ?>" onsubmit="return confirm('Delete this scheme?');">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="rounded-lg border border-red-200 bg-red-50 px-4 py-2 text-sm font-semibold text-red-600 hover:bg-red-100">Delete</button>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <div class="grid gap-6 lg:grid-cols-3">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
                <div class="flex items-center gap-3 mb-4">
                    <span class="inline-flex rounded-full bg-sky-100 px-3 py-1 text-xs font-bold uppercase tracking-wider text-sky-800">
                        <?php echo e($scheme->scheme_type === 'State' ? 'State Government' . ($scheme->state_name ? ' • ' . $scheme->state_name : '') : 'Central Government'); ?>

                    </span>
                    <span class="text-sm font-semibold text-slate-500"><?php echo e($scheme->category); ?></span>
                </div>
                
                <h1 class="text-2xl sm:text-3xl font-bold text-slate-900 leading-tight mb-4"><?php echo e($scheme->title); ?></h1>
                
                <div class="prose prose-slate max-w-none prose-sm sm:prose-base">
                    <p class="text-slate-700 leading-relaxed"><?php echo e($scheme->description); ?></p>
                </div>

                <div class="mt-8 space-y-6">
                    <div>
                        <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.1em] text-sky-600 mb-3">
                            <span>🎁</span> Key Benefits
                        </h3>
                        <div class="rounded-xl bg-sky-50/50 p-4 border border-sky-100">
                            <p class="text-slate-700 text-sm whitespace-pre-wrap leading-relaxed"><?php echo e($scheme->benefits); ?></p>
                        </div>
                    </div>

                    <div>
                        <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.1em] text-emerald-600 mb-3">
                            <span>✅</span> Eligibility Criteria
                        </h3>
                        <div class="rounded-xl bg-emerald-50/50 p-4 border border-emerald-100">
                            <p class="text-slate-700 text-sm whitespace-pre-wrap leading-relaxed"><?php echo e($scheme->eligibility); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <div class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                <h3 class="text-sm font-semibold uppercase tracking-wider text-slate-500 mb-4">Important Details</h3>
                
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="text-slate-400 mt-0.5">🐄</span>
                        <div>
                            <p class="font-semibold text-slate-900">Target Animal</p>
                            <p class="text-slate-600"><?php echo e($scheme->animal_type ?? 'All Animals (Generic)'); ?></p>
                        </div>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="text-slate-400 mt-0.5">📅</span>
                        <div>
                            <p class="font-semibold text-slate-900">Application Deadline</p>
                            <?php if($scheme->deadline): ?>
                                <?php
                                    $daysLeft = now()->diffInDays($scheme->deadline, false);
                                    $textColor = $daysLeft < 7 ? 'text-red-600 font-semibold' : 'text-slate-600';
                                ?>
                                <p class="<?php echo e($textColor); ?>">
                                    <?php echo e($scheme->deadline->format('d M, Y')); ?>

                                    <?php if($daysLeft >= 0): ?>
                                        <span class="text-xs ml-1">(<?php echo e($daysLeft); ?> days left)</span>
                                    <?php else: ?>
                                        <span class="text-xs ml-1">(Expired)</span>
                                    <?php endif; ?>
                                </p>
                            <?php else: ?>
                                <p class="text-slate-600">No deadline specified</p>
                            <?php endif; ?>
                        </div>
                    </li>
                </ul>

                <?php if($scheme->apply_link): ?>
                    <div class="mt-6 pt-6 border-t border-slate-100">
                        <a href="<?php echo e($scheme->apply_link); ?>" target="_blank" rel="noopener noreferrer" class="flex w-full items-center justify-center gap-2 rounded-xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">
                            Apply on Official Portal
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" /></svg>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/schemes/show.blade.php ENDPATH**/ ?>