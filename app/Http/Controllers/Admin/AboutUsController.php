<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\SliderResource;
use App\Models\AboutUs;
use App\Models\AboutUsPoint;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    protected $view = 'admin.about_us.';
    protected $redirect = 'admin/about_us';
    public function index()
    {
        $settings = AboutUs::orderBy('id','DESC');
        // if(\request('title1')){
        //     $key = \request('title1');
        //     $settings = $settings->where('title1','like','%'.$key.'%');
        // }
        // if(\request('status')){
        //     $key = \request('status');
        //     $settings = $settings->where('status',$key);
        // }
        $settings = $settings->paginate(config('custom.per_page'));
        return view($this->view.'index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view($this->view.'create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(\request(),[
            
            
            'description' => 'required',
            'image' => 'required|file|mimes:jpeg,png,jpg',
            'keyword' => 'required'
        ]);

        $setting = new AboutUs();

        $setting->description = strip_tags(\request('description'));
        $setting->sub_description = strip_tags(\request('sub_description'));
        $setting->status = \request('status');
        $setting->keyword = \request('keyword');
        $setting->seo_title = \request('seo_title');
        $setting->meta_keyword = strip_tags(\request('meta_keyword'));
        $setting->seo_description = strip_tags(\request('seo_description'));
        $setting->slug = Setting::create_slug(\request('seo_title'));
        if($request->hasFile('image')){
                $extension = \request()->file('image')->getClientOriginalExtension();
                $image_folder_type = array_search('about_us',config('custom.image_folders')); //for image saved in folder
                $count = rand(100,999);
                $out_put_path = User::save_image(\request('image'),$extension,$count,$image_folder_type);
                if($extension == "jpeg" || $extension == "jpg" || $extension == "png"){
                    $image_path = $out_put_path[0];
                    $setting->image = $image_path;
//                    $setting->doc_name = $out_put_path[2];
                }
            }

                
            
    
        if($setting->save()){
            $points = $request->points;
                if($points[0] != null){
                    foreach($points as $key => $point){
        
                        $about_us_point = new   AboutUsPoint();
                        
                        $about_us_point->about_us_id = $setting->id;
                        
                        
                        $about_us_point->point = $point;
                        $about_us_point->save();
                    }
                }
 
            Session::flash('success','About Us has been created!');
            return redirect($this->redirect);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $about_us = AboutUs::findorfail($id);
        return view($this->view.'show',compact('about_us'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $about_us = AboutUs::findorfail($id);
      return view($this->view.'edit',compact('about_us'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $setting=AboutUs::findorfail($id);

        $this->validate(\request(),[
            'keyword' => 'required',
            'description' => 'required',
            'image' => 'file|mimes:jpeg,png,jpg',
            'status' => 'required'
        ]);



        $setting->description = strip_tags(\request('description'));
        $setting->sub_description = strip_tags(\request('sub_description'));
        $setting->status = \request('status');
        $setting->keyword = \request('keyword');
        $setting->seo_title = \request('seo_title');
        $setting->meta_keyword = strip_tags(\request('meta_keyword'));
        $setting->seo_description = strip_tags(\request('seo_description'));
        $setting->point_title = strip_tags(\request('point_title'));
        $setting->slug = Setting::create_slug(\request('seo_title'));
        if($request->hasFile('image')){
            $extension = \request()->file('image')->getClientOriginalExtension();
            $image_folder_type = array_search('about_us',config('custom.image_folders')); //for image saved in folder
            $count = rand(100,999);
            $out_put_path = User::save_image(\request('image'),$extension,$count,$image_folder_type);
            $image_path = $out_put_path[0];
            $setting->image = $image_path;
//                    $setting->doc_name = $out_put_path[2];
        }
//        $requestData = $request->all();
//        $setting->fill($requestData);
        if($setting->update()){
            $points = $request->points;
         
            if((!empty($points)) && ($points[0] != null)){
                $about_us_point = $setting->about_us_points();
                $about_us_point->delete();
                foreach($points as $point){
                    $about_us_point = new AboutUsPoint();
                    $about_us_point->about_us_id = $id;
                    $about_us_point->point = $point;
                    $about_us_point->save();
                }
            }
            Session::flash('success','About Us has been Updated!');
            return redirect($this->redirect);
        }
        
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getSliders(){

        $settings = Slider::where('status',1)->get();
        return SliderResource::collection($settings);
    }
}
