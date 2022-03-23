@extends('backoffice.app')

@section('content')
    

       <div class="text-center p-6">

        @auth
      
        <div>
            USER: {{ Auth::user()->email }}
        </div>

        <div class="links p-6">
           <button class="btn btn-secondary"> <a href="admin">Admin</a>  </button>
           <button class="btn btn-secondary"> <a href="employees">Employees</a></button>
           <button class="btn btn-secondary"> <a href="companies">Companies</a></button>
           <button class="btn btn-secondary"> <a href="departments">Departments</a></button>
           <button class="btn btn-secondary"> <a href="locations">Locations</a></button>
           <button class="btn btn-secondary"> <a href="schedules">Schedules</a></button>
           <button class="btn btn-secondary"> <a href="files">Files</a></button>
        </div>
     
     

       
          <button class="btn btn-secondary"> <a href="{{ route('logout') }}">Logout</a>

        @else

          <button class="btn btn-secondary"> <a href="{{ url('login') }}">Login</a>

        @endauth
       
      </div>
     
        
@endsection