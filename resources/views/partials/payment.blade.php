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
        <p class="text-gray-700 mb-6">Your ticket has been confirmed. You can now return to the movie list.</p>

        <div class="flex justify-center gap-4 mt-4">
          <a id="downloadTicket"
            href="#"
            class="bg-green-600 text-white px-6 py-2 rounded font-semibold hover:bg-green-700">
            Download Ticket (PDF)
          </a>

          <button id="returnHome"
            class="bg-[#FFC90D] text-black px-6 py-2 rounded font-semibold hover:bg-yellow-400">
            Return to Movies
          </button>
        </div>
      </div>
    </div>
  </div>