<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Contact</title>
  <link rel="stylesheet" href="./css/contact-us.css" />
  <link rel="stylesheet" href="./css/landing.css">

</head>
<body>
<br>
<br>
<br>
  <section class="contact">
    <h2>Contact Me!</h2>
    <form id="contactForm">
      <div class="input-box">
        <div class="input-field field">
          <input type="text" placeholder="Full Name" id="name" class="item" autocomplete="off" >
          <div class="error-txt">Full name can't be blank</div>
        </div>
        <div class="input-field field">
          <input type="email" placeholder="Email Address" id="email" class="item" autocomplete="off" >
          <div class="error-txt email">Email address can't be blank</div>
        </div>
      </div>
      <div class="input-box">
        <div class="input-field field">
          <input type="text" placeholder="Phone Number" id="phone" class="item" autocomplete="off" >
          <div class="error-txt">Phone number can't be blank</div>
        </div>
        <div class="input-field field">
          <input type="text" placeholder="Subject" id="subject" class="item" autocomplete="off" >
          <div class="error-txt">Subject can't be blank</div>
        </div>
      </div>
      <div class="textarea-field field">
        <textarea id="message" cols="30" rows="10" placeholder="Your message" class="item" autocomplete="off" ></textarea>
        <div class="error-txt">Message can't be blank</div>
      </div>
      <div class="input-field field">
        <input type="file" id="file" class="item" name="file">
      </div>
      <button type="submit">Send Message</button>
    </form>

  </section>


  <script src="https://smtpjs.com/v3/smtp.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script src="./js/contact-us.js"></script> 
</body>
</html>