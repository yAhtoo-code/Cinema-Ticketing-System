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

/* Payment */
// Open the modal when Proceed button is clicked
document.getElementById("proceedBtn").addEventListener("click", () => {
  const modal = document.getElementById("paymentModal");
  document.getElementById("paymentTotal").textContent =
    document.getElementById("finalTotal").textContent;
  modal.classList.remove("hidden");
});

// Close modal
document.getElementById("cancelPayment").addEventListener("click", () => {
  document.getElementById("paymentModal").classList.add("hidden");
  document.getElementById("paymentForm").reset();
  document.getElementById("paymentFields").innerHTML = "";
});

// Dynamically show fields based on selected payment method
document.getElementById("paymentMethod").addEventListener("change", function () {
  const fields = document.getElementById("paymentFields");
  fields.innerHTML = "";

  switch (this.value) {
    case "gcash":
      fields.innerHTML = `
        <label>GCash Number:</label>
        <input type="text" name="gcash_number" placeholder="09XXXXXXXXX" required>
      `;
      break;

    case "paymaya":
      fields.innerHTML = `
        <label>PayMaya Account Email:</label>
        <input type="email" name="paymaya_email" placeholder="you@example.com" required>
        <label>Reference Number:</label>
        <input type="text" name="paymaya_ref" placeholder="Enter reference number" required>
      `;
      break;

    case "credit_card":
    case "debit_card":
      fields.innerHTML = `
        <label>Card Number:</label>
        <input type="text" name="card_number" placeholder="XXXX XXXX XXXX XXXX" required>
        <label>Expiry Date:</label>
        <input type="month" name="expiry" required>
        <label>CVV:</label>
        <input type="text" name="cvv" maxlength="3" required>
      `;
      break;
  }
});

// Handle form submission
document.getElementById("paymentForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const method = document.getElementById("paymentMethod").value;
  const total = document.getElementById("paymentTotal").textContent;

  alert(`✅ Payment Successful!
Method: ${method.toUpperCase()}
Amount: ₱${total}`);

  // In a real system, you'd POST this data to your backend:
  // - booking_id
  // - payment_method_id
  // - date_time
  // - payment_total

  document.getElementById("paymentModal").classList.add("hidden");
});