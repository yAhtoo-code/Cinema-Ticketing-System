<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Booking;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $booking = \App\Models\Booking::where('user_id', auth()->id())->latest('created_at')->first();

        // Create the payment record linked to that booking
        $payment = \App\Models\Payment::create([
            'date_time' => now(),
            'total_amount' => $request->input('total'),
            'booking_id' => $booking->id, 
            'payment_method_id' => $request->input('payment_method_id'),
            'payment_method_name' => $request->input('payment_method_name'),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment saved successfully!',
            'booking_id' => $booking->id,
            'payment_id' => $payment->id,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
