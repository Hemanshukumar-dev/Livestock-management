<?php if (isset($component)) { $__componentOriginalfb4bf44be545cdc2e345d8fa2f9195c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalfb4bf44be545cdc2e345d8fa2f9195c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-split-layout','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-split-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    
    <div class="w-full lg:w-1/2 flex flex-col justify-center px-8 py-10 sm:px-12 lg:px-16 xl:px-24 order-1" style="view-transition-name: auth-panel;">
        <div class="mb-10">
            <a href="/" class="inline-flex items-center gap-2 group mb-8">
                <span class="text-3xl transition duration-300 group-hover:scale-110">🐄</span>
                <span class="text-xl font-bold text-txt-100 tracking-tight">Livestock System</span>
            </a>
            <h2 class="text-3xl font-bold text-txt-100 tracking-tight">Welcome Back</h2>
            <p class="mt-2 text-sm text-txt-200">Sign in to manage your livestock records</p>
        </div>

        <!-- Session Status -->
        <?php if (isset($component)) { $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-session-status','data' => ['class' => 'mb-6','status' => session('status')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-session-status'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mb-6','status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(session('status'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $attributes = $__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__attributesOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5)): ?>
<?php $component = $__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5; ?>
<?php unset($__componentOriginal7c1bf3a9346f208f66ee83b06b607fb5); ?>
<?php endif; ?>

        
        <a href="<?php echo e(route('google.login')); ?>" class="flex w-full items-center justify-center gap-3 rounded-xl border border-bg-300 bg-bg-300 px-4 py-3.5 text-sm font-semibold text-txt-100 shadow-cinematic transition-all duration-300 hover:hover:bg-primary-100/20 hover:border-primary-300/50 hover:shadow-cinematic-hover hover:-translate-y-0.5">
            <svg class="h-5 w-5" viewBox="0 0 24 24">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92a5.06 5.06 0 0 1-2.2 3.32v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.1z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Continue with Google
        </a>

        
        <div class="relative my-8">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-bg-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="bg-bg-300 px-4 text-txt-200 font-medium transition-colors">or sign in with email</span>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('login')); ?>" class="space-y-5">
            <?php echo csrf_field(); ?>

            <!-- Email Address -->
            <div class="group">
                <label for="email" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Email Address</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="<?php echo e(old('email')); ?>"
                    required
                    autofocus
                    autocomplete="email"
                    placeholder="you@example.com"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3.5 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('email'),'class' => 'mt-2 text-status-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('email')),'class' => 'mt-2 text-status-danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
            </div>

            <!-- Password -->
            <div class="group">
                <label for="password" class="block text-sm font-medium text-txt-100 mb-1.5 transition-colors group-focus-within:text-primary-300">Password</label>
                <input
                    id="password"
                    type="password"
                    name="password"
                    required
                    autocomplete="current-password"
                    placeholder="••••••••"
                    class="block w-full rounded-xl border border-bg-300 hover:bg-primary-100/20 px-4 py-3.5 text-sm text-txt-100 placeholder-agri-muted transition-all duration-300 focus:border-primary-300 focus:bg-bg-300 focus:outline-none focus:ring-4 focus:ring-agri-teal/20 hover:bg-bg-300 hover:border-primary-300/50"
                />
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['messages' => $errors->get('password'),'class' => 'mt-2 text-status-danger']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('password')),'class' => 'mt-2 text-status-danger']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between pt-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group/checkbox">
                    <div class="relative flex items-center">
                        <input id="remember_me" type="checkbox" class="peer h-5 w-5 rounded-[6px] border-bg-300 bg-bg-300 text-primary-300 shadow-sm transition-all focus:ring-agri-teal focus:ring-offset-0" name="remember">
                    </div>
                    <span class="ms-2.5 text-sm text-txt-200 font-medium transition-colors group-hover/checkbox:text-txt-100">Remember me</span>
                </label>

                <?php if(Route::has('password.request')): ?>
                    <a class="text-sm font-medium text-primary-300 transition-colors hover:text-primary-100" href="<?php echo e(route('password.request')); ?>">
                        Forgot password?
                    </a>
                <?php endif; ?>
            </div>

            <!-- Submit -->
            <button
                type="submit"
                class="mt-2 w-full rounded-xl bg-primary-200 px-4 py-3.5 text-sm font-semibold text-white shadow-cinematic transition-all duration-300 hover:bg-primary-100 hover:shadow-cinematic-hover hover:-translate-y-0.5 focus:outline-none focus:ring-4 focus:ring-agri-cta/50 border border-primary-100"
            >
                Sign In
            </button>
        </form>

        
        <p class="mt-8 text-center text-sm text-txt-200">
            Don't have an account?
            <a href="<?php echo e(route('register')); ?>" class="font-semibold text-primary-300 transition-colors hover:text-primary-100 ml-1">
                Create one now
            </a>
        </p>
    </div>

    
    <div class="hidden lg:block lg:w-1/2 relative p-3 order-2" style="view-transition-name: image-panel;">
        <div class="absolute inset-3 rounded-[20px] overflow-hidden group">
            <div class="absolute inset-0 bg-bg-100/20 z-10 transition duration-700 group-hover:bg-transparent"></div>
            <div class="absolute inset-0 bg-gradient-to-t from-bg-100/90 via-bg-100/30 to-transparent z-10"></div>
            
            <img src="<?php echo e(asset('images/parrot.png')); ?>" alt="Parrot" class="w-full h-full object-cover transition-transform duration-[2000ms] group-hover:scale-105" />
            
            <div class="absolute bottom-12 left-10 z-20 pr-10">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-bg-300/10 backdrop-blur-md border border-agri-surface/20 mb-4 shadow-cinematic">
                    <span class="w-2 h-2 rounded-full bg-primary-300 animate-pulse"></span>
                    <span class="text-xs font-semibold text-white tracking-widest uppercase">Avian Records</span>
                </div>
                <h3 class="text-3xl font-bold text-white mb-3 tracking-tight">Track every detail.</h3>
                <p class="text-txt-200 max-w-sm text-base leading-relaxed">Experience a premium management platform. Log records seamlessly and keep your flock thriving.</p>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalfb4bf44be545cdc2e345d8fa2f9195c3)): ?>
<?php $attributes = $__attributesOriginalfb4bf44be545cdc2e345d8fa2f9195c3; ?>
<?php unset($__attributesOriginalfb4bf44be545cdc2e345d8fa2f9195c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalfb4bf44be545cdc2e345d8fa2f9195c3)): ?>
<?php $component = $__componentOriginalfb4bf44be545cdc2e345d8fa2f9195c3; ?>
<?php unset($__componentOriginalfb4bf44be545cdc2e345d8fa2f9195c3); ?>
<?php endif; ?>
<?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/auth/login.blade.php ENDPATH**/ ?>