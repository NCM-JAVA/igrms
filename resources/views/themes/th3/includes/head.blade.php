<head>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ $title ??''}}</title> 
    <meta name="Keywords" content="DCPW">
    <meta name="Description" content="DCPW">
    <meta name="title" content="DCPW">
    <meta name="language" content="EN">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    <link rel="icon" href="{{ url('/public/themes/th3/assets/images/logo.png') }}" />

    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/swiper-bundle.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/bootstrap-icons.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/bootstrap.min.css')}}"/>
    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/animate.min.css')}}">
    <link rel="stylesheet" ref="https://cdn.jsdelivr.net/npm/photo-sphere-viewer@4/dist/photo-sphere-viewer.css">
    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/fontawesome/css/all.min.css')}}"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" />
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/css/style.css')}}" id="theme">
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/css/blue.index.css')}} " id="blue-css" disabled>
    <link rel="stylesheet" href="{{ URL::asset('/public/themes/th3/assets/css/BW-css.css')}} " id="BW-css" disabled>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="{{ URL::asset('/public/assets/css/css/pannellum.css')}}">
    <!-- Latest compiled and minified JavaScript -->
    <script src= "{{ URL::asset('/public/assets/js/js/pannellum.js')}}"></script>
    
    <script>
      let originalFontSize = 16;
      let currentFontSize = originalFontSize;

      function increaseFontSize() {
          if (currentFontSize < originalFontSize + 2 * 2) { // Allow only 2 steps increase
              currentFontSize += 2;
              document.body.style.fontSize = currentFontSize + 'px';
          }
      }

      function decreaseFontSize() {
          if (currentFontSize > originalFontSize - 2 * 2) { // Allow only 2 steps decrease
              currentFontSize -= 2;
              document.body.style.fontSize = currentFontSize + 'px';
          }
      }

      function resetFontSize() {
          currentFontSize = originalFontSize;
          document.body.style.fontSize = originalFontSize + 'px';
      }
  </script>
  <script>

    function themeSwitcher(theme) {
        let blue_theme = document.getElementById('blue-css');
        let BW_theme = document.getElementById('BW-css');
        console.log(localStorage.getItem('blue'));
        if (theme === 'blue') {
            blue_theme.removeAttribute("disabled")
            BW_theme.setAttribute("disabled", true)
            localStorage.setItem('theme', 'blue')
        }
        else if (theme === 'BW') {
            BW_theme.removeAttribute("disabled")
            blue_theme.setAttribute("disabled", true)
            localStorage.setItem('theme', 'BW')

        } 
        if (theme == 'default') {
            BW_theme.setAttribute("disabled", true)
            blue_theme.setAttribute("disabled", true)
            localStorage.setItem('theme', 'default')
        }
    }

    function applyStoredTheme() {
        let storedTheme = localStorage.getItem('theme');
        if (storedTheme) {
            themeSwitcher(storedTheme);
        }
        else {
            themeSwitcher('default')
        }
    }

</script>

</head>