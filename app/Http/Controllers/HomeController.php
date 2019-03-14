<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function index()
    {
        return view('home');
    }

    public function edit($id){
        
        $title = DB::table('site_title')->where('id', $id)->first()->title;

        $data = array(
            'edit_flag' => true,
            'title' => $title,
            'id' => $id
        );

        return view('home',$data);

    }

    public function viewAll(){
        $title_datas = $title = DB::table('site_title')->get();
        return view('all_site',['title_datas' => $title_datas]);
    }


}
