<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#4E7A51] border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#8CB89F] focus:bg-[#3d6240] active:bg-[#3d6240] focus:outline-none focus:ring-2 focus:ring-[#8CB89F] focus:ring-offset-2 focus:ring-offset-[#0d332c] transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
