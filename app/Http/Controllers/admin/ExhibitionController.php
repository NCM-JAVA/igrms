<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Exhibition;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class ExhibitionController extends Controller
{
   
    /**
     * Display a listing of the Exhibition
     */
  
    public function index()
    {
         $title="Exhibition List";
         $approve_status=session()->get('approve_status');
         $sertitle=Session::get('category');
        //  dd($sertitle);
         $approve_status=Session::get('approve_status');
         $language_id=Session::get('language_id');
         $lists = Exhibition::whereNotNull('txtuplode');
         if (!empty($category)) {
             $lists->where('category', 'LIKE', "%{$sertitle}%");
         }
        //  if (!empty($approve_status)) {
            
        //      $lists->where('txtstatus',$approve_status);
        //  }
         if (!empty($language_id)) {
            
             $lists->where('language',$language_id);
         }
         $list = $lists->orderBy('created_at', 'DESC')->select('id','category','language','txtuplode','txtstatus','admin_id')->paginate(10);
        //  dd($list);
         return view('admin/exhibition/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new Exhibition details.
     */
    public function create()
    {
        $title="Add Exhibition ";
        return view('admin/exhibition/add',compact(['title']));
    }

    /**
     * Store a newly created exhibition in storage.
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
            return redirect('admin/exhibition');
        }

        if(isset($request->cmdsubmit)){  
        $txtuplode ='';
        $rules = array(
            'category' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            'txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024'
        );
        $valid
        =array(
            'category.required'=>'Category field  is required',
            // 'txtuplode.required'=>'Image upload field is required',
            'txtstatus.required' =>'status field is required'

        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('admin/exhibition/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){

                $txtuplode = str_replace(' ','_',clean_single_input($request->category)).'_exhibition'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/exhibition/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/exhibition/');
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//exhibition/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//exhibition/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['category']    					= clean_single_input($request->category); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = $txtuplode;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
			$create 	= Exhibition::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->category),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Exhibition Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/exhibition')->with('success','Exhibition details has successfully added');
			}
           
        }
      }
   }

    /**
     * Display the specified exhibition.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified exhibition.
     */
    public function edit(string $id)
    {
        $title="Edit Exhibition ";
        $id=clean_single_input($id);
        $data = Exhibition::find($id);
        return view('admin/exhibition/edit',compact(['title','data']));
    }

    /**
     * Update the specified exhibition in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $txtuplode ='';
        $rules = array(
            'category' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
            'category.required'=>'Menu title field  is required',
             'txtstatus.required' =>'status field is required'
        );
        if(!empty($request->txtuplode)){
            $rules = array(
                'txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules, $valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->txtuplode)){
                $txtuplode = str_replace(' ','_',clean_single_input($request->category)).'_exhibition'.'.'.$request->txtuplode->extension();  
                $image = $request->file('txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/exhibition/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/exhibition/');
              
                $image->move($destinationPath, $txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//exhibition/'.$txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($txtuplode1);
                }
                $thumbnail1 ='upload/admin/cmsfiles//exhibition/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }else{
                $oldimg=$request->oldimg;
            }
           
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;
            $dataArr = array(); 
            $pArray['category']    					= clean_single_input($request->category); 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = !empty($txtuplode)?$txtuplode:$oldimg;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= Exhibition::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->category),
								'page_action'           =>  'Update',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Exhibition Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/exhibition')->with('success','Exhibition details has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified exhibition from storage.
     */
    public function destroy(Exhibition $exhibition)
    {
        $delete = $exhibition->delete();
        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $exhibition->id,
                            'page_name'             =>  clean_single_input($exhibition->category),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($exhibition->language),
                            'page_title'        	=> 'Exhibition Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/exhibition')->with('success','Exhibition details deleted successfully');
         }
       
        
    }
    
}
