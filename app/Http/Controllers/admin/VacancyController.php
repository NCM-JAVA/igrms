<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Vacancy;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
class VacancyController extends Controller
{
    /**
     * Display a listing of the vacancy.
     */
    public function index()
    {
        $title="Manage Vacancy";
        $langid=!empty($langid)?$langid:1;
        // $list = Vacancy::paginate(10);
        $list = Vacancy::where('vacancytype', '1')->paginate(10);
        return view('admin/vacancy/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new Vacancy.
     */
    public function create()
    {
       $title="Add Vacancy";
        
       return view('admin/vacancy/add',compact(['title']));
    }

    /**
     * Store a newly created Vacancy in storage.
     */
    public function store(Request $request){ 
       $txtuplode1 ='';
       $rules = array(
           
           'language' => 'required',
           'title' => 'required',
           'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $valid
       =array(
            'menutype.required'=>'Menu type field  is required',
            'url.required'=>'Page url field  is required',
            'startdate.required'=>'Start date  field  is required',
            'enddate.required'=>'End date  field  is required',
            'txtstatus.required' =>'Pages Status field is required'

       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules. $valid);
       }elseif($request->menutype == 2){
          if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/vacancy/')) {
                mkdir('public/upload/admin/cmsfiles/vacancy/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_vacancy'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/vacancy/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//vacancy/'.$txtuplode1; //die();
                
                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
          }
       }elseif($request->menutype == 3){
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
       $validator = Validator::make($request->all(), $rules, $valid);
       
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
           
           $pArray['vacancytype']    			    = '1'; 
           $pArray['title']    			        	= clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));// clean_single_input(seo_url($request->title)); 
		   $pArray['page_url']                      = clean_single_input(seo_url($request->title));
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
           $pArray['metadescription']				= clean_single_input($request->metadescription); 
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['txtweblink']    				= clean_single_input($request->txtweblink); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['startdate']  			        = date("Y-m-d ", strtotime(clean_single_input($request->startdate)));
		   $pArray['enddate']  			            = date("Y-m-d ", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $create 	= Vacancy::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->menutype),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'        	=> 'Vacancy Model',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/vacancy')->with('success','Vacancy has successfully added');
           }
          
       }
    }

    /**
     * Display the specified Vacancy.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified Vacancy.
     */
    public function edit(string $id)
    {
        $title="Edit Vacancy ";
        $id=clean_single_input($id);
        $data = Vacancy::find($id);
        return view('admin/vacancy/edit',compact(['title','data']));
    }

    /**
     * Update the specified Vacancy in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=  clean_single_input($id);
       $txtuplode1 ='';
       $rules = array(
           
           'language' => 'required',
           'title' => 'required',
           'url' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
       );
       $valid
       =array(
            'menutype.required'=>'Menu type field  is required',
            'url.required'=>'Page url field  is required',
            'startdate.required'=>'Start date  field  is required',
            'enddate.required'=>'End date  field  is required',
            'txtstatus.required' =>'Pages Status field is required'

       );
       $validator = '';
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules);
       }elseif($request->menutype == 2){

           if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/vacancy/')) {
                mkdir('public/upload/admin/cmsfiles/vacancy/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_vacancy'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/vacancy/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//vacancy/'.$txtuplode1; //die();

                if (file_exists($txtuplode2)) {
                    unlink($txtuplode2);
                }
                 $validator = Validator::make($request->all(), $rulesdsad);
           }else{
            $txtuplode1 =$request->olduplode;
           }
       }elseif($request->menutype == 3){
        
           $rules = array(
               'txtweblink' => 'required'
           );
              
           $validator = Validator::make($request->all(), $rules);
       }
        $validator = Validator::make($request->all(), $rules ,$valid);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['vacancytype']    			    = '1'; 
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url)); // clean_single_input(seo_url($request->title)); 
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           if($request->menutype == 1){
               $pArray['txtuplode']  				    = ''; 
               $pArray['txtweblink']    				= '';
               $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
               $pArray['metadescription']				= clean_single_input($request->metadescription); 
            }elseif($request->menutype == 2){
                $pArray['metakeyword']    			    = ''; 
                $pArray['metadescription']				= ''; 
                $pArray['txtweblink']    				= ''; 
                $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
                
           }elseif($request->menutype == 3){
            $pArray['metakeyword']    			    = ''; 
            $pArray['metadescription']				= ''; 
            $pArray['txtuplode']    				= ''; 
            $pArray['txtweblink']  				    = clean_single_input($request->txtweblink); 
           }else{

           }
          
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['startdate']  			        = date("Y-m-d ", strtotime(clean_single_input($request->startdate)));
		   $pArray['enddate']  			            = date("Y-m-d ", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['page_url']  		            = clean_single_input(seo_url($request->title));
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= Vacancy::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Vacancy Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/vacancy')->with('success','Vacancy has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified Vacancy from storage.
     */
    public function destroy($id)
    {
	  $data = Vacancy::find($id);
      $delete= $data->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> 'Vacancy Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/vacancy')->with('success','Vacancy deleted successfully');
        }
       
     }
}
