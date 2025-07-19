<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Manual;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
class ManualController extends Controller
{
    /**
     * Display a listing of the Manual.
     */
    public function index()
    {
        $title="Manage Manual";
        $langid=!empty($langid)?$langid:1;
        // $list = Manual::paginate(10);
        $list = Manual::where('manualstype', '1')->paginate(10);
        return view('admin/manual/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new Manual.
     */
    public function create()
    {
       $title="Add Manual";
        
       return view('admin/manual/add',compact(['title']));
    }

    /**
     * Store a newly created Manual in storage.
     */
    public function store(Request $request){ 
       $txtuplode1 ='';
       $rules = array(
           
           'language' => 'required',
           'title' => 'required|string|min:3|regex:/^[a-zA-Z0-9\s\-_,.!?]+$/',
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
               'metakeyword' => 'required|string|min:3|regex:/^[a-zA-Z0-9\s\-_,.!?]+$/',
               'metadescription' => 'required|string|min:3|regex:/^[a-zA-Z0-9\s\-_,.!?]+$/',
           );
            
           $validator = Validator::make($request->all(), $rules, $valid);
       }elseif($request->menutype == 2){
          if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/manuals/')) {
                mkdir('public/upload/admin/cmsfiles/manuals/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_manuals'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/manuals/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//manuals/'.$txtuplode1; //die();
                
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
           
           $pArray['manualstype']    			    = '1'; 
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
           $create 	= Manual::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->menutype),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'        	=> 'Manual Model',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/manual')->with('success','Manual has successfully added');
           }
          
       }
    }

    /**
     * Display the specified Manual.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified Manual.
     */
    public function edit(string $id)
    {
        $title="Edit Manual ";
        $id=clean_single_input($id);
        $data = Manual::find($id);
        return view('admin/manual/edit',compact(['title','data']));
    }

    /**
     * Update the specified Manual in storage.
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

            if (!is_dir('public/upload/admin/cmsfiles/manuals/')) {
                mkdir('public/upload/admin/cmsfiles/manuals/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_manuals'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/manuals/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//manuals/'.$txtuplode1; //die();

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
          
           $pArray['manualstype']    			    = '1'; 
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

           $create 	= Manual::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Manual Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/manual')->with('success','Manual has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified Manual from storage.
     */
    public function destroy($id)
    {
	  $data = Manual::find($id);
      $delete= $data->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> 'Manual Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/manual')->with('success','Manual deleted successfully');
        }
       
     }
}
