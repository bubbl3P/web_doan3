@extends('layout_hr.master')
@push('css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/summernote-bs4.css') }}">
    <style>
        .error {
            color: red;
        }

        input[data-switch]:checked + label:after {
            left: 90px;
        }

        input[data-switch] + label {
            width: 110px;
        }

    </style>

@endpush
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div id="div-error" class="alert alert-danger d-none"></div>
                    <form class="form-horizontal" action="{{ route('hr.posts.store') }}" method="POST"
                          id="form-create-post">
                        @csrf
                        <div class="form-group">
                            <label>Company</label>
                            <select class="form-control" name="company" id="select-company">
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Language</label>
                            <select class="form-control" multiple name="languages[]" id="select-language">
                            </select>
                        </div>

                        <div class="form-row select-location">
                            <div class="form-group col-6">
                                <label>City</label>
                                <select class="form-control select-city" name="city" id="select-city">
                                </select>
                            </div>
                            <div class="form-group col-6">
                                <label>District</label>
                                <select class="form-control select-district" name="district" id="select-district">
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-4">
                                <label>Min Salary</label>
                                <input type="number" class="form-control" name="min_salary">
                            </div>
                            <div class="form-group col-4">
                                <label>Max Salary</label>
                                <input type="number" class="form-control" name="max_salary">
                            </div>
                            <div class="form-group col-4">
                                <label>Currency Salary</label>
                                <select name="currency_salary" class="form-control">
                                    @foreach($currencies as $currency => $value)
                                        <option value="{{ $value }}">
                                            {{ $currency }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-8">
                                <label>Requirements</label>
                                <textarea name="requirement" id="text-requirement" class="form-control"></textarea>

                            </div>
                            <div class="form-group col-8">
                                <label>Job Description</label>
                                <textarea name="job_description" id="text-description" class="form-control"></textarea>

                            </div>
                            <div class="form-group col-4">
                                <label>Number Applicant</label>
                                <input type="number" class="form-control" name="number_applicants">
                                <br>
                                <label>Experience</label>
                                <input type="number" class="form-control" name="experience">
                                <br>
                                <input type="checkbox" id="remote" name="remotables[remote]" checked
                                       data-switch="success">
                                <label for="remote" class="" data-on-label="Can Remote"
                                       data-off-label="No Remote"></label>

                                <input type="checkbox" id="office" name="remotables[office]" checked
                                       data-switch="success">
                                <label for="office" class="" data-on-label="Office" data-off-label="No Office"></label>


                                <br>
                                <input type="checkbox" id="can_parttime" name="can_parttime" checked data-switch="info">
                                <label for="can_parttime" class="" data-on-label="Can Parttime"
                                       data-off-label="No Parttime"></label>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Start Date</label>
                                <input type="date" class="form-control" name="start_date">
                            </div>
                            <div class="form-group  col-6">
                                <label>End Date</label>
                                <input type="date" class="form-control" name="end_date">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Title</label>
                                <input type="text" class="form-control" name="job_title" id="title">
                            </div>
                            <div class="form-group  col-6">
                                <label>Slug</label>
                                <input type="text" class="form-control" name="slug" id="slug">
                            </div>
                            {{--                            <div class="form-group col-6">--}}
                            {{--                                <label>Link</label>--}}
                            {{--                                <input type="text" class="form-control" name="link" id="link">--}}
                            {{--                            </div>--}}
                            {{--                            <div class="form-group col-4">--}}
                            {{--                                <label>Type Link</label>--}}
                            {{--                                <select name="type" class="form-control" id="type">--}}
                            {{--                                    @foreach($type as $type_links => $value)--}}
                            {{--                                        <option value="{{ $value }}">--}}
                            {{--                                            {{ $type_links }}--}}
                            {{--                                        </option>--}}
                            {{--                                    @endforeach--}}
                            {{--                                </select>--}}
                            {{--                            </div>--}}
                        </div>
                        <div class="form-group">
                            <button id="btn-submit" class="btn btn-success">Create</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="modal-company" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Create Company</h4>
                    <button type="button" class="close float-right" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form id="form-create-company" class="form-horizontal" action="{{ route('hr.companies.store') }}"
                          method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label>Company</label>
                            <input readonly name="name" id="company" class="form-control">
                        </div>
                        <div class="form-row select-location">
                            <div class="form-group col-4">
                                <label>Country (*)</label>
                                <select class="form-control" name="country" id='country'>
                                    @foreach($countries as $val => $name)
                                        <option value="{{ $val }}">
                                            {{ $name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-4">
                                <label>City (*)</label>
                                <select class="form-control select-city" name="city" id='city'></select>
                            </div>
                            <div class="form-group col-4">
                                <label>District</label>
                                <select class="form-control select-district" name="district" id='district'></select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Address</label>
                                <input type="text" name="address" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>Zipcode</label>
                                <input type="number" name="zipcode" class="form-control">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-6">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control">
                            </div>
                            <div class="form-group col-6">
                                <label>Phone</label>
                                <input type="number" name="phone" class="form-control">
                            </div>
                        </div>
{{--                        <div class="form-row">--}}
{{--                            <div class="form-group col-6">--}}
{{--                                <label>Email</label>--}}
{{--                                <input type="email" name="email" class="form-control">--}}
{{--                            </div>--}}
{{--                            <div class="form-group col-6">--}}
{{--                                <label>Logo</label>--}}
{{--                                <input type="file" name="logo"--}}
{{--                                       oninput="pic.src=window.URL.createObjectURL(this.files[0])">--}}
{{--                                <img id="pic" height="100"/>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="submitForm('company')" class="btn btn-success">Create</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.js"></script>
    <script src="{{ asset('js/summernote-bs4.min.js') }}"></script>
    <script>

        function generateTitle() {

            let languages = [];
            const selectedLanguages = $("#select-language :selected").map(function (i, v) {
                languages.push($(v).text());
            })
            languages = languages.join(',  ');
            const city = $("#select-city").val();
            const company = $("#select-company").val();
            let title = `(${city}) ${languages}`;
            if (company) {
                title += ' - ' + company;
            }
            $("#title").val(title);
            generateSlug(title);
        }

        function generateSlug(title) {
            $.ajax({
                url: '{{ route('api.posts.slug.generate') }}',
                type: 'POST',
                dataType: 'json',
                data: {title},
                success: function (response) {
                    $("#slug").val(response.data);
                    $("#slug").trigger("change");
                },
                error: function (response) {
                },
            });
        }

        async function loadDistrict(parent) {
            parent.find(".select-district").empty();
            const path = parent.find(".select-city option:selected").data('path');
            const response = await fetch('{{ asset('locations/') }}' + path);
            const districts = await response.json();
            const selectedValue = $("#select-district").val();

            let string = '';
            $.each(districts.district, function (index, each) {

                if (each.pre === 'Quận' || each.pre === 'Huyện') {
                    string += `<option`;
                    if (selectedValue === each.name) {
                        string += ` selected `;
                    }
                    string += `>${each.name}</option>`;

                }
            })
            parent.find(".select-district").append(string);
        }

        async function checkCompany() {
            $.ajax({
                url: '{{ route('api.companies.check') }}/' + $("#select-company").val(),
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    if (response.data) {
                        submitForm('post')
                    } else {
                        $("#modal-company").modal("show");
                        $("#company").val($("#select-company").val());
                        $("#city").val($("#select-city").val()).trigger('change');
                    }
                },
                error: function (response) {

                },
            });
        }

        function showError(errors) {
            let string = '<ul>';
            if (Array.isArray(errors)) {
                errors.forEach(function (each) {
                    each.forEach(function (error) {
                        string += `<li>${error}</li>`;
                    });
                });
            } else {
                string += `<li>${errors}</li>`;
            }
            string += '</ul>';
            $("#div-error").html(string);
            $("#div-error").removeClass("d-none").show();
            notifyError(string);
        }


        function submitForm(type) {
            const obj = $("#form-create-" + type);
            const formData = new FormData(obj[0]);
            $.ajax({
                url: obj.attr('action'),
                type: 'POST',
                dataType: 'json',
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                async: false,

                encrypt: 'multipart/form-data',
                success: function (response) {
                    if (response.success) {
                        $("#modal-company").modal("hide");
                        $("#div-error").hide();
                        notifySuccess();
                    } else {
                        showError(response.message);
                    }
                },
                error: function (response) {
                    let errors;
                    if (response.responseJSON.errors) {
                        errors = Object.values(response.responseJSON.errors);
                        showError(errors);
                    } else {
                        errors = response.responseJSON.errors;
                        showError(errors);
                    }

                },
            });
        }


        $(document).ready(async function () {
            $("#text-requirement").summernote();
            $("#text-description").summernote();
            $("#select-city").select2({tags: true});

            $("#city").select2({tags: true});
            const response = await fetch('{{ asset('locations/index.json') }}');
            const cities = await response.json();
            $.each(cities, function (index, each) {
                $("#select-city").append(`
                    <option data-path='${each.file_path}'>
                        ${index}
                    </option>`)
                $("#city").append(`
                <option data-path='${each.file_path}'>
                    ${index}
                </option>`)
            })
            $("#select-city, #city").change(function () {
                loadDistrict($(this).parents('.select-location'));
            })
            $("#select-district").select2({tags: true});
            $("#district").select2({tags: true});
            await loadDistrict($('#select-city').parents('.select-location'));


            $("#select-company").select2({
                tags: true,
                ajax: {
                    url: '{{ route('api.companies') }}',
                    data: function (params) {
                        const queryParameters = {
                            q: params.term
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.name,
                                }
                            })
                        }

                    },
                }
            });

            $('#select-language').select2({
                tags: true,
                ajax: {
                    url: '{{ route('api.languages') }}',
                    data: function (params) {
                        const queryParameters = {
                            q: params.term
                        };
                        return queryParameters;
                    },
                    processResults: function (data) {
                        return {
                            results: $.map(data.data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        }

                    },
                }
            });

            $(document).on('change', '#select-language, #select-company, #select-city', function () {
                generateTitle()
            })

            $("#slug").change(function () {
                $("#btn-submit").attr('disabled', true)
                $.ajax({
                    url: '{{ route('api.posts.slug.check') }}',
                    type: 'GET',
                    dataType: 'json',
                    data: {slug: $(this).val()},
                    success: function (response) {
                        if (response.success) {
                            $("#btn-submit").attr('disabled', false);
                        }
                    }
                });
            })

            $("#form-create-post").validate({
                rules: {},
                submitHandler: function () {
                    checkCompany()
                }
            });


        });
    </script>

@endpush

