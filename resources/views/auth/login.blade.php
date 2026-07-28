<x-guest-layout>

    <div class="w-full max-w-sm">

        <!--  marca podria ser -->
        <div class="text-center mb-4">
             <!-- Logo-->
            <h1 class="mt-2 text-lg font-extrabold text-[#E7F6FC]">EcoIncentivos</h1>
            <p class="text-xs tracking-widest text-[#8CB89F] uppercase">Inicia sesión</p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-3 text-center" :status="session('status')" />

        <div class="bg-[#0d332c] rounded-2xl shadow-lg border border-[#4E7A51]/40 p-5">
            <form method="POST" action="{{ route('login') }}" class="space-y-3">
                @csrf

                <!-- correo electronico -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- contraseña -->
                <div>
                    <x-input-label for="password" :value="__('contraseña')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="password"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="password" name="password" required autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <!-- recordar -->
                <div class="flex items-center justify-between pt-1">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-[#4E7A51] text-[#4E7A51] shadow-sm focus:ring-[#8CB89F]" name="remember">
                        <span class="ms-2 text-xs text-[#8CB89F]">{{ __('Recuerdame') }}</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a class="text-xs text-[#8CB89F] hover:text-[#E7F6FC] underline-offset-2 hover:underline"
                            href="{{ route('password.request') }}">
                            {{ __('Olvidaste tu contraseña') }}
                        </a>
                    @endif
                </div>

                <!-- iniciar secion  -->
                <button type="submit"
                    class="w-full py-2 rounded-lg bg-[#4E7A51] hover:bg-[#8CB89F] text-white text-sm font-semibold transition-colors duration-200 shadow-sm">
                    {{ __('iniciar sesión') }}
                </button>
            </form>

            @if (Route::has('register'))
                <p class="mt-4 text-center text-xs text-[#8CB89F]">
                    {{ __("No tienes cuenta") }}
                    <a href="{{ route('register') }}" class="text-[#E7F6FC] font-medium hover:underline">
                        {{ __('Registrate') }}
                    </a>
                </p>
            @endif
        </div>

    </div>

</x-guest-layout>