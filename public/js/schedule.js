/* ==============================
   DATE GENERATION (Next 5 Days)
================================= */
const dateContainer = document.getElementById("dates");
const today = new Date();

for (let i = 0; i < 5; i++) {
  const date = new Date(today);
  date.setDate(today.getDate() + i);
  const el = document.createElement("div");
  el.className = "option";
  el.textContent = date.toDateString().split(" ").slice(0, 3).join(" ");
  if (i === 0) el.classList.add("active");
  dateContainer.appendChild(el);
}

/* ==============================
   TIME GENERATION (Every 3 Hours)
================================= */
const timeContainer = document.getElementById("times");
const startTime = 10;
const intervalMinutes = 180;
const totalSlots = 5;

function formatTime(hour, minute) {
  const period = hour >= 12 ? "PM" : "AM";
  const displayHour = hour % 12 || 12;
  const displayMinute = minute.toString().padStart(2, "0");
  return `${displayHour}:${displayMinute} ${period}`;
}

let currentHour = startTime, currentMinute = 0;
for (let i = 0; i < totalSlots; i++) {
  const timeText = formatTime(currentHour, currentMinute);
  const el = document.createElement("div");
  el.className = "option";
  el.textContent = timeText;
  if (i === 0) el.classList.add("active");
  timeContainer.appendChild(el);

  const totalMins = currentMinute + intervalMinutes;
  currentHour += Math.floor(totalMins / 60);
  currentMinute = totalMins % 60;
}

/* ==============================
   OPTION CLICK HANDLER (Date/Time)
================================= */
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

/* ==============================
   CINEMA TYPE SELECTION
================================= */
let pricePerSeat = 250;
let selectedCinemaType = "Standard";

document.querySelectorAll(".cinema").forEach(cin => {
  cin.addEventListener("click", () => {
    document.querySelectorAll(".cinema").forEach(c => c.classList.remove("active"));
    cin.classList.add("active");

    pricePerSeat = parseInt(cin.dataset.price);
    selectedCinemaType = cin.dataset.type;
    updateTotal();
  });
});

/* ==============================
   SEAT GENERATION
================================= */
const seatWrapper = document.getElementById("seatWrapper");
const rows = ["A", "B", "C", "D", "E", "F", "G", "H"];
const cols = 10;
let selected = [];

function seatSVG(id, booked = false) {
  return `
    <svg class="seat ${booked ? "booked" : ""}" data-id="${id}"
      xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64">
      <rect x="8" y="20" width="48" height="30" rx="8" ry="8"/>
      <rect x="18" y="50" width="28" height="8" rx="2" ry="2"/>
    </svg>`;
}

/* ==============================
   LOAD BOOKED SEATS FROM BACKEND
================================= */
async function loadSeats() {
  const movieId = document.querySelector("#movie_id").value;
  try {
    const response = await fetch(`/booked-seats/${movieId}`);
    const bookedSeats = await response.json();

    seatWrapper.innerHTML = `
      <div></div>
      ${Array.from({ length: cols }, (_, i) => `<div class="seat-num">${i + 1}</div>`).join("")}
    `;

    rows.forEach(row => {
      seatWrapper.innerHTML += `
        <div class="row-letter">${row}</div>
        ${Array.from({ length: cols }, (_, i) => {
        const seatId = `${row}${i + 1}`;
        const isBooked = bookedSeats.includes(seatId);
        return seatSVG(seatId, isBooked);
      }).join("")}
      `;
    });
  } catch (error) {
    console.error("Error loading seats:", error);
  }
}
loadSeats();

/* ==============================
   SEAT SELECTION LOGIC
================================= */
seatWrapper.addEventListener("click", e => {
  const seat = e.target.closest(".seat");
  if (!seat || seat.classList.contains("booked")) return;
  seat.classList.toggle("selected");

  const id = seat.dataset.id;
  selected = seat.classList.contains("selected")
    ? [...selected, id]
    : selected.filter(s => s !== id);

  updateTotal();
});

/* ==============================
   UPDATE PAYMENT SUMMARY
================================= */
function updateTotal() {
  const total = selected.length * pricePerSeat;
  const paymentSummary = document.getElementById("paymentSummary");
  paymentSummary.style.display = selected.length ? "block" : "none";

  const movieTitle = document.querySelector("#movieTitleHeader")?.textContent || "-";
  const branch = (document.getElementById("cinemaBranchDropdown").value || "")
    .replace("_", " ").toUpperCase() || "-";
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

  document.getElementById("proceedBtn").disabled = selected.length === 0;
}

/* ==============================
   PAYMENT MODAL HANDLING
================================= */
const paymentModal = document.getElementById("paymentModal");
const paymentForm = document.getElementById("paymentForm");
const paymentFields = document.getElementById("paymentFields");
const paymentContent = document.getElementById("paymentContent");
const paymentSuccess = document.getElementById("paymentSuccess");
const proceedBtn = document.getElementById("proceedBtn");

function closePaymentModal() {
  paymentModal.classList.add("hidden");
  paymentForm.reset();
  paymentFields.innerHTML = "";
  paymentSuccess.classList.add("hidden");
  paymentContent.classList.remove("hidden");
}

proceedBtn.addEventListener("click", () => {
  paymentForm.reset();
  paymentFields.innerHTML = "";
  paymentSuccess.classList.add("hidden");
  paymentContent.classList.remove("hidden");
  document.getElementById("paymentTotal").textContent = document.getElementById("finalTotal").textContent;
  paymentModal.classList.remove("hidden");
});

/* ==============================
   PAYMENT METHOD DYNAMIC FIELDS
================================= */
document.getElementById("paymentMethod").addEventListener("change", function () {
  paymentFields.innerHTML = "";

  switch (this.value) {
    case "1":
      paymentFields.innerHTML = `<label>GCash Number:</label><input type="text" name="gcash_number" placeholder="09XXXXXXXXX" required>`;
      break;
    case "2":
      paymentFields.innerHTML = `<label>PayMaya Account Number:</label><input type="text" name="paymaya_number" placeholder="09XXXXXXXXX" required>`;
      break;
    case "3":
    case "4":
      paymentFields.innerHTML = `
        <label>Card Number:</label>
        <input type="text" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
        <label>Expiry Date:</label>
        <input type="month" name="expiry" required>
        <label>CVV:</label>
        <input type="text" name="cvv" maxlength="3" required>`;
      break;
  }
});

/* ==============================
   BOOKING SUBMISSION (to DB)
================================= */
let pendingBookingId = null;
proceedBtn.addEventListener("click", async () => {
  const bookingData = {
    movie_id: document.querySelector("#movie_id").value,
    movie_title: document.querySelector("#movie_title").value,
    cinema_type: selectedCinemaType,
    seats: selected.join(","),
  };

  try {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const response = await fetch("/booking/store", {
      method: "POST",
      headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": token },
      body: JSON.stringify(bookingData),
    });

    const result = await response.json();

    if (response.ok) {
      alert("Booking saved!");
      pendingBookingId = result.booking_id;
      document.querySelector("#booking_id").value = result.booking_id;
      loadSeats();
    } else alert(result.message || "Booking failed!");
  } catch (error) {
    console.error("Error:", error);
    alert("Something went wrong while booking.");
  }
});

/* ==============================
   PAYMENT CONFIRMATION (to DB)
================================= */
const confirmPayment = document.getElementById("confirmPayment");

confirmPayment.addEventListener("click", async (e) => {
  e.preventDefault();

  const totalValue = parseFloat(document.querySelector("#finalTotal").textContent.replace(/[^\d.]/g, ""));
  const paymentMethod = document.querySelector("#paymentMethod");
  const bookingId = document.querySelector("#booking_id").value;

  if (!paymentMethod.value) {
    alert("Please select a payment method.");
    return;
  }

  const paymentData = {
    booking_id: bookingId,
    payment_method_id: paymentMethod.value,
    payment_method_name: paymentMethod.options[paymentMethod.selectedIndex].text,
    total: totalValue,
  };

  try {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    const response = await fetch("/payment/store", {
      method: "POST",
      headers: { "Content-Type": "application/json", "X-CSRF-TOKEN": token },
      body: JSON.stringify(paymentData),
    });

    const result = await response.json();

    if (response.ok && result.success) {
      alert(result.message || "Payment Successful!");
      paymentContent.classList.add("hidden");
      paymentSuccess.classList.remove("hidden");
      pendingBookingId = null;

      const downloadLink = document.getElementById("downloadTicket");
      downloadLink.href = `/ticket/download/${result.booking_id}`;

    } else {
      alert(result.message || "Payment failed!");
    }
  } catch (error) {
    console.error("Error during payment:", error);
    alert("Something went wrong while processing payment.");
  }
});

async function deleteUnpaidBooking(bookingId) {
  try {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");
    await fetch(`/booking/${bookingId}`, {
      method: "DELETE",
      headers: { "X-CSRF-TOKEN": token },
    });
    console.log(`Booking ${bookingId} deleted.`);
  } catch (error) {
    console.error("Error deleting booking:", error);
  }
}

/* ==============================
   CANCEL BUTTON
================================= */
document.getElementById("cancelPayment").addEventListener("click", async () => {
  if (pendingBookingId) {
    await deleteUnpaidBooking(pendingBookingId);
    pendingBookingId = null;
  }
  closePaymentModal();
  selected = [];
  updateTotal();

  await loadSeats();
  window.location.reload();
});

/* ==============================
   RETURN TO MOVIE LIST
================================= */
document.getElementById("returnHome").addEventListener("click", () => {
  closePaymentModal();
  selected = [];
  updateTotal();
  window.location.href = "/movies";
});

/* =====================================================
   THE BOOKED WILL BE DELETED IF THE USER CLOSES THE TAB
======================================================== */
window.addEventListener("beforeunload", () => {
  if (pendingBookingId) {
    const token = document.querySelector('meta[name="csrf-token"]').getAttribute("content");

    const url = `/booking/${pendingBookingId}`;
    const data = new FormData();
    data.append("_token", token);

    navigator.sendBeacon(url, data);
  }
});

