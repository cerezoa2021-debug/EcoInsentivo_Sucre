<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-[#8B2500] border border-transparent rounded-lg font-semibold text-xs text-[#E7F6FC] uppercase tracking-widest hover:bg-[#A83000] active:bg-[#6B1D00] focus:outline-none focus:ring-2 focus:ring-[#A83000] focus:ring-offset-2 focus:ring-offset-[#0d332c] transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
