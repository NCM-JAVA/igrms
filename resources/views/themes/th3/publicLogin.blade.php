@extends('layouts.publicthemes')

@section('content')

@php
$pageurl = clean_single_input(request()->segment(2));
$langid1 = session()->get('locale')??1;
@endphp
<!--************************breadcrumb********************-->

<!--**********************************mid part******************-->
<!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

<style>
.w3-teal, .w3-hover-teal:hover {
    color: #fff !important;
    background-color: #009688 !important;
}
    .w3-animate-left {
    position: relative;
    animation: animateleft 0.4s;
}
.public_sidebar a{
    text-decoration:none !important;
}
.w3-sidebar {
    height: 100%;
    width: 250px;
    /* position: fixed !important; */
    z-index: 1;
    overflow: hidden;
}

.w3-bar-block .w3-bar-item {
    width: 100%;
    display: block;
    padding: 8px 16px;
    text-align: left;
    border: none;
    white-space: normal;
    float: none;
    outline: 0;
}
@keyframes animateleft {
  from {
    transform: translateX(-100%);
  }

  to {
    transform: translateX(0%);
  }
}
.nav-pills .nav-link.active, .nav-pills .show>.nav-link {
    color: #fff;
    background-color: #0d6efd;
}
</style>

<div class="d-flex public_sidebar">



<div class="w3-sidebar w3-bar-block w3-collapse w3-card w3-animate-left bg-dark"  id="mySidebar">
    <div class="d-flex w-100 justify-content-end">
        <a class="" onclick="w3_close()">&times;</a>
    </div>
  <ul class="nav nav-pills flex-column mb-auto">
      <li class="nav-item">
        <a href="#" class="nav-link active" aria-current="page">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#home"></use></svg>
          Online Data Collection
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#speedometer2"></use></svg>
          Edit Profile
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#table"></use></svg>
          Orders
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#grid"></use></svg>
          Products
        </a>
      </li>
      <li>
        <a href="#" class="nav-link text-white">
          <svg class="bi me-2" width="16" height="16"><use xlink:href="#people-circle"></use></svg>
          Customers
        </a>
      </li>
    </ul>
</div>

<div class="w3-main w-100 pl-2" >
<div class="w3-teal">
  <button class="w3-button w3-teal w3-xlarge w3-hide-large" onclick="w3_open()">&#9776;</button>
  <div class="w3-container">
    <h1>My Page</h1>
  </div>
</div>

<div class="w3-container">
  <h3>Responsive Sidebar</h3>
  <p>The sidebar in this example will always be displayed on screens wider than 992px, and hidden on tablets or mobile phones (screens less than 993px wide).</p>
  <p>On tablets and mobile phones the sidebar is replaced with a menu icon to open the sidebar.</p>
  <p>The sidebar will overlay of the page content.</p>
  <p><b>Resize the browser window to see how it works.</b></p>
</div>
   
</div>
</div>

<script>
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}

function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>
       
 


@endsection