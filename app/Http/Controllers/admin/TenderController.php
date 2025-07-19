<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Tender;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Support\Str;
class TenderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Tenders List";
        $langid=!empty($langid)?$langid:1;
        $list = Tender::orderBy('created_at', 'DESC')->select('id','tender_title','language','description','url','txtuplode','txtweblink','txtstatus','start_date','end_date')->paginate(100);
        return view('admin/tenders/index',compact(['list','langid','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Tender";
        
        return view('admin/tenders/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request){
        
        $txtuplode1 ='';
       $rules = array(
           
           'language' => 'required',
           'tender_title' => 'required',
           'url' => 'required',
           'menutype' => 'required',
        //    'tendertype' => 'required',
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

            if (!is_dir('public/upload/admin/cmsfiles/tenders/')) {
                mkdir('public/upload/admin/cmsfiles/tenders/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->tender_title)).'_tender'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/tenders/'), $txtuplode1);
              
               
                if($res){
                   $txtuplode1 =$txtuplode1;
                }
                $txtuplode2 ='upload/admin/cmsfiles//tenders/'.$txtuplode1; //die();
                
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
        $validator = Validator::make($request->all(), $rules);
       
       if ($validator->fails()) {
        return  back()->withErrors($validator)->withInput();
           
       }else{
           $user_login_id=Auth()->user()->id;
          
           $pArray['tender_title']    				= clean_single_input($request->tender_title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));
           $pArray['page_url']                      = Str::slug(clean_single_input($request->url));
           $pArray['language']    			        = clean_single_input($request->language); 
           $pArray['menutype']  					= clean_single_input($request->menutype); 
           $pArray['metakeyword']    			    = clean_single_input($request->metakeyword); 
           $pArray['metadescription']				= clean_single_input($request->metadescription); 
           $pArray['description']    				= clean_single_input($request->description); 
           $pArray['txtuplode']  				    = clean_single_input($txtuplode1); 
           $pArray['txtweblink']    				= clean_single_input($request->txtweblink); 
           $pArray['admin_id']  					= clean_single_input($user_login_id); 
           $pArray['start_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->startdate)));
		   $pArray['end_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['tendertype']  		            = 1; //clean_single_input($request->tendertype); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           
           $create 	= Tender::create($pArray);
           $lastInsertID = $create->id;
           $user_login_id=Auth()->user()->id;

           if($lastInsertID > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
            'page_id'           	=>  $lastInsertID,
            'page_name'             =>  clean_single_input($request->tender_title),
            'page_action'           =>  'Insert',
            'page_category'         =>  clean_single_input($request->menutype),
            'lang'                  =>  clean_single_input($request->language),
            'page_title'        	=> 'Tender Model',
            'approve_status'        => clean_single_input($request->txtstatus),
            'usertype'          	=> 'Admin'
        );
                           
               audit_trail($audit_data);
               return redirect('admin/tender')->with('success','Tender has successfully added');
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
        $title="Edit Tender ";
        $id=clean_single_input($id);
        $data = Tender::find($id);
        return view('admin/tenders/edit',compact(['title','data']));
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
           'tender_title' => 'required',
           'url' => 'required',
           'menutype' => 'required',
        //    'tendertype' => 'required',
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

            if (!is_dir('public/upload/admin/cmsfiles/tenders/')) {
                mkdir('public/upload/admin/cmsfiles/tenders/', 0777, TRUE);
            }
            
               $rulesdsad = array(
                   'txtuplode' => 'required|mimes:pdf,xlx,csv|max:2048',
               );
               $txtuplode1 = str_replace(' ','_',clean_single_input($request->tender_title)).'_tender'.'.'.$request->txtuplode->extension();  
       
                $res= $request->txtuplode->move(public_path('upload/admin/cmsfiles/tenders/'), $txtuplode1);
              
               
                  if($res){
                    $txtuplode1 =$txtuplode1;
                  }
                $txtuplode2 ='upload/admin/cmsfiles//tenders/'.$txtuplode1; //die();

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
          
         
           $pArray['tender_title']    				= clean_single_input($request->tender_title); 
           $pArray['url']    					    = Str::slug(clean_single_input($request->url));
           $pArray['page_url']                      = Str::slug(clean_single_input($request->url));
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
           $pArray['start_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->startdate)));
		   $pArray['end_date']  			        = date("Y-m-d", strtotime(clean_single_input($request->enddate)));
           $pArray['txtstatus']  			        = clean_single_input($request->txtstatus); 
           $pArray['tendertype']  		            = 1; //clean_single_input($request->tendertype); 
           $pArray['is_new']  				        = clean_single_input($request->is_new); 
           $user_login_id=Auth()->user()->id;

           $create 	= Tender::where('id', $id)->update($pArray);
           if($create > 0){
            $audit_data = array('user_login_id'     =>  $user_login_id,
                    'page_id'           	=>  $id,
                    'page_name'             =>  clean_single_input($request->tender_title),
                    'page_action'           =>  'update',
                    'page_category'         =>  clean_single_input($request->menutype),
                    'lang'                  =>  clean_single_input($request->language),
                    'page_title'        	=> 'Tender Model',
                    'approve_status'        => clean_single_input($request->txtstatus),
                    'usertype'          	=> 'Admin'
                );
                           
               audit_trail($audit_data);
               return redirect('admin/tender')->with('success','Tender has successfully Updated');
           }
          
       }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tender $tender)
    {
        $delete= $tender->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $tender->id,
                            'page_name'             =>  clean_single_input($tender->tender_title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($tender->language),
                            'page_title'        	=> 'tender Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/tender')->with('success','Tender deleted successfully');
        }
       
       
    }
}
