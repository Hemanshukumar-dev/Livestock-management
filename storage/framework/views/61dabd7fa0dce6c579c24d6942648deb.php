<?php $__env->startSection('title', 'Add New Scheme'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 max-w-3xl">
        <p class="text-xs font-semibold uppercase tracking-[0.2em] text-sky-600">Government Support</p>
        <h2 class="mt-1 text-2xl font-bold tracking-tight text-slate-900">Add a new scheme</h2>
        <p class="mt-1 text-sm leading-6 text-slate-600">Fill out the details below to add a new government scheme for farmers.</p>
    </div>

    <form method="POST" action="<?php echo e(route('schemes.store')); ?>" class="max-w-3xl rounded-2xl border border-slate-200 bg-white p-6 shadow-sm sm:p-8">
        <?php echo csrf_field(); ?>
        <div class="grid gap-6 sm:grid-cols-2">
            
            <div class="sm:col-span-2">
                <label for="title" class="mb-1.5 block text-sm font-semibold text-slate-700">Scheme Title *</label>
                <input id="title" name="title" type="text" value="<?php echo e(old('title')); ?>" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="category" class="mb-1.5 block text-sm font-semibold text-slate-700">Category *</label>
                <select id="category" name="category" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">Select Category</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($cat); ?>" <?php if(old('category') === $cat): echo 'selected'; endif; ?>><?php echo e($cat); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="animal_type" class="mb-1.5 block text-sm font-semibold text-slate-700">Target Animal Type</label>
                <select id="animal_type" name="animal_type" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">All Animals (Generic)</option>
                    <?php $__currentLoopData = $animalTypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($type); ?>" <?php if(old('animal_type') === $type): echo 'selected'; endif; ?>><?php echo e($type); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['animal_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="scheme_type" class="mb-1.5 block text-sm font-semibold text-slate-700">Government Level *</label>
                <select id="scheme_type" name="scheme_type" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="State" <?php if(old('scheme_type') === 'State'): echo 'selected'; endif; ?>>State Level</option>
                    <option value="Central" <?php if(old('scheme_type') === 'Central'): echo 'selected'; endif; ?>>Central Level</option>
                </select>
                <?php $__errorArgs = ['scheme_type'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div id="state_name_container">
                <label for="state_name" class="mb-1.5 block text-sm font-semibold text-slate-700">State Name *</label>
                <select id="state_name" name="state_name" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                    <option value="">Select State</option>
                    <?php $__currentLoopData = $states; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $state): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($state); ?>" <?php if(old('state_name') === $state): echo 'selected'; endif; ?>><?php echo e($state); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['state_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div>
                <label for="deadline" class="mb-1.5 block text-sm font-semibold text-slate-700">Application Deadline</label>
                <input id="deadline" name="deadline" type="date" value="<?php echo e(old('deadline')); ?>" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                <?php $__errorArgs = ['deadline'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="sm:col-span-2">
                <label for="apply_link" class="mb-1.5 block text-sm font-semibold text-slate-700">Official Application Link</label>
                <input id="apply_link" name="apply_link" type="url" placeholder="https://" value="<?php echo e(old('apply_link')); ?>" class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100">
                <?php $__errorArgs = ['apply_link'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="sm:col-span-2">
                <label for="description" class="mb-1.5 block text-sm font-semibold text-slate-700">Brief Description *</label>
                <textarea id="description" name="description" rows="3" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100"><?php echo e(old('description')); ?></textarea>
                <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="sm:col-span-2">
                <label for="benefits" class="mb-1.5 block text-sm font-semibold text-slate-700">Key Benefits *</label>
                <textarea id="benefits" name="benefits" rows="2" placeholder="e.g. 50% subsidy on feed" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100"><?php echo e(old('benefits')); ?></textarea>
                <?php $__errorArgs = ['benefits'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="sm:col-span-2">
                <label for="eligibility" class="mb-1.5 block text-sm font-semibold text-slate-700">Eligibility Criteria *</label>
                <textarea id="eligibility" name="eligibility" rows="2" placeholder="e.g. Must have at least 5 cows" required class="w-full rounded-xl border border-slate-300 px-3 py-2 text-sm outline-none transition focus:border-sky-500 focus:ring-2 focus:ring-sky-100"><?php echo e(old('eligibility')); ?></textarea>
                <?php $__errorArgs = ['eligibility'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <p class="mt-1 text-xs text-red-600"><?php echo e($message); ?></p> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="mt-8 flex flex-col gap-3 sm:flex-row sm:justify-end">
            <a href="<?php echo e(route('schemes.index')); ?>" class="inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Cancel</a>
            <button type="submit" class="inline-flex items-center justify-center rounded-xl bg-sky-600 px-6 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-500">
                Save Scheme
            </button>
        </div>
    </form>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const schemeTypeSelect = document.getElementById('scheme_type');
            const stateNameContainer = document.getElementById('state_name_container');
            
            function toggleState() {
                if (schemeTypeSelect.value === 'State') {
                    stateNameContainer.style.display = 'block';
                } else {
                    stateNameContainer.style.display = 'none';
                }
            }
            
            schemeTypeSelect.addEventListener('change', toggleState);
            toggleState();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/schemes/create.blade.php ENDPATH**/ ?>