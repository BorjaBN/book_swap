@if(session('success') || session('error') || session('info'))
<div 
    class="toast align-items-center text-white 
        @if(session('success')) bg-success 
        @elseif(session('error')) bg-danger 
        @elseif(session('info')) bg-primary 
        @endif
        border-0 show position-fixed top-0 start-50 translate-middle-x mt-4 mt-md-5"
    role="alert" 
    aria-live="assertive" 
    aria-atomic="true"
    style="z-index: 9999;"
>
    <div class="d-flex">
        <div class="toast-body">
            {{ session('success') ?? session('error') ?? session('info') }}
        </div>
        <button 
            type="button" 
            class="btn-close btn-close-white me-2 m-auto" 
            data-bs-dismiss="toast" 
            aria-label="Close"
        ></button>
    </div>
</div>
@endif