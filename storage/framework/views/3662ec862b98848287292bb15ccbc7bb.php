<?php $__env->startSection('title', 'Government Schemes'); ?>

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

    <?php if($isOwner && !$ownerState): ?>
        <div class="mb-8 flex items-center justify-between rounded-2xl border border-amber-200/80 dark:border-amber-500/20 bg-amber-50 dark:bg-amber-500/10 px-6 py-4 shadow-sm relative z-10 animate-[fadeUp_0.5s_ease-out_forwards]">
            <div class="text-sm font-medium text-amber-800 dark:text-amber-400 flex items-center gap-2">
                <span>⚠️</span> Complete your profile to receive state-specific government schemes.
            </div>
            <a href="<?php echo e(route('profile.edit')); ?>" class="text-xs font-bold uppercase tracking-wider text-amber-700 dark:text-amber-300 hover:text-amber-900 dark:hover:text-amber-200 underline underline-offset-4">Edit Profile</a>
        </div>
    <?php endif; ?>

    
    <div class="mb-10 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between relative z-10 animate-[fadeUp_0.6s_ease-out_forwards]">
        <div>
            <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-bg-200 dark:bg-bg-100 border border-bg-300 dark:border-white/10 text-txt-200 dark:text-stone-400 text-xs font-bold uppercase tracking-widest mb-4">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 dark:bg-indigo-500"></span>
                Resources
            </div>
            <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-txt-100 dark:text-white leading-[1.1]">
                Government Schemes
            </h2>
            <p class="mt-3 max-w-2xl text-base leading-relaxed text-txt-200 dark:text-stone-400 font-light">
                Browse and apply for state and central government programs designed to support livestock farmers with financial, medical, and structural aid.
            </p>
        </div>

        <?php if($currentUser?->isAdmin()): ?>
            <a href="<?php echo e(route('schemes.create')); ?>" class="inline-flex shrink-0 items-center justify-center rounded-full bg-gradient-to-r from-emerald-600 to-emerald-700 px-6 py-2.5 text-sm font-bold text-white shadow-sm transition-all hover:from-emerald-500 hover:to-emerald-600 hover:shadow-[0_0_20px_rgba(16,185,129,0.3)] border border-emerald-500/50">
                <span class="mr-2">➕</span> Add New Scheme
            </a>
        <?php endif; ?>
    </div>

    
    <form method="GET" action="<?php echo e(route('schemes.index')); ?>" class="mb-10 relative z-10 animate-[fadeUp_0.7s_ease-out_forwards]">
        <div class="rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/80 backdrop-blur-xl shadow-[0_8px_30px_rgba(0,0,0,0.02)] dark:shadow-none p-6">
            <div class="grid gap-5 md:grid-cols-5 items-end">
                
                <div class="md:col-span-2">
                    <label for="search" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Search Keywords</label>
                    <div class="relative">
                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-4 text-stone-400">🔍</div>
                        <input type="text" id="search" name="search" value="<?php echo e(request('search')); ?>" placeholder="Search scheme titles or descriptions..." class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 pl-10 pr-4 py-2.5 text-sm text-txt-100 dark:text-white placeholder-stone-400 dark:placeholder-stone-500 transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20" />
                    </div>
                </div>

                
                <div>
                    <label for="category" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Category</label>
                    <select id="category" name="category" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Categories</option>
                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat); ?>" <?php if(request('category') === $cat): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]"><?php echo e($cat); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="animal_type" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Animal Type</label>
                    <select id="animal_type" name="animal_type" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Animals</option>
                        <?php $__currentLoopData = $animalTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $animalType): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($animalType); ?>" <?php if(request('animal_type') === $animalType): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]"><?php echo e($animalType); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                
                <div>
                    <label for="scheme_type" class="block text-[11px] font-bold uppercase tracking-wider text-txt-200 dark:text-stone-400 mb-1.5">Govt Level</label>
                    <select id="scheme_type" name="scheme_type" class="block w-full rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-[#1a211e] px-4 py-2.5 text-sm text-txt-100 dark:text-white transition-all focus:border-emerald-500 focus:outline-none focus:ring-2 focus:ring-emerald-500/20">
                        <?php if($isOwner): ?>
                            <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Relevant</option>
                            <option value="Central" <?php if(request('scheme_type') === 'Central'): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]">Central</option>
                            <option value="My State Schemes" <?php if(request('scheme_type') === 'My State Schemes'): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]">My State</option>
                        <?php else: ?>
                            <option value="" class="bg-bg-100 dark:bg-[#1a211e]">All Levels</option>
                            <option value="State" <?php if(request('scheme_type') === 'State'): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]">State</option>
                            <option value="Central" <?php if(request('scheme_type') === 'Central'): echo 'selected'; endif; ?> class="bg-bg-100 dark:bg-[#1a211e]">Central</option>
                        <?php endif; ?>
                    </select>
                </div>

                
                <div class="md:col-span-5 flex justify-end gap-3 pt-4 border-t border-stone-100 dark:border-white/5 mt-2">
                    <a href="<?php echo e(route('schemes.index')); ?>" class="inline-flex items-center justify-center rounded-xl border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-6 py-2.5 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100">
                        Clear
                    </a>
                    <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-bg-100 dark:bg-bg-100 px-8 py-2.5 text-sm font-bold text-white dark:text-txt-100 transition-colors hover:bg-bg-300 dark:hover:bg-bg-200 shadow-sm">
                        Apply Filters
                    </button>
                </div>
            </div>
        </div>
    </form>

    
    <div class="relative z-10 animate-[fadeUp_0.8s_ease-out_forwards]">
        <?php if($schemes->isEmpty()): ?>
            <div class="rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/50 backdrop-blur-sm px-6 py-20 text-center shadow-sm">
                <div class="mx-auto w-24 h-24 mb-6 opacity-40 dark:opacity-20 flex items-center justify-center rounded-full bg-stone-200 dark:bg-bg-100">
                    <span class="text-4xl filter grayscale">🏛️</span>
                </div>
                <h3 class="text-xl font-bold text-txt-100 dark:text-white">No schemes available</h3>
                <p class="mt-2 text-sm text-txt-200 dark:text-stone-400 max-w-sm mx-auto">There are currently no active government programs matching your criteria.</p>
                <?php if(request()->hasAny(['search', 'category', 'animal_type', 'scheme_type'])): ?>
                    <a href="<?php echo e(route('schemes.index')); ?>" class="mt-8 inline-flex items-center justify-center rounded-full border border-bg-300 dark:border-white/10 bg-bg-100 dark:bg-bg-100 px-6 py-2 text-sm font-bold text-stone-700 dark:text-stone-300 transition-colors hover:bg-bg-200 dark:hover:bg-bg-100">
                        Clear All Filters
                    </a>
                <?php endif; ?>
            </div>
        <?php else: ?>
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <?php $__currentLoopData = $schemes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $scheme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="group flex flex-col rounded-3xl border border-bg-300/80 dark:border-white/5 bg-bg-100 dark:bg-bg-100/85 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:shadow-xl hover:border-emerald-200 dark:hover:border-emerald-500/30 overflow-hidden relative">
                        
                        
                        <div class="absolute inset-0 bg-gradient-to-br from-emerald-50/0 to-emerald-50/0 dark:from-emerald-900/0 dark:to-emerald-900/0 opacity-0 group-hover:opacity-100 group-hover:from-emerald-50/50 group-hover:to-transparent dark:group-hover:from-emerald-900/10 transition-opacity duration-300 pointer-events-none"></div>

                        <div class="p-6 sm:p-8 flex-1 flex flex-col relative z-10">
                            
                            <div class="flex items-start justify-between gap-3 mb-6">
                                <span class="inline-flex items-center gap-1.5 rounded-full border border-indigo-200/50 dark:border-indigo-500/20 bg-indigo-50 dark:bg-indigo-500/10 px-2.5 py-1 text-[9px] font-bold uppercase tracking-widest text-indigo-700 dark:text-indigo-300">
                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>
                                    <?php echo e($scheme->scheme_type === 'State' ? 'State: ' . $scheme->state_name : 'Central Govt'); ?>

                                </span>
                                <?php if($scheme->deadline): ?>
                                    <?php
                                        $daysLeft = now()->diffInDays($scheme->deadline, false);
                                        $deadlineConfig = $daysLeft < 7 
                                            ? ['bg' => 'bg-red-50 dark:bg-red-500/10', 'border' => 'border-red-200/50 dark:border-red-500/20', 'text' => 'text-red-700 dark:text-red-400']
                                            : ['bg' => 'bg-bg-200 dark:bg-bg-100', 'border' => 'border-bg-300/50 dark:border-white/10', 'text' => 'text-txt-200 dark:text-stone-400'];
                                    ?>
                                    <span class="inline-flex rounded-full border <?php echo e($deadlineConfig['border']); ?> <?php echo e($deadlineConfig['bg']); ?> px-2.5 py-1 text-[9px] font-bold uppercase tracking-widest <?php echo e($deadlineConfig['text']); ?>">
                                        <?php echo e($daysLeft < 0 ? 'Expired' : 'Ends ' . $scheme->deadline->format('M d')); ?>

                                    </span>
                                <?php endif; ?>
                            </div>

                            
                            <h3 class="text-xl font-bold text-txt-100 dark:text-white leading-tight tracking-tight mb-2">
                                <?php echo e($scheme->title); ?>

                            </h3>
                            <div class="text-xs font-bold uppercase tracking-widest text-emerald-600 dark:text-emerald-400 mb-5">
                                <?php echo e($scheme->category); ?>

                            </div>

                            
                            <p class="text-sm leading-relaxed text-txt-200 dark:text-stone-400 line-clamp-3 mb-6 font-light">
                                <?php echo e($scheme->description); ?>

                            </p>
                            
                            
                            <div class="mt-auto space-y-3 pt-4 border-t border-stone-100 dark:border-white/5">
                                <?php if($scheme->animal_type): ?>
                                    <div class="flex items-start gap-3">
                                        <span class="text-stone-400 mt-0.5">🐾</span>
                                        <div>
                                            <div class="text-[10px] font-bold uppercase tracking-widest text-stone-400">Eligible Livestock</div>
                                            <div class="text-sm font-medium text-txt-100 dark:text-stone-200"><?php echo e($scheme->animal_type); ?></div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <div class="flex items-start gap-3">
                                    <span class="text-stone-400 mt-0.5">✨</span>
                                    <div>
                                        <div class="text-[10px] font-bold uppercase tracking-widest text-stone-400">Key Benefits</div>
                                        <div class="text-sm font-medium text-txt-100 dark:text-stone-200 line-clamp-2"><?php echo e($scheme->benefits); ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                        <a href="<?php echo e(route('schemes.show', $scheme)); ?>" class="block border-t border-stone-100 dark:border-white/5 bg-bg-200/50 dark:bg-bg-100/[0.02] p-6 transition-colors group-hover:bg-emerald-50 dark:group-hover:bg-emerald-900/20 relative z-10">
                            <div class="flex items-center justify-between text-sm font-bold text-emerald-700 dark:text-emerald-400">
                                <span>Read Full Details</span>
                                <span class="transform transition-transform duration-300 group-hover:translate-x-1">→</span>
                            </div>
                        </a>

                        
                        <?php if($currentUser?->isAdmin()): ?>
                            <div class="absolute top-6 right-6 flex items-center gap-2 opacity-0 group-hover:opacity-100 transition-opacity z-20">
                                <a href="<?php echo e(route('schemes.edit', $scheme)); ?>" class="p-2 rounded-full bg-bg-100 dark:bg-bg-300 text-txt-200 hover:text-amber-600 shadow-sm border border-bg-300 dark:border-white/10 transition-colors" title="Edit">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path></svg>
                                </a>
                                <form method="POST" action="<?php echo e(route('schemes.destroy', $scheme)); ?>" onsubmit="return confirm('Delete this scheme?');" class="inline">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="p-2 rounded-full bg-bg-100 dark:bg-bg-300 text-txt-200 hover:text-red-500 shadow-sm border border-bg-300 dark:border-white/10 transition-colors" title="Delete">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <div class="mt-10">
                <?php echo e($schemes->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/schemes/index.blade.php ENDPATH**/ ?>