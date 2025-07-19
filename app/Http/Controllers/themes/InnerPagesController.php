<?php

namespace App\Http\Controllers\themes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Menu;
use App\Models\admin\Tender;
use App\Models\admin\Circular;
use App\Models\admin\Officer;
use App\Models\admin\Photogallery;
use App\Models\admin\Sanghralaya;
use App\Models\admin\Exhibition;
use App\Models\admin\ExhibitionCategory;
use App\Models\admin\Faq;
use Illuminate\Support\Facades\DB;
use App\Models\admin\Vacancy;

class InnerPagesController extends Controller
{
    public function index($slug="",Request $request)
    {   
        $slug= clean_single_input($slug);
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';$data='';
        $langid=session()->get('locale')??1;
        
        if($slug=="login"){
            $title="Login";
            $data="Data";
            return response()->view('auth/login', compact( 'data','title'));
        }
        if($slug=='home'){
            return redirect('/');  
        }
        
       
        $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->first();
        
        
        if(!empty($data)){
            $title=$data->m_name;
            $m_url=$data->m_url;
            $id=$data->id;
            $data1 =  Menu::where('id', $id)->where('language_id', $langid)->where('approve_status',3)->select('id','m_id','m_type','m_flag_id','menu_positions','language_id','m_name','m_url','m_title','m_keyword','m_description','content','doc_uplode','linkstatus','approve_status','page_postion','welcomedescription')->first();
            if(!empty($data1)){
                $m_flag_id=$data1->m_flag_id;
                $chtitle=$data1->title;
            }
            
            if($slug==='feedback'){
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/feedback", compact( 'data','title','id','m_flag_id','m_url','chtitle'));
 
            }
            if($slug=='site-map'){
               // $title="Site Map";
                $data="Data";
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/siteMaps", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug=='photo-collection'){
            //    $title="Photo Collections";
                $data=Photogallery::where('language', $langid)->where('txtstatus',3)->where('type',2)->orderby('created_at','DESC')->paginate(12);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/innerpagesPhoto", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug=='collection-details'){
                if($request->id){
                    // $title="Collection details";
                    $data=Photogallery::where('language', $langid)->where('txtstatus',3)->where('type',2)->where('id', $request->id)->first();
                    $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                    return response()->view("themes/{$themes}/collectionGallery", compact( 'data','title','id','m_flag_id','m_url'));
                }
                
                $data=Photogallery::where('language', $langid)->where('txtstatus',3)->where('type',2)->orderby('created_at','DESC')->paginate(12);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/innerpagesPhoto", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug=='photo-gallery'){
                //    $title="Photo Collections";
                $data=Photogallery::where('language', $langid)->where('txtstatus',3)->where('type',1)->orderby('created_at','DESC')->paginate(12);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/photoGallery", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug == 'sanghralaya'){
                $data = Sanghralaya::where('language', $langid)->where('txtstatus',3)->orderby('created_at','DESC')->paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/sanghralaya", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug == 'exhibition'){
                $data = Exhibition::where('language', $langid)->where('txtstatus',3)->orderby('created_at','DESC')->paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/exhibition", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug == 'exhibition-category-details'){
                if($request->id){
                    $exhibition_category = Exhibition::find($request->id);
                    $data =  DB::table('exhibition_categories')
                            ->join('exhibitions','exhibition_categories.category_id','exhibitions.id')
                            ->where('exhibition_categories.category_id', $request->id)
                            ->where('language', $langid)
                            ->select('exhibition_categories.*','exhibitions.category','exhibitions.language','exhibitions.txtuplode')
                            ->get();
                    // dd($data); 
                    $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                    return response()->view("themes/{$themes}/exhibitionCategory", compact( 'data','title', 'exhibition_category','id','m_flag_id','m_url'));
                }

                $data = Exhibition::where('language', $langid)->where('txtstatus',3)->orderby('created_at','DESC')->paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/exhibition", compact( 'data','title','id','m_flag_id','m_url'));
            }
            
            if($slug=='circulars'){
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $circular = Circular::where('language', $langid)->where('txtstatus',3)->where('circularstype', 1);

                if (!empty($request->keywords)) {
                    $circular_title=clean_single_input($request->keywords);
                    $circular->where('title',  'LIKE', "%{$circular_title}%" );
                }
                // if (!empty($request->circularstype)) {
                //     $circular->where('circularstype', clean_single_input($request->circularstype));
                // }
                if (!empty($request->enddate)) {
                    $circular->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $circular->where('startdate', clean_single_input($request->startdate));
                }
                $circulars=$circular->orderby('startdate','DESC')->select('title','description','language','circularstype','url','txtuplode','txtweblink','startdate','enddate')->paginate(10);
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/circular", compact( 'data','circulars','title','id','m_flag_id','m_url','chtitle'));
            }

            if($slug=='vacancy'){
                //$title="Vacancy";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $vacancy = Vacancy::where('vacancytype', '1')->where('enddate','>' ,$today)->where('language', $langid)->where('txtstatus',3);
               
                if (!empty($request->keywords)) {
                    $vacancy_title=clean_single_input($request->keywords);
                    $vacancy->where('title',  'LIKE', "%{$vacancy_title}%" );
                }
                if (!empty($request->startdate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $vacancy->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $vacancy->where('startdate', clean_single_input($request->startdate));
                }
                $vacancy=$vacancy->orderby('created_at','DESC')->paginate(10);
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/vacancy", compact( 'data','vacancy','title','id','m_flag_id','m_url','chtitle'));
        
            }

            if($slug == 'announcements'){
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $announcement = Circular::where('enddate','>' ,$today)->where('language', $langid)->where('txtstatus',3)->where('circularstype', '3');

                if (!empty($request->keywords)) {
                    $announcement_title=clean_single_input($request->keywords);
                    $announcement->where('title',  'LIKE', "%{$announcement_title}%" );
                }
                if (!empty($request->startdate)) {
                    $announcement->where('startdate', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $announcement->where('enddate', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $announcement->where('startdate', clean_single_input($request->startdate));
                }
                $announcement=$announcement->orderby('startdate','DESC')->select('title','description','language','circularstype','url','txtuplode','txtweblink','startdate','enddate')->paginate(10);
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/announcements", compact( 'data','announcement','title','id','m_flag_id','m_url','chtitle'));
            }

            if($slug=='publicLogin'){
               // $title="Photo Gallery";
                // $data=Photogallery::paginate(10);
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/publicLogin", compact( 'data','title','id','m_flag_id','m_url'));
            }
            if($slug=='faqs'){
               
                 $datas= Faq::where('language', $langid)->where('txtstatus',3)->orderby('updated_at','DESC')->select('id','title','url','admin_id', 'page_url','category','language','description','txtstatus')->paginate(100);
          
                 $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
               
                return response()->view("themes/{$themes}/faqspages", compact( 'datas','title','id','m_flag_id','m_url'));
             }
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
            if($slug=='tenders'){
                //$title="Tender";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $tender = Tender::where('end_date','>' ,$today)->where('language', $langid)->where('txtstatus',3);
               
                if($slug=='property-development-business'){
                    $tender->where('tendertype', 1);
                }
                if($slug=='gcc-other-guidelines'){
                    $tender->where('tendertype', 2);
                }
                if (!empty($request->keywords)) {
                    $tender_title=clean_single_input($request->keywords);
                    $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                }
                if (!empty($request->startdate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                if (!empty($request->enddate)) {
                    $tender->where('end_date', clean_single_input($request->enddate));
                }
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                $tenders=$tender->orderby('start_date','DESC')->select('tender_title','language','tendertype','url','txtuplode','txtweblink','start_date','end_date')->paginate(10);
    
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/tender", compact( 'data','tenders','title','id','m_flag_id','m_url','chtitle'));
        
            }
            if($slug==='archived-tenders'){
              //  $title="Archived Tenders";
                $todate=date('Y-m-d');
                $today= date("Y-m-d", strtotime($todate));
                $tender = Tender::where('end_date','<' ,$today)->where('txtstatus',3)->where('language', $langid);
                if (!empty($request->keywords)) {
                    $tender_title=clean_single_input($request->keywords);
                    $tender->where('tender_title',  'LIKE', "%{$tender_title}%" );
                }
                if (!empty($request->startdate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }else
                if (!empty($request->enddate)) {
                    $tender->where('end_date', clean_single_input($request->enddate));
                }else
                if (!empty($request->startdate) && !empty($request->enddate)) {
                    $tender->where('start_date', clean_single_input($request->startdate));
                }
                $tenders=$tender->orderby('start_date','DESC')->select('tender_title','language','tendertype','url','txtuplode','txtweblink','start_date','end_date')->paginate(10);
                $data =  Menu::where('m_url', 'LIKE', "%{$slug}%")->where('approve_status',3)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_title','m_name')->first();
                if(!empty($data)){
           
                    $id=$data->id;
                    $data1 =  Menu::where('id', $id)->where('language_id', $langid)->select('id','m_flag_id','m_url','m_name')->first();
                    if(!empty($data1)){
                        $m_flag_id=$data1->m_flag_id;
                        $chtitle=$data1->title;
                    }
                }
                $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
                return response()->view("themes/{$themes}/tender", compact( 'data','tenders','title','id','m_flag_id','m_url','chtitle'));
        
            }
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
            return response()->view("themes/{$themes}/innerpages", compact( 'data','title','id','m_flag_id','m_url','chtitle'));
        }else{
           
            return redirect('/');  
        }
      
    }
    
    public function tenderivew($slug="")
    {   
        $langid=session()->get('locale')??1;
       
      
        $data =  Tender::where('url', 'LIKE', "%{$slug}%")->where('txtstatus',3)->where('language', $langid)->select('tender_title','language','description','url','txtuplode','txtweblink','start_date','end_date')->first();
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';
        if(!empty($data)){
            $title=$data->officers_name;
            $m_url=$data->url;
            $id=$data->id;
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        
            return response()->view("themes/{$themes}/innerpages", compact( 'data','title','id','m_url','chtitle'));
        
        }else{
           
            return redirect('/');  
        }
      
    }
    public function officers($slug="")
    {   
        $langid=session()->get('locale')??1;
       
      
        $data =  Officer::where('url', 'LIKE', "%{$slug}%")->where('txtstatus',3)->where('language', $langid)->select('officers_name','url','designation','contents','language','txtuplode','txtstatus','admin_id')->first(); 
        $title=''; $id='';$m_flag_id=''; $m_url='';$chtitle='';
        if(!empty($data)){
            $title=$data->officers_name;
            $m_url=$data->url;
            $id=$data->id;
            $themes=!empty(get_setting($langid)->themes)?get_setting($langid)->themes:'th1';
        
            return response()->view("themes/{$themes}/officers", compact( 'data','title','id','chtitle'));
        
        }else{
           
            return redirect('/');  
        }
      
    }
}
