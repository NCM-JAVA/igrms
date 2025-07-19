<?php

namespace App\Http\Controllers\Admin;

use App\Models\admin\Exhibition;
use App\Models\admin\ExhibitionCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Image;
use Illuminate\Support\Facades\Session;

class ExhibitionCategoryController extends Controller
{
   
    /**
     * Display a listing of the Exhibition
     */
  
    public function index()
    {
         $title="Exhibition Category List";
         $approve_status=session()->get('approve_status');
         $sertitle=Session::get('title');
        //  dd($sertitle);
         $approve_status=Session::get('approve_status');
         $language_id=Session::get('language_id');
        //  $lists = ExhibitionCategory::all();
        //  dd($lists);

         $lists = DB::table('exhibition_categories')
                    ->join('exhibitions','exhibition_categories.category_id','exhibitions.id')
                    ->select('exhibition_categories.*','exhibitions.category','exhibitions.language','exhibitions.txtuplode');

         if (!empty($sertitle)) {
             $lists->where('exhibition_categories.title', 'LIKE', "%{$sertitle}%");
         }
         if (!empty($approve_status)) {
             $lists->where('exhibition_categories.txtstatus',$approve_status);
         }
         if (!empty($language_id)) {
             $lists->where('exhibitions.language',$language_id);
         }
         
         $list = $lists->orderBy('created_at', 'DESC')->paginate(10);
         return view('admin/exhibitionCategory/index',compact(['list','title']));
        
    }

    /**
     * Show the form for creating a new Exhibition details.
     */
    public function create()
    {
        $title="Add Exhibition Category ";
        $category_lists = Exhibition::all();
        return view('admin/exhibitionCategory/add',compact(['title','category_lists']));
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
            return redirect('admin/exhibition-category');
        }

        $language = Exhibition::where('id', $request->category_id)->select('language')->first();

        if(isset($request->cmdsubmit)){  
        $category_txtuplode ='';
        $rules = array(
            'category_id' => 'required',
            'title' => 'required',
            'txtstatus' => 'required',
            'category_txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:1024'
        );
        $valid
        =array(
            'category_id.required'=>'Category Id field  is required',
            'title.required'=>'Title field is required',
            'txtstatus.required' =>'status field is required'

        );
         $validator = Validator::make($request->all(), $rules, $valid);
        if ($validator->fails()) {
      
            return redirect()->back()->withErrors($validator)->withInput();
            
        }else{
            
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/', 0777, TRUE);
            }
            if (!is_dir('public/upload/admin/cmsfiles/exhibition/thumbnail/')) {
                mkdir('public/upload/admin/cmsfiles/exhibition/thumbnail/', 0777, TRUE);
            }
            if(!empty($request->category_txtuplode)){

                $category_txtuplode = str_replace(' ','_',clean_single_input($request->title)).'_exhibition-category'.'.'.$request->category_txtuplode->extension();
                
                $image = $request->file('category_txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/exhibition/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$category_txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/exhibition/');
                $image->move($destinationPath, $category_txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//exhibition/'.$category_txtuplode; //die();
				
                if (file_exists($txtuplode1)) {
                    unlink($category_txtuplode);
                }
                $thumbnail1 ='upload/admin/cmsfiles//exhibition/'.$destinationPathThumbnail; //die();
				
                if (file_exists($thumbnail1)) {
                    unlink($destinationPathThumbnail);
                }
            }
            
            $user_login_id=Auth()->user()->id;
            $dataArr = array(); 
            $pArray['category_id']    				= clean_single_input($request->category_id); 
            $pArray['title']    				    = clean_single_input($request->title); 
            $pArray['description']    				= clean_single_input($request->description); 
			$pArray['category_txtuplode']  		    = $category_txtuplode;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);
			
			
			$create 	= ExhibitionCategory::create($pArray);
            $lastInsertID = $create->id;
            $user_login_id=Auth()->user()->id;
            $usertype=Auth()->user()->designation;

            if($lastInsertID > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $lastInsertID,
								'page_name'             =>  clean_single_input($request->title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  $language->language,
								'page_title'        	=> 'Exhibition Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/exhibition-category')->with('success','Exhibition category details has successfully added');
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
        $title="Edit Exhibition Category";
        $id=clean_single_input($id);
        $data = ExhibitionCategory::find($id);
        $category_lists = Exhibition::all();
        return view('admin/exhibitionCategory/edit',compact(['title','data','category_lists']));
    }

    /**
     * Update the specified exhibition in storage.
     */
    public function update(Request $request, string $id)
    {
        $language = Exhibition::where('id', $request->category_id)->select('language')->first();
        $validator = '';
        $id=clean_single_input($id);
        $category_txtuplode ='';
        $rules = array(
            'category_id' => 'required',
            // 'language' => 'required',
            'txtstatus' => 'required'
        );
        $valid = array(
            'category_id.required'=>'Category field  is required',
             'txtstatus.required' =>'status field is required'
        );

        if(!empty($request->category_txtuplode)){
            $rules = array(
                'category_txtuplode' => 'image|mimes:jpeg,png,jpg,gif,svg|max:1024'
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
            if(!empty($request->category_txtuplode)){
                $category_txtuplode = str_replace(' ','_',clean_single_input($request->title)).'_exhibition-category'.'.'.$request->category_txtuplode->extension();
                $image = $request->file('category_txtuplode');
                $destinationPathThumbnail = public_path('upload/admin/cmsfiles/exhibition/thumbnail');
                $img = Image::make($image->path());
                $img->resize(1350, 380, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPathThumbnail.'/'.$category_txtuplode);
             
                $destinationPath = public_path('upload/admin/cmsfiles/exhibition/');
              
                $image->move($destinationPath, $category_txtuplode);

                $txtuplode1 ='upload/admin/cmsfiles//exhibition/'.$category_txtuplode; //die();
				
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
            $pArray['category_id']    				= clean_single_input($request->category_id); 
            $pArray['title']    				    = clean_single_input($request->title); 
            $pArray['description']    				= clean_single_input($request->description); 
			$pArray['category_txtuplode']  		    = $category_txtuplode ? $category_txtuplode : $oldimg;
			$pArray['txtstatus']  			        = clean_single_input($request->txtstatus);

            $create 	= ExhibitionCategory::where('id', $id)->update($pArray);

            if($create > 0){
				$audit_data = array('user_login_id'     =>  $user_login_id,
								'page_id'           	=>  $id,
								'page_name'             =>  clean_single_input($request->title),
								'page_action'           =>  'Insert',
								'page_category'         =>  '',
								'lang'                  =>  $language->language,
								'page_title'        	=> 'Exhibition Model',
								'approve_status'        => clean_single_input($request->txtstatus),
								'usertype'          	=> $usertype??'Admin'
							);
							
				audit_trail($audit_data);
                return redirect('admin/exhibition-category')->with('success','Exhibition category has successfully Updated');
			}
           
        }
    }

    /**
     * Remove the specified exhibition from storage.
     */
    public function destroy(ExhibitionCategory $exhibitionCategory)
    {
        $delete = $exhibitionCategory->delete();

        if($delete > 0){
            $user_login_id=Auth()->user()->id;
            $audit_data = array('user_login_id'     =>  $user_login_id,
                            'page_id'           	=>  $exhibitionCategory->id,
                            'page_name'             =>  clean_single_input($exhibitionCategory->title),
                            'page_action'           =>  'delete',
                            'page_category'         =>  '',
                            'lang'                  =>  1,
                            'page_title'        	=> 'Exhibition Category Model',
                            'approve_status'        => 1,
                            'usertype'          	=> 'Admin'
                        );
                        
            audit_trail($audit_data);
            return redirect()->back()->with('success','Exhibition category deleted successfully');
         }
       
        
    }
    
}

