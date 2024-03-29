$(document).ready(function () {
    $('.deleteEC').click(function (e) {
        e.preventDefault();

        var id = $(this).data('id');
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'DELETE',
                    url: $('#deleteEC').data('url').replace(':id', id),
                    data: {
                        "_token": CSRF_TOKEN
                    },
                    success: function (response) {
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        ).then((result) => {
                            location.reload();
                        });
                    },
                    error: function (xhr, status, error) {
                        Swal.fire(
                            'Error!',
                            'Failed to delete the record.',
                            'error'
                        );
                    }
                });
            }
        });
    });
});
