<?php $__env->startSection('title', 'Profile Settings'); ?>

<?php $__env->startSection('content'); ?>
    <?php
        $user = auth()->user();
        $owner = $user->isOwner() ? $user->owner : null;
        $states = ['Haryana', 'Punjab', 'Rajasthan', 'Uttar Pradesh', 'Delhi', 'Maharashtra', 'Gujarat', 'Karnataka', 'Tamil Nadu', 'Bihar', 'Madhya Pradesh', 'West Bengal', 'Telangana', 'Andhra Pradesh', 'Kerala', 'Odisha', 'Assam', 'Uttarakhand', 'Himachal Pradesh', 'Chhattisgarh', 'Jharkhand'];
    ?>

    
    <div class="mb-8">
        <p class="text-sm font-semibold uppercase tracking-[0.25em] text-green-700">⚙️ Settings</p>
        <h2 class="mt-2 text-3xl font-semibold tracking-tight text-slate-900">Profile Settings</h2>
        <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-600">
            Update your account information, contact details, and password.
        </p>
    </div>

    
    <?php if(session('status') === 'profile-updated'): ?>
        <div class="mb-8 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
            <span class="mr-2">✅</span>Profile updated successfully.
        </div>
    <?php endif; ?>

    <div class="space-y-8 max-w-2xl">

        
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-green-700 mb-2">
                <span>👤</span> Account Information
            </h3>
            <p class="text-sm text-slate-500 mb-6">Update your name and email address.</p>

            <form method="POST" action="<?php echo e(route('profile.update')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('patch'); ?>

                
                <div>
                    <label for="name" class="block text-sm font-medium text-slate-700">Full Name</label>
                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="<?php echo e(old('name', $user->name)); ?>"
                        required
                        autocomplete="name"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                    <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <div>
                    <label for="email" class="block text-sm font-medium text-slate-700">Email Address</label>
                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="<?php echo e(old('email', $user->email)); ?>"
                        required
                        autocomplete="username"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                    <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                
                <?php if($owner): ?>
                    <div class="border-t border-slate-200 pt-5">
                        <p class="text-xs font-semibold uppercase tracking-[0.15em] text-slate-400 mb-4">Owner Contact Details</p>

                        <div class="space-y-4">
                            <div>
                                <label for="phone" class="block text-sm font-medium text-slate-700">📞 Phone Number</label>
                                <input
                                    id="phone"
                                    type="tel"
                                    name="phone"
                                    value="<?php echo e(old('phone', $owner->phone)); ?>"
                                    maxlength="20"
                                    placeholder="e.g. +91 98765 43210"
                                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                                />
                                <?php $__errorArgs = ['phone'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="address" class="block text-sm font-medium text-slate-700">📍 Address</label>
                                <textarea
                                    id="address"
                                    name="address"
                                    rows="3"
                                    maxlength="500"
                                    placeholder="Your farm or home address"
                                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20 resize-none"
                                ><?php echo e(old('address', $owner->address)); ?></textarea>
                                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div>
                                <label for="state" class="block text-sm font-medium text-slate-700">🌍 State</label>
                                <select
                                    id="state"
                                    name="state"
                                    class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                                >
                                    <option value="">Select your state...</option>
                                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $st): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($st); ?>" <?php if(old('state', $owner->state) === $st): echo 'selected'; endif; ?>><?php echo e($st); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </select>
                                <?php $__errorArgs = ['state'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                
                <?php if($owner): ?>
                    <div class="rounded-2xl border border-slate-200 bg-slate-50/50 p-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm font-medium text-slate-500">Owner Code</span>
                            <span class="rounded-full bg-sky-50 border border-sky-200 px-3 py-1 text-xs font-semibold text-sky-700"><?php echo e($owner->owner_code); ?></span>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="flex items-center justify-between pt-2">
                    <span class="text-sm text-slate-500">Role: <strong class="text-slate-700 capitalize"><?php echo e($user->role); ?></strong></span>
                    <button
                        type="submit"
                        class="rounded-xl bg-green-700 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
                    >
                        Save Changes
                    </button>
                </div>
            </form>
        </div>

        
        <div class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
            <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-green-700 mb-2">
                <span>🔒</span> Update Password
            </h3>
            <p class="text-sm text-slate-500 mb-6">Use a strong, unique password to keep your account secure.</p>

            <?php if(session('status') === 'password-updated'): ?>
                <div class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-5 py-4 text-sm font-medium text-emerald-800 shadow-sm">
                    <span class="mr-2">✅</span>Password updated successfully.
                </div>
            <?php endif; ?>

            <form method="POST" action="<?php echo e(route('password.update')); ?>" class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php echo method_field('put'); ?>

                <div>
                    <label for="current_password" class="block text-sm font-medium text-slate-700">Current Password</label>
                    <input
                        id="current_password"
                        type="password"
                        name="current_password"
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                    <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-slate-700">New Password</label>
                    <input
                        id="password"
                        type="password"
                        name="password"
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                    <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirm New Password</label>
                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-green-500 focus:outline-none focus:ring-2 focus:ring-green-500/20"
                    />
                    <?php $__errorArgs = ['password_confirmation', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="flex justify-end pt-2">
                    <button
                        type="submit"
                        class="rounded-xl bg-green-700 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500/50"
                    >
                        Update Password
                    </button>
                </div>
            </form>
        </div>

        
        <div class="rounded-3xl border border-red-200 bg-white p-8 shadow-sm">
            <h3 class="flex items-center gap-2 text-sm font-semibold uppercase tracking-[0.2em] text-red-600 mb-2">
                <span>⚠️</span> Delete Account
            </h3>
            <p class="text-sm text-slate-500 mb-6">
                Once your account is deleted, all of its resources and data will be permanently deleted. This action cannot be undone.
            </p>

            <button
                type="button"
                onclick="document.getElementById('delete-account-modal').classList.remove('hidden'); document.getElementById('delete-account-modal').classList.add('flex');"
                class="rounded-xl border border-red-300 bg-red-50 px-6 py-3 text-sm font-semibold text-red-700 transition hover:bg-red-100"
            >
                Delete Account
            </button>
        </div>
    </div>

    
    <div id="delete-account-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="mx-4 w-full max-w-md rounded-3xl border border-slate-200 bg-white p-8 shadow-2xl">
            <div class="text-center mb-6">
                <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-full bg-red-100 text-3xl">⚠️</div>
                <h3 class="mt-4 text-xl font-semibold text-slate-900">Delete Your Account?</h3>
                <p class="mt-2 text-sm text-slate-600">
                    All your data will be permanently removed. Please enter your password to confirm.
                </p>
            </div>

            <form method="POST" action="<?php echo e(route('profile.destroy')); ?>" class="space-y-4">
                <?php echo csrf_field(); ?>
                <?php echo method_field('delete'); ?>

                <div>
                    <label for="delete-password" class="block text-sm font-medium text-slate-700">Password</label>
                    <input
                        id="delete-password"
                        type="password"
                        name="password"
                        required
                        placeholder="Enter your password"
                        class="mt-1.5 block w-full rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm text-slate-900 placeholder-slate-400 transition focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20"
                    />
                    <?php if($errors->userDeletion->has('password')): ?>
                        <p class="mt-1 text-xs text-red-600"><?php echo e($errors->userDeletion->first('password')); ?></p>
                    <?php endif; ?>
                </div>

                <div class="flex gap-3 pt-2">
                    <button
                        type="button"
                        onclick="document.getElementById('delete-account-modal').classList.add('hidden'); document.getElementById('delete-account-modal').classList.remove('flex');"
                        class="flex-1 rounded-xl border border-slate-300 bg-white px-4 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50"
                    >
                        Cancel
                    </button>
                    <button
                        type="submit"
                        class="flex-1 rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white transition hover:bg-red-500"
                    >
                        Delete Account
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/profile/edit.blade.php ENDPATH**/ ?>