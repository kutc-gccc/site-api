<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
class SiteDataDBController extends Controller
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


    public function delete($id, $url){
        $site_title_table = DB::table('site_title')->where('id', $id)->first();
        $html_data_id = $site_title_table->id_site_html_data;
        $title = $site_title_table->title;
        DB::table('site_title')->where('id', $id)->delete();
        DB::table('site_html_data')->where('id', $html_data_id)->delete();

        session()->flash('flash_message', $title .' を削除しました');
        
        if(isset($url)){
            return redirect('/'.$url);
        }else{
            return redirect('/home');
        }
    }

    public function view($id){
        $html_data_id = DB::table('site_title')->where('id', $id)->first()->id_site_html_data;
        $html_data = DB::table('site_html_data')->where('id', $html_data_id)->first()->html_data;
        return $html_data;
    }

    public function upload(Request $request){

        $validate_rule = [
            'article_title' => 'required',
            'upfile' => 'bail|required',
        ];
        $this->validate($request, $validate_rule);

        $parser = new \cebe\markdown\GithubMarkdown();
        $article_title = $request->article_title;

        $file_name = $request->file('upfile')->getClientOriginalName();
        $file_path = Storage::put('tempFile', $request->file('upfile'));
        $file = Storage::get($file_path);

        $extension = $request->file('upfile')->getClientOriginalExtension();
        $html = null;
        if($extension=='html'){
            $html = $file;
        }else{
            $html = $parser->parse($file);
        }
        Storage::delete($file_path);

        $html_data_param = [
            'html_data' => $html,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ];
        DB::table('site_html_data')->insert($html_data_param);

        $html_data_id = DB::getPdo()->lastInsertId();
        $site_title_param = [
            'id_site_html_data' => $html_data_id,
            'title' => $article_title,
            'created_at' => NOW(),
            'updated_at' => NOW(),
        ];
        DB::table('site_title')->insert($site_title_param);
        session()->flash('flash_message', $file_name.' をアップロードしました');
        return redirect('/home/'.$html_data_id);

    }
}
