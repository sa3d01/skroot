@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Edit') }}: {{ $customer->name }}</h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.customers.update',$customer->id) }}">
                                @csrf
                                @method('PUT')

                                {{-- Country --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Country') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('country_id') is-invalid @enderror"
                                                name="country_id" id="countries_list">
                                            @foreach($countries as $country)
                                                <option {{$customer->country_id ==$country->id?" selected ":""}}
                                                        value="{{$country->id}}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('country_id')
                                        <div class="invalid-feedback">{{ $errors->first('country_id') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- City --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('City') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('city_id') is-invalid @enderror"
                                                name="city_id" id="cities_list">
                                            @foreach($cities as $city)
                                                <option {{$customer->city_id ==$city->id?" selected ":""}}
                                                        value="{{$city->id}}">{{$city->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('city_id')
                                        <div class="invalid-feedback">{{ $errors->first('city_id') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Name --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('name') is-invalid @enderror" type="text"
                                               name="name" value="{{old('name',$customer->name)}}" required autofocus>
                                        @error('name')
                                        <div class="invalid-feedback">{{ $errors->first('name') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Email --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Email') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('email') is-invalid @enderror" type="email"
                                               name="email" value="{{old('email',$customer->email)}}" required autofocus>
                                        @error('email')
                                        <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Phone --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Phone') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('phone') is-invalid @enderror" type="text"
                                               name="phone" value="{{old('phone',$customer->phone)}}" required autofocus>
                                        @error('phone')
                                        <div class="invalid-feedback">{{ $errors->first('phone') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                                <a href="{{ route('admin.customers.index') }}" class="btn btn-primary">{{ __('Return') }}</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            hydrateCities($("#countries_list").val());

            /* -------------------------//
            // ---- Hydrate Cities ---- //
            //------------------------- */
            $('#countries_list').on('change', function (e) {
                const countryIdSelected = this.value;
                hydrateCities(countryIdSelected);
            });

            function hydrateCities(countryId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {countryId: countryId},
                    url: '{{route('admin.json.cities')}}',
                    dataType: 'json',
                    success: function (data) {
                        const $el = $("#cities_list");
                        $el.empty(); // remove old options
                        $.each(data, function (value, key) {
                            $el.append($("<option></option>").attr("value", key.id).text(key.name));
                        });
                    }
                });
            }

        });
    </script>
@endsection
