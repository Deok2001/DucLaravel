<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class HomeController extends Controller
{
    public function send_mail(){
        //send mail
        $to_name = "Hoang Anh Duc";
        $to_email = "hoanganhduczzxx@gmail.com";

        $data = array("name"=>"Mail từ tài khoản khách hàng","body"=>"Mail gửi về vấn đề hàng hóa");

        Mail::send('pages.send_mail',$data,function($message) use ($to_name,$to_email){
            $message->to($to_email)->subject('Test thử gửi mail google');
            $message->from($to_email,$to_name);
        });
        return redirect('/')->with('message','');
        //end send mail
    }
    public function index(Request $request){
        //seo
        $meta_desc= "Chuyên bán các loại phụ kiện hỗ trợ chơi game";
        $meta_keywords = "Phụ kiện chơi game, phụ kiện chơi game, phụ kiện chơi game";
        $meta_title = "Phụ kiện chơi game dành cho Proplayer";
        $url_canonical = $request->url();
        //endseo


        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand','tbl_brand.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();

        $all_product = DB::table('tbl_product')->where('product_status','1')->orderBy('brand_id','desc')->limit(8)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('all_product',$all_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
    public function search(Request $request){
        $meta_desc= "Tìm kiếm sản phẩm";
        $meta_keywords = "Tìm kiếm sản phẩm";
        $meta_title = "Tìm kiếm sản phẩm";
        $url_canonical = $request->url();
        $keywords = $request->keywords_submit;

        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderBy('category_id','desc')->get();

        $brand_product = DB::table('tbl_brand')->where('brand_status','1')->orderBy('brand_id','desc')->get();

        $search_product= DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        
        return view('pages.products.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product)
        ->with('meta_desc',$meta_desc)->with('meta_keywords',$meta_keywords)->with('meta_title',$meta_title)->with('url_canonical',$url_canonical);
    }
}
