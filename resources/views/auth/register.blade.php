<x-guest-layout>

    <div class="w-full max-w-sm">

        <!-- Encabezado con acento de marca -->
        <div class="text-center mb-4">
             <!-- Logo-->
            <h1 class="mt-2 text-lg font-extrabold text-[#E7F6FC]">EcoIncentivos</h1>
            <p class="text-xs tracking-widest text-[#8CB89F] uppercase">Crea tu cuenta</p>
        </div>

        <div class="bg-[#0d332c] rounded-2xl shadow-lg border border-[#4E7A51]/40 p-5">
            <form method="POST" action="{{ route('register') }}" class="space-y-3">
                @csrf

                <!-- Nombre y Apellido en fila -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <x-input-label for="nombre" :value="__('Nombre')" class="text-[#E7F6FC] font-medium text-sm" />
                        <x-text-input id="nombre"
                            class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                            type="text" name="nombre" :value="old('nombre')" required autofocus autocomplete="given-name" />
                        <x-input-error :messages="$errors->get('nombre')" class="mt-1" />
                    </div>

                    <div>
                        <x-input-label for="apellido" :value="__('Apellido')" class="text-[#E7F6FC] font-medium text-sm" />
                        <x-text-input id="apellido"
                            class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                            type="text" name="apellido" :value="old('apellido')" required autocomplete="family-name" />
                        <x-input-error :messages="$errors->get('apellido')" class="mt-1" />
                    </div>
                </div>

                <!-- Email -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="email"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Telefono -->
                <div>
                    <x-input-label for="telefono" :value="__('Telefono')" class="text-[#E7F6FC] font-medium text-sm" />
                    <x-text-input id="telefono"
                        class="block mt-1 w-full rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F]"
                        type="text" name="telefono" :value="old('telefono')" autocomplete="tel" />
                    <x-input-error :messages="$errors->get('telefono')" class="mt-1" />
                </div>

                <!-- Password y Confirm en fila -->
                <div class="grid grid-cols-2 gap-3">
                    <div>
                        <x-input-label for="password" :value="__('contraseña')" class="text-[#E7F6FC] font-medium text-sm" />
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
                    {{ __('Register') }}
                </button>
            </form>

            <p class="mt-4 text-center text-xs text-[#8CB89F]">
                {{ __('¿Ya tienes cuenta?') }}
                <a href="{{ route('login') }}" class="text-[#E7F6FC] font-medium hover:underline">
                    {{ __('Inicia sesión') }}
                </a>
            </p>
        </div>

    </div>

</x-guest-layout>