@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border-bg-300 focus:border-primary-200 focus:ring-primary-200 rounded-md shadow-sm']) }}>
