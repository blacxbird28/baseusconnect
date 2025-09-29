@props(['disabled' => false, 'value' => ''])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'text-[14px] border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm']) }} value="{{ $value }}">
