@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Parts') }} ({{$total}})</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('admin.parts.create') }}"
                                   class="btn btn-primary m-2"><i class="cil-plus"></i> {{ __('Add Part') }}</a>
                            </div>
                            <br>

                            <table class="table table-responsive-sm table-hover table-outline mb-0">
                                <thead class="thead-light">
                                <tr>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Brand') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($parts as $part)
                                    <tr>
                                        <td>
                                            <div>{{$part->partCategory->name}}</div>
                                        </td>
                                        <td>
                                            <div>{{$part->name}}</div>
                                            <div class="small text-muted">{{$part->description}}</div>
                                        </td>
                                        <td>
                                            <div>{{$part->carBrandModel->name ?? ''}}</div>
                                            <div class="small text-muted"
                                            >{{ ($part->carBrand->name ?? '') ." - ". $part->year}}</div>
                                        </td>
                                        <td>
                                            <div>{{$part->price}}</div>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.parts.edit', $part->id) }}"
                                               class="btn btn-primary"><i class="cil-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.parts.destroy', $part->id ) }}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('You will delete a part. Are you sure?')"
                                                    class="btn btn-danger"><i class="cil-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>

                            {{ $parts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
