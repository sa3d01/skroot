@extends('dashboard.base')

@section('content')
    <div class="container-fluid">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="card">
                        <div class="card-header"><h4>{{ __('Intro Slides') }} ({{$total}})</h4></div>
                        <div class="card-body">
                            <div class="row">
                                <a href="{{ route('admin.app-intro-slides.create') }}"
                                   class="btn btn-primary m-2"><i class="cil-plus"></i> {{ __('Add Intro Slide') }}</a>
                            </div>
                            <br>
                            <table class="table table-responsive-sm table-striped">
                                <thead>
                                <tr>
                                    <th>{{ __('English Title') }}</th>
                                    <th>{{ __('Arabic Title') }}</th>
                                    <th>{{ __('Sequence') }}</th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($slides as $slide)
                                    <tr>
                                        <td>{{ $slide->translate('en')->title }}</td>
                                        <td>{{ $slide->translate('ar')->title }}</td>
                                        <td>{{ $slide->order }}</td>
                                        <td>
                                            <a href="{{ route('admin.app-intro-slides.up', $slide->id) }}"
                                               class="btn btn-success"><i class="cil-arrow-thick-top"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.app-intro-slides.down', $slide->id) }}"
                                               class="btn btn-success"><i class="cil-arrow-thick-bottom"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.app-intro-slides.show', $slide->id) }}"
                                               class="btn btn-primary"><i class="cil-notes"></i></a>
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.app-intro-slides.edit', $slide->id) }}"
                                               class="btn btn-primary"><i class="cil-pencil"></i></a>
                                        </td>
                                        <td>
                                            <form action="{{ route('admin.app-intro-slides.destroy', $slide->id ) }}"
                                                  method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button
                                                    onclick="return confirm('You will delete a slide. Are you sure?')"
                                                    class="btn btn-danger"><i class="cil-trash"></i></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            {{ $slides->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('javascript')
@endsection
