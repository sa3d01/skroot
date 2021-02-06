@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Create Customer') }}</h4></div>
                        <div class="card-body">
                            <form method="POST" action="{{ route('admin.parts.index') }}">
                                @csrf

                                {{-- Category --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Category') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('part_category_id') is-invalid @enderror"
                                                name="part_category_id">
                                            @foreach($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('part_category_id')
                                        <div class="invalid-feedback">{{ $errors->first('part_category_id') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Car Brand --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Car Brand') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('car_brand_id') is-invalid @enderror"
                                                name="car_brand_id" id="car_brand_list">
                                            @foreach($brands as $brand)
                                                <option value="{{$brand->id}}">{{$brand->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('car_brand_id')
                                        <div class="invalid-feedback">{{ $errors->first('car_brand_id') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Brand Model --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Brand Model') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <select class="form-control @error('car_brand_model_id') is-invalid @enderror"
                                                name="car_brand_model_id" id="models_list">
                                            @foreach($models as $model)
                                                <option value="{{$model->id}}">{{$model->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('car_brand_model_id')
                                        <div class="invalid-feedback">{{ $errors->first('car_brand_model_id') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- English Name --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('English Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('en.name') is-invalid @enderror" type="text"
                                               name="en[name]" value="{{old('en.name')}}" required autofocus>
                                        @error('en.name')
                                        <div class="invalid-feedback">{{ $errors->first('en.name') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Arabic Name --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Arabic Name') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('ar.name') is-invalid @enderror" type="text"
                                               name="ar[name]" value="{{old('ar.name')}}" required autofocus>
                                        @error('ar.name')
                                        <div class="invalid-feedback">{{ $errors->first('ar.name') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- English Description --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('English Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                      <textarea class="form-control @error('en.description') is-invalid @enderror"
                                                name="en[description]" required>{{old('en.description')}}</textarea>
                                        @error('en.description')
                                        <div class="invalid-feedback">{{ $errors->first('en.description') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Arabic Description --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Arabic Description') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <textarea class="form-control @error('ar.description') is-invalid @enderror"
                                                  name="ar[description]" required>{{old('ar.description')}}</textarea>
                                        @error('ar.description')
                                        <div class="invalid-feedback">{{ $errors->first('ar.description') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Year --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Year') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('year') is-invalid @enderror" type="number"
                                               name="year" value="{{old('year')}}" required autofocus>
                                        @error('year')
                                        <div class="invalid-feedback">{{ $errors->first('year') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Price --}}
                                <div class="form-group row mb-4">
                                    <label
                                        class="col-form-label text-md-right col-12 col-md-3 col-lg-3">{{ __('Price') }}</label>
                                    <div class="col-sm-12 col-md-7">
                                        <input class="form-control @error('price') is-invalid @enderror" type="number"
                                               step="0.01" name="price" value="{{old('price')}}" required autofocus>
                                        @error('price')
                                        <div class="invalid-feedback">{{ $errors->first('price') }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <button class="btn btn-success" type="submit">{{ __('Add') }}</button>
                                <a href="{{ route('admin.parts.index') }}"
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
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {

            hydrateBrandModels($("#car_brand_list").val());

            /* ----------------------------//
            // --- Hydrate BrandModels --- //
            //---------------------------- */
            $('#car_brand_list').on('change', function (e) {
                const brandIdSelected = this.value;
                hydrateBrandModels(brandIdSelected);
            });

            function hydrateBrandModels(brandId) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
                $.ajax({
                    type: "GET",
                    data: {brandId: brandId},
                    url: '{{route('admin.json.brand-models')}}',
                    dataType: 'json',
                    success: function (data) {
                        const $el = $("#models_list");
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
