<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Booking;
use App\Models\Payment;

class TicketController extends Controller
{
    public function download($bookingId)
    {
        // Load the booking + movie relationship
        $booking = Booking::with('movie')->findOrFail($bookingId);

        // Fetch the latest payment linked to this booking
        $payment = Payment::where('booking_id', $bookingId)
                          ->latest('created_at')
                          ->first();

        // Pass BOTH booking and payment to the Blade view
        $pdf = Pdf::loadView('pdf.ticket', compact('booking', 'payment'));

        // Download the PDF file
        return $pdf->download('ticket-' . $booking->id . '.pdf');
    }
}

