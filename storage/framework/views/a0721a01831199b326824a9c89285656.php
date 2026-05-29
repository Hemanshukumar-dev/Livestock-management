<?php $__env->startSection('title', 'Livestock Records'); ?>

<?php $__env->startSection('content'); ?>
    <?php $currentUser = auth()->user(); ?>

    
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[40rem] h-[40rem] bg-stone-200/30 dark:bg-emerald-900/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] opacity-70"></div>
        <div class="absolute top-[40%] left-[-10%] w-[50rem] h-[50rem] bg-emerald-50/50 dark:bg-bg-300/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-60"></div>
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMSIvPjwvc3ZnPg==')] opacity-50 dark:opacity-20 mix-blend-overlay"></div>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-8 rounded-2xl border border-emerald-200/80 dark:border-emerald-500/20 bg-emerald-50 dark:bg-emerald-500/10 px-5 py-4 text-sm font-semibold text-emerald-800 dark:text-emerald-400 shadow-sm relative z-10 animate-[fadeUp_0.4s_ease-out_forwards]">
            <span class="mr-2">✅</span> <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between relative z-10 animate-[fadeUp_0.6s_ease-out_forwards]">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-bg-200 dark:bg-bg-100 border border-bg-300 dark:border-white/10 text-txt-200 dark:text-stone-400 text-xs font-bold uppercase tracking-widest mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-sky-400 dark:bg-sky-500"></span>
                Registry
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-txt-100 dark:text-white leading-[1.1]">
                <?php echo e($currentUser?->isAdmin() ? 'All Livestock Records' : 'My Livestock'); ?>

            </h2>
            <p class="mt-3 max-w-2xl text-base leading-relaxed text-txt-200 dark:text-stone-400 font-light">
                Browse, search, and manage registered animals. Click any animal to view full profile and health history.
            </p>
        </div>
        <div class="flex items-center gap-4 shrink-0">
            <span class="inline-flex items-center gap-1.5 rounded-full bg-bg-200 dark:bg-bg-100 border border-bg-300 dark:border-white/10 px-4 py-2 text-xs font-bold text-txt-200 dark:text-stone-400">
                <span class="text-txt-100 dark:text-white"><?php echo e($livestock->total()); ?></span> Total
            </span>
            <a href="<?php echo e(route('livestock.create')); ?>" class="inline-flex items-center justify-center rounded-full bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition-all hover:from-emerald-500 hover:to-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.3)] border border-emerald-500/50 focus:outline-none focus:ring-2 focus:ring-emerald-500/50">
                <span class="mr-2">➕</span> Add Livestock
            </a>
        </div>
    </div>

    
    <form method="GET" action="<?php echo e(route('livestock.index')); ?>" class="mb-10 relative z-10 animate-[fadeUp_0.7s_ease-out_forwards]">
        <div class="rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/80 backdrop-blur-xl shadow-[0_8px_30px_rgba(0,0,0,0.02)] dark:shadow-none p-6">
            <div class="mb-5 flex items-center justify-between">
                <h3 class="text-xs font-bold uppercase tracking-widest text-txt-100 dark:text-white flex items-center gap-2">
                    <span class="text-stone-400">🔍</span> Filter Records
                </h3>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-5 items-end">
                
                <div class="xl:col-span-1">
                    <label for="filter-tag" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Tag Number</label>
                    <input type="text" id="filter-tag" name="tag_number" value="<?php echo e(request('tag_number')); ?>" placeholder="e.g. TAG-001" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-2.5 text-sm font-mono text-txt-100 dark:text-white placeholder-stone-400 dark:placeholder-stone-500 transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20" />
                </div>

                
                <div class="xl:col-span-1">
                    <label for="filter-type" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Livestock Type</label>
                    <select id="filter-type" name="type" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Types</option>
                        <?php $__currentLoopData = $livestockTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type); ?>" <?php echo e(request('type') === $type ? 'selected' : ''); ?> class="bg-bg-100 dark:bg-[#1a211e]"><?php echo e($type); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div class="xl:col-span-1">
                    <label for="filter-health" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Health Status</label>
                    <select id="filter-health" name="health_status" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Statuses</option>
                        <?php $__currentLoopData = $healthStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($status); ?>" <?php echo e(request('health_status') === $status ? 'selected' : ''); ?> class="bg-bg-100 dark:bg-[#1a211e]"><?php echo e($status); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <?php if($currentUser?->isAdmin()): ?>
                    
                    <div class="xl:col-span-1">
                        <label for="filter-code" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Owner Code</label>
                        <input type="text" id="filter-code" name="owner_code" value="<?php echo e(request('owner_code')); ?>" placeholder="e.g. OWN001" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-2.5 text-sm font-mono text-txt-100 dark:text-white placeholder-stone-400 dark:placeholder-stone-500 transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20" />
                    </div>
                <?php else: ?>
                    <div class="xl:col-span-1 hidden xl:block"></div> 
                <?php endif; ?>

                
                <div class="xl:col-span-1 flex gap-3 h-[42px]"> 
                    <a href="<?php echo e(route('livestock.index')); ?>" class="flex-1 inline-flex items-center justify-center rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100">
                        Clear
                    </a>
                    <button type="submit" class="flex-[1.5] inline-flex items-center justify-center rounded-xl bg-bg-100 dark:bg-bg-100 px-4 text-sm font-bold text-white dark:text-txt-100 transition-colors hover:bg-bg-300 dark:hover:bg-bg-200 shadow-sm">
                        Apply
                    </button>
                </div>
                
                
                <div class="hidden">
                    <select id="filter-breed" name="breed">
                        <option value="">All Breeds</option>
                        <?php $__currentLoopData = $breeds; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $breed): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($breed); ?>" <?php echo e(request('breed') === $breed ? 'selected' : ''); ?>><?php echo e($breed); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
            </div>
        </div>
    </form>

    
    <div class="relative z-10 animate-[fadeUp_0.8s_ease-out_forwards]">
        <?php if($livestock->isEmpty()): ?>
            <div class="rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/50 backdrop-blur-sm px-6 py-20 text-center shadow-sm">
                <div class="mx-auto w-24 h-24 mb-6 opacity-40 dark:opacity-20 flex items-center justify-center rounded-full bg-stone-200 dark:bg-bg-100">
                    <span class="text-4xl filter grayscale">🐑</span>
                </div>
                
                <?php if(request()->hasAny(['tag_number', 'owner_name', 'owner_code', 'type', 'breed', 'health_status'])): ?>
                    <h3 class="text-xl font-bold text-txt-100 dark:text-white">No matches found</h3>
                    <p class="mt-2 text-sm text-txt-200 dark:text-stone-400 max-w-sm mx-auto">We couldn't find any animals matching your current filter criteria.</p>
                    <a href="<?php echo e(route('livestock.index')); ?>" class="mt-8 inline-flex items-center justify-center rounded-full border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-6 py-2 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100">
                        Clear All Filters
                    </a>
                <?php else: ?>
                    <h3 class="text-xl font-bold text-txt-100 dark:text-white">Your registry is empty</h3>
                    <p class="mt-2 text-sm text-txt-200 dark:text-stone-400 max-w-md mx-auto">You haven't registered any animals yet. Add your first livestock to start tracking their health and details.</p>
                    <a href="<?php echo e(route('livestock.create')); ?>" class="mt-8 inline-flex items-center justify-center rounded-full bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-2 text-sm font-bold text-white transition-all hover:from-emerald-500 hover:to-emerald-600 border border-emerald-500/50">
                        Add First Animal
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            
            <div class="hidden lg:block overflow-hidden rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/85 backdrop-blur-xl shadow-sm h-[650px]">
                <div class="overflow-x-auto h-full relative scrollbar-hide">
                    <table class="w-full text-left text-sm relative border-collapse">
                        <thead class="sticky top-0 z-20">
                            <tr class="border-b border-bg-300/80 dark:border-white/5 bg-bg-200/95 dark:bg-[#151c19]/95 backdrop-blur-md">
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400">Tag Identity</th>
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400">Type & Breed</th>
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400">Age</th>
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400">Health Status</th>
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400">Owner Identity</th>
                                <th class="px-6 py-4 text-[10px] font-bold uppercase tracking-widest text-txt-200 dark:text-stone-400 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 dark:divide-white/5">
                            <?php $__currentLoopData = $livestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                                    $statusConfig = [
                                        'Healthy' => ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'text' => 'text-emerald-700 dark:text-emerald-400', 'dot' => 'bg-emerald-500'],
                                        'Sick' => ['bg' => 'bg-red-50 dark:bg-red-500/10', 'text' => 'text-red-700 dark:text-red-400', 'dot' => 'bg-red-500'],
                                        'Under Treatment' => ['bg' => 'bg-yellow-50 dark:bg-yellow-500/10', 'text' => 'text-yellow-700 dark:text-yellow-400', 'dot' => 'bg-yellow-500'],
                                        'Hospitalized' => ['bg' => 'bg-bg-200 dark:bg-bg-2000/10', 'text' => 'text-stone-700 dark:text-stone-400', 'dot' => 'bg-bg-2000'],
                                        'Injured' => ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'text' => 'text-amber-700 dark:text-amber-400', 'dot' => 'bg-amber-500'],
                                    ][$animal->health_status] ?? ['bg' => 'bg-bg-200 dark:bg-bg-100', 'text' => 'text-txt-200 dark:text-stone-400', 'dot' => 'bg-stone-400'];
                                ?>
                                <tr class="group cursor-pointer transition-colors hover:bg-bg-200/80 dark:hover:bg-bg-100/[0.02]" onclick="window.location='<?php echo e(route('livestock.show', $animal->id)); ?>'">
                                    
                                    
                                    <td class="px-6 py-4">
                                        <div class="font-mono text-sm font-bold text-txt-100 dark:text-white"><?php echo e($animal->tag_number); ?></div>
                                    </td>
                                    
                                    
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="text-base opacity-80 filter grayscale group-hover:grayscale-0 transition-all"><?php echo e($typeIcon); ?></span>
                                            <div>
                                                <div class="text-sm font-semibold text-txt-100 dark:text-stone-200"><?php echo e($animal->type); ?></div>
                                                <div class="text-xs text-txt-200 dark:text-txt-200"><?php echo e($animal->breed ?? 'Mixed Breed'); ?></div>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    
                                    <td class="px-6 py-4 text-sm text-txt-200 dark:text-stone-400">
                                        <?php echo e($animal->age !== null ? $animal->age . ' yrs' : '—'); ?>

                                    </td>
                                    
                                    
                                    <td class="px-6 py-4">
                                        <span class="inline-flex items-center gap-1.5 rounded-full <?php echo e($statusConfig['bg']); ?> px-2.5 py-1 text-[10px] font-bold uppercase tracking-wider <?php echo e($statusConfig['text']); ?>">
                                            <span class="h-1.5 w-1.5 rounded-full <?php echo e($statusConfig['dot']); ?>"></span>
                                            <?php echo e($animal->health_status); ?>

                                        </span>
                                    </td>
                                    
                                    
                                    <td class="px-6 py-4">
                                        <?php if($animal->owner): ?>
                                            <div class="flex items-center gap-2">
                                                <span class="inline-flex rounded-md bg-bg-200 dark:bg-bg-100 border border-bg-300 dark:border-white/10 px-2 py-0.5 text-[10px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400">
                                                    <?php echo e($animal->owner->owner_code); ?>

                                                </span>
                                                <span class="text-sm font-medium text-stone-700 dark:text-stone-300 truncate max-w-[120px]">
                                                    <?php echo e($animal->owner->name); ?>

                                                </span>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-sm text-stone-400">Unassigned</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    
                                    <td class="px-6 py-4 text-right" onclick="event.stopPropagation()">
                                        <div class="flex items-center justify-end gap-1 opacity-0 transition-opacity group-hover:opacity-100">
                                            <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="p-2 text-stone-400 hover:text-txt-100 dark:hover:text-white transition-colors" title="View Details">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                            <?php $canEdit = $currentUser?->isAdmin() || ($currentUser?->isOwner() && $animal->owner?->user_id === $currentUser->id); ?>
                                            <?php if($canEdit): ?>
                                                <a href="<?php echo e(route('livestock.edit', $animal->id)); ?>" class="p-2 text-stone-400 hover:text-emerald-600 transition-colors" title="Edit">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                                </a>
                                            <?php endif; ?>
                                            <?php if($currentUser?->isAdmin()): ?>
                                                <form method="POST" action="<?php echo e(route('livestock.destroy', $animal->id)); ?>" class="inline" onsubmit="return false;">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button type="button" onclick="openDeleteModal(this.closest('form'))" class="p-2 text-stone-400 hover:text-red-500 transition-colors" title="Delete">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>
            </div>

            
            <div class="lg:hidden space-y-4">
                <?php $__currentLoopData = $livestock; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $typeIcon = (function($t) { $m = ['cow'=>'🐄', 'cattle'=>'🐄', 'goat'=>'🐐', 'sheep'=>'🐑', 'pig'=>'🐖', 'horse'=>'🐴', 'chicken'=>'🐔', 'poultry'=>'🐔', 'duck'=>'🦆']; return $m[$t] ?? '🐾'; })(strtolower($animal->type));
                        $statusConfig = [
                            'Healthy' => ['bg' => 'bg-emerald-50 dark:bg-emerald-500/10', 'text' => 'text-emerald-700 dark:text-emerald-400', 'dot' => 'bg-emerald-500'],
                            'Sick' => ['bg' => 'bg-red-50 dark:bg-red-500/10', 'text' => 'text-red-700 dark:text-red-400', 'dot' => 'bg-red-500'],
                            'Under Treatment' => ['bg' => 'bg-yellow-50 dark:bg-yellow-500/10', 'text' => 'text-yellow-700 dark:text-yellow-400', 'dot' => 'bg-yellow-500'],
                            'Hospitalized' => ['bg' => 'bg-bg-200 dark:bg-bg-2000/10', 'text' => 'text-stone-700 dark:text-stone-400', 'dot' => 'bg-bg-2000'],
                            'Injured' => ['bg' => 'bg-amber-50 dark:bg-amber-500/10', 'text' => 'text-amber-700 dark:text-amber-400', 'dot' => 'bg-amber-500'],
                        ][$animal->health_status] ?? ['bg' => 'bg-bg-200 dark:bg-bg-100', 'text' => 'text-txt-200 dark:text-stone-400', 'dot' => 'bg-stone-400'];
                    ?>
                    <a href="<?php echo e(route('livestock.show', $animal->id)); ?>" class="block rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/85 p-5 shadow-sm transition-all hover:shadow-md hover:border-bg-300 dark:hover:border-white/10">
                        <div class="flex items-start justify-between gap-3 mb-4">
                            <div class="font-mono text-base font-bold text-txt-100 dark:text-white"><?php echo e($animal->tag_number); ?></div>
                            <span class="inline-flex items-center gap-1.5 rounded-full <?php echo e($statusConfig['bg']); ?> px-2 py-0.5 text-[9px] font-bold uppercase tracking-wider <?php echo e($statusConfig['text']); ?>">
                                <span class="h-1.5 w-1.5 rounded-full <?php echo e($statusConfig['dot']); ?>"></span>
                                <?php echo e($animal->health_status); ?>

                            </span>
                        </div>
                        
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-xl opacity-80 filter grayscale"><?php echo e($typeIcon); ?></span>
                            <div>
                                <div class="text-sm font-semibold text-txt-100 dark:text-stone-200"><?php echo e($animal->type); ?></div>
                                <div class="text-xs text-txt-200 dark:text-txt-200"><?php echo e($animal->breed ?? 'Mixed Breed'); ?></div>
                            </div>
                        </div>

                        <div class="grid grid-cols-2 gap-4 border-t border-stone-100 dark:border-white/5 pt-4">
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-stone-400">Age</div>
                                <div class="text-sm font-medium text-stone-700 dark:text-stone-300 mt-0.5"><?php echo e($animal->age !== null ? $animal->age . ' yrs' : '—'); ?></div>
                            </div>
                            <div>
                                <div class="text-[10px] font-bold uppercase tracking-widest text-stone-400">Owner</div>
                                <div class="text-sm font-medium text-stone-700 dark:text-stone-300 mt-0.5 truncate"><?php echo e($animal->owner?->owner_code ?? '—'); ?></div>
                            </div>
                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="mt-8">
                <?php echo e($livestock->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    
    <div id="delete-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-bg-100/60 dark:bg-black/60 backdrop-blur-md transition-opacity">
        <div class="mx-4 w-full max-w-sm rounded-3xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 p-8 shadow-[0_20px_50px_rgba(0,0,0,0.2)] dark:shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
            <div class="text-center mb-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-50 dark:bg-red-500/10 text-3xl mb-6 ring-4 ring-red-50 dark:ring-red-500/10">⚠️</div>
                <h3 class="text-xl font-bold text-txt-100 dark:text-white">Delete Record</h3>
                <p class="mt-3 text-sm font-light text-txt-200 dark:text-stone-400 leading-relaxed">
                    Are you sure you want to delete this animal record? This action cannot be undone.
                </p>
            </div>
            <div class="flex gap-3 pt-2">
                <button type="button" onclick="closeDeleteModal()" class="flex-1 rounded-full border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-4 py-3 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100">Cancel</button>
                <button type="button" id="confirm-delete-btn" class="flex-1 rounded-full bg-red-600 px-4 py-3 text-sm font-bold text-white transition-colors hover:bg-red-500 shadow-[0_0_15px_rgba(220,38,38,0.3)]">Yes, Delete</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Modal Logic
            let activeDeleteForm = null;
            window.openDeleteModal = function(form) {
                activeDeleteForm = form;
                const modal = document.getElementById('delete-modal');
                modal.classList.remove('hidden');
                modal.classList.add('flex');
            };
            window.closeDeleteModal = function() {
                activeDeleteForm = null;
                const modal = document.getElementById('delete-modal');
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            };
            document.getElementById('confirm-delete-btn').addEventListener('click', function () {
                if (activeDeleteForm) activeDeleteForm.submit();
            });
            document.getElementById('delete-modal').addEventListener('click', function (e) {
                if (e.target === this) window.closeDeleteModal();
            });
            document.addEventListener('keydown', function (e) {
                if (e.key === 'Escape') window.closeDeleteModal();
            });

            // Dynamic Breed Filtering
            const typeSelect = document.getElementById('filter-type');
            const breedSelect = document.getElementById('filter-breed');
            const currentBreed = '<?php echo e(request('breed')); ?>';

            const breedMap = {
                'Cow': ['Gir','Sahiwal','Red Sindhi','Tharparkar','Holstein Friesian','Jersey'],
                'Buffalo': ['Murrah','Nili-Ravi','Jaffarabadi','Surti','Mehsana'],
                'Goat': ['Jamunapari','Boer','Beetal','Barbari','Sirohi'],
                'Sheep': ['Merino','Suffolk','Dorper','Rambouillet','Deccani'],
                'Poultry': ['Broiler','Layer','Desi Chicken','Kadaknath','Rhode Island Red']
            };

            function updateBreeds() {
                const selectedType = typeSelect.value;
                breedSelect.innerHTML = '<option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Breeds</option>';

                if (selectedType && breedMap[selectedType]) {
                    breedMap[selectedType].forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        option.className = "bg-bg-100 dark:bg-[#1a211e]";
                        if (currentBreed === breed) {
                            option.selected = true;
                        }
                        breedSelect.appendChild(option);
                    });
                } else if (!selectedType) {
                    Object.values(breedMap).flat().forEach(breed => {
                        const option = document.createElement('option');
                        option.value = breed;
                        option.textContent = breed;
                        option.className = "bg-bg-100 dark:bg-[#1a211e]";
                        if (currentBreed === breed) {
                            option.selected = true;
                        }
                        breedSelect.appendChild(option);
                    });
                }
            }

            if (typeSelect && breedSelect) {
                typeSelect.addEventListener('change', updateBreeds);
                updateBreeds();
            }
        });
    </script>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        /* Hide scrollbar for table container */
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/livestock/index.blade.php ENDPATH**/ ?>