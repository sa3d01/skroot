@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Countries') }} ({{$total}})</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('admin.countries.create') }}"
                                   class="btn btn-primary m-2"><i class="cil-plus"></i> {{ __('Add Country') }}</a>
                            </div>
                            <br>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('English Name') }}</th>
                                    <th>{{ __('Arabic Name') }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($countries as $country)
                                    <tr>
                                        <td>{{ $country->translate('en')->name }}</td>
                                        <td>{{ $country->translate('ar')->name }}</td>
                                        <td>
                                            <a href="{{route('admin.cities.index',['country'=>$country->id])}}"
                                               class="btn btn-block btn-outline-dark">{{ __('Cities') }}</a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.countries.show', $country->id) }}"
                                               class="btn btn-primary"><i class="cil-notes"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.countries.edit', $country->id) }}"
                                               class="btn btn-primary"><i class="cil-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.countries.destroy', $country->id ) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('You will delete a country. Are you sure?')"
                                                    class="btn btn-danger"><i class="cil-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $countries->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
