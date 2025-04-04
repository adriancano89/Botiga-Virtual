<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center items-center w-full px-4 py-3 fondo-secundario border border-transparent rounded-md font-semibold text-sm text-white dark:text-white uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
    {{ $slot }}
</button>
