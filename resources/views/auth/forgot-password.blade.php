<x-guest-layout>

    <div class="w-full max-w-sm">

        <!-- Encabezado con acento de marca -->
        <div class="text-center mb-4">
             <!-- Logo-->
            <h1 class="mt-2 text-lg font-extrabold text-[#E7F6FC]">EcoIncentivos</h1>
            <p class="text-xs tracking-widest text-[#8CB89F] uppercase">Recuperar contraseña</p>
        </div>

        <div class="bg-[#0d332c] rounded-2xl shadow-lg border border-[#4E7A51]/40 p-5">

            <div class="mb-4 text-sm text-[#8CB89F]">
                {{ __('Olvidaste tu contraseña, Ingresa tu correo electrónico y número de teléfono para verificar tu identidad y recuperar tu contraseña.') }}
            </div>

            <!-- Session Status -->
            <x-auth-session-status class="mb-3" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}" class="space-y-3">
                @csrf

                <!-- Correo -->
                <div>
                    <x-input-label for="email" :value="__('Correo Electronico')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="email" name="email" :value="old('email')" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- numero -->
                <div>
                    <x-input-label for="telefono" :value="__('Numero de Teléfono')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="telefono"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="text" name="telefono" :value="old('telefono')" required />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
                </div>

                <!-- boton de verificar -->
                <button type="submit"
                    class="w-full py-2 rounded-lg bg-[#4E7A51] hover:bg-[#8CB89F] text-white text-sm font-semibold transition-colors duration-200 shadow-sm mt-1">
                    {{ __('Verificar la Identidad') }}
                </button>
            </form>

        </div>

    </div>

</x-guest-layout>
