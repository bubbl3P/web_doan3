@extends('layout_frontpage.master')
@section('content')
    <div class="row">
        <div class="col-md-6 col-sm-6">
            <div class="tab-content">
                <div class="card card-pricing">
                    <div class="card-content">
                        <h3 class="category-social text-success ">
                            <a>DETAIL</a>
                        </h3>
                        <ul>
                            <li class=""> Working form: {{ $post->remotable_name }}</li>

                            <li>
                                @if($post->experience)
                                    Experience: {{ $post->experience }} years
                                @else
                                    Experience:
                                @endif
                            </li>
                            <li>
                                @if($post->date)
                                    Apply from: {{ $post->date }}
                                @else
                                    Apply from:
                                @endif
                            </li>
                            <li>
                                @if($post->number_applicants)
                                    Number of recruits: {{ $post->number_applicants }} people
                                @else
                                    Number of recruits:
                                @endif
                            </li>
                            <li>
                                @if($post->salary)
                                    Salary: {{ $post->salary }}
                                @else
                                    Salary:
                                @endif
                            </li>
                            <li>
                                @if($post->can_parttime)
                                    <i class="material-icons text-success">check </i>  Part Time
                                @else
                                    <i class="material-icons text-danger">close</i>  Part Time
                                @endif
                            </li>
                            <li>
                                @if($post->remotable)
                                    <i class="material-icons text-success">check </i>  Remote
                                @else
                                    <i class="material-icons text-danger">close</i>  Remote
                                @endif
                            </li>
                            {{--                            <li><i class="material-icons text-danger">close</i> Private Messages</li>--}}
                            {{--                            <li><i class="material-icons text-danger">close</i> Personal Brand</li>--}}
                        </ul>
                        <a href="#" class="btn btn-primary btn-round">
                            Apply now!
                        </a>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <h2 class="title">
                @if(is_null($post->company->logo))
                    <img src="" alt="">
                @else
                    <img src="{{ $post->company->logo}}" alt="">
                @endif
                <span>{{ $post->job_title }}</span>
            </h2>
            <h3>
                <a>
                    <span style="color: black">Company: </span> {{ $post->company->name }}
                </a>

            </h3>
            <h3>
                <a>
                    <span style="color: black">Address: </span> {{ $post->location }}
                </a>
            </h3>
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
                                <p> {{ $post->requirement }} </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel-group" id="accordion">
                    <div class="panel panel-border panel-default">
                        <div class="panel-heading" role="tab" id="headingOne">
                            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                               aria-expanded="true" aria-controls="collapseTwo">
                                <h4 class="panel-title">
                                    Job description
                                    <i class="material-icons">keyboard_arrow_down</i>
                                </h4>
                            </a>
                        </div>
                        <div id="collapseTwo" class="panel-collapse collapse in">
                            <div class="panel-body">
                                <p> {{ $post->job_description }} </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if($post->file)
                    <div class="row text-right">
                        <a class="btn btn-rose btn-round" href="{{ $post->file->link }}" target="_blank">
                            Open File &nbsp;
                            <i
                                class="fa fa-file">
                            </i>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
        DSDASDSA
    </div>
    <div class="col-md-6 col-sm-6">
DSADSADSADSA
    </div>

@endsection
