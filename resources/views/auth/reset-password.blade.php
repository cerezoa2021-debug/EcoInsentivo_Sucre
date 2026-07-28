<x-guest-layout>

    <div class="w-full max-w-sm">

        <!-- Encabezado con acento de marca -->
        <div class="text-center mb-4">
            
            <!-- Logo-->
            <h1 class="mt-2 text-lg font-extrabold text-[#E7F6FC]">EcoIncentivos</h1>
            <p class="text-xs tracking-widest text-[#8CB89F] uppercase">Restablecer contraseña</p>
        </div>

        <div class="bg-[#0d332c] rounded-2xl shadow-lg border border-[#4E7A51]/40 p-5">

            <div class="mb-4 text-sm text-[#8CB89F]">
                {{ __('Ingresa tu correo electrónico, número de teléfono y tu nueva contraseña.') }}
            </div>

            <form method="POST" action="{{ route('password.store') }}" class="space-y-3">
                @csrf

                <!-- resetiar token contraseña -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- correo -->
                <div>
                    <x-input-label for="email" :value="__('Correo Electronico')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="email" name="email" :value="old('email', session('reset_email', $request->email))" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- numero -->
                <div>
                    <x-input-label for="telefono" :value="__('Numero de Teléfono')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="telefono"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="text" name="telefono" :value="old('telefono')" required autocomplete="tel" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
                </div>

                <!-- Confirmar contrasena -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <x-input-label for="password" :value="__('Nueva Contraseña')" class="text-[#E7F6FC] font-medium text-sm" />
                        <x-text-input id="password"
                            class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                            type="password" name="password" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirmar')" class="text-[#E7F6FC] font-medium text-sm" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                            type="password" name="password_confirmation" required autocomplete="new-password" />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1" />
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit"
                    class="w-full py-2 rounded-lg bg-[#4E7A51] hover:bg-[#8CB89F] text-white text-sm font-semibold transition-colors duration-200 shadow-sm mt-1">
                    {{ __('Restablecer Contraseña') }}
                </button>
            </form>

        </div>

    </div>

</x-guest-layout>