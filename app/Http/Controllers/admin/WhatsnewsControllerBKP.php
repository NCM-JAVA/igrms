<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Str;
use App\Models\admin\Whatsnew;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class WhatsnewsController extends Controller
{
    public function index()
    {
        $title="Whatsnews List";
        $langid=!empty($langid)?$langid:1;
        $list = Whatsnew::paginate(100);
        return view('admin/Whatsnews/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Whatsnews";
        
        return view('admin/whatsnews/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
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
      // $validator = '';
      $validator = Validator::make($request->all(), $rules);
       if($request->menutype == 1){
           $rules = array(
               'description' => 'required',
               'metakeyword' => 'required',
               'metadescription' => 'required'
           );
            
           $validator = Validator::make($request->all(), $rules);
       }elseif($request->menutype == 2){
          if (!empty($request->txtuplode)){

            if (!is_dir('public/upload/admin/cmsfiles/whatsnews/')) {
                mkdir('public/upload/admin/cmsfiles/whatsnews/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_whatsnews'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/whatsnews/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//whatsnews/'.$txtuplode1; //die();
                
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
       
       
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['page_url']    				    = Str::slug(clean_single_input($request->url)); 
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
           
           $create 	= Whatsnew::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){

                        $audit_data = array('user_login_id'     =>  $user_login_id,
                        'page_id'             	=>  $lastInsertID,
                        'page_name'              =>  clean_single_input($request->title),
                        'page_action'            =>  'Insert',
                        'page_category'          =>  clean_single_input($request->menutype),
                        'lang'                   =>  clean_single_input($request->language),
                        'page_title'             => 'Whatsnew Model',
                        'approve_status'         => clean_single_input($request->txtstatus),
                        'usertype'          	    => 'Admin'
                    );            
                audit_trail($audit_data);

                return redirect('admin/whatsnews')->with('success','Whatsnews has successfully added');
           }
          
       }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title="Edit Whatsnews";
        $id=clean_single_input($id);
        $data = Whatsnew::find($id);
        return view('admin/whatsnews/edit',compact(['title','data']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $id=  clean_single_input($id);
        $txtuplode1 ='';
        $rules = array(
           'language' => 'required',
           'title' => 'required',
           'menutype' => 'required',
           'txtstatus' => 'required',
           'is_new' => 'required',
           'startdate' => 'required',
           'enddate' => 'required'
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

            if (!is_dir('public/upload/admin/cmsfiles/whatsnews/')) {
                mkdir('public/upload/admin/cmsfiles/whatsnews/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->title)).'_whatsnews'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/whatsnews/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//whatsnews/'.$txtuplode1; //die();

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
           $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
            return  back()->withErrors($validator)->withInput();
       }else{
           $user_login_id=Auth()->user()->id;
          
         
           $pArray['title']    				        = clean_single_input($request->title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url)); 
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           if($request->menutype == 1){
               $pArray['txtuplode']  			    = ''; 
               $pArray['txtweblink']    			= '';
               $pArray['metakeyword']    			= clean_single_input($request->metakeyword); 
               $pArray['metadescription']			= clean_single_input($request->metadescription); 
            }elseif($request->menutype == 2){
                $pArray['metakeyword']    			= ''; 
                $pArray['metadescription']			= ''; 
                $pArray['txtweblink']    			= ''; 
                $pArray['txtuplode']  				= clean_single_input($txtuplode1); 
                
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
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= Whatsnew::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Whatsnew Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/whatsnews')->with('success','Whatsnews has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Whatsnew $whatsnew,$id)
    {
	
		$whatsnews = Whatsnew::find($id);
		
        $delete= $whatsnews->delete();
         if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $whatsnews->id,
                            'page_name'             =>  clean_single_input($whatsnews->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  1,
                            'page_title'        	=> 'whatsnews  Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/whatsnews')->with('success','Whatsnews deleted successfully');
        }
    }
}
