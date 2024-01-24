@extends('layouts.app')

@section('content')
<div class="container-xl">
    <div class="row g-2 align-items-center my-3">
        @auth
        <a href="{{ route('events.index') }}"
            class="">Dashboard Event List
        </a>
        
        @endauth
    </div>
</div>
@endsection