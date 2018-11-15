@extends('layouts.portal')

@section('title')
    Dashboard
@endsection

@section('content')

    {{--<div class="mdl-grid  content">--}}
    {{--<div class="mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid">--}}
        <iframe src="{{ url('/') }}" style="width: 100%; height: 92vh"></iframe>
    {{--</div>--}}
    {{--</div>--}}
@endsection
