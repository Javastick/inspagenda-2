<div>
    <button {{ $attributes->merge(['class' => 'btn']) }}>
        {{ $slot }}
    </button>
</div>