<script>
    @if (session()->get('success'))
        Swal.fire({
            title: '{{ session()->get('success') }}',
            icon: 'success',
            toast: true,
            position: "top-end",
            animation: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    @endif


    @if (session()->get('info'))
        Swal.fire({
            title: '{{ session()->get('info') }}',
            icon: 'info',
            toast: true,
            position: "top-end",
            animation: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    @endif


    @if (session()->get('warning'))
        Swal.fire({
            title: '{{ session()->get('warning') }}',
            icon: 'warning',
            toast: true,
            position: "top-end",
            animation: true,
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    @endif
</script>
