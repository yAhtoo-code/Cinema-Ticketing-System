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







  // // ✅ Generate unique ticket ID
  // const ticketID = "CT-" + Math.floor(100000 + Math.random() * 900000);
  // document.getElementById("ticketID").textContent = ticketID;

  // // ✅ Prepare QR data
  // const qrData = {
  //   ticketID,
  //   movie: document.getElementById("summaryMovieTitle").textContent,
  //   branch: document.getElementById("summaryBranch").textContent,
  //   seat: document.getElementById("seatList").textContent,
  //   time: document.getElementById("summaryTime").textContent,
  //   date: document.getElementById("summaryDate").textContent,
  // };

  // console.log("QR data:", JSON.stringify(qrData));

  // // ✅ Get QR container and render QR
  // const qrCanvas = document.getElementById("qrCode");
  // if (!qrCanvas) {
  //   console.error("QR canvas element not found!");
  //   return;
  // }
  // qrCanvas.innerHTML = "";
  // new QRCode(qrCanvas, {
  //   text: JSON.stringify(qrData),
  //   width: 100,
  //   height: 100,
  // });

  // // ✅ Wait for QR to render visually
  // await new Promise((r) => setTimeout(r, 1000));

  // // ✅ Ensure payment summary is visible before capture
  // const element = document.getElementById("paymentSummary");
  // element.style.display = "block";

  // // ✅ Small delay to let the browser visually render updates
  // await new Promise((r) => setTimeout(r, 300));

  // // ✅ Generate PDF
  // const options = {
  //   margin: [0.3, 0.3],
  //   filename: `Cinematique_Ticket_${ticketID}.pdf`,
  //   image: { type: "jpeg", quality: 0.98 },
  //   html2canvas: { scale: 2, useCORS: true },
  //   jsPDF: { unit: "in", format: "a5", orientation: "portrait" },
  // };

  // await html2pdf().set(options).from(element).save();