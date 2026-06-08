<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Amenity;
class HomeController extends Controller
{
    public function room_details($id)
    {
        $room = Room::find($id);
    $amenities = Amenity::all(); // fetch all amenities
    return view('home.room_details', compact('room', 'amenities'));
    }

    public function add_booking(Request $request, $id)
{
       $request->validate([
        'startDate' => 'required|date',
        'endDate' => 'required|date|after:startDate',
        'name' => 'required|string|max:255',
        'email' => 'required|email',
        'phone' => 'required|string|max:15',
        'amenities.*' => 'nullable|exists:amenities,id' 
    ]);

    $startDate = $request->startDate;
    $endDate = $request->endDate;

    $isBooked = Booking::where('room_id', $id)
        ->where('start_date', '<=', $endDate)
        ->where('end_date', '>=', $startDate)
        ->exists();

    if ($isBooked) {
        return redirect()->back()->with('message', 'Room is already booked, try different dates or another room.');
    } else {
        $data = new Booking();
        $data->room_id = $id;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->start_date = $startDate;
        $data->end_date = $endDate;

       
        $room = Room::find($id);
        $totalPrice = $room->price;

       
        $data->total_price = $totalPrice; 
        $data->save();

       
        if ($request->has('amenities')) {
            $amenityIds = $request->amenities;
            $data->amenities()->attach($amenityIds);

          
            $amenitiesPrice = \App\Models\Amenity::whereIn('id', $amenityIds)->sum('price');
            $data->total_price = $totalPrice + $amenitiesPrice;
            $data->save();
        }

        return redirect()->back()->with('message', 'Room booked successfully!');
    }
}

    public function contact(Request $request)
    {
        $data = new Contact;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->message = $request->message;

        $data->save();
        return Redirect()->back()->with('message', 'Message Sent Succesfully');
    }
    public function our_room(Request $request)
    {
      
        if ($request->has('start_date') && $request->has('end_date')) {
            
            $startDate = $request->start_date;
            $endDate = $request->end_date;
            
           
            if ($startDate >= $endDate) {
                return redirect()->back()->with('error', 'Departure date must be after arrival date!');
            }
            
          
            $bookedRoomIds = Booking::where('start_date', '<=', $endDate)
                                    ->where('end_date', '>=', $startDate)
                                    ->pluck('room_id')
                                    ->toArray();
            
 
            $room = Room::whereNotIn('id', $bookedRoomIds)->get();
           
            if ($room->isEmpty()) {
                return view('home.our_room', compact('room'))
                       ->with('error', 'Sorry! No rooms available for these dates. Please try different dates.');
            }
            
            return view('home.our_room', compact('room', 'startDate', 'endDate'))
                   ->with('success', count($room) . ' room(s) available for your dates!');
            
        } else {
      
            $room = Room::all();
            return view('home.our_room', compact('room'));
        }
    }
    public function our_gallery()
    {
        $gallery = Gallery::all();
        return view('home.our_gallery', compact('gallery'));
    }
    public function contact_us()
    {

        return view('home.contact_us');
    }
}
