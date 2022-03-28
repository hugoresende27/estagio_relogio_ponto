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
           <ol class="list-group ">
               <li class="list-group-item ">
                Required fields are in <span style="background-color: rgb(240, 138, 131)">pink</span>
               </li>
               <li class="list-group-item ">
                Regist a Company to start (need address)
               </li>
               <li class="list-group-item ">
                Regist a Employee in the Company (need address)
               </li>
           </ol>

       
          
           
        </div>
    @endauth
        
     
        
@endsection