@extends('layouts.modal')

@section('title')
    Create page
@endsection

@section('content')
    <form id="create" method="post" action="{{ url('/page/save') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label>Type:</label>
            <select class="mdl-select" name="type">
                @foreach($types as $type)
                    <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                @endforeach
            </select>
        </div>
        <div class="mdl-textfield mdl-js-textfield form-group">
            <label>Title:</label>
            <input name="title" class="mdl-textfield__input" type="text">
        </div>
    </form>
@endsection
