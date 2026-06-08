<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Gallery;
use App\Models\Contact;
use App\Notifications\SendEmailNotification;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    function index()
    {
        if (Auth::id()) {
            $usertype = Auth::user()->usertype;
            if ($usertype == "user")
             {
                $room = Room::all();
                $gallery= Gallery::all();
                return view('home.index',compact('room','gallery'));
            } 
                
                $reportData = Booking::selectRaw('
                        YEAR(start_date) as year,
                        MONTH(start_date) as month,
                        COUNT(bookings.id) as total_bookings,
                        SUM(bookings.total_price) as total_revenue,
                        SUM(CASE WHEN LOWER(rooms.room_type) = "regular" THEN 1 ELSE 0 END) as regular_rooms,
                        SUM(CASE WHEN LOWER(rooms.room_type) = "premium" THEN 1 ELSE 0 END) as premium_rooms,
                        SUM(CASE WHEN LOWER(rooms.room_type) = "deluxe" THEN 1 ELSE 0 END) as deluxe_rooms
                    ')
                    ->join('rooms', 'bookings.room_id', '=', 'rooms.id')
                    ->whereNotNull('bookings.start_date')
                    ->where('bookings.status', '!=', 'rejected')
                    ->groupBy('year', 'month')
                    ->orderBy('year', 'desc')
                    ->orderBy('month', 'desc')
                    ->limit(12)
                    ->get()
                    ->map(function($item) {
                        return [
                            'month_year' => date('F Y', mktime(0, 0, 0, $item->month, 1, $item->year)),
                            'total_bookings' => $item->total_bookings,
                            'total_revenue' => number_format($item->total_revenue, 0),
                            'regular_rooms' => $item->regular_rooms,
                            'premium_rooms' => $item->premium_rooms,
                            'deluxe_rooms' => $item->deluxe_rooms,
                        ];
                    });
    
                return view('admin.index', compact('reportData'));
                
            } else {
                return redirect()->back();
            }
        
        }
    
    
    public function home()
    {
        $room = Room::all();
        $gallery= Gallery::all();
        return view('home.index',compact('room','gallery'));
    }

    public function create_room()
    {
        return view('admin.create_room');
    }
    public function add_room(Request $request)
    {
        $data = new Room;
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;

        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();
        return Redirect()->back();
    }

    public function view_room()
    {

        $data = Room::all();
        return view('admin.view_room', ['data' => $data]);
    }
    public function room_delete($id)
    {

        $data = Room::find($id);
        $data->delete();
        return redirect()->back();
    }
    public function room_update($id)
    {
        $data = Room::find($id);
        return view('admin.room_update', compact('data'));
    }
    public function edit_room(Request $request, $id)
    {
        $data = Room::find($id);
        $data->room_title = $request->title;
        $data->description = $request->description;
        $data->price = $request->price;
        $data->wifi = $request->wifi;
        $data->room_type = $request->type;
        $image = $request->image;

        if ($image) {
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $request->image->move('room', $imagename);
            $data->image = $imagename;
        }

        $data->save();

        return Redirect()->back();
    }
    public function bookings()
    {
        $data = booking::all();
        return view('admin.booking',compact('data'));
    }
    public function delete_booking($id)
    {
      $data = booking::find($id);
      $data->delete();
      return Redirect()->back();
    }
    public function approved_book($id)
    {
      $data = booking::find($id);
      $data->status='approve';
      $data->save();
     return Redirect()->back();
    }

    public function rejected_booking($id)
    {
      $data = booking::find($id);
      $data->status='rejected';
      $data->save();
     return Redirect()->back();
    }
    
    public function view_gallery()
    {
        $gallery = Gallery::all();
        return view('admin.gallery',compact('gallery'));
    }
    
    public function upload_gallery(Request $request)
    {
        $data = new Gallery;
        $image = $request->image;
        if($image){
            $imagename=time().'.'.$image->getClientOriginalExtension();
            $request->image->move('gallery',$imagename);
            $data->image = $imagename;
            $data->save();
            return redirect()->back();
        }
    }
    public function delete_gallery($id)
    {
      $data = Gallery::find($id);
      $data->delete();
      return Redirect()->back();
    }
    public function all_message()
    {
        $data = Contact::all();
     return view('admin.all_message',compact('data'));
    }
    public function send_mail($id)
    {
        $data = Contact::find($id);
     return view('admin.send_mail',compact('data'));
    }
    public function mail(Request $request, $id)
    {
        $data = Contact::find($id);
        
        $details = [
            'greeting' => $request->greeting,     
            'body' => $request->body,              
            'action_text' => $request->action_text, 
            'action_url' => $request->action_url,   
            'endline' => $request->endline,        ];

        Notification::send($data, new SendEmailNotification($details));
        
        return redirect()->back()->with('message', 'Email sent successfully!');
    }
 
}
