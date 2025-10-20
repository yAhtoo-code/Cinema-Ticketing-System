@extends('main')
@section('content')

<link href="/css/schedule.css" rel="stylesheet">

<div class="container mx-auto px-4 pt-8 pb-1">
  <h1 class="text-3xl text-white font-bold mb-6">Movie Schedule</h1>
</div>

<body>
  <div class="movie_container">
    <h1 class="text-4xl font-extrabold"><span id="movieTitleHeader">Transformers</span></h1>
    <img class="w-60 h-75 object-cover" src="{{ asset('images/transformers.jpg') }}" alt="Transformers">
    <div class="meta font-semibold pt-5">⭐ 8.5/10 | 142 min | Action, Thriller | R-18</div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Cinema Branch</h3>
      <select id="cinemaBranchDropdown" name="cinema_branch"
        class="w-full p-3 text-black rounded-lg bg-white hover-amber-400 cursor-pointer">
        <option value="" disabled selected>Select a Branch...</option>
        <option value="sm_megamall">SM Megamall</option>
        <option value="glorietta_4">Glorietta 4</option>
        <option value="robinsons_galleria">Robinsons Galleria</option>
        <option value="greenbelt_3">Greenbelt 3</option>
        <option value="trinoma">Trinoma</option>
      </select>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Date</h3>
      <div class="options" id="dates"></div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Time</h3>
      <div class="options" id="times">
        <div class="option">10:00</div>
        <div class="option">13:30</div>
        <div class="option">16:00</div>
        <div class="option">19:30</div>
        <div class="option">22:00</div>
      </div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Cinema Type</h3>
      <div class="cinema-type" id="cinemaType">
        <div class="cinema" data-price="250">
          <h3>Standard</h3>
          <p>Regular screen and seating</p>
          <span>₱250</span>
        </div>
        <div class="cinema" data-price="450">
          <h3>IMAX</h3>
          <p>Enhanced visuals and sound</p>
          <span>₱450</span>
        </div>
        <div class="cinema" data-price="600">
          <h3>Director’s Club</h3>
          <p>Luxury experience</p>
          <span>₱600</span>
        </div>
      </div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold">Select Your Seats</h3>
      <div class="screen">SCREEN</div>
      <div class="seat-layout">
        <div class="seat-wrapper" id="seatWrapper"></div>
      </div>
    </div>

    <div class="section payment-summary" id="paymentSummary" style="display:none;">
      <div class="pdf-ticket mx-auto">
        <div class="ticket-header">
          <h2>PAYMENT SUMMARY</h2>
        </div>

        <p><strong>Movie:</strong> <span id="summaryMovieTitle">-</span></p>
        <p><strong>Branch:</strong> <span id="summaryBranch">-</span></p>
        <p><strong>Date:</strong> <span id="summaryDate">-</span></p>
        <p><strong>Time:</strong> <span id="summaryTime">-</span></p>
        <p><strong>Seat(s):</strong> <span id="seatList">None</span></p>
        <p><strong>Type:</strong> <span id="summaryType">-</span></p>
        <p><strong>Ticket(s):</strong> <span id="ticketCount">0x ₱0</span></p>
        <p><strong>Total Paid:</strong> ₱<span id="finalTotal">0</span></p>

       <!-- <div class="ticket-footer">
          <canvas id="qrCode" class="ticket-qr"></canvas>
          <p>Show this QR at the cinema entrance</p>
          <p class="ticket-id">Ticket ID: <span id="ticketID"></span></p>
        </div>
      </div>  -->

      <div class="text-right mt-4">
        <button id="proceedBtn" disabled
          class="bg-[#FFC90D] text-white font-semibold px-6 py-2 rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed">
          Proceed to Payment
        </button>
      </div>
    </div>
  </div>

  <!-- Payment Modal -->
  <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white text-black rounded-lg p-6 w-full max-w-md shadow-lg relative">
      <div id="paymentContent">
        <h2 class="text-2xl font-bold mb-4 text-center">Payment</h2>
        <form id="paymentForm">
          <label for="paymentMethod">Select Payment Method:</label>
          <select id="paymentMethod" name="payment_method" required>
            <option value="">-- Select --</option>
            <option value="gcash">GCash</option>
            <option value="paymaya">PayMaya</option>
            <option value="credit_card">Credit Card</option>
            <option value="debit_card">Debit Card</option>
          </select>

          <div id="paymentFields" class="mt-3"></div>
          <p class="mt-4 font-semibold">Total: ₱<span id="paymentTotal">0</span></p>

          <div class="flex justify-between mt-6">
            <button type="button" id="cancelPayment" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Confirm Payment</button>
          </div>
        </form>
      </div>

      <div id="paymentSuccess" class="hidden text-center">
        <h2 class="text-2xl font-bold text-black mb-3">Payment Successful!</h2>
        <p class="text-gray-700 mb-6">Your ticket has been confirmed. You can now return to the homepage.</p>
        <button id="returnHome"
          class="bg-[#FFC90D] text-black px-6 py-2 rounded font-semibold hover:bg-yellow-400">
          Return to Homepage
        </button>
      </div>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/qrcodejs/qrcode.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
  <script src="js/schedule.js"></script>
</body>

@endsection