<?php

namespace App\Http\Controllers\themes;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Banner;
use App\Models\admin\Sanghralaya;
use App\Models\admin\Exhibition;
use App\Models\admin\ExhibitionCategory;
use App\Models\admin\Officer;
use App\Models\admin\Feedback;
use App\Models\admin\Whatsnew;
use App\Models\admin\Tender;
use App\Models\admin\Circular;
use App\Models\admin\Menu;
use Illuminate\Support\Facades\DB;
use App\Models\admin\Photogallery;
//use Session;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\admin\Logo;
use App\Models\admin\Vacancy;
use App\Models\admin\EventNews;


class HomeController extends Controller
{
    public function index()
    {
        $title = 'Home';
       
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        $banner =  Banner::where('txtstatus',3)->where('language',$langid)->orderBy('created_at', 'DESC')->latest()->take(3)->get();
        $officer = Officer::where('txtstatus',3)->where('designation','MD')->where('language',$langid)->select('id','officers_name','url','designation','contents','language','txtuplode','txtstatus')->first();
        $todate=date('Y-m-d');
        $today= date("Y-m-d", strtotime($todate));
        $whatsnew = Whatsnew::where('enddate','>' ,$today)->where('txtstatus',3)->where('language',$langid)->select('id','title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','startdate','enddate')->paginate(10);
		$tenders = Tender::where('txtstatus',3)->where('txtstatus',3)->where('language',$langid)->select('id','tender_title','language','description','url','txtuplode','txtweblink','txtstatus','start_date','end_date')->paginate(100);
		$recruitment = Circular::where('enddate','>' ,$today)->where('txtstatus',3)->where('circularstype', '5')->where('language',$langid)->select('id','title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','startdate','enddate')->paginate(20);
        $announcement = Circular::where('enddate','>' ,$today)->where('txtstatus',3)->where('circularstype', '3')->where('language',$langid)->select('id','title','url','page_url','is_new','language','menutype','metakeyword','metadescription','description','txtuplode','txtweblink','txtstatus','circularstype','startdate','enddate')->paginate(20);
        $vacancy = Vacancy::where('enddate','>' ,$today)->where('txtstatus',3)->where('vacancytype', '1')->where('language',$langid)->paginate(20);
        $circular = Circular::where('enddate','>' ,$today)->where('txtstatus',3)->where('circularstype', '1')->where('language',$langid)->paginate(20);
        $important	 = Menu::where('m_flag_id')->where('approve_status',3)->where('language_id',$langid)->orderBy('page_postion', 'ASC')->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->paginate(5);
        $logos = Logo::where('txtstatus',3)->where('language', $langid)->orderBy('id', 'DESC')->get();
        $photogallery = Photogallery::where('txtstatus',3)->where('language',$langid)->where('type',2)->orderBy('created_at','DESC')->select('id','title','description','language','txtuplode','txtstatus','admin_id')->get();
        // $sanghralaya = Sanghralaya::where('txtstatus',3)->where('language',$langid)->orderBy('created_at','DESC')->limit(3)->get();
        $sanghralaya = Sanghralaya::where('txtstatus',3)->where('language',$langid)->latest()->first();
        $exhibition = Exhibition::where('txtstatus',3)->where('language',$langid)->orderBy('created_at','DESC')->limit(4)->get();
        $eventNews = EventNews::latest()->first();
        
        return response()->view("themes/{$themes}/home", compact( 'logos','banner','officer','whatsnew','announcement','vacancy','circular','title','important','tenders','photogallery','sanghralaya','exhibition','eventNews'));
    }
    public function feedback()
    {
        $title = 'Feedback';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        // echo $themes;
        // die();
        return response()->view("themes/{$themes}/feedback", compact('title'));
    }

    public function feed_process(Request $request)
    {
        $rules = array(
            'name' => ['required','string','min:2','max:100','regex:/^[a-zA-Z0-9\s]+$/'],
            'email' => 'required|email|max:150',
            'message' => ['required','min:10','max:1000','regex:/^[a-zA-Z0-9\s]+$/'],
       );
       $validator = Validator::make($request->all(), $rules);
      
        if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
        }else{
           
         $code = clean_single_input($request->CaptchaCode); 
         $isHuman = captcha_validate($code); //die();
        if($isHuman)
        {
           $pArray['name']    				= clean_single_input($request->name); 
           $pArray['email']    				= clean_single_input($request->email);
           $pArray['message']    			= clean_single_input($request->message);
           $create 	= Feedback::create($pArray);
           if($create){
                //    $langid=session()->get('locale')??1;
                //    $cof_type = "EMAIL";
                //    $mail = get_mailsms_details($langid,$cof_type);
                //    if($mail){
                $name = $request->name;
                $email = $request->email;
                $message = $request->message;
            
            
                // \Mail::send('emails.visitor_email', ['name' => $name, 'email' => $email, 'phone' => $phone, 'comments' => $comments], function ($message) {
        
                //     $message->to("honeylucky2000@gmail.com")->subject('Subject of the message!');
                // });
        }


           return redirect('feedback')->with('success','Feedback has successfully Submitted');
        }else{
            return redirect('feedback')->with('error','Captcha Is Wrong.');
        }
           
       }


    }
    public function screenreader()
    {
        $title = 'Screen Reader Access';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        //echo $themes;
        //die();
        return response()->view("themes/{$themes}/screenreader", compact('title'));
    }
	
	public function sitemap()
    {
        $title = 'Sitemap';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
		$data= Menu::all();
        //echo $themes;
        //die();
		//dd($data);
        return response()->view("themes/{$themes}/siteMaps", compact(['title','data']));
    }
	
	public function touristdestination()
    {
        $title = 'Tourist Destination';
        $langid=session()->get('locale')??1;
		 $id = session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        //echo $themes;
        //die();
        return response()->view("themes/{$themes}/touristdestination", compact('title'));
    }

    Public function search(Request $request)
    {
        $rules = array(
            'search' => 'required'
        );
        $valid =array(
            'search.required'=>'search field  is required'
        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('/')->withErrors($validator)->withInput();
            
        }else{
        $title = 'Search';
        $search = $request->q;
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';

        if(!empty($search)){
        $results = Menu::where('content', 'LIKE', '%' . $search . '%')->orWhere('m_name', 'LIKE', '%' . $search . '%')->get();
        }
        return response()->view("themes/{$themes}/search", compact('title','results'));
    }
    }
	
	public function technical_info()
    {
        $title = 'Technical Information';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        //echo $themes;
        //die();
        return response()->view("themes/{$themes}/technicalInfos", compact('title'));
    }
	
	public function publication()
    {
        $title = 'Publications';
        $langid=session()->get('locale')??1;
        $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        //echo $themes;
        //die();
        return response()->view("themes/{$themes}/publication", compact('title'));
    }

    public function collection($id){
        $title = 'Collections';
        $langid = session()->get('locale')??1;
        $themes = !empty(get_setting($langid)->themes) ? get_setting($langid)->themes : 'th1';
        $photogallery = Photogallery::where('txtstatus',3)->where('language',$langid)->where('id',$id)->first();
        return response()->view("themes/{$themes}/collectionGallery", compact('title','photogallery'));
    }
    
}
