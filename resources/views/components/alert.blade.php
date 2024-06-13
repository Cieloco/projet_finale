@if(session('success'))
    <div class="alert alert-dismissible fade show rounded-0 text-white" role="alert" style="background: linear-gradient(135deg, #B46F55, #FFFFFF);">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif