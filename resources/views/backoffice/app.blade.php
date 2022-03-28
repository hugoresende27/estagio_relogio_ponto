<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ url('css/my_styles.css') }}">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Relogio Ponto</title>
  </head>

  <body class=" text-white ">


    <a href="\">
      <div class="mytitle text-center">
        
        
        <h1>Relogio de Ponto </h1>
        <h2 >BackOffice</h2>
      
      </div>
    </a>
    @auth
      {{-- <a href="/"><button class="btn btn-success homeBtn">HOME</button></a> --}}

      <div class="text-center" >
        <form action="{{ url('api/search') }}" method="GET">
            {{ csrf_field() }}
            <input type="text" name="search" class="inputSearch" required/>
            <button type="submit" class="submitBtn">Search</button>
        </form>
       </div>

    @endauth
  
    
    
    @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif


    
    @auth

    <div class="mylogin">
      <h5>User Details</h5>

      {{-- <img class ="" src="{{  asset(Auth::user()->image->image_path) }}" alt="Avatar" style="width:100%;"> --}}
      <p> {{ Auth::user()->name }}</p>
      <p> {{ Auth::user()->email }}</p>    
      <p>  TENANT ID: {{ Auth::user()->tenant_id }}</p>
      {{-- <p>   {{ Auth::user()->tenant->name }}</p> --}}
        <p><a href="{{ route('logout') }}">   <button class="btn btn-secondary " > Logout </button> </a> </p>
    </div>

    <div class="text-center p-6">


      <div class="links p-6">
          <a href="{{ url('admin') }}">   <button class="btn btn-secondary"> Admin  </button> </a> 
          <a href="{{ url('companies') }}">   <button class="btn btn-secondary">Companies  </button> </a>
          <a href="{{ url('departments') }}">   <button class="btn btn-secondary">Departments  </button> </a>
          <a href="{{ url('employees') }}">   <button class="btn btn-secondary">Employees  </button> </a>
          <a href="{{ url('clockpointentry') }}">   <button class="btn btn-secondary">Clockpoint Reg  </button> </a>           
          <a href="{{ url('schedules') }}">   <button class="btn btn-secondary">Schedules  </button> </a>
          <a href="{{ url('locations') }}">   <button class="btn btn-secondary">Locations  </button> </a>
          <a href="{{ url('files') }}">   <button class="btn btn-secondary">Files  </button> </a>
          <a href="{{ url('images') }}">   <button class="btn btn-secondary">Images  </button> </a>
      </div>
     

      @endauth
     
  </div>
        
  
           
    <div class="container ">
    
                
                @yield('content')
                
        
    </div>

    <footer>
        <div class="navbar navbar-default navbar-fixed-bottom">
            <div class="container" style="font-size: .8em">
                <p class="navbar-text">
                  &copy;Hugo Resende
                </p>
               
            </div>
        </div>
    </footer>

    <script>

      // SCRIPT IMAGES LOAD FORM
      function preview() {
      frame.src=URL.createObjectURL(event.target.files[0]);
  }
  
  </script>
      
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>