<?php $__env->startSection('title', 'Profile Settings'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $user = auth()->user();
        $owner = $user->isOwner() ? $user->owner : null;
        $states = ['Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'];
    ?>

    
    <div class="fixed inset-0 pointer-events-none z-[-1] overflow-hidden">
        <div class="absolute top-[-10%] right-[-5%] w-[40rem] h-[40rem] bg-primary-300/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] opacity-70"></div>
        <div class="absolute top-[40%] left-[-10%] w-[50rem] h-[50rem] bg-accent-200/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[120px] opacity-60"></div>
        
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI0IiBoZWlnaHQ9IjQiPjxyZWN0IHdpZHRoPSI0IiBoZWlnaHQ9IjQiIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wMSIvPjwvc3ZnPg==')] opacity-50 dark:opacity-20 mix-blend-overlay"></div>
    </div>

    
    <div class="mb-10 relative z-10 animate-[fadeUp_0.8s_ease-out_forwards]">
        <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-primary-300/10 border border-primary-300/20 text-primary-300 text-xs font-bold uppercase tracking-widest mb-4">
            <span class="w-1.5 h-1.5 rounded-full bg-primary-300"></span>
            Settings
        </div>
        <h2 class="text-3xl sm:text-4xl font-bold tracking-tight text-txt-100 leading-[1.1]">
            Profile Settings
        </h2>
        <p class="mt-3 max-w-2xl text-base leading-relaxed text-txt-200 font-light">
            Manage your personal profile, owner identity, and security preferences.
        </p>
    </div>

    
    <?php if(session('status') === 'profile-updated'): ?>
        <div class="mb-8 rounded-2xl border border-agri-success/30 bg-status-success/10 px-5 py-4 text-sm font-semibold text-status-success shadow-sm relative z-10 animate-[fadeUp_0.4s_ease-out_forwards]">
            <span class="mr-2">✅</span> Profile successfully updated.
        </div>
    <?php endif; ?>

    <div class="grid lg:grid-cols-12 gap-8 relative z-10">
        
        <div class="lg:col-span-7 space-y-8 animate-[fadeUp_0.6s_ease-out_forwards]">
            
            
            <div class="rounded-3xl border border-bg-300 bg-bg-300 p-6 sm:p-8 shadow-cinematic">
                <div class="mb-8">
                    <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-primary-300 mb-1">
                        <span>👤</span> Account Details
                    </h3>
                    <p class="text-sm text-txt-200">Update your name, email address, and owner identity.</p>
                </div>

                <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-6">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('patch'); ?>

                    <div class="grid sm:grid-cols-2 gap-5">
                        
                        <div class="sm:col-span-2">
                            <label for="name" class="block text-sm font-semibold text-txt-100 mb-1.5">Full Name</label>
                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="<?php echo e(old('name', $user->name)); ?>"
                                required
                                autocomplete="name"
                                class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                            />
                            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        
                        <div class="sm:col-span-2">
                            <label for="email" class="block text-sm font-semibold text-txt-100 mb-1.5">Email Address</label>
                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="<?php echo e(old('email', $user->email)); ?>"
                                required
                                autocomplete="username"
                                class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                            />
                            <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                    </div>

                    
                    <?php if($owner): ?>
                        <div class="pt-6 mt-6 border-t border-bg-300">
                            <div class="mb-5 flex items-center justify-between">
                                <div>
                                    <h4 class="text-xs font-bold uppercase tracking-widest text-txt-100">Contact & Location</h4>
                                    <p class="text-xs text-txt-200 mt-0.5">Where your farm is registered.</p>
                                </div>
                                <div class="rounded-full hover:bg-primary-100/20 border border-bg-300 px-3 py-1 flex items-center gap-2">
                                    <span class="text-[10px] font-bold uppercase tracking-wider text-txt-200">Owner Code</span>
                                    <span class="text-xs font-bold text-txt-100"><?php echo e($owner->owner_code); ?></span>
                                </div>
                            </div>

                            <div class="grid sm:grid-cols-2 gap-5">
                                <div class="sm:col-span-1">
                                    <label for="phone" class="block text-sm font-semibold text-txt-100 mb-1.5">Phone Number</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-txt-200">📞</div>
                                        <input
                                            id="phone"
                                            type="tel"
                                            name="phone"
                                            value="<?php echo e(old('phone', $owner->phone)); ?>"
                                            maxlength="20"
                                            placeholder="+91 98765 43210"
                                            class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 pl-9 pr-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                                        />
                                    </div>
                                    <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="sm:col-span-1">
                                    <label for="state" class="block text-sm font-semibold text-txt-100 mb-1.5">State</label>
                                    <div class="relative">
                                        <div class="pointer-events-none absolute inset-y-0 left-0 flex items-center pl-3 text-txt-200">🌍</div>
                                        <select
                                            id="state"
                                            name="state"
                                            class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 pl-9 pr-4 py-2.5 text-sm text-txt-100 transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20 appearance-none"
                                        >
                                            <option value="" class="hover:bg-primary-100/20">Select state...</option>
                                            <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option value="<?php echo e($st); ?>" <?php if(old('state', $owner->state) === $st): echo 'selected'; endif; ?> class="hover:bg-primary-100/20"><?php echo e($st); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-3 text-txt-200">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                    <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>

                                <div class="sm:col-span-2">
                                    <label for="address" class="block text-sm font-semibold text-txt-100 mb-1.5">Address</label>
                                    <textarea
                                        id="address"
                                        name="address"
                                        rows="2"
                                        maxlength="500"
                                        placeholder="Farm or home address"
                                        class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20 resize-none"
                                    ><?php echo e(old('address', $owner->address)); ?></textarea>
                                    <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                        <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="pt-6 mt-6 border-t border-bg-300 flex items-center justify-between">
                        <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-md hover:bg-primary-100/20 text-[10px] font-bold uppercase tracking-wider text-txt-200">
                            Role: <span class="text-txt-100"><?php echo e($user->role); ?></span>
                        </span>
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-full bg-primary-200 px-6 py-2.5 text-sm font-bold text-white shadow-cinematic transition-all hover:bg-primary-100 hover:shadow-cinematic-hover border border-primary-100 focus:outline-none focus:ring-2 focus:ring-agri-cta/50"
                        >
                            Save Profile
                        </button>
                    </div>
                </form>
            </div>
        </div>

        
        <div class="lg:col-span-5 space-y-8 lg:sticky lg:top-32 h-max animate-[fadeUp_0.8s_ease-out_forwards]">
            
            
            <div class="rounded-3xl border border-bg-300 bg-bg-300/80 backdrop-blur-xl p-6 sm:p-8 shadow-cinematic relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-32 h-32 bg-primary-300/5 rounded-full blur-3xl group-hover:bg-primary-300/10 transition-colors pointer-events-none"></div>
                
                <div class="relative z-10 mb-8">
                    <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-txt-100 mb-1">
                        <span class="text-primary-300">🔒</span> Security
                    </h3>
                    <p class="text-sm text-txt-200">Ensure your account uses a strong, unique password.</p>
                </div>

                <?php if(session('status') === 'password-updated'): ?>
                    <div class="mb-6 rounded-2xl border border-agri-success/30 bg-status-success/10 px-4 py-3 text-xs font-semibold text-status-success shadow-sm animate-[fadeUp_0.4s_ease-out_forwards]">
                        Password updated successfully.
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('password.update')); ?>" class="space-y-5 relative z-10">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('put'); ?>

                    <div>
                        <label for="current_password" class="block text-sm font-semibold text-txt-100 mb-1.5">Current Password</label>
                        <input
                            id="current_password"
                            type="password"
                            name="current_password"
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                        />
                        <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-txt-100 mb-1.5">New Password</label>
                        <input
                            id="password"
                            type="password"
                            name="password"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                        />
                        <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div>
                        <label for="password_confirmation" class="block text-sm font-semibold text-txt-100 mb-1.5">Confirm New Password</label>
                        <input
                            id="password_confirmation"
                            type="password"
                            name="password_confirmation"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-2.5 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-primary-300 focus:outline-none focus:ring-2 focus:ring-agri-teal/20"
                        />
                        <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1.5 text-xs font-medium text-status-danger"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="flex justify-end pt-4">
                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-full bg-primary-200 px-6 py-2.5 text-sm font-bold text-bg-100 shadow-sm transition-all hover:bg-bg-200 hover:shadow-cinematic focus:outline-none focus:ring-2 focus:ring-primary-200/50"
                        >
                            Update Security
                        </button>
                    </div>
                </form>
            </div>

            
            <div class="rounded-3xl border border-agri-danger/20 bg-status-danger/10 backdrop-blur-sm p-6 sm:p-8 relative overflow-hidden group transition-colors hover:bg-status-danger/20">
                <div class="absolute right-0 top-0 w-40 h-40 bg-status-danger/10 rounded-full blur-3xl pointer-events-none transition-all group-hover:bg-status-danger/20"></div>
                
                <div class="relative z-10">
                    <h3 class="flex items-center gap-2 text-xs font-bold uppercase tracking-widest text-status-danger mb-1">
                        <span>⚠️</span> Danger Zone
                    </h3>
                    <p class="text-sm font-medium text-txt-200 mb-6 max-w-[90%]">
                        Permanently delete your account. This action cannot be undone and all data will be lost.
                    </p>

                    <button
                        type="button"
                        onclick="document.getElementById('delete-account-modal').classList.remove('hidden'); document.getElementById('delete-account-modal').classList.add('flex');"
                        class="inline-flex items-center justify-center rounded-full border border-agri-danger/30 bg-bg-100/50 px-5 py-2.5 text-sm font-bold text-status-danger transition-all hover:bg-status-danger/10 hover:border-agri-danger/50 shadow-sm"
                    >
                        Delete Account
                    </button>
                </div>
            </div>
        </div>
    </div>

    
    <div id="delete-account-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-bg-100/80 backdrop-blur-md transition-opacity">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-bg-300 bg-bg-300 p-8 shadow-cinematic">
            <div class="text-center mb-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-status-danger/10 text-3xl mb-6 ring-4 ring-agri-danger/10">⚠️</div>
                <h3 class="text-2xl font-bold text-txt-100">Delete Account</h3>
                <p class="mt-3 text-sm font-light text-txt-200 leading-relaxed">
                    This action is permanent and irreversible. Please enter your password to confirm deletion.
                </p>
            </div>

            <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div>
                    <input
                        id="delete-password"
                        type="password"
                        name="password"
                        required
                        placeholder="Confirm Password"
                        class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm text-txt-100 placeholder-agri-muted transition-all focus:border-agri-danger focus:outline-none focus:ring-2 focus:ring-agri-danger/20"
                    />
                    <?php if($errors->userDeletion->has('password')): ?>
                        <p class="mt-2 text-xs font-medium text-status-danger"><?php echo e($errors->userDeletion->first('password')); ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        type="button"
                        onclick="document.getElementById('delete-account-modal').classList.add('hidden'); document.getElementById('delete-account-modal').classList.remove('flex');"
                        class="flex-1 rounded-full border border-bg-300 hover:bg-primary-100/20 px-4 py-3 text-sm font-bold text-txt-100 transition-colors hover:bg-bg-300"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="flex-1 rounded-full bg-status-danger px-4 py-3 text-sm font-bold text-white transition-colors hover:opacity-90 shadow-cinematic"
                    >
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </div>

    
    <?php if($errors->userDeletion->isNotEmpty()): ?>
        <script>
            document.getElementById('delete-account-modal').classList.remove('hidden');
            document.getElementById('delete-account-modal').classList.add('flex');
        </script>
    <?php endif; ?>

    <style>
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/profile/edit.blade.php ENDPATH**/ ?>