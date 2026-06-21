<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Login - Paramitra ERP</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap');
        body { font-family: 'Outfit', sans-serif; }
        
        .bg-office {
            background-image: url('{{ asset('images/bg-office.png') }}');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            position: relative;
        }

        .bg-office::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(15, 23, 42, 0.6) 0%, rgba(30, 41, 59, 0.85) 100%);
            backdrop-filter: blur(8px);
            z-index: 1;
        }

        .login-anim {
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { transform: translateY(40px); opacity: 0; }
            to { transform: translateY(0); opacity: 1; }
        }

        .float {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }
    </style>
</head>
<body class="bg-office min-h-screen flex items-center justify-center p-4 sm:p-6">
    <div class="max-w-md w-full login-anim relative z-10">
        <div class="bg-white p-6 sm:p-12 rounded-[2rem] sm:rounded-[3.5rem] shadow-[0_32px_64px_-16px_rgba(0,0,0,0.08)] border border-slate-50 relative overflow-hidden">
            <!-- Decorative Elements -->
            <div class="absolute -top-10 -right-10 w-32 h-32 bg-blue-50 rounded-full blur-3xl"></div>
            <div class="absolute -bottom-10 -left-10 w-32 h-32 bg-indigo-50 rounded-full blur-3xl"></div>

            <div class="relative z-10">
                <div class="text-center mb-8 sm:mb-12">
                    <div class="inline-flex p-1 bg-white rounded-[1.5rem] sm:rounded-[2rem] shadow-2xl shadow-blue-200 mb-6 sm:mb-8 float overflow-hidden border border-slate-100">
                        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-16 h-16 sm:w-24 sm:h-24 object-contain">
                    </div>
                    <h1 class="text-2xl sm:text-3xl font-black text-slate-900 tracking-tight uppercase">Paramitra Portal</h1>
                    <p class="text-slate-400 text-xs sm:text-sm font-medium mt-3">Silakan masuk untuk mengakses sistem operasional <br class="hidden sm:inline"> <span class="font-bold text-slate-900 italic">PT Paramitra Praya Prawatya</span></p>
                </div>

                <form action="{{ route('login.submit') }}" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-2">Email Address</label>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-300 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="mail" class="w-5 h-5"></i>
                            </span>
                            <input type="email" name="email" required class="block w-full pl-14 pr-6 py-4 bg-slate-50 border border-slate-50 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all outline-none font-medium text-slate-700" placeholder="name@company.com">
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs font-bold mt-1 ml-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-2">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Password</label>
                            <a href="#" class="text-[10px] font-black text-blue-600 uppercase tracking-[0.2em] hover:text-blue-700 transition-colors">Lupa?</a>
                        </div>
                        <div class="relative group">
                            <span class="absolute inset-y-0 left-0 pl-5 flex items-center text-slate-300 group-focus-within:text-blue-500 transition-colors">
                                <i data-lucide="lock" class="w-5 h-5"></i>
                            </span>
                            <input type="password" id="password" name="password" required class="block w-full pl-14 pr-14 py-4 bg-slate-50 border border-slate-50 rounded-2xl focus:bg-white focus:ring-4 focus:ring-blue-500/5 focus:border-blue-500 transition-all outline-none font-medium text-slate-700" placeholder="••••••••">
                            <button type="button" id="toggle-password" class="absolute inset-y-0 right-0 pr-5 flex items-center text-slate-400 hover:text-slate-600 transition-colors outline-none">
                                <i data-lucide="eye" id="icon-show" class="w-5 h-5 hidden"></i>
                                <i data-lucide="eye-off" id="icon-hide" class="w-5 h-5"></i>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-slate-900 hover:bg-blue-600 text-white font-extrabold py-4 sm:py-5 px-4 rounded-2xl shadow-xl shadow-slate-200 transition-all transform hover:-translate-y-1 active:scale-[0.98]">
                        Login
                    </button>
                </form>

                <div class="mt-12 text-center">
                    <p class="text-[10px] font-bold text-slate-300 uppercase tracking-widest">PT Paramitra Praya Prawatya &copy; 2026</p>
                </div>
            </div>
        </div>
    </div>

    <script>
        lucide.createIcons();

        // Password Visibility Toggle
        const togglePassword = document.getElementById('toggle-password');
        const passwordInput = document.getElementById('password');
        const iconShow = document.getElementById('icon-show');
        const iconHide = document.getElementById('icon-hide');

        togglePassword.addEventListener('click', () => {
            const isPassword = passwordInput.getAttribute('type') === 'password';
            
            if (isPassword) {
                passwordInput.setAttribute('type', 'text');
                iconShow.classList.remove('hidden');
                iconHide.classList.add('hidden');
            } else {
                passwordInput.setAttribute('type', 'password');
                iconShow.classList.add('hidden');
                iconHide.classList.remove('hidden');
            }
        });
    </script>
</body>
</html>
