<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>To Do List</title>
  <!-- Link to Google Fonts for a fantasy-style font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Lobster&display=swap">
  <link rel="stylesheet" href="../../public/css/landing.css">
</head>
<body>

  <!-- Header with styled title and centered links -->
  <header>
    <h1>To Do List</h1>
    <nav>
      <a href="#slideshow-container">Home</a>
     <!-- <a href="#about">About Us</a>-->
      <a href="#features">Features</a>
      <a href="contact-us.php">Contact Us</a>
    </nav>
    <a href="../../public/login.php" class="login-btn">Login</a>
  </header>

  <!-- Slideshow container -->
  <div class="slideshow-container" id="slideshow-container">
    <!-- Slides -->
    <div class="slide">
      <img src="../../public/images/slide1.jpg" alt="Slide 1">
    </div>
    
    <div class="slide">
      <img src="../../public/images/slide2.jpg" alt="Slide 2">
    </div>
    
    <div class="slide">
      <img src="../../public/images/slide3.jpg" alt="Slide 3">
    </div>

    <!-- Next and previous buttons -->
    <a class="prev" onclick="changeSlide(-1)">&#10094;</a>
    <a class="next" onclick="changeSlide(1)">&#10095;</a>
      <!-- Dot indicators -->
  <div class="dot-container">
    <span class="dot" onclick="setSlide(1)"></span> 
    <span class="dot" onclick="setSlide(2)"></span> 
    <span class="dot" onclick="setSlide(3)"></span> 
  </div>
  </div>

<!-- About Us Section -->
<div class="about-us-section" id="about">
  <div class="about-message">
    <h2>About Us</h2>
    <p>Welcome to your ultimate productivity partner! Our To-Do List app is designed to help you stay organized, motivated, and focused. Whether you're managing work tasks or personal goals, we've got you covered.</p>
    <p>Our mission is to simplify your day-to-day planning and track your progress with ease. Experience a seamless, clutter-free interface that lets you manage tasks effectively and stay on top of your priorities.</p>
    <a href="#features" class="go-to-features-btn">Explore Our Features</a>
  </div>
  <div class="about-summary">

  <div class="calendar-section" id="calendar">
  <div class="calendar">
    <div class="calendar-header">
      <button id="prev-month" onclick="changeMonth(-1)">&#10094;</button>
      <h3 id="current-month-year">Month Year</h3>
      <button id="next-month" onclick="changeMonth(1)">&#10095;</button>
    </div>
    <div class="calendar-grid" id="calendar-grid">
      <!-- Days will be dynamically generated here -->
    </div>
  </div>
</div>

  </div>
</div>


<script>
// Calendar Script
const calendarGrid = document.getElementById('calendar-grid');
const currentMonthYear = document.getElementById('current-month-year');
let currentDate = new Date();

// Function to render the calendar
function renderCalendar() {
  // Clear the calendar grid
  calendarGrid.innerHTML = '';

  // Set the current month and year
  const month = currentDate.toLocaleString('default', { month: 'long' });
  const year = currentDate.getFullYear();
  currentMonthYear.textContent = `${month} ${year}`;

  // Get the first day of the month and the number of days in the month
  const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
  const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
  const daysInMonth = lastDay.getDate();
  const startingDay = firstDay.getDay(); // 0 (Sunday) to 6 (Saturday)

  // Add empty cells for days before the first day of the month
  for (let i = 0; i < startingDay; i++) {
    const emptyCell = document.createElement('div');
    emptyCell.classList.add('empty');
    calendarGrid.appendChild(emptyCell);
  }

  // Add cells for each day of the month
  for (let i = 1; i <= daysInMonth; i++) {
    const dayCell = document.createElement('div');
    dayCell.textContent = i;

    // Highlight the current day
    if (
      i === new Date().getDate() &&
      currentDate.getMonth() === new Date().getMonth() &&
      currentDate.getFullYear() === new Date().getFullYear()
    ) {
      dayCell.classList.add('current-day');
    }

    // Add event listener for task addition
    //dayCell.addEventListener('click', () => {
     // const task = prompt("Enter your task for this day:");
      //if (task) {
     //   dayCell.innerHTML += `<br><span class="task">${task}</span>`;
    //  }
    //});

    calendarGrid.appendChild(dayCell);
  }
}

// Function to change the month
function changeMonth(offset) {
  currentDate.setMonth(currentDate.getMonth() + offset);
  renderCalendar();
}

// Initial render of the calendar
renderCalendar();</script>

  <!-- Features Section -->
  <div class="features" id="features">
    <h2>Key Features</h2>
    <br>
    <br>
    <p>Stay on top of your tasks with our smart To-Do List App. Effortlessly manage your schedule, track progress with dynamic visuals, and stay motivated with built-in inspiration tools. Designed for simplicity and efficiency, this app helps you stay productive and focused every day.</p>

    <!-- Photo Gallery Section Inside Features -->
    <div class="photo-gallery">
      <div class="gallery-item">
        <img src="../../public/images/add-task.png" alt="Task Management">
        <div class="photo-caption">
          <h3>Effortless Task Management</h3>
          <p>Add unlimited tasks and prioritize them to stay organized. With an intuitive interface, managing work, personal goals, and reminders is easier than ever.</p>
        </div>
      </div>

      <div class="gallery-item">
        <img src="../../public/images/motivation-f.png" alt="Motivation">
        <div class="photo-caption">
          <h3>Daily Motivation & Focus</h3>
          <p>Boost your productivity with motivational insights and reminders. Stay inspired to complete tasks and tackle challenges with confidence.</p>
        </div>
      </div>

      <div class="gallery-item">
        <img src="../../public/images/analysis.png" alt="Progress Tracking">
        <div class="photo-caption">
          <h3>Visual Progress Tracking</h3>
          <p>Monitor your productivity with a real-time progress graph. Every completed task updates your stats, giving you a clear sense of achievement.</p>
        </div>
      </div>
    </div> 
  </div>

  <br>
  <br>
  <br>
  <footer class="footer">
        <div class="container">
            <div class="footer-row">
                <div class="footer-col">
                    <h4>Company</h4>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Services</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">contact us</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Get Help</h4>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping</a></li>
                        <li><a href="#">Returns</a></li>
                        <li><a href="#">Order Status</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4>Follow Us</h4>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <p class="footer-bottom">&copy; <span id="year"></span> Your Company. All rights reserved.</p>
    </footer>

  <!-- Scripts -->
  <script src="../../public/js/landing.js"></script>
  <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
  <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>
</html>