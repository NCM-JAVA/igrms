<!DOCTYPE html>
<html lang="en">
   @php
         $langid=session()->get('locale')??1;
   @endphp
   @php
   $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'';
   @endphp
 
   @include("../themes.{$themes}.includes.head")
  
  <script>
  function noBack(){ window.history.forward(); } //The forward method loads the next URL in the History list.
</script>
<body id="fontSize">
    <div id="app1">
      <div class="main-wrapper main-wrapper-1">
        @include("../themes.{$themes}.includes.publicheader")
        @yield('content')
                
                
        
    </div>
    @include("../themes.{$themes}.includes.footer")
  </body>
</html>