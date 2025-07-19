<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\EventNews;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class EventNewsController extends Controller
{
    /**
     * Display a listing of the Logo.
     */
    public function index()
    {
            
        $title="Managae Events";
    
        $sertitle=Session::get('title');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id');
        
        $list = EventNews::query();
        if (!empty($sertitle)) {
            $list->where('title', 'LIKE', "%{$sertitle}%");
        }
        if (!empty($approve_status)) {
            $list->where('txtstatus', $approve_status);
        }
        if (!empty($language_id)) {
            $list->where('language', $language_id);
        }
    
        $list = $list->paginate(10);
        return view('admin/eventNews/index',compact(['list','language_id','title']));
        
    }

    /**
     * Show the form for creating a new the Logo.
     */
    public function create()
    {
        $title="Add Events ";
        return view('admin/eventNews/add',compact(['title']));
    }

    /**
     * Store a newly created the Logo in storage.
     */
    public function store(Request $request)
    {
        if(isset($request->search)){
            $title=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('title', $title);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/event-news');
        }

        $txtuplode ='';
        $rules = array(
            'title' => 'required',
            'url' => 'required',
            'txtstatus' => 'required',
            'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
        );
        $valid
        =array(
             'title.required'=>'Events title field  is required',
             'txtstatus.required' =>'Status field is required',
             'txtuplode.required' => 'Events upload field is required'

        );
         $validator = Validator::make($request->all(), $rules,$valid);
        if ($validator->fails()) {
      
            return redirect('admin/event-news/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/events/')) {
                mkdir('public/upload/admin/cmsfiles/events/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/events/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/events/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_events'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/events/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/events/');
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//events/'.$txtuplode; //die();
                
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//events/'.$destinationPathThumbnail; //die();
                
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']                        = clean_single_input($request->title); 
            $pArray['url']                          = clean_single_input($request->url); 
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['txtuplode']                    = $txtuplode;
            $pArray['admin_id']                     = $user_login_id;
            $pArray['txtstatus']                    = clean_single_input($request->txtstatus);
            
            
            $create     = EventNews::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;

            if($lastInsertID > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'               =>  $lastInsertID,
                                'page_name'             =>  clean_single_input($request->menu_title),
                                'page_action'           =>  'Insert',
                                'page_category'         =>  '',
                                'lang'                  =>  1,
                                'page_title'            => 'Events Model',
                                'approve_status'        => clean_single_input($request->txtstatus),
                                'usertype'              => 'Admin'
                            );
                            
                audit_trail($audit_data);
                return redirect('admin/event-news')->with('success','Events has successfully added');
            }
           
        }

    }

    /**
     * Display the specified the Event.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified Officer Messages.
     */
    public function edit(string $id)
    {
        $title="Edit Events ";
        $id=clean_single_input($id);
        $data = EventNews::find($id);
        return view('admin/eventNews/edit',compact(['title','data']));
    }

    /**
     * Update the specified the Event in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'title' => 'required',
            'url' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
            'title.required'=>'Events title field  is required',
             'txtstatus.required' =>'Status field is required'
            
        );
        if(!empty($request->txtuplode)){
            $rules = array(
                'txtuplode' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:5120'
                
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules, $valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/events/')) {
                mkdir('public/upload/admin/cmsfiles/events/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/events/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/events/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_events'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/events/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/events/');
              
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//events/'.$txtuplode; //die();
                
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles//events/'.$destinationPathThumbnail; //die();
                
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            // $pArray['eventstype']    			    = '1'; 
            $pArray['title']                        = clean_single_input($request->title); 
            $pArray['url']                          = clean_single_input($request->url); 
            $pArray['language']    					= clean_single_input($request->language); 
            $pArray['txtuplode']                    = !empty($txtuplode)?$txtuplode:$oldimg;
            $pArray['admin_id']                     = $user_login_id;
            $pArray['txtstatus']                    = clean_single_input($request->txtstatus);

            $create     = EventNews::where('id', $id)->update($pArray);
            if($create > 0){
                $audit_data = array('user_login_id'     =>  $user_login_id,
                                'page_id'               =>  $id,
                                'page_name'             =>  clean_single_input($request->menu_title),
                                'page_action'           =>  'Update',
                                'page_category'         =>  '',
                                'lang'                  =>  1,
                                'page_title'            => 'Events Model',
                                'approve_status'        => clean_single_input($request->txtstatus),
                                'usertype'              => 'Admin'
                            );
                            
                audit_trail($audit_data);
                return redirect('admin/event-news')->with('success','Event has successfully Updated');
            }
           
        }
    }

    /**
     * Remove the specified the Event from storage.
     */
    public function destroy($id)
    {
	  $data = EventNews::find($id);
      $delete= $data->delete();
       
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $data->id,
                            'page_name'             =>  clean_single_input($data->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($data->language),
                            'page_title'        	=> 'Events Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/event-news')->with('success','Events deleted successfully');
        }
       
    }
}
