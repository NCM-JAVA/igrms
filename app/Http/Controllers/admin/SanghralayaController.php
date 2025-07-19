<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Sanghralaya;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class SanghralayaController extends Controller
{
   
    /**
     * Display a listing of the sanghralaya
     */
  
    public function index()
    {
         $title="Sanghralaya List";
         $approve_status=session()->get('approve_status');
         $sertitle=Session::get('title');
         $approve_status=Session::get('approve_status');
         $language_id=Session::get('language_id');
         $lists = Sanghralaya::whereNotNull('txtuplode');
         if (!empty($title)) {
             $lists->where('title', 'LIKE', "%{$sertitle}%");
         }
         if (!empty($approve_status)) {
            
             $lists->where('txtstatus',$approve_status);
         }
         if (!empty($language_id)) {
            
             $lists->where('language',$language_id);
         }
         $list = $lists->orderBy('created_at', 'DESC')->select('id','title','description','language','txtuplode','txtstatus','admin_id')->paginate(10);

         return view('admin/sanghralaya/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new Sanghralaya details.
     */
    public function create()
    {
        $title="Add Sanghralaya details ";
        return view('admin/sanghralaya/add',compact(['title']));
    }

    /**
     * Store a newly created sanghralaya in storage.
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
            return redirect('admin/sanghralaya');
        }

        if(isset($request->cmdsubmit)){  
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120'
        );
        $valid
        =array(
            'menu_title.required'=>'Menu title field  is required',
            // 'txtuplode.required'=>'Image upload field is required',
            'txtstatus.required' =>'status field is required'

        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('admin/sanghralaya/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/sanghralaya/')) {
                mkdir('public/upload/admin/cmsfiles/sanghralaya/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/sanghralaya/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/sanghralaya/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_sanghralaya'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/sanghralaya/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/sanghralaya/');
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//sanghralaya/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//sanghralaya/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['description']    				= clean_single_input($request->description); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = $txtuplode;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
			$create 	= Sanghralaya::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Sanghralaya Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/sanghralaya')->with('success','Sanghralaya details has successfully added');
			}
           
        }
      }
   }

    /**
     * Display the specified sanghralaya.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified sanghralaya.
     */
    public function edit(string $id)
    {
        $title="Edit Sanghralaya Details ";
        $id=clean_single_input($id);
        $data = Sanghralaya::find($id);
        return view('admin/sanghralaya/edit',compact(['title','data']));
    }

    /**
     * Update the specified sanghralaya in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
            'menu_title.required'=>'Menu title field  is required',
             'txtstatus.required' =>'status field is required'
        );
        if(!empty($request->txtuplode)){
            $rules = array(
                'txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg|max:5120'
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules, $valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/sanghralaya/')) {
                mkdir('public/upload/admin/cmsfiles/sanghralaya/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/sanghralaya/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/sanghralaya/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_sanghralaya'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/sanghralaya/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/sanghralaya/');
              
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//sanghralaya/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles//sanghralaya/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['description']    					= $request->description; 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = !empty($txtuplode)?$txtuplode:$oldimg;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= Sanghralaya::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Sanghralaya Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/sanghralaya')->with('success','Sanghralaya details has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified sanghralaya from storage.
     */
    public function destroy(Sanghralaya $sanghralaya)
    {

        $delete = $sanghralaya->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $sanghralaya->id,
                            'page_name'             =>  clean_single_input($sanghralaya->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($sanghralaya->language),
                            'page_title'        	=> 'Sanghralaya Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/sanghralaya')->with('success','Sanghralaya details deleted successfully');
         }
       
        
    }
    
}
