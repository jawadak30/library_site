
@push('styles')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
@if(session('message'))
<script>
    document.addEventListener('DOMContentLoaded', function() {
        Swal.fire({
            icon: 'success', // Make sure this matches your intent
            title: 'Success!',
            text: '{{ session('message') }}',
        }).then(() => {
            // Clear session message from history
            window.history.replaceState({}, document.title, window.location.pathname);
        });
    });
</script>
@endif



@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endpush
