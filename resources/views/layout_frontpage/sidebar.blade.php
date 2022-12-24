<div class="col-md-3">
    <div class="card card-refine card-plain">
        <form>

            <div class="card-content">
                <h4 class="card-title">
                    {{ __('frontpage.searchtitle') }}
                    <a href="{{ route('homepage.index') }}"
                        class="btn btn-default btn-fab btn-fab-mini btn-simple pull-right" rel="tooltip" title=""
                            data-original-title="{{ __('frontpage.hoversearchtitle') }}">
                        <i class="material-icons">cached</i>
                    </a>
                </h4>

                <div class="panel panel-default panel-rose">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseFilter" aria-expanded="false" aria-controls="collapseFilter">
                            <h4 class="panel-title"> Filter </h4>
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </div>
                    <div id="collapseFilter" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">
                        <div class="panel-body">
                            <div class="checkbox">
                                <select class="form-control" name="remotable">
                                    @foreach($filtersPostRemotable as $key => $val)
                                        <option value="{{ $val }}" @if($remotable == $val) selected @endif >
                                            {{ __('frontpage.' . $key) }}
                                        </option>

                                    @endforeach
                                </select>
{{--                                @if()--}}
{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input--}}
{{--                                                type="checkbox"--}}
{{--                                                value="{{  }}"--}}
{{--                                                data-toggle="checkbox"--}}
{{--                                                name="cities[]"--}}
{{--                                                @if(in_array($city, $searchCities))--}}
{{--                                                    checked--}}
{{--                                                @endif--}}
{{--                                            >--}}
{{--                                            <span--}}
{{--                                                class="checkbox-material"><span class="check"></span></span>--}}
{{--                                            {{ $city }}--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                @endif--}}
                            </div>


                        </div>

                    </div>
                </div>

                <div class="panel panel-default panel-rose">
                    <div class="panel-heading" role="tab" id="headingOne">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapsePrice" aria-expanded="false" aria-controls="collapsePrice">
                            <h4 class="panel-title"> {{ __('frontpage.pricerange') }}</h4>
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </div>

                    <div id="collapsePrice" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingOne">

                        <input type="hidden" name="min_salary" value="{{ $minSalary }}" id="input-min-salary">
                        <input type="hidden" name="max_salary" value="{{ $maxSalary }}" id="input-max-salary">
                        <div class="panel-body panel-refine">
                            <span class="price-left pull-left">
                                $<span id="span-min-salary">{{ $minSalary }}</span>
                            </span>
                            <span class="price-right pull-right" >
                                $<span id="span-max-salary">{{ $maxSalary }}</span>
                            </span>
                            <div class="clearfix"></div>
                            <div id="sliderRefine"
                                 class="slider slider-rose noUi-target noUi-ltr noUi-horizontal"></div>
                        </div>
                    </div>
                </div>


                <div class="panel panel-default panel-rose">
                    <div class="panel-heading" role="tab" id="headingThree">
                        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion"
                           href="#collapseLocation" aria-expanded="false" aria-controls="collapseLocation">
                            <h4 class="panel-title">{{ __('frontpage.location') }}</h4>
                            <i class="material-icons">keyboard_arrow_down</i>
                        </a>
                    </div>
                    <div id="collapseLocation" class="panel-collapse collapse in" role="tabpanel"
                         aria-labelledby="headingThree">
                        <div class="panel-body">
                            @foreach($arrCity as $city)
                                <div class="checkbox">
                                    <label>
                                        <input
                                            type="checkbox"
                                            value="{{ $city }}"
                                            data-toggle="checkbox"
                                            name="cities[]"
                                            @if(in_array($city, $searchCities))
                                                checked
                                            @endif
                                        >
                                        <span
                                            class="checkbox-material"><span class="check"></span></span>
                                        {{ $city }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="page" value="{{ $page }}">
            <button class="btn btn-rose btn-round" style="">
                <i class="material-icons">search</i>
                {{ __('frontpage.search') }}
            </button>
        </form>
    </div>
</div>

