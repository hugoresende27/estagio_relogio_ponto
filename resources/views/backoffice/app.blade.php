<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/my_styles.css">

    {{-- TAILWIND --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Relogio Ponto</title>
  </head>

  <body class=" text-white ">

    <h1 class="mytitle">Relogio de Ponto </h1>
    <h2>BackOffice</h2>
    
    @auth

    <div class="mylogin card text-black p-3">
      <h5 class="card-title">User Details</h5>
      <p> EMAIL: {{ Auth::user()->email }}</p>
      <p> NAME: {{ Auth::user()->name }}</p>
      <p>  TENANT ID: {{ Auth::user()->tenant_id }}</p>
       <a href="{{ route('logout') }}">   <button class="btn btn-secondary"> Logout </button> </a> 
    </div>

    <div class="text-center p-6">


      <div class="links p-6">
          <a href="../admin">   <button class="btn btn-secondary"> Admin  </button> </a> 
          <a href="../clockpointentry">   <button class="btn btn-secondary">Clockpoint Reg  </button> </a>  
          <a href="../employees">   <button class="btn btn-secondary">Employees  </button> </a>
          <a href="../companies">   <button class="btn btn-secondary">Companies  </button> </a>
          <a href="../departments">   <button class="btn btn-secondary">Departments  </button> </a>
          <a href="../locations">   <button class="btn btn-secondary">Locations  </button> </a>
          <a href="../schedules">   <button class="btn btn-secondary">Schedules  </button> </a>
          <a href="../files">   <button class="btn btn-secondary">Files  </button> </a>
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
      
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
  </body>
</html>