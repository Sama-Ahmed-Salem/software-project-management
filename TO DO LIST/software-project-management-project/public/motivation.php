<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Motivation Flip Cards</title>
  <link rel="stylesheet" href="../public/css/motivation.css">
</head>
<body>
  <?php include '../app/views/dashboard.php'; ?>

  <!-- Title in the center -->
  <h1>Motivation Quotes</h1>

  <!-- Flip Cards -->
  <div class="card-container">
    <div class="flip-card" onclick="this.classList.toggle('clicked')">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="images/motivation1.png" alt="Motivational Image 1">
        </div>
        <div class="flip-card-back">
          <p>"The secret of getting ahead is getting started."</p>
        </div>
      </div>
    </div>

    <div class="flip-card" onclick="this.classList.toggle('clicked')">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="images/motivation2.png" alt="Motivational Image 2">
        </div>
        <div class="flip-card-back">
          <p>"Your future is created by what you do today, not tomorrow."</p>
        </div>
      </div>
    </div>

    <div class="flip-card" onclick="this.classList.toggle('clicked')">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="images/motivation3.png" alt="Motivational Image 3">
        </div>
        <div class="flip-card-back">
          <p>"Success is the sum of small efforts repeated day in and day out."</p>
        </div>
      </div>
    </div>

    <div class="flip-card" onclick="this.classList.toggle('clicked')">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="images/motivation4.png" alt="Motivational Image 4">
        </div>
        <div class="flip-card-back">
          <p>"Don't watch the clock; do what it does. Keep going."</p>
        </div>
      </div>
    </div>

    <div class="flip-card" onclick="this.classList.toggle('clicked')">
      <div class="flip-card-inner">
        <div class="flip-card-front">
          <img src="images/motivation5.png" alt="Motivational Image 5">
        </div>
        <div class="flip-card-back">
          <p>"The best way to predict the future is to create it."</p>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
