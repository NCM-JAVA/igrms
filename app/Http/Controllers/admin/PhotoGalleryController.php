<?php

namespace App\Http\Controllers\Admin;
use App\Models\admin\Photogallery;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Str;
use Image;
use Illuminate\Support\Facades\Session;

class PhotoGalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title="Photogallery List";
        $sertitle=Session::get('title');
        $approve_status=Session::get('approve_status');
        $language_id=Session::get('language_id');
        
        $list = Photogallery::where('type',1);
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
        return view('admin/photoGallery/index',compact(['list','title']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title="Add Gallery ";
        return view('admin/photoGallery/add',compact(['title']));
    }

    /**
     * Store a newly created resource in storage.
     */

    // Name: Anshu Singh
    // Date: 31-10-23
    // Reason: This Function is used to stored the data in the database and also multiple images stored in the folder and db.
     
    public function store(Request $request)
    {
        if(isset($request->search)){
            $title=clean_single_input(trim($request->title));
            $approve_status=clean_single_input($request->approve_status);
            $language_id=clean_single_input($request->language_id);
            Session::put('title', $title);
            Session::put('approve_status', $approve_status);
            Session::put('language_id', $language_id);
            return redirect('admin/photo-gallery');
        }

        $imguplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required',
            //'imguplode' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10224'
			'imguplode' => 'required|array',
            'imguplode.*' => 'required|mimes:jpeg,png,jpg,gif,svg|max:10224',
        );
        $valid
        =array(
            'menu_title.required'=>'Title field  is required',
             'txtstatus.required' =>'Status field is required',
             'imguplode.required' => 'Image field is required'

        );
        $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect('admin/photo-gallery/create')->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/photos/')) {
                mkdir('public/upload/admin/cmsfiles/photos/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/photos/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/photos/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->imguplode))
            {
               
              for ($i=0; $i < count($request->imguplode); $i++) 
               { 
                    $imguplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_gallery_'.$i.'.'.$request->imguplode[$i]->extension(); 
                    // echo "<pre>"; 
                    // echo $imguplode;
                    // echo "<br>";
                    $images[] = $imguplode;
                    $image = $request->file('imguplode')[$i];
                    $destinationPathThumbnail = public_path('upload/admin/cmsfiles/photos/thumbnail');
                    $img = Image::make($image->path());
                    $img->resize(1350, 380, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($destinationPathThumbnail.'/'.$imguplode);
                
                    $destinationPath = public_path('upload/admin/cmsfiles/photos/');
                    $image->move($destinationPath, $imguplode);

                    $imguplode1 ='upload/admin/cmsfiles//photos/'.$imguplode; //die();
                    
                    if (file_exists($imguplode1)) {
                        unlink($imguplode);
                    }
                    $thumbnail1 ='upload/admin/cmsfiles//photos/'.$destinationPathThumbnail; //die();
                    
                    if (file_exists($thumbnail1)) {
                        unlink($destinationPathThumbnail);
                    }
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['description']    				= $request->description; 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = implode(",",$images);
			$pArray['category_id']  				= 1;
            $pArray['type']                         = 1;
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			//dd($pArray);
			$create 	= Photogallery::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Photo Gallery Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/photo-gallery')->with('success','Photo Gallery has successfully added Thank you');
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
        $title="Edit Photogallery ";
        $id=clean_single_input($id);
        $data = photogallery::find($id);
        return view('admin/photoGallery/edit',compact(['title','data']));
    }

    /**
     * Update the specified resource in storage.
     */


    // Name: Kesh Kumar
    // Date: 31-10-23
    // Reason: This Function is used to update the data in the database and also multiple images update in the folder and db.
     
    public function update(Request $request, string $id)
    {
        $validator = '';
        $id=clean_single_input($id);
        $imguplode ='';
        $rules = array(
            'menu_title' => 'required',
            'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid
        =array(
             'menu_title.required'=>'Title field  is required',
             'txtstatus.required' =>'Status field is required'
        );
        if(!empty($request->imguplode)){
            $rules = array(
                'imguplode' => 'required'
                
            );
            $validator = Validator::make($request->all(), $rules);

        }else{
            $validator = Validator::make($request->all(), $rules, $valid);
        }
        
        
        if ($validator->fails()) {
            
            return  back()->withErrors($validator)->withInput();
            
        }else{
            if (!is_dir('public/upload/admin/cmsfiles/photos/')) {
                mkdir('public/upload/admin/cmsfiles/photos/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/photos/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/photos/thumbnail/', 0777, TRUE);
            }
            $images= [];
            if(!empty($request->imguplode)){
                $time= date('Ymdhis');
                for ($i=0; $i < count($request->imguplode); $i++) 
                { 
                     $imguplode = str_replace(' ','_',clean_single_input($request->menu_title)).'_gallery_'.$time.'_'.$i.'.'.$request->imguplode[$i]->extension(); 
                     // echo "<pre>"; 
                     // echo $imguplode;
                     // echo "<br>";
                     $images[] = $imguplode;
                     $image = $request->file('imguplode')[$i];
                     $destinationPathThumbnail = public_path('upload/admin/cmsfiles/photos/thumbnail');
                     $img = Image::make($image->path());
                     $img->resize(1350, 380, function ($constraint) {
                         $constraint->aspectRatio();
                     })->save($destinationPathThumbnail.'/'.$imguplode);
                 
                     $destinationPath = public_path('upload/admin/cmsfiles/photos/');
                     $image->move($destinationPath, $imguplode);
 
                     $imguplode1 ='upload/admin/cmsfiles//photos/'.$imguplode; //die();
                     
                     if (file_exists($imguplode1)) {
                         unlink($imguplode);
                     }
                     $thumbnail1 ='upload/admin/cmsfiles//photos/'.$destinationPathThumbnail; //die();
                     
                     if (file_exists($thumbnail1)) {
                         unlink($destinationPathThumbnail);
                     }
                 }
            }
            $data = Photogallery::where('id', $id)->select('txtuplode')->first();
            $olddata= explode(",",$data->txtuplode);

            $inputimage= array_merge($olddata,$images);
           // dd($inputimage);die();
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['title']    					= clean_single_input($request->menu_title); 
            $pArray['description']    				= $request->description; 
            $pArray['language']    					= clean_single_input($request->language); 
			$pArray['txtuplode']  				    = implode(',', $inputimage);
			$pArray['admin_id']  					= $user_login_id;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
           // dd($pArray);
            $create 	= photogallery::where('id', $id)->update($pArray);
            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->menu_title),
								'page_action'           =>  '',
								'page_category'         =>  '',
								'lang'                  =>  clean_single_input($request->language),
								'page_title'        	=> 'Photo Gallery Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> 'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/photo-gallery')->with('success','Photo Gallery has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Photogallery $photogallery,$id)
    {
		$photogallery = photogallery::find($id);
        $photogallerys= $photogallery->delete();
     
        if($photogallerys > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $id,
                            'page_name'             =>  clean_single_input($photogallery->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  clean_single_input($photogallery->language),
                            'page_title'        	=> 'Photo Gallery Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect('admin/photo-gallery')->with('success','Photo Gallery deleted successfully');
        }
       
      }
}
