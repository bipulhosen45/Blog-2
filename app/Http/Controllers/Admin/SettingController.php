<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */

    //website setting
    public function website()
    {
        $setting=DB::table('settings')->first();
        return view('backend.modules.setting.website',compact('setting'));
    }

    //website setting update
    public function WebsiteUpdate(Request $request,$id)
    {
        $slug = Str::slug($request->phone_one);
        $data=array();
        $data['currency']=$request->currency;
        $data['phone_one']=$request->phone_one;
        $data['phone_two']=$request->phone_two;
        $data['main_email']=$request->main_email;
        $data['support_email']=$request->support_email;
        $data['address']=$request->address;
        $data['facebook']=$request->facebook;
        $data['twitter']=$request->twitter;
        $data['instagram']=$request->instagram;
        $data['linkedin']=$request->linkedin;
        $data['youtube']=$request->youtube;
        if ($request->main_logo) {  //jodi new logo die thake
            if (File::exists($request->old_logo)) {
				unlink($request->old_logo);
			}
            $photo = $request->main_logo;
            $manager = new ImageManager(new Driver());
            $photoName = $slug.'.'.$photo->getClientOriginalExtension();
    
            $photo = $manager->read($request->main_logo);
            $photo = $photo->resize(320, 120);  //image intervention
            $photo->toPng()->save(base_path('public/uploads/files/logo/' . $photoName));  //image intervention

            $data['main_logo']='uploads/files/logo/'.$photoName;  
        }else{   //jodi new logo na dey
            $data['main_logo']=$request->old_logo;
        }

        if ($request->favicon) {  //jodi new logo die thake
            if (File::exists($request->old_favicon)) {
				unlink($request->old_favicon);
			}
              $favicon=$request->favicon;
              $manager = new ImageManager(new Driver());
              $favicon_name=uniqid().'.'.$favicon->getClientOriginalExtension();
              $favicon = $manager->read($request->favicon);
              $favicon = $favicon->resize(220, 80);  //image intervention
              $favicon->toPng()->save(base_path('public/uploads/files/logo/' . $favicon_name));  //image intervention
              $data['favicon']='uploads/files/logo/'.$favicon_name;  
        }else{   //jodi new logo na dey
            $data['favicon']=$request->old_favicon;
        }

        DB::table('settings')->where('id',$id)->update($data);
        toastr()->success('Setting Updated!','success');
        return redirect()->back();


    }

}
