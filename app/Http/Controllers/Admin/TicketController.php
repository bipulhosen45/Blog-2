<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class TicketController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    //__all tickets
    public function index(Request $request)
    {
         if ($request->ajax()) {

            $ticket="";
              $query=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id');
                   
                if ($request->date) {
                    $query->where('tickets.date',$request->date);
                 }

                 if ($request->type== 'Technical') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Payment') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Affiliate') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Return') {
                    $query->where('tickets.service',$request->type);
                 }
                 if ($request->type=='Refund') {
                    $query->where('tickets.service',$request->type);
                 }
                 
                if ($request->status==0) {
                    $query->where('tickets.status',0);
                }
                if ($request->status==1) {
                     $query->where('tickets.status',1);
                }

                if ($request->status==2) {
                    $query->where('tickets.status',2);
                }

            $ticket=$query->select('tickets.*','users.name')->get();
            return DataTables::of($ticket)
                    ->addIndexColumn()
                    ->editColumn('status',function($row){
                        if ($row->status==1) {
                            return '<span class="badge badge-warning"> Running </span>';
                        }elseif($row->status==2){
                            return '<span class="badge badge-success"> Close </span>';
                        }else{
                            return '<span class="badge badge-danger"> Pending </span>';
                        }
                    })
                    ->editColumn('date',function($row){
                       return date('d F Y', strtotime($row->date));
                    })
                    ->addColumn('action', function($row){
                        $actionbtn='
                        <a href="'.route('admin.ticket.show',[$row->id]).'" class="btn btn-primary btn-sm"><i class="fas fa-eye"></i></a>
                        <a href="'.route('admin.ticket.delete',[$row->id]).'" class="btn btn-danger btn-sm delete" id="delete_ticket"><i class="fas fa-trash"></i>
                        </a>';
                       return $actionbtn;   
                    })
                    ->rawColumns(['action','status','date'])
                    ->make(true);       
        }
        return view('backend.modules.ticket.index');
    }

    //__show method
    public function show($id)
    {
        $ticket=DB::table('tickets')->leftJoin('users','tickets.user_id','users.id')->select('tickets.*','users.name')->where('tickets.id',$id)->first();
        return view('backend.modules.ticket.view_ticket',compact('ticket'));
    }


    public function AdminReplystore(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=0;
        $data['reply_date']=date('Y-m-d');

        if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = uniqid().'.'.$photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(600,350);  //image interventio
			$photo->toPng()->save(base_path('public/uploads/files/ticket/' . $photoName));  //image intervention

			$data['image'] = 'uploads/files/ticket/'.$photoName;   // public/files/brand/plus-point.jpg
		}
        
        DB::table('replies')->insert($data);
        toastr()->success( 'Replied Done!', 'success');
        return redirect()->back();
    }

    public function TicketClose($id)
    {
         DB::table('tickets')->where('id',$id)->update(['status'=>2]);
         toastr()->success('Ticket Closed!', 'success');
         return redirect()->route('ticket.index');
    }

    public function destroy($id)
    {
        DB::table('tickets')->where('id',$id)->delete();
        return response()->json('successfully deleted!');
    }

    // user ticket section=======================================================
    public function OpenTicket()
    {
        $ticket=DB::table('tickets')->where('user_id',Auth::id())->orderBy('id','DESC')->take(10)->get();
        return view('backend.modules.user.ticket',compact('ticket'));
    }

    //new ticket
    public function NewTicket()
    {
       return view('backend.modules.user.new_ticket');
    }

    //store ticket
    public function StoreTicket(Request $request)
    {
        $validated = $request->validate([
           'subject' => 'required',
        ]);

        $data=array();
        $data['subject']=$request->subject;
        $data['service']=$request->service;
        $data['priority']=$request->priority;
        $data['message']=$request->message;
        $data['user_id']=Auth::id();
        $data['status']=0;
        $data['date']=date('Y-m-d');

        if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = uniqid().'.'.$photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(600,350);  //image interventio
			$photo->toPng()->save(base_path('public/uploads/files/ticket/' . $photoName));  //image intervention

			$data['image'] = 'uploads/files/ticket/'.$photoName;   // public/files/brand/plus-point.jpg
		}
        
        DB::table('tickets')->insert($data);
        toastr()->success('Ticket Inserted!', 'success');
        return redirect()->route('open.ticket');
    }

    //__ticket show
    public function ShowTicket($id)
    {
        $ticket=DB::table('tickets')->where('id',$id)->first();
        return view('backend.modules.user.show_ticket',compact('ticket'));
    }


    //__reply ticket
    public function ReplyTicket(Request $request)
    {
        $validated = $request->validate([
           'message' => 'required',
        ]);

        $data=array();
        $data['message']=$request->message;
        $data['ticket_id']=$request->ticket_id;
        $data['user_id']=Auth::id();
        $data['reply_date']=date('Y-m-d');

        if ($request->file('image')){
			$manager = new ImageManager(new Driver());
			$photo = $request->image;
			$photoName = uniqid().'.'.$photo->getClientOriginalExtension();

			$photo = $manager->read($request->file('image'));
			$photo = $photo->resize(600,350);  //image interventio
			$photo->toPng()->save(base_path('public/uploads/files/ticket/' . $photoName));  //image intervention

			$data['image'] = 'uploads/files/ticket/'.$photoName;   // public/files/brand/plus-point.jpg
		}
        
        DB::table('replies')->insert($data);
        DB::table('tickets')->where('id',$request->ticket_id)->update(['status'=>0]);

        toastr()->success( 'Replied Done!', 'success');
        return redirect()->back();
    }


}
