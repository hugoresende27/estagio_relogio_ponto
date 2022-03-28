@extends('backoffice.app')

@section('content')
    
    @guest
    <div class="mywelcome text-center">
        <a href="{{ url('login') }}">  <button class="btn btn-secondary"> Login </button></a>
        <a href="{{ url('registerweb') }}"><button class="btn btn-secondary"> Register </button></a>
    </div>
    @endguest

    @auth
        <div class="mycenter">
            <h1>Welcome  {{ Auth::user()->name }}, tenant ID {{ Auth::user()->tenant_id }} </h1>
            <h3>Required fields are in <span style="background-color: rgb(240, 138, 131)">pink</span></h3>
        </div>
    @endauth
        
     
        
@endsection