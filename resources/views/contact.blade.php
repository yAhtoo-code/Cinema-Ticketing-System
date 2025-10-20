@extends('main')
@section('content')

<style>
body {
    color: white;
    margin: 0;
    padding: 0;
    min-height: 100vh;
}
main {
    display: flex;
    justify-content: center;
    padding-top: 60px;
    padding-bottom: 60px;
}

.contact-container {
    background: #8E0204;
    backdrop-filter: blur(10px);
    border-radius: 16px;
    padding: 40px 60px;
    text-align: center;
    max-width: 450px;
    width: 90%;
    box-shadow: 0 0 15px rgba(255, 201, 13, 0.3);
}
h1 {
    color: #FFC90D;
    margin-bottom: 20px;
    font-size: 2em;
    letter-spacing: 1px;
}
.email {
    background: #fff;
    color: #000;
    display: inline-block;
    padding: 10px 20px;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    margin-bottom: 25px;
    transition: all 0.3s ease;
}
.email:hover {
    background: #FFC90D;
    color: #fff;
}
.social-section {
    text-align: center;
}
.social-section h3 {
    color: #FFC90D;
    margin-bottom: 15px;
}
.social-links {
    display: flex;
    justify-content: center;
    gap: 20px;
    flex-wrap: wrap;
}
.social-links a {
    color: white;
    text-decoration: none;
    font-size: 16px;
    font-weight: 500;
    padding: 10px 20px;
    border: 2px solid #FFC90D;
    border-radius: 8px;
    transition: all 0.3s ease;
}
.social-links a:hover {
    background: #FFC90D;
    color: #000;
    transform: scale(1.05);
}
footer {
    margin-top: 30px;
    font-size: 12px;
    color: #ccc;
}
@media (max-width: 600px) {
    .contact-container {
        padding: 30px 20px;
    }
    .social-links a {
        font-size: 14px;
        padding: 8px 16px;
    }
}
</style>

<main>
  <div class="contact-container">
    <h1>Contact Us</h1>
    <p class= "mb-2">Have questions, feedback, or partnership inquiries? We’d love to hear from you!</p>
    
    <a href="mailto:support@cineworld.com" class="email">📧 Cinematique@gmail.com</a>

    <div class="social-section">
      <h3>Follow Us on Social Media</h3>
      <div class="social-links">
        <a href="https://www.instagram.com/" target="_blank">Instagram</a>
        <a href="https://www.facebook.com/" target="_blank">Facebook</a>
        <a href="https://www.tiktok.com/" target="_blank">TikTok</a>
        <a href="https://twitter.com/" target="_blank">Twitter</a>
      </div>
    </div>

    <footer>© 2025 Cinematique. All rights reserved.</footer>
  </div>
</main>

@endsection