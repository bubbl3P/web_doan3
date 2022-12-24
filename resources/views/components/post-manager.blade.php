

<script src="{{ asset('js/vendor.min.js') }}"></script>
<script src="{{ asset('js/app.min.js') }}"></script>
<script src="{{ asset('js/helper.js') }}"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{ route('api.posts') }}',
            dataType: 'json',
            data: {page: {{ request()->get('page') ?? 1 }}},
            success: function (response) {
                response.data.data.forEach(function (each) {
                    console.log(each);
                    let location = each.district + ' - ' + each.city;
                    let remotable = each.remotable ? 'x' : '';
                    let is_parttime = each.is_parttime ? 'x' : '';
                    let range_salary = (each.min_salary && each.max_salary) ? each.min_salary + '-' + each.max_salary : '';
                    let date_range = (each.start_date && each.end_date) ? each.start_date + '-' + each.end_date : '';
                    let is_pinned = each.is_pinned ? 'x' : '';
                    let created_at = convertDateToDateTime(each.created_at);
                    $('#table-data').append($('<tr>')
                        .append($('<td>').append(each.id))
                        .append($('<td>').append(each.job_title))
                        .append($('<td>').append(location))
                        .append($('<td>').append(remotable))
                        .append($('<td>').append(is_parttime))
                        .append($('<td>').append(range_salary))
                        .append($('<td>').append(date_range))
                        .append($('<td>').append(each.status))
                        .append($('<td>').append(is_pinned))
                        .append($('<td>').append(created_at))
                    );

                });
                renderPagination(response.data.pagination);
            },
            error: function (response) {
                $.toast({
                    heading: 'Import Error',
                    text: response.responseJSON.messages,
                    showHideTransition: 'slide',
                    position: 'bottom-right',
                    icon: 'error',
                })
            },
        })

        $(document).on('click', '#pagination > li > a', function (event) {
            event.preventDefault();
            let page = $(this).text();
            let urlParams = new URLSearchParams(window.location.search);
            urlParams.set('page', page);
            window.location.search = urlParams;
        });

        $("#csv").change(function (event) {
            var formData = new FormData();
            formData.append('file', $(this)[0].files[0]);
            $.ajax({
                url: ' {{ route('admin.posts.import_csv') }} ',
                type: 'POST',
                dataType: 'json',
                enctype: 'multipart/form-data',
                data: formData,
                async: false,
                cache: false,
                contentType: false,
                processData: false,
                success: function (response) {
                    $.toast({
                        heading: 'Import Success',
                        text: 'Your data have been imported',
                        showHideTransition: 'slide',
                        position: 'bottom-right',
                        icon: 'success',
                    })
                },
                error: function (respone) {

                }

            })

        })
    });

</script>

