@extends('main')
@section('content')

<link href="/css/schedule.css" rel="stylesheet">

<div class="container mx-auto px-4 pt-8 pb-1">
    <h1 class="text-3xl text-white font-bold mb-6">Movie Schedule</h1>
</div>

<body>
  <div class="movie_container">
    <h1 class= "text-4xl font-extrabold" >Transformers</h1>
    <img class="w-60 h-75 object-cover" src="{{ asset('images/transformers.jpg') }}" alt="Transformers">
    <div class="meta font-semibold pt-5">⭐ 8.5/10 | 142 min | Action, Thriller | R-18</div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Date</h3>
      <div class="options" id="dates"></div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold pb-3">Select Showtime</h3>
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
      <h3 class="text-white font-semibold pb-3">Select Cinema Branch</h3>
      <div class="cinema-branch" id="cinemaBranch">
        <div class="branch">SM Megamall</div>
        <div class="branch">Glorietta 4</div>
        <div class="branch">Robinsons Galleria</div>
        <div class="branch">Greenbelt 3</div>
        <div class="branch">Trinoma</div>
      </div>
    </div>

    <div class="section">
      <h3 class="text-white font-semibold">Select Your Seats</h3>
      <div class="screen">SCREEN</div>
      <div class="seat-layout">
        <div class="row-labels" id="rowLabels"></div>
        <div class="seat-section">
          <div class="seat-numbers" id="seatNumbers"></div>
          <div class="seat-grid" id="seatsContainer"></div>
        </div>
      </div>
    </div>

    <div class="summary">
      <div>
        Selected Seats: <span id="selectedSeats">None</span><br />
        Total: ₱<span id="total">0</span>
      </div>
      <button id="proceedBtn" disabled>Proceed to Payment</button>
    </div>
  </div>

<script>
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

function handleOptionGroup(id) {
  document.querySelectorAll(`#${id} .option`).forEach((opt) => {
    opt.addEventListener("click", () => {
      document
        .querySelectorAll(`#${id} .option`)
        .forEach((o) => o.classList.remove("active"));
      opt.classList.add("active");
    });
  });
}
handleOptionGroup("dates");
handleOptionGroup("times");

let pricePerSeat = 250;
document.querySelectorAll(".cinema").forEach((cin) => {
  cin.addEventListener("click", () => {
    document.querySelectorAll(".cinema").forEach((c) => c.classList.remove("active"));
    cin.classList.add("active");
    pricePerSeat = parseInt(cin.dataset.price);
    updateTotal();
  });
});

const rows = ["A", "B", "C", "D", "E", "F", "G", "H"];
const cols = 10;
const seatContainer = document.getElementById("seatsContainer");
const rowLabels = document.getElementById("rowLabels");
const seatNumbers = document.getElementById("seatNumbers");

rows.forEach((r) => {
  const div = document.createElement("div");
  div.textContent = r;
  rowLabels.appendChild(div);
});
for (let i = 1; i <= cols; i++) {
  const div = document.createElement("div");
  div.textContent = i;
  seatNumbers.appendChild(div);
}

function seatSVG(id, booked = false) {
  return `
  <svg class="seat ${booked ? "booked" : ""}" data-id="${id}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
    <rect x="8" y="20" width="48" height="30" rx="8" ry="8"/>
    <rect x="18" y="50" width="28" height="8" rx="2" ry="2"/>
  </svg>`;
}

rows.forEach((r) => {
  for (let c = 1; c <= cols; c++) {
    const id = r + c;
    const booked = Math.random() < 0.15;
    seatContainer.insertAdjacentHTML("beforeend", seatSVG(id, booked));
  }
});

let selected = [];
seatContainer.addEventListener("click", (e) => {
  if (e.target.closest(".seat")) {
    const seat = e.target.closest(".seat");
    if (seat.classList.contains("booked")) return;
    seat.classList.toggle("selected");
    const id = seat.dataset.id;
    if (selected.includes(id)) {
      selected = selected.filter((s) => s !== id);
    } else {
      selected.push(id);
    }
    updateTotal();
  }
});

function updateTotal() {
  const total = selected.length * pricePerSeat;
  document.getElementById("total").textContent = total;
  document.getElementById("selectedSeats").textContent = selected.length
    ? selected.join(", ")
    : "None";
  document.getElementById("proceedBtn").disabled = selected.length === 0;
}
</script>

@endsection