@extends('layout_frontpage.master')
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="tab-content">
                <div class="card card-pricing">
                    <div class="card-content">
                        <h3 class="category-social text-success ">
                            <a>Chi Tiết </a>
                        </h3>
                        <ul>
                            <li> {{ $post->remotable_name }}</li>
                            <li>
                                @if($post->can_parttime)
                                    <i class="material-icons text-success">check </i>  Part Time
                                @else
                                    <i class="material-icons text-danger">close</i>  Part Time
                                @endif

                            </li>
                            <li><i class="material-icons text-danger">close</i> Private Messages</li>
                            <li><i class="material-icons text-danger">close</i> Personal Brand</li>
                        </ul>
                        <a href="#pablo" class="btn btn-primary btn-round">
                            Get Started
                        </a>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <h2 class="title">
                {{ $post->job_title }}
            </h2>
            <h3>
                <a>
                    {{ $post->company->name }}
                </a>
            </h3>
            <h4 class="main-price">
                {{ $post->salary }}
            </h4>

            @isset( $post->requirement )
                <div id="acordeon">
                    <div class="panel-group" id="accordion">
                        <div class="panel panel-border panel-default">
                            <div class="panel-heading" role="tab" id="headingOne">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne"
                                   aria-expanded="true" aria-controls="collapseOne">
                                    <h4 class="panel-title">
                                        Requirement
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </h4>
                                </a>
                            </div>
                            <div id="collapseOne" class="panel-collapse collapse in">
                                <div class="panel-body">
                                    <p> {{ $post->requirement }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endisset

                    @isset($post->file)
                        <div class="row text-right">
                            <a class="btn btn-rose btn-round" href="{{ $post->file->link }}" target="_blank">
                                Open File &nbsp;
                                <i
                                    class="fa fa-file">
                                </i>
                            </a>
                        </div>
                    @endisset

                </div>
        </div>
@endsection
