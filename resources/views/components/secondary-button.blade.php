<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-[#1a3f35] border border-[#4E7A51] rounded-lg font-semibold text-xs text-[#8CB89F] uppercase tracking-widest shadow-sm hover:bg-[#0d332c] hover:text-[#E7F6FC] focus:outline-none focus:ring-2 focus:ring-[#8CB89F] focus:ring-offset-2 focus:ring-offset-[#0d332c] disabled:opacity-25 transition ease-in-out duration-200']) }}>
    {{ $slot }}
</button>
