<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-bg-300 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-primary-100 focus:bg-primary-100 active:bg-bg-100 focus:outline-none focus:ring-2 focus:ring-primary-200 focus:ring-offset-2 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
