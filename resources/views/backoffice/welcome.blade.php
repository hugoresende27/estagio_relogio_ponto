@extends('backoffice.app')

@section('content')
    
    @guest
    <div class="mytitle text-center">
        <a href="{{ url('login') }}">  <button class="btn btn-secondary"> Login </button></a>
        <a href="{{ url('registerweb') }}"><button class="btn btn-secondary"> Register </button></a>
    </div>
    @endguest
        
     
        
@endsection