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

// Generate Time
const timeContainer = document.getElementById("times");
const startTime = 10; // Start at 10:00 AM
const totalSlots = 5; // Generate 5 slots 

// Function to format 24-hour time to 12-hour (e.g., 13:30 -> 1:30 PM)
function formatTime(hour, minute) {
    const period = hour >= 12 ? 'PM' : 'AM';
    const displayHour = hour % 12 || 12; // Converts 0 to 12 (midnight) and 13 to 1
    const displayMinute = minute.toString().padStart(2, '0'); // Ensures 00, 30
    return `${displayHour}:${displayMinute} ${period}`;
}

let currentHour = startTime;
let currentMinute = 0;

for (let i = 0; i < totalSlots; i++) {
    // Format the time
    const timeText = formatTime(currentHour, currentMinute);

    // Create the element
    const el = document.createElement("div");
    el.className = "option";
    el.textContent = timeText;

    // Set the first slot as active (e.g., 1:00 PM)
    if (i === 0) {
        el.classList.add("active");
    }

    // Append to the container
    timeContainer.appendChild(el);

    // Increment time by 30 minutes
    currentMinute += 180;
    if (currentMinute >= 60) {
        currentHour += 1;
        currentMinute = 0;
    }
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
const rows = ["A", "B", "C", "D", "E", "F", "G", "H"];
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

// Seat Layout
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

/* -------------------- PAYMENT MODAL -------------------- */
const paymentModal = document.getElementById("paymentModal");
const paymentForm = document.getElementById("paymentForm");
const paymentFields = document.getElementById("paymentFields");
const paymentContent = document.getElementById("paymentContent");
const paymentSuccess = document.getElementById("paymentSuccess");
const proceedBtn = document.getElementById("proceedBtn");

/* ---- Open modal ---- */
proceedBtn.addEventListener("click", () => {
  paymentForm.reset();
  paymentFields.innerHTML = "";
  paymentSuccess.classList.add("hidden");
  paymentContent.classList.remove("hidden");

  document.getElementById("paymentTotal").textContent =
    document.getElementById("finalTotal").textContent;

  paymentModal.classList.remove("hidden");
});

/* ---- Close modal ---- */
document.getElementById("cancelPayment").addEventListener("click", () => {
  closePaymentModal();
});

function closePaymentModal() {
  paymentModal.classList.add("hidden");
  paymentForm.reset();
  paymentFields.innerHTML = "";
  paymentSuccess.classList.add("hidden");
  paymentContent.classList.remove("hidden");
}

/* ---- Payment method fields ---- */
document.getElementById("paymentMethod").addEventListener("change", function () {
  paymentFields.innerHTML = "";

  if (this.value === "gcash") {
    paymentFields.innerHTML = `
      <label>GCash Number:</label>
      <input type="text" name="gcash_number" placeholder="09XXXXXXXXX" required>
    `;
  } else if (this.value === "paymaya") {
    paymentFields.innerHTML = `
      <label>PayMaya Account Number:</label>
      <input type="text" name="paymaya_number" placeholder="09XXXXXXXXX" required>
    `;
  } else if (this.value === "credit_card" || this.value === "debit_card") {
    paymentFields.innerHTML = `
      <label>Card Number:</label>
      <input type="text" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
      <label>Expiry Date:</label>
      <input type="month" name="expiry" required>
      <label>CVV:</label>
      <input type="text" name="cvv" maxlength="3" required>
    `;
  }
});

/* ---- Payment Form Submit ---- */
paymentForm.addEventListener("submit", async function (e) {
  e.preventDefault();

  // Hide form, show success screen
  paymentContent.classList.add("hidden");
  paymentSuccess.classList.remove("hidden");
});

/* ---- Return Home ---- */
document.getElementById("returnHome").addEventListener("click", () => {
  closePaymentModal();
  selected = [];
  updateTotal();
  window.location.href = "/";
});