<?php $__env->startSection('title', 'Owner Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-primary-300/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-70"></div>
        <div class="absolute -bottom-32 left-0 w-[50rem] h-[50rem] bg-accent-200/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-60"></div>
        
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMSIvPjwvc3ZnPg==')] opacity-50 dark:opacity-20 mix-blend-overlay"></div>
    </div>

    
    <div class="mb-12 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between relative z-10">
        <div class="animate-[fadeUp_0.8s_ease-out_forwards]">
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-300/10 border border-primary-300/20 text-primary-300 text-xs font-medium uppercase tracking-widest mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-primary-300"></span>
                Farmer Workspace
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-txt-100 leading-[1.1]">
                Owner Dashboard
            </h2>
            <p class="mt-3 max-w-2xl text-base leading-relaxed text-txt-200 font-light">
                Manage your livestock records, health activities, and discover relevant government schemes in one unified environment.
            </p>
        </div>
        <?php if($owner): ?>
            <div class="flex items-center gap-3 animate-[fadeLeft_0.8s_ease-out_forwards]">
                <a href="<?php echo e(route('livestock.index')); ?>" class="inline-flex items-center justify-center rounded-full border border-bg-300 bg-bg-300/80 backdrop-blur-md px-5 py-2.5 text-sm font-medium text-txt-100 transition-all hover:hover:bg-primary-100/20 hover:border-primary-300/30">
                    <span class="mr-2">🐄</span> My Livestock
                </a>
                <a href="<?php echo e(route('livestock.create')); ?>" class="group relative inline-flex items-center justify-center rounded-full bg-primary-200 px-5 py-2.5 text-sm font-medium text-white transition-all hover:bg-primary-100 hover:shadow-cinematic-hover shadow-cinematic border border-primary-100 overflow-hidden">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-b from-white/10 to-transparent"></span>
                    <span class="relative flex items-center gap-2">
                        <span>➕</span> Add Livestock
                    </span>
                </a>
            </div>
        <?php endif; ?>
    </div>

    <?php if(! $owner): ?>
        
        <div class="rounded-3xl border border-bg-300 bg-bg-300/60 backdrop-blur-md px-8 py-20 text-center shadow-cinematic relative z-10">
            <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full hover:bg-primary-100/20 mb-6 text-2xl">
                🔗
            </div>
            <h3 class="text-2xl font-bold text-txt-100">Profile Not Linked</h3>
            <p class="mt-3 text-txt-200 font-light max-w-md mx-auto">Your user account is active, but an owner record has not been securely linked by an administrator yet.</p>
        </div>
    <?php else: ?>
        <?php $historyCount = $owner->livestock->sum(fn ($animal) => $animal->histories->count()); ?>

        
        <div class="mb-12 grid gap-6 md:grid-cols-2 xl:grid-cols-3 relative z-10">
            
            <div class="rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic transition-all hover:shadow-cinematic-hover hover:-translate-y-1 group">
                <div class="flex items-center justify-between mb-4">
                    <p class="text-xs font-semibold uppercase tracking-widest text-txt-200">Identity</p>
                    <div class="w-8 h-8 rounded-full hover:bg-primary-100/20 flex items-center justify-center text-txt-200 group-hover:bg-primary-300/10 group-hover:text-primary-300 transition-colors">👤</div>
                </div>
                <h3 class="text-2xl sm:text-3xl font-bold text-txt-100 mb-4 line-clamp-1"><?php echo e($owner->name); ?></h3>
                <div class="space-y-1 text-sm font-medium">
                    <p class="text-txt-200"><span class="text-txt-200 mr-2">Code</span> <?php echo e($owner->owner_code); ?></p>
                    <p class="text-txt-200"><span class="text-txt-200 mr-2">Phone</span> <?php echo e($owner->phone); ?></p>
                </div>
            </div>

            
            <div class="rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic transition-all hover:shadow-cinematic-hover hover:-translate-y-1 group relative overflow-hidden">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-primary-300/5 rounded-full blur-2xl group-hover:bg-primary-300/10 transition-colors"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-semibold uppercase tracking-widest text-txt-200">Registry</p>
                        <div class="w-8 h-8 rounded-full hover:bg-primary-100/20 flex items-center justify-center text-txt-200 group-hover:bg-primary-300/10 group-hover:text-primary-300 transition-colors">🐄</div>
                    </div>
                    <h3 class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-agri-primary to-txt-200 mb-2"><?php echo e($owner->livestock->count()); ?></h3>
                    <p class="text-sm font-medium text-txt-200">Animals currently linked</p>
                </div>
            </div>

            
            <div class="rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic transition-all hover:shadow-cinematic-hover hover:-translate-y-1 group relative overflow-hidden">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-accent-200/5 rounded-full blur-2xl group-hover:bg-accent-200/10 transition-colors"></div>
                <div class="relative z-10">
                    <div class="flex items-center justify-between mb-4">
                        <p class="text-xs font-semibold uppercase tracking-widest text-txt-200">Logs</p>
                        <div class="w-8 h-8 rounded-full hover:bg-primary-100/20 flex items-center justify-center text-txt-200 group-hover:bg-accent-200/10 group-hover:text-accent-200 transition-colors">📝</div>
                    </div>
                    <h3 class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-agri-primary to-txt-200 mb-2"><?php echo e($historyCount); ?></h3>
                    <p class="text-sm font-medium text-txt-200">Recorded events across herd</p>
                </div>
            </div>
        </div>

        
        <div class="grid gap-8 lg:grid-cols-12 relative z-10 mb-12">
            
            
            <div class="lg:col-span-5 space-y-8">
                
                
                <div class="rounded-3xl border border-bg-300 bg-bg-300/60 backdrop-blur-xl p-6 sm:p-8 shadow-cinematic transition-all hover:bg-bg-300/80">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-txt-100 flex items-center gap-2">
                            <span class="text-status-warning">⚠️</span> Action Required
                        </h3>
                    </div>
                    <?php if($attentionLivestock->isEmpty()): ?>
                        <div class="rounded-2xl hover:bg-primary-100/20 px-6 py-10 text-center border border-bg-300 transition-colors">
                            <div class="text-2xl mb-3 opacity-50 filter grayscale">✨</div>
                            <p class="text-sm font-medium text-txt-200">All clear</p>
                            <p class="text-xs text-txt-200 mt-1">Animals are healthy.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $attentionLivestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $statusConfig = [
                                        'Sick' => ['bg-status-danger/10 text-status-danger border-agri-danger/20', 'bg-status-danger'],
                                        'Under Treatment' => ['bg-status-warning/10 text-status-warning border-agri-warning/20', 'bg-status-warning'],
                                        'Hospitalized' => ['bg-txt-200/10 text-txt-200 border-agri-muted/20', 'bg-txt-200'],
                                        'Injured' => ['bg-status-warning/10 text-status-warning border-agri-warning/20', 'bg-status-warning'],
                                    ][$animal->health_status] ?? ['hover:bg-primary-100/20 text-txt-200 border-bg-300', 'bg-txt-200'];
                                    
                                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                ?>
                                <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="group flex items-center justify-between rounded-2xl border border-bg-300 bg-bg-300 p-4 transition-all hover:shadow-cinematic hover:hover:bg-primary-100/20 hover:-translate-y-0.5">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-bg-100 flex items-center justify-center text-lg border border-bg-300 group-hover:scale-110 transition-transform">
                                            <?php echo e($typeIcon); ?>

                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-txt-100"><?php echo e($animal->tag_number); ?></p>
                                            <p class="text-xs font-medium text-txt-200 mt-0.5"><?php echo e($animal->type); ?></p>
                                        </div>
                                    </div>
                                    <span class="inline-flex items-center gap-1.5 rounded-full border px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider <?php echo e($statusConfig[0]); ?>">
                                        <span class="w-1.5 h-1.5 rounded-full <?php echo e($statusConfig[1]); ?> animate-pulse"></span>
                                        <?php echo e($animal->health_status); ?>

                                    </span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>

                
                <div class="rounded-3xl border border-bg-300 bg-bg-300/60 backdrop-blur-xl p-6 sm:p-8 shadow-cinematic transition-all hover:bg-bg-300/80">
                    <div class="mb-6 flex items-center justify-between">
                        <h3 class="text-lg font-bold text-txt-100 flex items-center gap-2">
                            <span class="text-status-success">🆕</span> New Records
                        </h3>
                        <a href="<?php echo e(route('livestock.index')); ?>" class="text-xs font-semibold uppercase tracking-wider text-primary-300 hover:text-primary-200 transition-colors">View All</a>
                    </div>
                    <?php if($latestLivestock->isEmpty()): ?>
                        <div class="rounded-2xl hover:bg-primary-100/20 px-6 py-10 text-center border border-bg-300">
                            <p class="text-sm font-medium text-txt-200">Registry empty</p>
                            <p class="text-xs text-txt-200 mt-1">No livestock added recently.</p>
                        </div>
                    <?php else: ?>
                        <div class="space-y-3">
                            <?php $__currentLoopData = $latestLivestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                ?>
                                <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="group flex items-center justify-between rounded-2xl border border-bg-300 bg-bg-300 p-4 transition-all hover:shadow-cinematic hover:-translate-y-0.5 hover:border-primary-300/30">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-full bg-primary-300/10 flex items-center justify-center text-lg border border-primary-300/10 group-hover:bg-primary-300/20 transition-colors">
                                            <?php echo e($typeIcon); ?>

                                        </div>
                                        <div>
                                            <p class="text-sm font-bold text-txt-100"><?php echo e($animal->tag_number); ?></p>
                                            <p class="text-xs font-medium text-txt-200 mt-0.5">
                                                <?php echo e($animal->type); ?> 
                                                <?php if($animal->breed): ?>
                                                    <span class="text-bg-300 mx-1">|</span> <span class="text-txt-200"><?php echo e($animal->breed); ?></span>
                                                <?php endif; ?>
                                            </p>
                                        </div>
                                    </div>
                                    <span class="text-[10px] font-semibold uppercase tracking-wider text-txt-200"><?php echo e($animal->created_at->diffForHumans(null, true, true)); ?> ago</span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            
            <div class="lg:col-span-7">
                <div class="rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic h-full">
                    <div class="mb-8 flex items-center justify-between border-b border-bg-300 pb-4">
                        <h3 class="text-xl font-bold text-txt-100 flex items-center gap-2">
                            <span class="text-txt-200">⏱️</span> Health Timeline
                        </h3>
                    </div>
                    
                    <?php if($recentHistory->isEmpty()): ?>
                        <div class="rounded-2xl hover:bg-primary-100/20 px-6 py-16 text-center border border-bg-300 mt-4">
                            <div class="text-3xl mb-4 opacity-40 grayscale">📝</div>
                            <p class="text-base font-semibold text-txt-100">Clean Slate</p>
                            <p class="text-sm text-txt-200 mt-2 max-w-sm mx-auto">No recent health records or events have been logged for your animals.</p>
                        </div>
                    <?php else: ?>
                        <div class="relative pl-4 sm:pl-6 space-y-8 mt-4 before:absolute before:inset-y-0 before:left-[21px] sm:before:left-[29px] before:w-px before:bg-gradient-to-b before:from-agri-border before:via-bg-300 before:to-transparent">
                            <?php $__currentLoopData = $recentHistory; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $history): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    // Map to semantic variables
                                    $eventColor = [
                                        'Vaccination' => ['text-primary-300', 'bg-primary-300/10', 'border-primary-300/20', '💉'],
                                        'Treatment' => ['text-accent-200', 'bg-accent-200/10', 'border-accent-200/20', '💊'],
                                        'Checkup' => ['text-status-success', 'bg-status-success/10', 'border-agri-success/20', '🩺'],
                                        'Illness' => ['text-status-danger', 'bg-status-danger/10', 'border-agri-danger/20', '🤒'],
                                        'Deworming' => ['text-primary-300', 'bg-primary-300/10', 'border-primary-300/20', '🧪'],
                                        'Surgery' => ['text-status-warning', 'bg-status-warning/10', 'border-agri-warning/20', '🔬'],
                                    ][$history->event_type] ?? ['text-txt-200', 'hover:bg-primary-100/20', 'border-bg-300', '📝'];
                                ?>
                                <div class="relative group">
                                    
                                    <div class="absolute -left-6 sm:-left-8 top-1 flex h-8 w-8 items-center justify-center rounded-full <?php echo e($eventColor[1]); ?> border <?php echo e($eventColor[2]); ?> <?php echo e($eventColor[0]); ?> text-sm shadow-sm ring-4 ring-agri-surface transition-transform group-hover:scale-110">
                                        <?php echo e($eventColor[3]); ?>

                                    </div>
                                    
                                    
                                    <div class="pl-6">
                                        <div class="flex flex-col sm:flex-row sm:items-baseline sm:justify-between mb-1">
                                            <p class="text-base font-bold text-txt-100">
                                                <?php echo e($history->event_type); ?>

                                            </p>
                                            <p class="text-xs font-semibold uppercase tracking-widest text-txt-200 mt-1 sm:mt-0">
                                                <?php echo e(\Illuminate\Support\Carbon::parse($history->event_date)->format('M d, Y')); ?>

                                            </p>
                                        </div>
                                        <p class="text-sm font-medium text-txt-200 mb-3">
                                            Administered to <a href="<?php echo e(route('livestock.show', $history->livestock->id)); ?>" class="text-primary-300 hover:text-primary-200 font-bold transition-colors"><?php echo e($history->livestock->tag_number); ?></a>
                                        </p>
                                        
                                        <?php if($history->description): ?>
                                            <div class="rounded-2xl border border-bg-300 hover:bg-primary-100/20 p-4 text-sm leading-relaxed text-txt-200 mb-4 transition-colors group-hover:bg-bg-300">
                                                <?php echo e($history->description); ?>

                                            </div>
                                        <?php endif; ?>
                                        
                                        <div class="flex items-center gap-3 opacity-0 transform translate-y-1 transition-all group-hover:opacity-100 group-hover:translate-y-0">
                                            <a href="<?php echo e(route('livestock.histories.edit', $history->id)); ?>" class="inline-flex items-center rounded-lg border border-bg-300 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-txt-200 hover:hover:bg-primary-100/20 hover:text-txt-100 transition-colors">
                                                Edit Log
                                            </a>
                                            <form method="POST" action="<?php echo e(route('livestock.histories.destroy', $history->id)); ?>" class="inline" onsubmit="return false;">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="button" onclick="openDeleteHistoryModal(this.closest('form'), '<?php echo e($history->event_type); ?>')" class="inline-flex items-center rounded-lg border border-agri-danger/20 bg-status-danger/10 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-status-danger hover:bg-status-danger/20 transition-colors">
                                                    Delete
                                                </button>
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

    
    <div class="relative z-10 pt-8 border-t border-bg-300">
        <div class="mb-6 flex items-center justify-between">
            <h3 class="text-xl font-bold text-txt-100 flex items-center gap-2">
                <span class="text-primary-300">✦</span> Recommended Schemes
            </h3>
            <a href="<?php echo e(route('schemes.index')); ?>" class="inline-flex items-center gap-1 text-sm font-semibold text-txt-200 hover:text-txt-100 transition-colors group">
                Browse Directory 
                <span class="transform transition-transform group-hover:translate-x-1">→</span>
            </a>
        </div>
        
        <?php if($featuredSchemes->isEmpty()): ?>
            <div class="rounded-3xl bg-bg-300/60 backdrop-blur-md px-6 py-12 text-center border border-bg-300 shadow-cinematic">
                <p class="text-sm font-medium text-txt-200">No active schemes found.</p>
            </div>
        <?php else: ?>
            <div class="grid gap-6 md:grid-cols-3">
                <?php $__currentLoopData = $featuredSchemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('schemes.show', $scheme)); ?>" class="group block rounded-3xl border border-bg-300 bg-bg-300 p-6 shadow-cinematic transition-all duration-300 hover:-translate-y-1 hover:shadow-cinematic-hover hover:border-primary-300/30">
                        <div class="mb-4 flex flex-wrap items-center gap-2">
                            <span class="inline-flex rounded-full bg-primary-200 px-2.5 py-1 text-[10px] font-bold uppercase tracking-widest text-bg-100"><?php echo e($scheme->scheme_type); ?></span>
                            <span class="text-xs font-medium text-txt-200"><?php echo e($scheme->category); ?></span>
                        </div>
                        <h4 class="text-lg font-bold text-txt-100 group-hover:text-primary-300 transition-colors line-clamp-2 leading-tight mb-3">
                            <?php echo e($scheme->title); ?>

                        </h4>
                        <p class="text-sm font-light leading-relaxed text-txt-200 line-clamp-3">
                            <?php echo e($scheme->description); ?>

                        </p>
                        <div class="mt-6 flex items-center text-xs font-bold uppercase tracking-widest text-primary-300 group-hover:text-primary-100 transition-colors">
                            Read Details <span class="ml-1 transform transition-transform group-hover:translate-x-1">→</span>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>

    
    <div id="delete-history-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-bg-100/80 backdrop-blur-md transition-opacity">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic">
            <div class="text-center">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-status-danger/10 text-3xl mb-6 ring-4 ring-agri-danger/10">⚠️</div>
                <h3 class="text-2xl font-bold text-txt-100">Delete Record</h3>
                <p class="mt-3 text-sm font-light text-txt-200 leading-relaxed">Are you sure you want to permanently remove the <strong id="delete-history-type" class="font-bold text-txt-100"></strong> record? This action cannot be reversed.</p>
            </div>
            <div class="mt-8 flex gap-3">
                <button
                    type="button"
                    onclick="closeDeleteHistoryModal()"
                    class="flex-1 rounded-full border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm font-bold text-txt-100 transition-colors hover:bg-bg-300"
                >
                    Cancel
                </button>
                <button
                    type="button"
                    id="confirm-history-delete-btn"
                    class="flex-1 rounded-full bg-status-danger px-4 py-3 text-sm font-bold text-white transition-colors hover:opacity-90 shadow-cinematic hover:shadow-cinematic-hover"
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
            
            // Trigger animation
            const content = modal.querySelector('div.max-w-md');
            content.style.opacity = '0';
            content.style.transform = 'scale(0.95) translateY(10px)';
            requestAnimationFrame(() => {
                content.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
                content.style.opacity = '1';
                content.style.transform = 'scale(1) translateY(0)';
            });
        }

        function closeDeleteHistoryModal() {
            const modal = document.getElementById('delete-history-modal');
            const content = modal.querySelector('div.max-w-md');
            
            content.style.opacity = '0';
            content.style.transform = 'scale(0.95) translateY(10px)';
            
            setTimeout(() => {
                activeHistoryDeleteForm = null;
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 200);
        }

        document.getElementById('confirm-history-delete-btn')?.addEventListener('click', function () {
            if (activeHistoryDeleteForm) activeHistoryDeleteForm.submit();
        });

        document.getElementById('delete-history-modal')?.addEventListener('click', function (e) {
            if (e.target === this) closeDeleteHistoryModal();
        });

        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && !document.getElementById('delete-history-modal').classList.contains('hidden')) {
                closeDeleteHistoryModal();
            }
        });
    </script>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeLeft {
            from { opacity: 0; transform: translateX(20px); }
            to { opacity: 1; transform: translateX(0); }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/dashboard/owner.blade.php ENDPATH**/ ?>