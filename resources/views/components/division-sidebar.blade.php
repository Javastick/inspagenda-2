@props(['division'])

<div class="card bg-base-100 shadow-sm border border-base-200 mb-6">
    <div class="card-body p-4 md:p-6 text-center">
        <div class="avatar mx-auto mb-4">
            <div class="w-24 rounded-full ring ring-primary ring-offset-base-100 ring-offset-2">
                <img src="{{ asset('images/logo-inspagenda-512px.png') }}" alt="Irban Icon" />
            </div>
        </div>
        <h2 class="card-title justify-center text-xl font-bold">{{ $division->name }}</h2>
        
        <div class="divider my-2"></div>
        
        
    </div>
</div>
