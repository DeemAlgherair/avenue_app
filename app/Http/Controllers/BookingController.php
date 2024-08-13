<?php

namespace App\Http\Controllers;

use App\Models\Avenue;
use App\Models\Day;
use App\Notifications\AvenueBooked;
use Auth;
use App\Models\Review;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Booking;
use App\Http\Requests\StoreAvenuebookingRequest;
use App\Http\Requests\UpdateAvenuebookingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\BookingSubmitted;
use DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\ApprovedMail; 
use Illuminate\Support\Facades\Log;


class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookings = Booking::with(['customers','avenues','booking_statuses'])->orderBy('created_at', 'desc')->get();
        return view('Backend.booking.show-booking')->with('bookings',$bookings);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function success()
    {
        
        return view('Frontend.layout.success');
    }

    
     public function create($avenueId)
    {
        
    }
    function generateUniqueSerialNumber()
    {
        // Get the current timestamp
        $timestamp = now()->format('YmdHis');
    
        // Generate a random string 
        $randomString = substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'), 0, 6);
    
        // Combine timestamp and random string
        $serialNumber = $timestamp . $randomString;
    
        return $serialNumber;
    }
    /**
     * Store a newly created resource in storage.
     */
    
     public function store(StoreAvenuebookingRequest $request, $avenueId) 
     { 
         $selectedAvenue = Avenue::findOrFail($avenueId); 
      
         // Validate form data 
         $validatedData = $request->validated(); 
      
         // Check for overlapping bookings 
         $isBooked = Booking::where('avenue_id', $avenueId)
         ->where('status_id', 3)
             ->where(function ($query) use ($request) { 
                 $query->whereBetween('startDate', [$request->start_date, $request->end_date]) 
                       ->orWhereBetween('endDate', [$request->start_date, $request->end_date]) 
                       ->orWhere(function ($query) use ($request) { 
                           $query->where('startDate', '<=', $request->start_date) 
                                 ->where('endDate', '>=', $request->end_date); 
                       }); 
             })->exists(); 
      
         if ($isBooked) { 
             return redirect()->back()->withErrors(['date' => 'The selected date range is already booked.'])->withInput(); 
         } 
   // Calculate booked days
   $startDate = Carbon::parse($request->start_date);
   $endDate = Carbon::parse($request->end_date);
   $bookedDays = $startDate->diffInDays($endDate) + 1; // Including the end date      
         // Create a new booking 
         $booking = new Booking(); 
         $booking->booking_date = now(); 
         $booking->startDate = $request->start_date; 
         $booking->endDate = $request->end_date; 
         $booking->serial_no = $this->generateUniqueSerialNumber(); 
         $booking->customer_id = Auth::guard('customers')->id(); 
         $booking->avenue_id = $selectedAvenue->id; 
         $booking->status_id = 1; // 'Pending' 
         $booking->subtotal = $selectedAvenue->price_per_hours *  $bookedDays; 
         $booking->tax = $booking->subtotal * 0.05; // 5% tax 
         $booking->total = $booking->subtotal + $booking->tax; 
      
         $booking->save(); 
         $admins = User::where('id', 1)->get(); 
         //send to database
         Notification::send($admins , new AvenueBooked($booking->id));
         //send to mail
         Notification::send($admins, new BookingSubmitted($booking));



         session()->flash('customer_message', 'Booking created successfully!');
         return redirect()->route('invoice.show', $booking->id);
     }

    /**
     * Display the specified resource.
     */
    public function show(Request $request,$avenueId)
    { 
        $selectedAvenue = Avenue::with('days')->findOrFail($avenueId);
        $bookings = Booking::with(['customers','avenues','booking_statuses'])->get();


    
        return view("Frontend.layout.booking", [
            'selectedAvenue' => $selectedAvenue,
            //'availableDays' => $availableDays,
            'bookings' => $bookings

        ]);
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function detailsBooking($id)
    {
        // استرجاع تفاصيل الحجز
        $bookings = Booking::with(['customers', 'avenues', 'booking_statuses'])->findOrFail($id);
    
        // استرجاع معرفات الإشعارات المرتبطة بهذا الحجز
        $booknotiIds = DB::table('notifications')
            ->where('data->booking_id', $id)
            ->pluck('id');
    
        // تحديث الإشعارات كمقروءة
        DB::table('notifications')
            ->whereIn('id', $booknotiIds)
            ->update(['read_at' => now()]);
    
        // عرض تفاصيل الحجز في الواجهة
        return view('Backend.booking.details-booking')->with('bookings', $bookings);
    }
    
    public function printinvoice($id)
    {
        
        $bookings = Booking::with(['customers','avenues','booking_statuses'])->findOrFail($id);
        return view('Backend.booking.print-invoice')->with('bookings',$bookings);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAvenuebookingRequest $request, Booking $avenuebooking)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $bookings= Booking::findOrFail($id);
        $bookings->delete();
        session()->flash('success', 'Reservation deleted successfully!');
        return redirect()->route('showReservation');
    }

    public function confiremdBooking($id)
    {
        $booking = Booking::findOrFail($id);
        $booking->status_id = 2; // Assuming 2 is the ID for "Approved"
        $booking->save();
        $paymentDeadline = now()->addHours(24)->format('d-m-Y H:i');
        // Send an email to the customer
        $customerName = $booking->customers->name;
        $bookingDetailsUrl = route('invoice.show', ['id' => $booking->id]);
        $customerEmail = $booking->customers->email;
    
        Mail::to($customerEmail)->send(new ApprovedMail($customerName, $booking->serial_no, $bookingDetailsUrl,$paymentDeadline,$booking->id));

    
        session()->flash('customer_message', 'Your booking is confirmed. Please proceed to payment.');
        return back()->with('success', 'Booking confirmed and email sent!');

    }

    public function showConfirmedBookings( Request $request)
    {
        $customer_id = Auth::guard('customers')->user()->id;

        $confirmedBookings = Booking::where('customer_id', $customer_id)->get();
        
        $reviews = Review::where('customer_id', $customer_id)->get();

        $filter = $request->query('filter', 'latest');
    
        $query = Booking::where('customer_id', $customer_id);
        if ($filter == 'latest') {
            $query->orderBy('created_at', 'desc');
        } elseif ($filter == 'oldest') {
            $query->orderBy('created_at', 'asc');
        } elseif ($filter == 'paid') {
            $query->orderBy('created_at', 'desc');

            $query->where('status_id', 3);
        } elseif ($filter == 'not_paid') {
            $query->where('status_id', 2);
        } elseif ($filter == 'not_approved') {
            $query->whereIn('status_id', [4, 5]);
            $query->orderBy('created_at', 'desc');

        }
        
        $confirmedBookings = $query->get();

        
        return view('Frontend.layout.Confirmed')
            ->with('confirmedBookings', $confirmedBookings)
            ->with('reviews', $reviews); 
     }
    public function reviewBooking($bookingId)
    {
        $booking = Booking::findOrFail($bookingId);
        // Fetch the existing review if it exists
        $review = Review::where('customer_id', Auth::guard('customers')->id() )
                        ->where('avenue_id', $booking->avenue_id)
                        ->where('booking_id',$bookingId)
                        ->first();
    
        return view('Frontend.layout.review', [
            'booking' => $booking,
            'review' => $review // Pass the review to the view
        ]);
    }
    

    public function submitReview(Request $request, $bookingId)
    {
        $request->validate([
            'rate' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
    
        $booking = Booking::findOrFail($bookingId);
    
        // Check if a review already exists
        $review = Review::where('customer_id',Auth::guard('customers')->id())
                        ->where('avenue_id', $booking->avenue_id)
                        ->where('booking_id', $bookingId)
                        ->first();
    
        if ($review) {
            // Update the existing review
            $review->update([
                'rate' => $request->input('rate'),
                'comment' => $request->input('comment'),
            ]);
    
            return redirect()->route('confirmed.bookings')
                             ->with('success', 'Review updated successfully!');
        } else {
            // Create a new review
            Review::create([
                'rate' => $request->input('rate'),
                'comment' => $request->input('comment'),
                'customer_id' => Auth::guard('customers')->id(),
                'avenue_id' => $booking->avenue_id,
                'booking_id' => $bookingId ,// Ensure booking_id is provided here

            ]);
    
            return redirect()->route('confirmed.bookings')
                             ->with('success', 'Review submitted successfully!');
        }
    }

    
public function showUnconfirmedBookings() { 
        $unconfirmedBookings = Booking::all(); 
 
        return view('Frontend.layout.unconfirmed', compact('unconfirmedBookings'));
    }
    public function search(Request $request) {
        $query = $request->input('query');
        $paymentStatus = $request->input('payment_status');
        
        // بناء الاستعلام الأساسي
        $bookings = Booking::where(function ($q) use ($query) {
            $q->whereHas('customers', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })->orWhereHas('avenues', function ($q) use ($query) {
                $q->where('name', 'LIKE', '%' . $query . '%');
            })->orWhereHas('status', function ($q) use ($query) {
                $q->where('statues_name', 'LIKE', '%' . $query . '%');
            });
    
            // إضافة البحث النصي عن حالة الدفع
            if (str_contains(strtolower($query), 'payment failed')) {
                $q->orWhere('status_id', 4); // الدفع فشل
            } elseif (str_contains(strtolower($query), 'payment succeeded')) {
                $q->orWhere('status_id', 3); // الدفع نجح
            } elseif (str_contains(strtolower($query), 'waiting for payment')) {
                $q->orWhere('status_id', 2); // بانتظار الدفع
            }
        });
    
        // إضافة فلترة حالة الدفع إذا تم اختيارها
        if ($paymentStatus) {
            if ($paymentStatus == 'failed') {
                $bookings->where('status_id', 4); // الدفع فشل
            } elseif ($paymentStatus == 'succeeded') {
                $bookings->where('status_id', 3); // الدفع نجح
            } elseif ($paymentStatus == 'waiting') {
                $bookings->where('status_id', 2); // بانتظار الدفع
            }
        }
    
        // تنفيذ الاستعلام وجلب النتائج
        $bookings = $bookings->get();
    
        // إعادة عرض النتائج
        return view('Backend.booking.search', compact('bookings'));
    }
    
    

    public function updateStatus(Request $request, $id)
    {
        $booking = Booking::find($id);

        if ($booking) {
            $booking->status_id = $request->input('status', 4); // Default to 4 if not provided
            $booking->save();

        }
        return back();
    }

    public function MAR(){
        $userUnreadNotification = auth()->user()->unreadNotifications;
        if($userUnreadNotification){
            $userUnreadNotification-> markAsRead();
            return back();
        }

    }
    
}
