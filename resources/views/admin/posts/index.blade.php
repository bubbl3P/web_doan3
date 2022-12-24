@extends('layout.master')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{--                    <a href="{{ route('admin.posts.create') }}" class="btn btn-primary">--}}
                    {{--                        Create--}}
                    {{--                    </a>--}}
                    {{--                    <label for="csv" class="btn btn-info mb-0">--}}
                    {{--                        Import CSV--}}
                    {{--                    </label>--}}
                    <input type="file" name="csv" id="csv" class="d-none"
                           accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel">
                    <nav class="float-right">
                        <ul class="pagination pagination-rounded mb-0" id="pagination">
                        </ul>
                    </nav>
                </div>
                <div class="card-body">
                    <table class="table table-striped" id="table-data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Job Title</th>
                            <th>Location</th>
                            <th>Remotable</th>
                            <th>Can Part-time</th>
                            <th>Range Salary</th>
                            <th>Date Range</th>
                            <th>Status</th>
                            <th>Is Pinned</th>
                            <th>Created At</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
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
                        let can_parttime = each.can_parttime ? 'x' : '';
                        let range_salary = (each.min_salary && each.max_salary) ? each.min_salary + '-' + each.max_salary : '';
                        let date_range = (each.start_date && each.end_date) ? each.start_date + '-' + each.end_date : '';
                        let is_pinned = each.is_pinned ? 'x' : '';
                        let created_at = convertDateToDateTime(each.created_at);
                        $('#table-data').append($('<tr>')
                            .append($('<td>').append(each.id))
                            .append($('<td>').append(each.job_title))
                            .append($('<td>').append(location))
                            .append($('<td>').append(remotable))
                            .append($('<td>').append(can_parttime))
                            .append($('<td>').append(range_salary))
                            .append($('<td>').append(date_range))
                            .append($('<td>').append($('<input type="checkbox" class="toggle-class" name="status" data-id="{{ $data[0]->id }}" {{ $status === true ? 'checked' : '' }} >')))
                            .append($('<td>').append(is_pinned))
                            .append($('<td>').append(created_at))
                        );
                        {{--<select name="currency_salary" class="form-control">--}}
                        {{--    @foreach($currencies as $currency => $value)--}}
                        {{--    <option value="{{ $value }}">--}}
                        {{--    {{ $currency }}--}}
                        {{--    </option>--}}
                        {{--    @endforeach--}}
                        {{--</select>--}}
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
                    success: function (respone) {
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


            $(document).on('click', '.toggle-class', function () {
                var status = $(this).prop('checked') === true ? 2 : 0;
                var post_id = $(this).data('id');
                alert(post_id);

                $.ajax({
                    type: 'get',
                    dataType: 'json',
                    url: '{{ route('admin.posts.changeStatus')  }}',
                    data: {
                        'status': status,
                        'status_id': post_id,
                    },
                    success: function (data) {

                    },
                    error: function (data) {
                    }


                });


            });
        });


    </script>
@endpush
