@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Show Item</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary"
                    href="{{ route('ToDo.index')}}">
                    Back
                </a>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <strong>Item:</strong>
                @if ($ToDo->status === 'active')
                    {{ $ToDo->text }}
                @else
                    <del> {{ $ToDo->text }} </del>
                @endif
            </div>
            <div class="form-group">
                <strong>Status:</strong>
                @if ($ToDo->status === 'active')
                    Active
                @else
                    Finished
                @endif
            </div>
        </div>
    </div>
@endsection