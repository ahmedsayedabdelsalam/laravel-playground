@extends('layouts.app')

@section('content')
<div class="row" style="position: relative;">
    <div class="col-10">
        left
    </div>
    <div class="col-2" style="position: fixed; right:0; height: 100%">
        <chat-bar></chat-bar>
    </div>
</div>
@endsection
