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

<script>
    // Generate Dates
    const dateContainer = document.getElementById("dates");
    const today = new Date();
    for (let i = 0; i < 5; i++) {
      const d = new Date(today);
      d.setDate(today.getDate() + i);
      const el = document.createElement("div");
      el.className = "option";
      el.textContent = d.toDateString().split(" ").slice(0, 3).join(" ");
      if (i === 0) el.classList.add("active");
      dateContainer.appendChild(el);
    }

    // Option handling
    function handleOptionGroup(id) {
      document.querySelectorAll(`#${id} .option`).forEach(opt => {
        opt.addEventListener("click", () => {
          document.querySelectorAll(`#${id} .option`).forEach(o => o.classList.remove("active"));
          opt.classList.add("active");
          updateTotal();
        });
      });
    }
    handleOptionGroup("dates");
    handleOptionGroup("times");

    // Cinema type
    let pricePerSeat = 250;
    document.querySelectorAll(".cinema").forEach(cin => {
      cin.addEventListener("click", () => {
        document.querySelectorAll(".cinema").forEach(c => c.classList.remove("active"));
        cin.classList.add("active");
        pricePerSeat = parseInt(cin.dataset.price);
        updateTotal();
      });
    });

    // Generate Seats
    const rows = ["A","B","C","D","E","F","G","H"];
    const cols = 10;
    const seatWrapper = document.getElementById("seatWrapper");

    function seatSVG(id, booked = false) {
      return `
        <svg class="seat ${booked ? "booked" : ""}" data-id="${id}"
          xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
          <rect x="8" y="20" width="48" height="30" rx="8" ry="8"/>
          <rect x="18" y="50" width="28" height="8" rx="2" ry="2"/>
        </svg>`;
    }

    seatWrapper.innerHTML = `
      <div></div>
      ${Array.from({ length: cols }, (_, i) => `<div class="seat-num">${i + 1}</div>`).join("")}
    `;
    rows.forEach(row => {
      seatWrapper.innerHTML += `
        <div class="row-letter">${row}</div>
        ${Array.from({ length: cols }, (_, i) => seatSVG(`${row}${i + 1}`, Math.random() < 0.1)).join("")}
      `;
    });

    // Seat Selection Logic
    let selected = [];
    seatWrapper.addEventListener("click", (e) => {
      const seat = e.target.closest(".seat");
      if (!seat || seat.classList.contains("booked")) return;
      seat.classList.toggle("selected");
      const id = seat.dataset.id;
      if (selected.includes(id)) {
        selected = selected.filter(s => s !== id);
      } else {
        selected.push(id);
      }
      updateTotal();
    });

    // Update Payment Summary
    function updateTotal() {
      const total = selected.length * pricePerSeat;
      const paymentSummary = document.getElementById("paymentSummary");
      paymentSummary.style.display = selected.length > 0 ? "block" : "none";

      const movieTitle = document.querySelector("#movieTitleHeader")?.textContent || "-";
      const branch = (document.getElementById("cinemaBranchDropdown").value || "").replace("_", " ").toUpperCase() || "-";
      const date = document.querySelector("#dates .option.active")?.textContent || "-";
      const time = document.querySelector("#times .option.active")?.textContent || "-";
      const type = document.querySelector(".cinema.active h3")?.textContent || "-";

      document.getElementById("summaryMovieTitle").textContent = movieTitle;
      document.getElementById("summaryBranch").textContent = branch;
      document.getElementById("summaryDate").textContent = date;
      document.getElementById("summaryTime").textContent = time;
      document.getElementById("summaryType").textContent = type;
      document.getElementById("ticketCount").textContent = `${selected.length}x ₱${pricePerSeat}`;
      document.getElementById("finalTotal").textContent = total.toLocaleString();
      document.getElementById("seatList").textContent = selected.join(", ") || "None";

      const proceedBtn = document.getElementById("proceedBtn");
      proceedBtn.disabled = selected.length === 0;
    }
</script>

@endsection