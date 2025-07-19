<!DOCTYPE html>
<html lang="en">
   <head>
     @include('../includes.head')
</head>
  
<body>
  <div id="app">
   <div class="main-wrapper main-wrapper-1">  
         @include('../includes.header')
            <!-- Sidebar  -->
         @include('../includes.sidebar')
            <!-- end topbar -->
               
            <!-- Main Content -->
               @yield('content')    
            </div>
         </div>
         @include('../includes.footer')
      </body>
</html>