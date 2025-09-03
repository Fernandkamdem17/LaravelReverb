

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Welcome Uber Passenger</h2>

        {{-- Ici tu appelles ton composant Vue --}}
        <div id="app">
            <request-travel></request-travel>
        </div>
    </div>
@endsection

