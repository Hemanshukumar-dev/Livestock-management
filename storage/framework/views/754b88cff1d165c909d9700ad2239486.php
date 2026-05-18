<?php $__env->startSection('title', 'Owner Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
            <span class="mb-2 inline-block rounded-full bg-emerald-50 px-3 py-1 text-xs font-semibold text-emerald-700 ring-1 ring-inset ring-emerald-700/10">Farmer Dashboard</span>
            <h2 class="mt-1 text-3xl font-semibold tracking-tight text-slate-900">Owner Dashboard</h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">Manage your livestock records, health activities, and discover relevant government schemes.</p>
        </div>
        <?php if($owner): ?>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('livestock.index')); ?>" class="rounded-xl border border-slate-300 bg-white px-4 py-2 text-sm font-semibold text-slate-700 transition hover:bg-slate-50 shadow-sm flex items-center gap-2">
                    <span>🐄</span> My Livestock
                </a>
                <a href="<?php echo e(route('livestock.create')); ?>" class="rounded-xl bg-green-700 px-4 py-2 text-sm font-semibold text-white transition hover:bg-green-600 shadow-sm flex items-center gap-2">
                    <span>➕</span> Add Livestock
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if(! $owner): ?>
        <div class="rounded-3xl border border-dashed border-slate-300 bg-white px-6 py-16 text-center shadow-sm">
            <h3 class="text-xl font-semibold text-slate-900">Owner profile not linked yet</h3>
            <p class="mt-2 text-sm text-slate-600">Your user account is active, but an owner record has not been linked by an administrator.</p>
        </div>
    <?php else: ?>
        <?php $historyCount = $owner->livestock->sum(fn ($animal) => $animal->histories->count()); ?>

        <div class="mb-10 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Owner</p>
                <h3 class="mt-3 text-2xl font-semibold text-slate-900"><?php echo e($owner->name); ?></h3>
                <p class="mt-2 text-sm text-slate-600">Code: <?php echo e($owner->owner_code); ?></p>
                <p class="mt-1 text-sm text-slate-600">Phone: <?php echo e($owner->phone); ?></p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">Livestock</p>
                <h3 class="mt-3 text-4xl font-bold text-slate-900"><?php echo e($owner->livestock->count()); ?></h3>
                <p class="mt-2 text-sm text-slate-600">Animals linked to your account</p>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <p class="text-sm font-medium uppercase tracking-[0.15em] text-slate-500">History</p>
                <h3 class="mt-3 text-4xl font-bold text-slate-900"><?php echo e($historyCount); ?></h3>
                <p class="mt-2 text-sm text-slate-600">Recorded events across all livestock</p>
            </div>
        </div>

        <div class="grid gap-6 lg:grid-cols-2">
            <div class="space-y-6">
                
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-900 flex items-center gap-2"><span>⚠️</span> Needs Attention</h3>
                    </div>
                    <?php if($attentionLivestock->isEmpty()): ?>
                        <div class="rounded-xl bg-slate-50 px-4 py-8 text-center text-sm text-slate-500 border border-dashed border-slate-200">
                            All animals are currently marked as healthy.
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $attentionLivestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $statusClasses = [
                                        'Sick' => 'bg-red-100 text-red-700',
                                        'Under Treatment' => 'bg-yellow-100 text-yellow-800',
                                        'Hospitalized' => 'bg-slate-200 text-slate-800',
                                        'Injured' => 'bg-amber-100 text-amber-800',
                                    ][$animal->health_status] ?? 'bg-slate-100 text-slate-600';
                                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                ?>
                                <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="flex items-center justify-between rounded-xl border border-slate-100 bg-white p-3.5 transition hover:border-slate-300 hover:shadow-sm">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl"><?php echo e($typeIcon); ?></span>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900"><?php echo e($animal->tag_number); ?></p>
                                            <p class="text-xs text-slate-500"><?php echo e($animal->type); ?></p>
                                        </div>
                                    </div>
                                    <span class="rounded-full px-2.5 py-1 text-xs font-semibold <?php echo e($statusClasses); ?>"><?php echo e($animal->health_status); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-900 flex items-center gap-2"><span>🆕</span> Recently Added</h3>
                        <a href="<?php echo e(route('livestock.index')); ?>" class="text-sm font-medium text-green-600 hover:text-green-700">View All →</a>
                    </div>
                    <?php if($latestLivestock->isEmpty()): ?>
                        <div class="rounded-xl bg-slate-50 px-4 py-8 text-center text-sm text-slate-500 border border-dashed border-slate-200">
                            No livestock added yet.
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $latestLivestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                ?>
                                <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="flex items-center justify-between rounded-xl border border-slate-100 bg-white p-3.5 transition hover:border-green-200 hover:bg-green-50/50">
                                    <div class="flex items-center gap-3">
                                        <span class="text-xl"><?php echo e($typeIcon); ?></span>
                                        <div>
                                            <p class="text-sm font-semibold text-slate-900"><?php echo e($animal->tag_number); ?></p>
                                            <p class="text-xs text-slate-500"><?php echo e($animal->type); ?> <span class="text-slate-400">(<?php echo e($animal->breed ?? 'N/A'); ?>)</span></p>
                                        </div>
                                    </div>
                                    <span class="text-xs font-medium text-slate-400"><?php echo e($animal->created_at->diffForHumans()); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <div class="space-y-6">
                
                <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="font-semibold text-slate-900 flex items-center gap-2"><span>🩺</span> Recent Activity</h3>
                    </div>
                    <?php if($recentHistory->isEmpty()): ?>
                        <div class="rounded-xl bg-slate-50 px-4 py-8 text-center text-sm text-slate-500 border border-dashed border-slate-200">
                            No health records found.
                        </div>
                    <?php else: ?>
                        <div class="space-y-5">
                            <?php $__currentLoopData = $recentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $eventColor = [
                                        'Vaccination' => ['text-blue-500', 'bg-blue-100', '💉'],
                                        'Treatment' => ['text-purple-500', 'bg-purple-100', '💊'],
                                        'Checkup' => ['text-green-500', 'bg-green-100', '🩺'],
                                        'Illness' => ['text-red-500', 'bg-red-100', '🤒'],
                                        'Deworming' => ['text-teal-500', 'bg-teal-100', '🧪'],
                                        'Surgery' => ['text-orange-500', 'bg-orange-100', '🔬'],
                                    ][$history->event_type] ?? ['text-slate-500', 'bg-slate-100', '📝'];
                                ?>
                                <div class="relative flex gap-4 pl-2">
                                    <?php if(!$loop->last): ?>
                                        <div class="absolute left-[15px] top-6 bottom-[-20px] w-px bg-slate-100"></div>
                                    <?php endif; ?>
                                    <div class="relative z-10 flex h-6 w-6 items-center justify-center rounded-full <?php echo e($eventColor[1]); ?> ring-4 ring-white mt-0.5 shadow-sm text-xs">
                                        <?php echo e($eventColor[2]); ?>

                                    </div>
                                    <div class="flex-1 pb-1">
                                        <p class="text-sm font-semibold text-slate-900">
                                            <?php echo e($history->event_type); ?> 
                                            <span class="font-normal text-slate-500">on</span> 
                                            <a href="<?php echo e(route('livestock.show', $history->livestock->id)); ?>" class="text-green-600 hover:underline hover:text-green-700"><?php echo e($history->livestock->tag_number); ?></a>
                                        </p>
                                        <p class="mt-0.5 text-xs font-medium text-slate-400"><?php echo e(\Illuminate\Support\Carbon::parse($history->event_date)->format('M d, Y')); ?></p>
                                        <?php if($history->description): ?>
                                            <p class="mt-2 text-sm text-slate-600 bg-slate-50 p-3 rounded-xl border border-slate-100"><?php echo e(\Illuminate\Support\Str::limit($history->description, 80)); ?></p>
                                        <?php endif; ?>
                                        <div class="mt-3 flex items-center gap-2">
                                            <a href="<?php echo e(route('livestock.histories.edit', $history->id)); ?>" class="rounded-lg border border-slate-200 px-3 py-1 text-xs font-medium text-slate-600 hover:bg-slate-50 transition">✏️ Edit</a>
                                            <form method="POST" action="<?php echo e(route('livestock.histories.destroy', $history->id)); ?>" class="inline" onsubmit="return false;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" onclick="openDeleteHistoryModal(this.closest('form'), '<?php echo e($history->event_type); ?>')" class="rounded-lg border border-red-200 text-red-600 px-3 py-1 text-xs font-medium hover:bg-red-50 transition">🗑 Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <div id="delete-history-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-2xl">
            <div class="text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl">⚠️</div>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Delete History Record</h3>
                <p class="mt-2 text-sm text-slate-600">Are you sure you want to delete the <strong id="delete-history-type"></strong> record? This action cannot be undone.</p>
            </div>
            <div class="mt-8 flex gap-3">
                <button
                    type="button"
                    onclick="closeDeleteHistoryModal()"
                    class="flex-1 rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="confirm-history-delete-btn"
                    class="flex-1 rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-500"
                >
                    Yes, Delete
                </button>
            </div>
        </div>
    </div>

    <script>
        let activeHistoryDeleteForm = null;

        function openDeleteHistoryModal(form, eventType) {
            activeHistoryDeleteForm = form;
            document.getElementById('delete-history-type').textContent = eventType;
            const modal = document.getElementById('delete-history-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeDeleteHistoryModal() {
            activeHistoryDeleteForm = null;
            const modal = document.getElementById('delete-history-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        document.getElementById('confirm-history-delete-btn')?.addEventListener('click', function () {
            if (activeHistoryDeleteForm) activeHistoryDeleteForm.submit();
        });

        document.getElementById('delete-history-modal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteHistoryModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') closeDeleteHistoryModal();
        });
    </script>

    <!-- Featured Schemes -->
    <div class="mt-4">
        <div class="mb-3 flex items-center justify-between">
            <h3 class="text-sm font-semibold text-slate-900">Featured Government Schemes</h3>
            <a href="<?php echo e(route('schemes.index')); ?>" class="text-xs font-semibold text-sky-600 hover:text-sky-700">Browse All Schemes →</a>
        </div>
        
        <?php if($featuredSchemes->isEmpty()): ?>
            <div class="rounded-xl border border-dashed border-slate-300 bg-white p-6 text-center text-sm text-slate-500">
                No schemes available at the moment.
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

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/dashboard/owner.blade.php ENDPATH**/ ?>