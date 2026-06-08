<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;

class GeminiChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = strtolower($request->input('message'));

        //  Branches
        if (str_contains($message, 'branch') || str_contains($message, 'location') || str_contains($message, 'where')) {
            return response()->json(['reply' => 'We have branches in:\n• Lahore\n• Karachi\n• Islamabad\n\nAll branches offer the same excellent service!']);
        }

        //  Services
        if (str_contains($message, 'service') || str_contains($message, 'facility') || str_contains($message, 'facilities')) {
            return response()->json(['reply' => ' HotelNest offers:\n•  Swimming Pool\n•  Spa\n• Gym\n•  Free Wi-Fi\n•  Breakfast\n• Airport Pickup\n• 24/7 Room Service\n\nWe ensure your comfort!']);
        }

        //  Check-in/Check-out
        if (
            str_contains($message, 'check-in') || str_contains($message, 'check in') ||
            str_contains($message, 'check-out') || str_contains($message, 'check out') ||
            str_contains($message, 'timing') || str_contains($message, 'time')
        ) {
            return response()->json(['reply' => ' Our timings:\n• Check-in: 12:00 PM (Noon)\n• Check-out: 11:00 AM\n\nEarly check-in and late check-out available on request!']);
        }

        //  Established
        if (
            str_contains($message, 'establish') || str_contains($message, 'when') ||
            str_contains($message, 'history') || str_contains($message, 'founded')|| str_contains($message, 'about')
        ) {
            return response()->json(['reply' => ' HotelNest was established in 2005.\n\nWe have been proudly serving guests for almost 20 years with excellence and hospitality!']);
        }

        //  Pricing
        if (
            str_contains($message, 'price') || str_contains($message, 'cost') ||
            str_contains($message, 'rate') || str_contains($message, 'charge')
        ) {
            $rooms = Room::select('room_type', 'price')->groupBy('room_type', 'price')->get();
            $reply = " Our room rates:\n\n";
            foreach ($rooms as $room) {
                $reply .= "• " . ucfirst($room->room_type) . " Room: Rs. {$room->price}/night\n";
            }
            $reply .= "\nPrices may vary based on season and availability.";
            return response()->json(['reply' => $reply]);
        }

        //  Room Types
        if (
            str_contains($message, 'room type') || str_contains($message, 'types of room') ||
            str_contains($message, 'what room')
        ) {
            return response()->json(['reply' => ' We offer three types of rooms:\n\n•  Regular Rooms - Comfortable and affordable\n•  Premium Rooms - Enhanced amenities\n•  Deluxe Rooms - Luxury experience\n\nAll rooms include free Wi-Fi!']);
        }

        //  Available Rooms (Database Check)
        if (
            str_contains($message, 'available') || str_contains($message, 'book') ||
            str_contains($message, 'vacancy')
        ) {

            // Default dates (you can enhance this to parse dates from message)
            $startDate = now()->format('Y-m-d');
            $endDate = now()->addDays(3)->format('Y-m-d');

            $bookedRoomIds = Booking::where('start_date', '<=', $endDate)
                ->where('end_date', '>=', $startDate)
                ->where('status', '!=', 'rejected')
                ->pluck('room_id')
                ->toArray();

            $availableRooms = Room::whereNotIn('id', $bookedRoomIds)->get();

            if ($availableRooms->isEmpty()) {
                return response()->json(['reply' => " Sorry! No rooms are currently available.\n\nPlease try different dates or contact our reception for assistance.\n Reception: Available 24/7"]);
            }

            $reply = " Available rooms:\n\n";
            $groupedRooms = $availableRooms->groupBy('room_type');

            foreach ($groupedRooms as $type => $rooms) {
                $reply .= "**" . ucfirst($type) . " Rooms:**\n";
                foreach ($rooms as $room) {
                    $wifi = $room->wifi == 'yes' ? '' : '';
                    $reply .= "• {$room->room_title} - Rs. {$room->price}/night {$wifi}\n";
                }
                $reply .= "\n";
            }

            $reply .= "Would you like to book? Visit our website or call reception! ";
            return response()->json(['reply' => $reply]);
        }

        // Contact
        if (
            str_contains($message, 'contact') || str_contains($message, 'phone') ||
            str_contains($message, 'call') || str_contains($message, 'reach')
        ) {
            return response()->json(['reply' => ' Contact HotelNest:\n\n• Reception: 24/7 Available\n• Email: info@hotelnest.com\n• Website: www.hotelnest.com\n\nOur staff is always ready to help you!']);
        }

        //  Food/Breakfast
        if (
            str_contains($message, 'food') || str_contains($message, 'breakfast') ||
            str_contains($message, 'meal') || str_contains($message, 'dining')
        ) {
            return response()->json(['reply' => ' Dining at HotelNest:\n\n• Complimentary breakfast included\n• In-room dining (24/7)\n• Restaurant with local & international cuisine\n• Special dietary requirements accommodated\n\nEnjoy delicious meals during your stay!']);
        }

        //  Booking Process
        if (
            str_contains($message, 'how to book') || str_contains($message, 'booking process') ||
            str_contains($message, 'reserve')
        ) {
            return response()->json(['reply' => ' How to book:\n\n Visit our Rooms page\ Select your dates\n Choose your room type\n Fill in your details\n Confirm booking\n\n You will receive confirmation via email!\n\nOr call our reception for instant booking.']);
        }

        // Parking
        if (str_contains($message, 'park') || str_contains($message, 'vehicle')) {
            return response()->json(['reply' => ' Free parking available for all guests!\n\nSecure parking area with 24/7 security. Both covered and open parking spots available.']);
        }

        //  Cancellation
        if (str_contains($message, 'cancel') || str_contains($message, 'refund')) {
            return response()->json(['reply' => ' Cancellation Policy:\n\n• Free cancellation up to 24 hours before check-in\n• 50% refund for cancellations within 24 hours\n• No refund for no-shows\n\nContact reception for assistance with cancellations.']);
        }

        //  Greetings
        if (
            str_contains($message, 'hi') || str_contains($message, 'hello') ||
            str_contains($message, 'hey') || str_contains($message, 'assalam')||str_contains($message, 'hy')
        ) {
            return response()->json(['reply' => ' Hello! Welcome to HotelNest!\n\nI am your virtual assistant. How can I help you today?\n\nYou can ask me about:\n• Our branches and locations\n• Available rooms\n• Services and facilities\n• Pricing and booking\n• Check-in/check-out times\n\nJust type your question! ']);
        }

        //  Thank you
        if (str_contains($message, 'thank') || str_contains($message, 'thanks')) {
            return response()->json(['reply' => ' You\'re welcome! Happy to help!\n\nIf you have any more questions, feel free to ask. We look forward to hosting you at HotelNest! ✨']);
        }

        //  Goodbye
        if (str_contains($message, 'bye') || str_contains($message, 'goodbye')) {
            return response()->json(['reply' => '👋 Goodbye! Have a wonderful day!\n\nWe hope to see you soon at HotelNest. Safe travels! ']);
        }


        if (str_contains($message, 'help') || str_contains($message, 'what can you')) {
            return response()->json(['reply' => ' I can help you with:\n\n Locations & Branches\n Room Availability\n Pricing Information\n Services & Facilities\n Check-in/Check-out Times\n Contact Information\n Dining Options\n Booking Process\n Parking Details\n Cancellation Policy\n\nJust ask me anything! ']);
        }

        return response()->json(['reply' => ' I\'m not sure I understood that.\n\nYou can ask me about:\n• Available rooms\n• Our branches\n• Services and facilities\n• Pricing\n• Booking process\n\nOr type "help" to see all options! 😊']);
    }
}
