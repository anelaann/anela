@extends('layout')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>To Do Application</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('ToDo.create') }}">
                    Add New Item
                </a>
            </div>
        </div>
    </div>
    

    @if($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <table class="table table-bordered">
        <tr>
            <th>No.</th>
            <th>Item</th>
            <th>Status</th>
            <th style="width:280px">Action</th>
        </tr>

        @foreach($ToDo as $item)
            <tr>
                <td>{{ ++$i }}</td>
                @if ($item->status == 'inactive')
                    <td><del>{{ $item->text }}</del></td>
                    <td>Finished</td>
                @else
                    <td>{{ $item->text }}</td>
                    <td>Active
                @endif
                
                <td>
                    <form action="{{ route('ToDo.destroy', $item->id) }}" method="POST">
                        <a class="btn btn-info" 
                            href="{{ route('ToDo.show', $item->id) }}">
                            Show
                        </a>

                        <a class="btn btn-primary"
                            href="{{ route('ToDo.edit', $item->id) }}">
                            Edit
                        </a>

                        {{-- @csrf 
                        @method('DELETE')
                        --}}

                        {{ csrf_field() }}
                        {{ method_field('DELETE') }}

                        <button type="submit" class="btn btn-danger">
                            Delete
                        </button>

                    </form>
                </td>
            </tr>
        @endforeach
    </table>

    {!! $ToDo->links() !!}

@endsection