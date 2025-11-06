<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Cinematique Ticket</title>
  <style>
    body {
      font-family: DejaVu Sans, sans-serif;
      margin: 0;
      padding: 40px;
      color: #fff;
      background: #111;
    }

    .ticket {
      background: #e7000b;
      border: 3px solid #FFC90D;
      border-radius: 12px;
      padding: 35px 40px;
      box-shadow: 0 0 20px rgba(255, 201, 13, 0.3);
      max-width: 600px;
      margin: 0 auto;
      position: relative;
    }

    .header {
      text-align: center;
      margin-bottom: 20px;
    }

    .header img {
      width: 100px;
      height: auto;
      margin-bottom: 10px;
    }

    .title {
      font-size: 20px;
      font-weight: bold;
      letter-spacing: 1px;
    }

    .divider {
      border-top: 1px solid white;
      margin: 20px 0;
    }

    .info p {
      font-size: 16px;
      margin: 6px 0;
      line-height: 1.4;
    }

    .label {
      font-weight: bold;
      width: 160px;
      display: inline-block;
    }

    .footer {
      text-align: center;
      font-size: 12px;
      color: white;
      margin-top: 25px;
    }

    .footer p {
      margin: 3px 0;
    }
  </style>
</head>
<body>
  <div class="ticket">
    <div class="header">
      <img src="{{ public_path('images/logo.png') }}" alt="Cinematique Logo">
      <div class="title">CINEMATIQUE ONLINE TICKET</div>
      
    </div>

    <div class="info">
      <p><span class="label">Transaction Date/Time:</span> {{ $payment->created_at->timezone('Asia/Manila')->format('F j, Y g:i A') }}</p>
      <p><span class="label">Booking ID:</span> {{ $booking->id }}</p>
      <div class="divider"></div>

      <p><span class="label">Branch:</span> {{ $booking->branch ?? 'N/A' }}</p>
      <p><span class="label">Movie:</span> {{ $booking->movie->title }}</p>
      <p><span class="label">Screening Time:</span> {{ $booking->screening_time ?? 'N/A' }}</p>
      <p><span class="label">Screening Date:</span> {{ $booking->screening_date ?? 'N/A' }}</p>

      <div class="divider"></div>
      <p><span class="label">Total Payment:</span> ₱{{ number_format($payment->total_amount, 2) }}</p>
      <p><span class="label">Seats:</span> {{ $booking->seats }}</p>
      <p><span class="label">Cinema Type:</span> {{ $booking->cinema_type }}</p>
    </div>

      <div class="divider"></div>

    <div class="footer">
      <p>Need help? Contact <strong>support@cinematique.com</strong></p>
      <p><em>This ticket is valid only with matching ID and payment confirmation.</em></p>
    </div>
  </div>
</body>

</html>