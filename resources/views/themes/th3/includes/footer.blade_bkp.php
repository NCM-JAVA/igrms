
  
<!-- ----------------------Footer Start-------------------------- -->
<footer>
    <div class="d-flex justify-content-center py-2 footer_upper">
          <?php   $pos=[3,4];
            $langid=session()->get('locale')??1;
            $res= get_menu($langid,$pos,0) ; $i=1; 
            $pageurl = clean_single_input(request()->segment(2));
            ?>
             @foreach($res as $mod)
                @if($mod->m_type==2)
                    <a target="_blank" href="{{ url('/public/upload/admin/cmsfiles/menus/') }}/{{$mod->doc_uplode}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                @elseif($mod->m_type==3)
                <a target="_blank" href="{{$mod->linkstatus}}" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
            
                @else
                <a href="@if($mod->m_url=='#') '' @else {{ url('/pages') }}/{{$mod->m_url}} @endif" title="{{$mod->m_name}}" > {{$mod->m_name}}</a>
                
                @endif
                <?php $i++ ; ?>
               @endforeach
        
    </div>
    <div class="footer_bottom d-flex justify-content-between py-3 px-5">
        <p> {{ date('Y') }} . {{get_title('footercontained',$langid)->title}}</p>
        <p>{{get_title('helpline',$langid)->title}}</p>
    <p>{{get_title('Visitors',$langid)->title}}:- {{get_visitor_count()}}	</p>
    </div>
</footer>


  
<script src="{{ URL::asset('/public/themes/th3/assets/JS/main.js')}}"></script>
<script src="{{ URL::asset('/public/themes/th3/assets/JS/font-size-new.js')}}"></script>
<script src="{{ URL::asset('/public/themes/th3/assets/JS/styleswitcher.js')}}"></script>
 <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="{{ URL::asset('/public/themes/th3/assets/bootstrap-5.0.2-dist/js/bootstrap.min.js')}}"></script>
 <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.0.1/js/bootstrap.min.js" integrity="sha512-EKWWs1ZcA2ZY9lbLISPz8aGR2+L7JVYqBAYTq5AXgBkSjRSuQEGqWx8R1zAX16KdXPaCjOCaKE8MCpU0wcHlHA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>   -->
 <script src="{{ URL::asset('/public/themes/th3/JS/clientside.validation.js')}}"></script>
    <script> 
    function sitevisit()
    {
        var ret_val = confirm("This is an external link. Do you wish to open in new window.");
        if (ret_val == true)
        {
            return true;
        } else
        {
            return false;
        }
    }
    function change_language(data){
		//alert(data.value);
		if(data.value==1)
		{
            var ret_val = confirm("Switch To English");
			return true;
		}
		else
		{
            var ret_val = confirm("Switch To Hindi");
			return false;
		}
	}

    function myFunction() {
        window.print();
    }
  </script>
  <script type="text/javascript">
  
    var url = "{{ route('changeLang') }}";

    $(".changeLang").change(function(){
        window.location.href = url + "?lang="+ $(this).val()??1;
    });
  
  </script>
  <script>
    const modal = document.getElementById("myModal");
    const modalImg = document.getElementById("img01");
    let images = [];
    let currentImageIndex = 0;

    function openModal(imageSrc, categoryImages) {
        modal.style.display = "block";
        setTimeout(() => {
            modal.classList.add("show");
            modalImg.src = imageSrc;
            images = categoryImages;
            currentImageIndex = categoryImages.indexOf(imageSrc);
        }, 10);
    }

    function closeModal() {
        modal.classList.remove("show");
        setTimeout(() => {
            modal.style.display = "none";
        }, 500);
    }

    function nextSlide() {
        if (images.length === 0) return;
        currentImageIndex = (currentImageIndex + 1) % images.length;
        modalImg.src = images[currentImageIndex];
    }

    // Close the modal if the user clicks outside of it
    window.onclick = function (event) {
        if (event.target == modal) {
            closeModal();
        }
    };
</script>
</body>

</html>