@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$country->translate('en')->name .' - '. __('Edit') }}: {{ $city->translate('en')->name }}</h4>
                        </div>
                        <div class="card-body">
                            <form method="POST"
                                  action="{{ route('admin.cities.update',['country'=>$country->id,'city'=>$city->id]) }}">
                                @csrf
                                @method('PUT')

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label class="form-col-form-label">{{ __('English Name') }}</label>
                                        <input class="form-control @error('name_en') is-invalid @enderror" type="text"
                                               name="name_en" value="{{old('name_en',$city->translate('en')->name)}}" required
                                               autofocus>
                                        @error('name_en')
                                        <div class="invalid-feedback">{{ $errors->first('name_en') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label>{{ __('Arabic Name') }}</label>
                                        <input class="form-control @error('name_ar') is-invalid @enderror" type="text"
                                               name="name_ar" value="{{old('name_ar',$city->translate('ar')->name)}}" required>
                                        @error('name_ar')
                                        <div class="invalid-feedback">{{ $errors->first('name_ar') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group row">
                                        <label>{{ __('Delivery Fee') }}</label>
                                        <input class="form-control @error('delivery_fee') is-invalid @enderror"
                                               type="number" step="0.01"
                                               name="delivery_fee" value="{{old('delivery_fee',$city->delivery_fee)}}" required>
                                        @error('delivery_fee')
                                        <div class="invalid-feedback">{{ $errors->first('delivery_fee') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">{{ __('Save') }}</button>
                                <a href="{{ route('admin.cities.index',['country'=>$country->id]) }}"
                                   class="btn btn-primary">{{ __('Return') }}</a>

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
