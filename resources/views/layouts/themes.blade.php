<!DOCTYPE html>
<html lang="en">
   @php
         $langid=session()->get('locale')??1;
   @endphp
   @php
   $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'';
   @endphp
 
   @include("../themes.{$themes}.includes.head")
  
  <!-- <script>
  function noBack(){ window.history.forward(); } //The forward method loads the next URL in the History list.
</script> -->
<!-- <body id="fontSize" onload="noBack();" onpageshow="if (event.persisted) noBack();"> -->
<body id="fontSize">
    <div id="app1">
      <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        @include("../themes.{$themes}.includes.header")
        @yield('content')
                
        @if($title !== "Home" && $title !== "Feedback")  
          <div class="text-end">
            <span class="page-updated-date px-3 text-align-right print_remove fw-bold">{{get_title('lastupdate',$langid1)->title}}: {{ get_last_updated_date($title) }} </span>
          </div>
        @endif
        
      </div>
    </div>
    @include("../themes.{$themes}.includes.footer")
  </body>
</html>