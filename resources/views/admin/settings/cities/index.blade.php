@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>{{$country->name_en .' - '. __('Cities') }} ({{$total}})</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('admin.countries.index') }}"
                                   class="btn btn-outline-info m-2">{{ __('All Countries') }}</a>

                                <a href="{{ route('admin.cities.create',['country'=>$country->id]) }}"
                                   class="btn btn-primary m-2"><i class="cil-plus"></i> {{ __('Add City') }}</a>
                            </div>
                            <br>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('English Name') }}</th>
                                    <th>{{ __('Arabic Name') }}</th>
                                    <th>{{ __('Delivery Fee') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($cities as $city)
                                    <tr>
                                        <td>{{ $city->translate('en')->name }}</td>
                                        <td>{{ $city->translate('ar')->name }}</td>
                                        <td>{{ $city->delivery_fee }}</td>
                                        <td>
                                            <a href="{{ route('admin.cities.edit', ['country'=>$country->id,'city'=>$city->id]) }}"
                                               class="btn btn-primary"><i class="cil-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.cities.destroy', ['country'=>$country->id,'city'=>$city->id] ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('You will delete a city. Are you sure?')"
                                                    class="btn btn-danger"><i class="cil-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $cities->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
