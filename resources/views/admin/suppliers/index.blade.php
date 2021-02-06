@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Suppliers') }} ({{$total}})</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('admin.suppliers.create') }}"
                                   class="btn btn-primary m-2"><i class="cil-plus"></i> {{ __('Add Supplier') }}</a>
                            </div>
                            <br>

                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th class="text-center"><i class="c-icon c-icon-lg cil-people"></i></th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('City') }}</th>
                                    <th>{{ __('Last Login') }}</th>
                                    <th>{{ __('Registered') }}</th>
{{--                                    <th></th>--}}
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($suppliers as $supplier)
                                    <tr>
                                        <td class="text-center">
                                            <div class="c-avatar">
                                                <img class="c-avatar-img" src="{{$supplier->avatar_url}}"
                                                     alt="{{$supplier->email}}">
                                            </div>
                                        </td>
                                        <td>
                                            <div>{{$supplier->name}}</div>
                                            <div class="small text-muted">{{$supplier->email}}</div>
                                        </td>
                                        <td>
                                            <div>{{$supplier->city->name ?? ''}}</div>
                                            <div class="small text-muted">{{$supplier->country->name ?? ''}}</div>
                                        </td>
                                        <td>
                                            @if($supplier->last_login_at)
                                                <div class="small text-muted">
                                                    {{$supplier->last_login_at->diffForHumans()}}
                                                </div>
                                                <div class="small text-muted">
                                                    {{$supplier->last_login_at->format('d M Y - H:i')}}
                                                </div>
                                            @else
                                                <div class="small text-muted">
                                                    Never
                                                </div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="small text-muted">
                                                {{$supplier->created_at->diffForHumans()}}
                                            </div>
                                            <div class="small text-muted">
                                                {{$supplier->created_at->format('d M Y - H:i')}}
                                            </div>
                                        </td>

{{--                                        <td>--}}
{{--                                            <a href="{{ route('admin.suppliers.show', $supplier->id) }}"--}}
{{--                                               class="btn btn-primary"><i class="cil-notes"></i></a>--}}
{{--                                        </td>--}}
                                        <td>
                                            <a href="{{ route('admin.suppliers.edit', $supplier->id) }}"
                                               class="btn btn-primary"><i class="cil-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.suppliers.destroy', $supplier->id ) }}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('You will delete a supplier. Are you sure?')"
                                                    class="btn btn-danger"><i class="cil-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $suppliers->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
