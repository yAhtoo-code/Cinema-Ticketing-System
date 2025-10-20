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
      <select id="cinemaBranchDropdown" name="cinema_branch" class="w-full p-3 text-black rounded-lg bg-white hover-amber-400 cursor-pointer">
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
        <div class="cinema" data-price="250"><h3>Standard</h3><p>Regular screen and seating</p><span>₱250</span></div>
        <div class="cinema" data-price="450"><h3>IMAX</h3><p>Enhanced visuals and sound</p><span>₱450</span></div>
        <div class="cinema" data-price="600"><h3>Director’s Club</h3><p>Luxury experience</p><span>₱600</span></div>
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
      <h3 class="text-white font-semibold pb-3">Payment Summary</h3>
      <div class="bg-white rounded-lg p-4 text-black leading-relaxed">
        <p><strong>Movie Title:</strong> <span id="summaryMovieTitle">-</span></p>
        <p><strong>Branch:</strong> <span id="summaryBranch">-</span></p>
        <p><strong>Date:</strong> <span id="summaryDate">-</span></p>
        <p><strong>Time:</strong> <span id="summaryTime">-</span></p>
        <p><strong>Cinema Type:</strong> <span id="summaryType">-</span></p>
        <hr class="my-2 border-gray-400">
        <p><strong>Ticket(s):</strong> <span id="ticketCount">0x ₱0</span></p>
        <p><strong>Total Price:</strong> ₱<span id="finalTotal">0</span></p>
        <p><strong>Seat(s):</strong> <span id="seatList">None</span></p>
        <div class="text-right mt-4">
          <button id="proceedBtn" disabled
            class="bg-[#FFC90D] text-white font-semibold px-6 py-2 rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed">
            Proceed to Payment
          </button>
        </div>
      </div>
    </div>
  </div>

<!-- Payment Modal -->
<div id="paymentModal" class="payment-modal hidden">
  <div class="payment-content">
    <h2>Complete Your Payment</h2>

    <form id="paymentForm">
      <div class="form-group">
        <label for="paymentMethod">Select Payment Method:</label>
        <select id="paymentMethod" name="payment_method" required>
          <option value="" disabled selected>Select a method</option>
          <option value="gcash">GCash</option>
          <option value="paymaya">PayMaya</option>
          <option value="credit_card">Credit Card</option>
          <option value="debit_card">Debit Card</option>
        </select>
      </div>

      <div id="paymentFields"></div>

      <div class="payment-total">
        <strong>Total Amount:</strong> ₱<span id="paymentTotal">0</span>
      </div>

      <div class="payment-actions">
        <button type="button" id="cancelPayment">Cancel</button>
        <button type="submit" id="confirmPayment">Confirm Payment</button>
      </div>
    </form>
  </div>
</div>

<script src="js/schedule.js"></script>
</body>

@endsection