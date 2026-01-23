

@if (session('mensaje'))
    <div class="toast toast-top toast-center">
        <div class="alert alert-{{ session('tipo', 'success') }} animate-fade-out">
            <span>{{ session('mensaje') }}</span>
        </div>
    </div>
@endif
