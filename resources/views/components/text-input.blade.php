@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg bg-[#00221C] border-[#4E7A51] text-[#E7F6FC] focus:border-[#8CB89F] focus:ring-[#8CB89F] shadow-sm']) }}>
