<x-app-layout>
    <x-slot name="header">
        <div class="text-center">
            <h2 class="text-xl font-extrabold text-[#000000] leading-tight">
                {{ __('Mi Perfil') }}
            </h2>
            <p class="text-xs tracking-widest text-[#80B000] uppercase mt-1">
                {{ __('Gestiona tu información personal y seguridad') }}
            </p>
        </div>
    </x-slot>

    <div class="py-8 sm:py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <!-- Perfil Information  -->
            <div class="bg-[#0d332c] border border-[#4E7A51]/40 shadow-lg rounded-2xl p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <!-- Update Password Card -->
            <div class="bg-[#0d332c] border border-[#4E7A51]/40 shadow-lg rounded-2xl p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <!-- Delete Account Card -->
            <div class="bg-[#0d332c] border border-[#4E7A51]/40 shadow-lg rounded-2xl p-4 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
