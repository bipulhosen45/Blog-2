<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Division;
use App\Models\Profile;
use App\Models\Thana;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class UserProfileController extends Controller


{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
   final public function index()
    {
        $divisions = Division::pluck('name', 'id');
        $profile = Profile::where('user_id', Auth::id())->first();
        return view('backend.modules.profile.profile', compact('divisions', 'profile'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'phone' => 'required',
            'address' => 'required',
            'division_id' => 'required',
            'district_id' => 'required',
            'thana_id' => 'required',
            'gender' => 'required',
        ]);
        
        $profile_data = $request->all();

        $profile_data['user_id'] = Auth::id();
        
        $existing_profile = Profile::where('user_id', Auth::id())->first();
        if ($existing_profile){
            $existing_profile->update($profile_data);
        }else{
            Profile::create($profile_data);
        }
       
        return redirect()->back();
    }

// get district   
    final public function getDistrict($division_id)
    {
        $districts = District::select('id', 'name')->where('division_id', $division_id)->get();
        return response()->json($districts);

    }
    final public function getThana($district_id)
    {
        $thanas = Thana::select('id', 'name')->where('district_id', $district_id)->get();
        return response()->json($thanas);

    }

    
    final public function upload_photo(Request $request)
    { 
        $data = array();
        
        $slug = str_slug(Auth::user()->name);
        
        if($request->file('image')){
            if(!file_exists('uploads/user/photo')){
                mkdir('uploads/user/photo', 077, true);
            }
            $photo = $request->image;
            $manager = new ImageManager(new Driver());
            $currentDate = Carbon::Now()->toDateString();
            $photoName = $slug.'-'.$currentDate.'-'.'.'.$photo->getClientOriginalExtension();

            $photo = $manager->read($request->image);
            $photo = $photo->resize(120, 80);  //image intervention
            $photo->toPng()->save(base_path('public/uploads/user/' . $photoName));  //image intervention

            $data['image']='uploads/user/'.$photoName;  
        }else{
            $photoName = 'default.png';
        }
        $photo = new Profile();
        $photo->image = $photoName;
  
        return redirect()->back();
    }

    //user profile update status
    public function userindex()
    {
        $divisions = Division::pluck('name', 'id');
        $districts = District::pluck('name', 'id');
        $thanas = Thana::pluck('name', 'id');
        $data = DB::table('users')
        ->leftJoin('divisions','users.division_id','divisions.id')
        ->leftJoin('districts','users.district_id','districts.id')
        ->leftJoin('thanas','users.thana_id','thanas.id')
        ->select('users.*','divisions.name','districts.name','thanas.name')
        ->where('role', 2)->first();
        return view('backend.modules.profile.index', compact('data','divisions', 'districts', 'thanas'));
    }

    //user profile update status
    public function userupdate(Request $request)
    { 
        $slug = str_slug(Auth::user()->name);

        $data = array();
        $data['name'] =$request->name;
        $data['division_id'] =$request->division_id;
        $data['district_id'] =$request->district_id;
        $data['thana_id'] =$request->thana_id;
        $data['phone'] =$request->phone;
        $data['address'] =$request->address;
        $data['gender'] =$request->gender;
        
        
         if ($request->image) {  //jodi new image die thake
            if (File::exists($request->old_image)) {
				unlink($request->old_image);
			}
            $photo = $request->image;
            $manager = new ImageManager(new Driver());
            $photoName = $slug.'.'.$photo->getClientOriginalExtension();
    
            $photo = $manager->read($request->image);
            $photo = $photo->resize(160, 160);  //image intervention
            $photo->toPng()->save(base_path('public/uploads/profile/' . $photoName));  //image intervention

            $data['image']='uploads/profile/'.$photoName;  
        }else{   //jodi new logo na dey
            $data['image']=$request->old_image;
        }

        $existing_profile = User::where('id', Auth::id())->first();
        if ($existing_profile){
            $existing_profile->update($data);
        }else{
            User::create($data);
        }

        DB::table('users')->where('id', Auth::id())->update($data);
        toastr()->success('Profile Updated!','success');
        return redirect()->back();
    }
}
