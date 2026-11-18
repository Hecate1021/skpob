<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center justify-center px-6 py-3 bg-sk-yellow border border-transparent rounded-full font-bold text-sk-darkgreen uppercase tracking-widest hover:bg-yellow-300 hover:shadow-lg focus:bg-yellow-400 active:bg-yellow-500 focus:outline-none focus:ring-2 focus:ring-sk-yellow focus:ring-offset-2 transition ease-in-out duration-150 transform hover:-translate-y-0.5']) }}>
    {{ $slot }}
</button>
