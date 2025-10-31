@extends('main')
@section('content')

<link href="/css/schedule.css" rel="stylesheet">

<div class="container mx-auto px-4 pt-8 pb-1">
  <h1 class="text-3xl text-white font-bold mb-6">Movie Schedule</h1>
</div>

<body>
  <div class="movie_container">
    <div class="flex space-x-6">
        
        <img class="w-60 h-auto object-cover rounded-lg shadow-xl" 
             src="{{ asset('images/transformers.jpg') }}" 
             alt="Transformers">
        
        <div class="flex-grow text-white">
            
            <h1 class="text-4xl font-extrabold mb-3">
                <span id="movieTitleHeader">Transformers</span>
            </h1>

            <input type="hidden" id="movieId" value="1">

            <div class="flex items-center font-semibold text-lg mb-2">
                <span class="meta font-semibold">142 min | Action, Thriller | R-18</span>
            </div>

            <div class="mb-6 text-gray-200">
                <p class="text-base leading-relaxed">
                    Four years after the Chicago battle, the government is hunting down all Transformers. 
                    Cade Yeager, a Texas mechanic, buys an old truck and discovers it's Optimus Prime, 
                    forcing him into a new war against a powerful enemy faction and a nefarious government agency.
                </p>
            </div>
            
            </div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Cinema Branch</h3>
      <select id="cinemaBranchDropdown" name="cinema_branch"
        class="w-full p-3 text-black rounded-lg bg-white hover-amber-400 cursor-pointer">
        <option value="" disabled selected>Select a Branch...</option>
        <option value="sm_megamall">SM Megamall</option>
        <!-- <option value="glorietta_4">Glorietta 4</option>
        <option value="robinsons_galleria">Robinsons Galleria</option>
        <option value="greenbelt_3">Greenbelt 3</option>
        <option value="trinoma">Trinoma</option> -->
      </select>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Date</h3>
      <div class="options" id="dates"></div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Time</h3>
      <div class="options" id="times"></div>
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
        <p><strong>Total Payment:</strong> ₱<span id="finalTotal">0</span></p>

        <input type ="hidden" id="movie_id" value=1>
        <input type ="hidden" id="movie_title" value="Transformers">

      <div class="text-right mt-4">
        <button id="proceedBtn" disabled
          class="bg-[#FFC90D] text-white font-semibold px-6 py-2 rounded-lg cursor-pointer disabled:bg-gray-400 disabled:cursor-not-allowed">
          Proceed to Payment
        </button>
      </div>
      
    </div>
  </div>

  <input type="hidden" id="booking_id" value="">
  
  <!-- Payment Modal -->
  <div id="paymentModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-50">
    <div class="bg-white text-black rounded-lg p-6 w-full max-w-md shadow-lg relative">
      <div id="paymentContent">
        <h2 class="text-2xl font-bold mb-4 text-center">Payment</h2>
        <form id="paymentForm">
          <label for="paymentMethod">Select Payment Method:</label>
          <select id="paymentMethod" name="payment_method" required>
            <option value="">-- Select --</option>
            <option value="1">GCash</option>
            <option value="2">PayMaya</option>
            <option value="3">Credit Card</option>
            <option value="4">Debit Card</option>
          </select>

          <div id="paymentFields" class="mt-3"></div>
          <p class="mt-4 font-semibold">Total: ₱<span id="paymentTotal">0</span></p>

          <div class="flex justify-between mt-6">
            <button type="button" id="cancelPayment" class="bg-gray-400 text-white px-4 py-2 rounded">Cancel</button>
            <button type="submit" id="confirmPayment" class="bg-red-600 text-white px-4 py-2 rounded">Confirm Payment</button>
          </div>
        </form>
      </div>

      <div id="paymentSuccess" class="hidden text-center">
        <h2 class="text-2xl font-bold text-black mb-3">Payment Successful!</h2>
        <p class="text-gray-700 mb-6">Your ticket has been confirmed. You can now return to the homepage.</p>
        <button id="returnHome"
          class="bg-[#FFC90D] text-black px-6 py-2 rounded font-semibold hover:bg-yellow-400">
          Return to Movies
        </button>
      </div>
    </div>
  </div>

<script src="js/schedule.js"></script>
</body>

@endsection