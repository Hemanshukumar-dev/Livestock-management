<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-bg-100 border border-bg-300 rounded-md font-semibold text-xs text-txt-200 uppercase tracking-widest shadow-sm hover:bg-bg-200 focus:outline-none focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
