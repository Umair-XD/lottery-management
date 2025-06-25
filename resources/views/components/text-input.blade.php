@props(['disabled' => false])

<input @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'border border-blue-500 focus:border-blue-900 focus:ring-blue-900 rounded-md shadow-sm',
    ]) }}>
