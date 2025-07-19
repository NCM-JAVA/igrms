<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\admin\Menu;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index($slug="")
    {   $title="View Menu ";
        $views = Menu::all();
        $view =  Menu::where('m_url', 'LIKE', "%{$slug}%")->first();
        if(!empty($view)){
            return response()->view('/admin/dashboard', compact('views', 'view','title'));
        }else{
            return redirect('/');  
        }
      
    }
}
