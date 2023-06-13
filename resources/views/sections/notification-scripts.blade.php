<script>
        'use strict';

        let status = "{{session('success') ? 'success' : (session('error') ? 'danger' : '') }}"
        let message =
            "{{session('success') ? session('success') : (session('error') ? session('error') : '') }}"
        let icon = status == 'success' ? '<i class="fa fa-check"></i>' : (status == 'danger' ?
            '<i class="fa fa-warning"></i>' : '')
        let errors = JSON.parse("{{ $errors }}".replaceAll('&quot;','"'));

        if (status) {
            $.notify(icon + message, {
                type: status,
                allow_dismiss: true,
                delay: 10000,
                showProgressbar: true,
                timer: 10,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        }

        if(Object.keys(errors).length) multipleErrors(errors)

        function notifyError(message){
            $.notify('<i class="fa fa-warning"></i>' + message, {
                    type: 'danger',
                    allow_dismiss: true,
                    delay: 10000,
                    showProgressbar: true,
                    timer: 10,
                    animate: {
                        enter: 'animated fadeInDown',
                        exit: 'animated fadeOutUp'
                }
            });
        }

        function multipleErrors(message){
            let errors = '<ul>'
            Object.entries(message).forEach(error => {
                errors = errors + '<li>' + error[1] + '</li>'
            });
            errors += '</ul>'
            notifyError(errors)
        }

        // ServerSide Error + Success
        function successMessage(message) {
            $.notify('<i class="fa fa-check"></i>' + message, {
                type: 'success',
                allow_dismiss: true,
                delay: 10000,
                showProgressbar: true,
                timer: 10,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        }

        function errorMessage(message) {
            if (typeof message == 'string') {
                notifyError(message)
            } else {
                multipleErrors(message)
            }
        }

        $(document).on("click", "#delete-data", function(event) {
            var button = event.target;
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                buttons: true,
                dangerMode: true,
            }).then(function(result) {
                var url = button.getAttribute('data-url');
                if (result) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        },
                        url: url,
                        type: 'DELETE',
                        success: function(data) {
                            if (data.success) {
                                location.reload(true);
                            } else {
                                errorMessage(data.message);
                            }
                        },
                        error: function(request) {
                            errorMessage(request.responseJSON['message']);
                        }
                    });
                }
            }).catch(()=>{});
        });

        function notify(title,message) {
            $.notify('<i class="fa fa-bell pe-1"></i>' + title + "<div class='ps-4'>" + message + "</div>", {
                type: 'info',
                allow_dismiss: true,
                timer:1,
                delay: 2500,
	            timer: 500,
                animate: {
                    enter: 'animated fadeInDown',
                    exit: 'animated fadeOutUp'
                }
            });
        }

</script>

