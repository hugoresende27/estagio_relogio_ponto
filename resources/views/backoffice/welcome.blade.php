@extends('backoffice.app')

@section('content')
    
    @guest
    <div class="mytitle text-center">
        <button class="btn btn-secondary"> <a href="{{ url('login') }}">Login</a> </button>
    </div>
    @endguest
        
     
        
@endsection