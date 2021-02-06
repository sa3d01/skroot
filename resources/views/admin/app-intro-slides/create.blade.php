@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Create Country') }}</h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.countries.store') }}">
                                @csrf

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="form-col-form-label">{{ __('English Name') }}</label>
                                        <input class="form-control @error('name_en') is-invalid @enderror" type="text"
                                               name="name_en" value="{{old('name_en')}}" required autofocus>
                                        @error('name_en')
                                        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label>{{ __('Arabic Name') }}</label>
                                        <input class="form-control @error('name_ar') is-invalid @enderror" type="text"
                                               name="name_ar" value="{{old('name_ar')}}" required>
                                        @error('name_ar')
                                        <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">{{ __('Add') }}</button>
                                <a href="{{ route('admin.countries.index') }}" class="btn btn-primary">{{ __('Return') }}</a>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
