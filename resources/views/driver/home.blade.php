

@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Welcome Uber Driver</h2>

        {{-- Ici tu appelles ton composant Vue --}}
        <div id="app">
            <request-details></request-details>
        </div>

@endsection

