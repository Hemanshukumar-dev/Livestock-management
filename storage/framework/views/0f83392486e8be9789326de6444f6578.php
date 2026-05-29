<?php $__env->startSection('title', 'Livestock Management — Simple Record Keeping for Farmers'); ?>
<?php $__env->startSection('content_class', ''); ?>

<?php $__env->startSection('content'); ?>


<div class="relative min-h-[calc(100vh-4.5rem)] bg-bg-100 overflow-hidden flex flex-col lg:flex-row items-center transition-colors duration-500">
    
    
    <div class="absolute top-1/4 left-0 w-[40rem] h-[40rem] bg-primary-300/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] dark:blur-[120px] animate-blob z-0 transition-all duration-700"></div>
    <div class="absolute bottom-0 left-1/4 w-[30rem] h-[30rem] bg-accent-200/20 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[90px] dark:blur-[100px] animate-blob animation-delay-2000 z-0 transition-all duration-700"></div>

    
    <div class="relative z-10 w-full lg:w-[55%] px-6 sm:px-12 lg:px-16 xl:px-24 pt-32 pb-16 lg:pt-40 lg:pb-20">
        <div class="max-w-xl xl:max-w-2xl opacity-0 animate-[fadeUp_1s_ease-out_forwards]">
            
            
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-primary-300/10 border border-primary-300/20 text-primary-300 text-xs font-semibold uppercase tracking-wider mb-8 transition-colors duration-300">
                <span class="w-2 h-2 rounded-full bg-primary-300 animate-pulse"></span>
                Livestock Registry
            </div>

            
            <h1 class="text-5xl sm:text-6xl lg:text-7xl font-bold text-txt-100 leading-[1.05] mb-6 tracking-tight transition-colors duration-300">
                Modern Livestock <br class="hidden sm:block" />
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-200 to-primary-300">Management</span> For <br class="hidden sm:block" />
                Smarter Record Keeping
            </h1>
            
            
            <p class="text-lg sm:text-xl text-txt-200 mb-10 leading-relaxed font-light max-w-lg transition-colors duration-300">
                Keep track of your animals, maintain health logs, and organize ownership details without the confusion of endless spreadsheets.
            </p>

            
            <div class="flex flex-col sm:flex-row gap-5 mb-16">
                <a href="<?php echo e(route('register')); ?>" id="hero-register-btn" class="group relative inline-flex items-center justify-center px-8 py-4 bg-primary-200 text-white font-medium rounded-full overflow-hidden transition-all duration-300 hover:-translate-y-1 shadow-cinematic hover:shadow-cinematic-hover border border-primary-100 text-lg tracking-wide">
                    <span class="absolute inset-0 w-full h-full bg-gradient-to-b from-white/10 to-transparent"></span>
                    <span class="relative">Create Account</span>
                </a>
                <a href="<?php echo e(route('login')); ?>" id="hero-login-btn" class="inline-flex items-center justify-center px-8 py-4 border border-bg-300 text-txt-100 font-medium rounded-full transition-all duration-300 hover:border-primary-200 hover:text-primary-200 hover:hover:bg-primary-100/20 hover:-translate-y-1 text-lg tracking-wide backdrop-blur-sm bg-bg-300/50">
                    Login
                </a>
            </div>

            
            <div class="border-t border-bg-300 pt-8 flex items-center gap-6 transition-colors duration-300">
                <div class="flex items-center gap-4">
                    <div class="flex -space-x-3">
                        <div class="w-10 h-10 rounded-full border-2 border-bg-100 bg-bg-200 flex items-center justify-center text-txt-100 text-sm font-bold transition-colors">JD</div>
                        <div class="w-10 h-10 rounded-full border-2 border-bg-100 bg-bg-300 flex items-center justify-center text-txt-100 text-sm font-bold transition-colors">AM</div>
                        <div class="w-10 h-10 rounded-full border-2 border-bg-100 hover:bg-primary-100/20 flex items-center justify-center text-txt-100 text-sm font-bold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-txt-100 font-medium transition-colors">Practical utility for real farms</p>
                        <p class="text-xs text-txt-200 transition-colors">Join our growing community</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="w-full lg:absolute lg:right-0 lg:top-0 lg:h-full lg:w-[52%] z-20 overflow-hidden">
        <div class="w-full h-[60vh] lg:h-full angled-clip relative group opacity-0 animate-[fadeLeft_1.5s_ease-out_0.2s_forwards]">
            
            
            <img src="<?php echo e(asset('images/cinematic_cows.png')); ?>" alt="Premium Livestock Management" class="w-full h-full object-cover object-center scale-110 group-hover:scale-105 transition-transform duration-[7s] ease-out">
            
            
            <div class="absolute inset-0 bg-bg-100/20 group-hover:bg-transparent transition-colors duration-700 pointer-events-none"></div>
            
            
            <div class="absolute inset-y-0 left-0 w-48 bg-gradient-to-r from-bg-100 via-bg-100/50 to-transparent opacity-90 hidden lg:block transition-colors duration-500 pointer-events-none"></div>
            <div class="absolute inset-x-0 top-0 h-32 bg-gradient-to-b from-bg-100 to-transparent opacity-90 lg:hidden transition-colors duration-500 pointer-events-none"></div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    @keyframes fadeLeft {
        from { opacity: 0; transform: translateX(60px); }
        to { opacity: 1; transform: translateX(0); }
    }
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob {
        animation: blob 15s infinite;
    }
    .animation-delay-2000 {
        animation-delay: 2s;
    }
    
    /* Asymmetrical clip path for desktop */
    @media (min-width: 1024px) {
        .angled-clip {
            clip-path: polygon(15% 0, 100% 0, 100% 100%, 0 100%);
        }
    }
    /* Subtle angle for mobile */
    @media (max-width: 1023px) {
        .angled-clip {
            clip-path: polygon(0 6vw, 100% 0, 100% 100%, 0 100%);
        }
    }
</style>


<div class="relative z-30 -mt-8 sm:-mt-12 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-24">
    <div class="bg-bg-300/80 backdrop-blur-xl border border-bg-300 rounded-3xl p-8 sm:p-12 shadow-cinematic transition-all duration-500">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4 text-center">
            <div class="flex flex-col items-center justify-center space-y-2">
                <span class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-primary-300 to-primary-200">10k+</span>
                <span class="text-txt-200 text-sm font-medium uppercase tracking-wider">Animals Tracked</span>
            </div>
            <div class="flex flex-col items-center justify-center space-y-2 relative">
                <div class="hidden md:block absolute left-0 w-px h-12 bg-gradient-to-b from-transparent via-bg-300 to-transparent transition-colors"></div>
                <span class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-agri-primary to-bg-200">2.5k</span>
                <span class="text-txt-200 text-sm font-medium uppercase tracking-wider">Active Records</span>
            </div>
            <div class="flex flex-col items-center justify-center space-y-2 relative">
                <div class="hidden md:block absolute left-0 w-px h-12 bg-gradient-to-b from-transparent via-bg-300 to-transparent transition-colors"></div>
                <span class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-primary-300 to-primary-200">99%</span>
                <span class="text-txt-200 text-sm font-medium uppercase tracking-wider">Log Accuracy</span>
            </div>
            <div class="flex flex-col items-center justify-center space-y-2 relative">
                <div class="hidden md:block absolute left-0 w-px h-12 bg-gradient-to-b from-transparent via-bg-300 to-transparent transition-colors"></div>
                <span class="text-4xl sm:text-5xl font-bold text-transparent bg-clip-text bg-gradient-to-br from-agri-primary to-bg-200">0</span>
                <span class="text-txt-200 text-sm font-medium uppercase tracking-wider">Lost Papers</span>
            </div>
        </div>
    </div>
</div>


<div class="relative w-full h-px">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-primary-300/30 to-transparent blur-sm transition-colors duration-500"></div>
</div>


<div class="relative py-24 sm:py-32 overflow-hidden bg-bg-200/30 transition-colors duration-500">
    
    <div class="absolute top-0 right-0 w-[40rem] h-[40rem] bg-accent-200/10 rounded-full mix-blend-multiply dark:mix-blend-screen filter blur-[100px] dark:blur-[120px] pointer-events-none transition-all duration-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row items-center gap-16 lg:gap-24">
            
            
            <div class="w-full lg:w-1/2 relative group">
                <div class="relative rounded-3xl overflow-hidden shadow-cinematic aspect-[16/9] lg:aspect-[4/3] border border-bg-300 transition-colors">
                    <img src="<?php echo e(asset('images/3.jpg')); ?>" alt="Livestock Registration" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-gradient-to-t from-bg-100/80 via-transparent to-transparent opacity-80 transition-colors"></div>
                </div>
                
                <div class="absolute -bottom-8 -right-8 w-48 h-48 bg-primary-300/20 rounded-full blur-[40px] pointer-events-none transition-colors"></div>
            </div>

            
            <div class="w-full lg:w-1/2 relative z-10">
                <h2 class="text-sm font-bold text-primary-300 uppercase tracking-widest mb-4 transition-colors">Livestock Registration</h2>
                <h3 class="text-4xl sm:text-5xl font-bold text-txt-100 mb-6 leading-[1.1] transition-colors">
                    Centralized Animal <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-bg-200 to-txt-200">Records</span>
                </h3>
                <p class="text-lg text-txt-200 leading-relaxed font-light mb-8 max-w-lg transition-colors">
                    Maintain a clean, organized digital registry for all your animals. Track age, breed, identifiers, and acquisition details in one secure place.
                </p>
                <ul class="space-y-4">
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-300/10 border border-primary-300/20 flex items-center justify-center mt-1 transition-colors">
                            <svg class="w-4 h-4 text-primary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <h4 class="text-txt-100 font-medium transition-colors">Comprehensive Profiles</h4>
                            <p class="text-sm text-txt-200 mt-1 transition-colors">Keep vital statistics easily accessible.</p>
                        </div>
                    </li>
                    <li class="flex items-start gap-4">
                        <span class="flex-shrink-0 w-8 h-8 rounded-full bg-primary-300/10 border border-primary-300/20 flex items-center justify-center mt-1 transition-colors">
                            <svg class="w-4 h-4 text-primary-300" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </span>
                        <div>
                            <h4 class="text-txt-100 font-medium transition-colors">Searchable Database</h4>
                            <p class="text-sm text-txt-200 mt-1 transition-colors">Find any record in seconds.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<div class="relative w-full h-px">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-bg-300 to-transparent blur-sm transition-colors duration-500"></div>
</div>


<div class="relative py-24 sm:py-32 bg-bg-100 overflow-hidden transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col lg:flex-row-reverse items-center gap-16 lg:gap-24">
            
            
            <div class="w-full lg:w-1/2 relative group">
                <div class="relative rounded-3xl overflow-hidden shadow-cinematic aspect-[16/9] lg:aspect-[4/3] border border-bg-300 transition-all">
                    <img src="<?php echo e(asset('images/5.jpg')); ?>" alt="Veterinary Health Monitoring" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700 ease-out">
                    <div class="absolute inset-0 bg-bg-100/10 transition-colors"></div>
                </div>
                
                
                <div class="absolute -bottom-10 -left-10 bg-bg-300/90 backdrop-blur-xl border border-bg-300 rounded-2xl p-6 shadow-cinematic hidden sm:block w-72 transition-colors z-20">
                    <div class="flex items-center gap-4 mb-4">
                        <div class="w-10 h-10 rounded-full bg-status-success/10 flex items-center justify-center text-status-success transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        </div>
                        <div>
                            <p class="text-xs text-txt-200 uppercase tracking-wider transition-colors">Health Log</p>
                            <p class="text-sm font-bold text-txt-100 transition-colors">Vaccination Recorded</p>
                        </div>
                    </div>
                    <div class="w-full hover:bg-primary-100/20 rounded-full h-1.5 transition-colors">
                        <div class="bg-status-success h-1.5 rounded-full w-full transition-colors"></div>
                    </div>
                </div>
            </div>

            
            <div class="w-full lg:w-1/2 relative z-10">
                <h2 class="text-sm font-bold text-txt-200 uppercase tracking-widest mb-4 transition-colors">Veterinary Logs</h2>
                <h3 class="text-4xl sm:text-5xl font-bold text-txt-100 mb-6 leading-[1.1] transition-colors">
                    Practical Health <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-300 to-bg-200">Management</span>
                </h3>
                <p class="text-lg text-txt-200 leading-relaxed font-light mb-8 max-w-lg transition-colors">
                    Ditch the unreadable notebooks. Keep clear medical records, log vaccinations, and securely document treatments for every animal in your care.
                </p>
                <a href="<?php echo e(route('register')); ?>" class="inline-flex items-center gap-2 text-primary-200 font-medium hover:text-primary-100 transition-colors group">
                    Explore Health Features
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"></path></svg>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="relative w-full h-px">
    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-primary-300/30 to-transparent blur-sm transition-colors duration-500"></div>
</div>


<div class="relative py-24 sm:py-32 overflow-hidden bg-bg-200/20 transition-colors duration-500">
    <div class="absolute bottom-0 left-0 w-full h-3/4 bg-gradient-to-t from-bg-100/80 to-transparent pointer-events-none transition-colors duration-500"></div>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="text-center max-w-3xl mx-auto mb-16">
            <h2 class="text-3xl sm:text-5xl font-bold text-txt-100 mb-6 leading-[1.1] transition-colors">
                Organize Your <br>
                <span class="text-transparent bg-clip-text bg-gradient-to-r from-bg-200 to-txt-200">Ownership Records</span>
            </h2>
            <p class="text-lg text-txt-200 leading-relaxed font-light transition-colors">
                Manage owner details, link animals to their respective owners, and maintain a clear chain of custody. Our dashboard makes daily administration straightforward.
            </p>
        </div>

        <div class="relative rounded-3xl overflow-hidden shadow-cinematic border border-bg-300 aspect-[21/9] group transition-all">
            <img src="<?php echo e(asset('images/2.jpg')); ?>" alt="Flock Management" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[10s] ease-out">
            <div class="absolute inset-0 bg-bg-100/30 backdrop-blur-[2px] transition-colors"></div>
            
            
            <div class="absolute inset-0 flex items-center justify-center p-6 sm:p-12">
                <div class="w-full max-w-4xl bg-bg-300/80 backdrop-blur-2xl rounded-2xl border border-bg-300 shadow-cinematic overflow-hidden transition-colors">
                    <div class="h-12 border-b border-bg-300 flex items-center px-6 gap-2 bg-bg-200/30 transition-colors">
                        <div class="w-3 h-3 rounded-full bg-txt-200 transition-colors"></div>
                        <div class="w-3 h-3 rounded-full bg-txt-200 transition-colors"></div>
                        <div class="w-3 h-3 rounded-full bg-txt-200 transition-colors"></div>
                    </div>
                    <div class="p-6 sm:p-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                        <div class="hover:bg-primary-100/20 rounded-xl p-5 border border-bg-300 transition-colors">
                            <div class="text-txt-200 text-xs uppercase tracking-wider mb-2 transition-colors">Total Animals</div>
                            <div class="text-2xl font-bold text-txt-100 mb-1 transition-colors">142 Registered</div>
                            <div class="text-sm text-status-success transition-colors">Fully Documented</div>
                        </div>
                        <div class="hover:bg-primary-100/20 rounded-xl p-5 border border-bg-300 transition-colors">
                            <div class="text-txt-200 text-xs uppercase tracking-wider mb-2 transition-colors">Owners</div>
                            <div class="text-2xl font-bold text-txt-100 mb-1 transition-colors">12 Active</div>
                            <div class="text-sm text-txt-200 transition-colors">Linked Profiles</div>
                        </div>
                        <div class="hover:bg-primary-100/20 rounded-xl p-5 border border-bg-300 transition-colors">
                            <div class="text-txt-200 text-xs uppercase tracking-wider mb-2 transition-colors">Recent Logs</div>
                            <div class="space-y-3 mt-3">
                                <div class="h-2 w-3/4 bg-bg-200 rounded-full transition-colors"></div>
                                <div class="h-2 w-1/2 bg-bg-200 rounded-full transition-colors"></div>
                                <div class="h-2 w-5/6 bg-bg-200 rounded-full transition-colors"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>



<div class="relative py-24 sm:py-32 bg-bg-100 overflow-hidden transition-colors duration-500">
    
    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[50rem] h-[50rem] bg-primary-300/10 rounded-full blur-[100px] pointer-events-none transition-colors duration-500"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-center">
            
            <div class="lg:col-span-5">
                <h2 class="text-3xl sm:text-4xl font-bold text-txt-100 mb-6 leading-[1.2] transition-colors">
                    Built for the Reality of <br>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-300 to-bg-200">Practical Agriculture</span>
                </h2>
                <p class="text-lg text-txt-200 leading-relaxed font-light mb-8 transition-colors">
                    We didn't build just another bloated software tool. We built a straightforward database tailored to the mud, sweat, and reality of keeping farm records organized.
                </p>
                <div class="flex items-center gap-4 p-4 rounded-2xl bg-bg-300/80 border border-bg-300 backdrop-blur-md transition-colors shadow-cinematic">
                    <img src="<?php echo e(asset('images/4.jpg')); ?>" alt="Capybara Friend" class="w-16 h-16 rounded-xl object-cover">
                    <div>
                        <p class="text-sm font-medium text-txt-100 transition-colors">Join a thriving community.</p>
                        <p class="text-xs text-txt-200 transition-colors">Even the capybaras approve.</p>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7 relative group">
                <div class="relative rounded-3xl overflow-hidden shadow-cinematic aspect-[4/5] sm:aspect-video lg:aspect-[4/3] border border-bg-300 transition-all">
                    <img src="<?php echo e(asset('images/1.jpg')); ?>" alt="Real Farmer Trust" class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-[8s] ease-out">
                    <div class="absolute inset-0 bg-gradient-to-tr from-bg-100/80 via-transparent to-transparent transition-colors"></div>
                    
                    <div class="absolute bottom-8 left-8 right-8">
                        <div class="backdrop-blur-md bg-bg-300/80 border border-bg-300 rounded-2xl p-6 transition-colors shadow-cinematic">
                            <p class="text-txt-100 italic text-lg leading-relaxed mb-4 transition-colors">"Moving away from paper logs was the best decision we made. It's simple, reliable, and keeps our ownership records perfectly clear."</p>
                            <p class="text-sm font-bold text-txt-200 uppercase tracking-wider transition-colors">— Thomas R., Cattle Rancher</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


<div class="relative py-24 sm:py-32 overflow-hidden bg-bg-100 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-16 text-center">
        <h2 class="text-3xl sm:text-5xl font-bold text-txt-100 mb-4 transition-colors">
            Trusted by the <span class="text-transparent bg-clip-text bg-gradient-to-r from-primary-300 to-bg-200">Best</span>
        </h2>
        <p class="text-lg text-txt-200 font-light transition-colors">See what practical farms are saying about our platform.</p>
    </div>

    
    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="absolute inset-y-0 left-0 w-32 bg-gradient-to-r from-bg-100 to-transparent z-20 pointer-events-none hidden lg:block transition-colors duration-500"></div>
        <div class="absolute inset-y-0 right-0 w-32 bg-gradient-to-l from-bg-100 to-transparent z-20 pointer-events-none hidden lg:block transition-colors duration-500"></div>

        <div class="flex flex-wrap justify-center gap-6 lg:gap-8 relative z-10 perspective-1000">
            
            
            <div class="w-full sm:w-[340px] bg-bg-300/80 backdrop-blur-md border border-bg-300 rounded-2xl p-8 shadow-cinematic transform lg:-rotate-2 hover:rotate-0 hover:z-30 hover:scale-105 transition-all duration-500 hover:bg-bg-300 mt-4">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-primary-300/10 flex items-center justify-center text-primary-300 font-bold border border-primary-300/20 transition-colors">EJ</div>
                    <div>
                        <div class="text-txt-100 font-medium transition-colors">Elena Jenkins</div>
                        <div class="text-xs text-txt-200 transition-colors">Dairy Farm Manager</div>
                    </div>
                </div>
                <p class="text-txt-200 leading-relaxed font-light transition-colors">"The health tracking has simplified our audits. We can instantly pull up vaccination records for any animal in the herd without digging through files."</p>
            </div>

            
            <div class="w-full sm:w-[380px] bg-bg-300 backdrop-blur-md border border-bg-300 rounded-2xl p-8 shadow-cinematic-hover transform lg:-translate-y-6 hover:z-30 hover:scale-105 transition-all duration-500 relative z-20">
                <div class="absolute top-0 right-0 w-0 h-0 border-t-[40px] border-t-agri-base border-l-[40px] border-l-transparent rounded-tr-2xl transition-colors duration-500"></div>
                <div class="flex items-center gap-4 mb-6">
                    <img src="<?php echo e(asset('images/1.jpg')); ?>" alt="Marcus" class="w-12 h-12 rounded-full object-cover border border-bg-300 transition-colors">
                    <div>
                        <div class="text-txt-100 font-bold">Marcus Thorne</div>
                        <div class="text-xs text-txt-200">Owner, Thorne Livestock</div>
                    </div>
                </div>
                <p class="text-txt-200 leading-relaxed font-medium text-lg transition-colors">"I've been searching for a straightforward registry for YEARS. It's clean, incredibly fast, and my team actually logs data consistently now."</p>
            </div>

            
            <div class="w-full sm:w-[340px] bg-bg-300/80 backdrop-blur-md border border-bg-300 rounded-2xl p-8 shadow-cinematic transform lg:rotate-2 hover:rotate-0 hover:z-30 hover:scale-105 transition-all duration-500 hover:bg-bg-300 mt-4">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-12 h-12 rounded-full bg-accent-200/10 flex items-center justify-center text-accent-200 font-bold border border-accent-200/20 transition-colors">SW</div>
                    <div>
                        <div class="text-txt-100 font-medium transition-colors">Sarah Winston</div>
                        <div class="text-xs text-txt-200 transition-colors">Equine Breeder</div>
                    </div>
                </div>
                <p class="text-txt-200 leading-relaxed font-light transition-colors">"Managing ownership transfers and maintaining accurate logs used to be a headache. Now it's visual, intuitive, and properly documented."</p>
            </div>

        </div>
    </div>
</div>


<div class="relative py-24 sm:py-32 mt-12 overflow-hidden border-t border-bg-300 transition-colors duration-500">
    
    <div class="absolute inset-0 z-0">
        <img src="<?php echo e(asset('images/6.png')); ?>" alt="Calm Pasture" class="w-full h-full object-cover filter brightness-[0.6] dark:brightness-[0.4] contrast-125 transition-all duration-500">
        <div class="absolute inset-0 bg-gradient-to-b from-bg-100 via-transparent to-bg-100 transition-colors duration-500"></div>
    </div>

    <div class="relative z-10 max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
        <div class="bg-bg-300/80 backdrop-blur-lg border border-bg-300 rounded-3xl p-10 sm:p-16 shadow-cinematic transition-colors">
            <h2 class="text-4xl sm:text-5xl font-bold text-txt-100 mb-6 leading-tight">
                Ready to organize your records?
            </h2>
            <p class="text-xl text-txt-200 mb-10 font-light max-w-2xl mx-auto transition-colors">
                Join modern farmers who have streamlined their livestock tracking with our premium platform.
            </p>
            <a href="<?php echo e(route('register')); ?>" class="group relative inline-flex items-center justify-center px-10 py-5 bg-primary-200 text-white font-medium rounded-full overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-cinematic-hover text-xl tracking-wide border border-primary-100">
                <span class="absolute inset-0 w-full h-full bg-gradient-to-b from-white/10 to-transparent"></span>
                <span class="relative flex items-center gap-2">
                    Create Account
                    <svg class="w-5 h-5 transform group-hover:translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
            </a>
        </div>
    </div>
</div>


<footer class="bg-bg-200/30 border-t border-bg-300 py-12 relative z-10 transition-colors duration-500">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
            <div class="col-span-1 md:col-span-2">
                <a href="/" class="flex items-center gap-3 mb-4 group">
                    <span class="text-2xl transition-transform duration-300 group-hover:scale-110">🐄</span>
                    <h1 class="text-lg font-bold text-txt-100 tracking-wide">Livestock<span class="text-primary-300 transition-colors">System</span></h1>
                </a>
                <p class="text-txt-200 text-sm max-w-xs leading-relaxed transition-colors">
                    Premium livestock management and health tracking designed for the modern agricultural era.
                </p>
            </div>
            <div>
                <h4 class="text-txt-100 font-bold mb-4 uppercase text-xs tracking-wider">Product</h4>
                <ul class="space-y-2 text-sm text-txt-200">
                    <li><a href="#" class="hover:text-primary-300 transition-colors">Features</a></li>
                    <li><a href="#" class="hover:text-primary-300 transition-colors">Pricing</a></li>
                    <li><a href="#" class="hover:text-primary-300 transition-colors">Security</a></li>
                </ul>
            </div>
            <div>
                <h4 class="text-txt-100 font-bold mb-4 uppercase text-xs tracking-wider">Company</h4>
                <ul class="space-y-2 text-sm text-txt-200">
                    <li><a href="#" class="hover:text-primary-300 transition-colors">About Us</a></li>
                    <li><a href="#" class="hover:text-primary-300 transition-colors">Contact</a></li>
                    <li><a href="#" class="hover:text-primary-300 transition-colors">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
        <div class="border-t border-bg-300 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 transition-colors">
            <p class="text-txt-200 text-sm transition-colors">© <?php echo e(date('Y')); ?> Livestock System. All rights reserved.</p>
            <div class="flex items-center gap-4 text-txt-200 transition-colors">
                <a href="#" class="hover:text-txt-100 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/></svg></a>
                <a href="#" class="hover:text-txt-100 transition-colors"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z"/></svg></a>
            </div>
        </div>
    </div>
</footer>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\hp\Desktop\livestock\livestock\resources\views/welcome.blade.php ENDPATH**/ ?>