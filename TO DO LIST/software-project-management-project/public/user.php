<?php
require '../app/db/config.php'; // Database configuration
require '../app/model/user_class.php';
require '../app/model/task_class.php';

// Check if the user is signed in
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit;
}

// Create a User object
$user = new User($conn);
$task=new task($conn);

// Handle Task Submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add-task'])) {
    $taskName = htmlspecialchars($_POST['task-name'], ENT_QUOTES, 'UTF-8');
    $taskDate = $_POST['task-date'];
    $taskPriority = $_POST['task-priority'];
    $taskCategory = $_POST['task-category'];

    $task->submitTask($taskName, $taskDate, $taskPriority, $taskCategory);
    $message = $user->getMessage();
}

// Handle Task Deletion or Completion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Read raw POST data
    $inputData = json_decode(file_get_contents('php://input'), true);

    if (isset($inputData['task_id']) && isset($inputData['action'])) {
        $taskId = intval($inputData['task_id']);

        if ($inputData['action'] === 'delete') {
            // Delete the task
            $stmt = $conn->prepare("DELETE FROM tasks WHERE id = ?");
            $stmt->bind_param("i", $taskId);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => $conn->error]);
            }
        } elseif ($inputData['action'] === 'done') {
            // Mark the task as Complete
            $stmt = $conn->prepare("UPDATE tasks SET task_status = 'Complete' WHERE id = ?");
            $stmt->bind_param("i", $taskId);
            if ($stmt->execute()) {
                echo json_encode(['status' => 'success']);
            } else {
                echo json_encode(['status' => 'error', 'message' => $conn->error]);
            }
        }
        exit; // End the script after processing the request
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
    <link rel="stylesheet" href="../public/css/user.css">
    <style>
           * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }
        .container{
            width: 100%;
        }
        body {
            display: flex;
            background-color: #f0f1f7;
            width: 100%;
        }
           /* Header section */
           .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 15px 30px;
            background-color: #0056b3;
            color: white;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            font-size: 20px;
        }

        .header .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .header .profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .header .dashboard-title {
            font-size: 24px;
            font-weight: bold;
        }

        /* Main container with grid layout */
        .main-container {
            display: flex;
            flex-grow: 1;
            width: 100%;
            padding: 20px;
            gap: 20px;
            overflow-y: auto;
            height: 90%;

        }

        /* Existing styles */
        .first-column {
            display: flex;
            gap: 25px;
            width: 100%;
            padding-top: 25px;
            padding-left: 30px;
        }

        .last-column {
            display: flex;
            flex-direction: column;
            gap: 5%;
            width: 100%;
            height: 100%;
        }
        /* Section styles */
        .section {
            padding: 20px;
            border-radius: 20px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: flex-start;
            width: 100%;

        }

        /* Specific colors for each section */
        .add-edit {
            background: linear-gradient(135deg, #BFECFF, #9ED6FF);
        }
        .section.add-edit{
            width: 100%;
        }

        .task { 
            background-color: #FFCCEA; 
            display: flex;
            flex-direction: column;
        }

        .calendar {
            background-color: #ddd;
        }

        .graph {
            background-color: #CDC1FF;
            height: 100%;
        }

        /* Fancy styles for Add/Edit/Remove Task */
        .add-edit h2 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .input-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
            width: 100%;
        }

        .input-container input[type="text"],
        .input-container input[type="date"],
        .input-container select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: all 0.3s ease;
            box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        }

        /* Input focus and hover styles */
        .input-container input[type="text"]:focus,
        .input-container input[type="date"]:focus,
        .input-container select:focus,
        .input-container input[type="text"]:hover,
        .input-container input[type="date"]:hover,
        .input-container select:hover {
            border-color: #007bff;
            box-shadow: 0px 0px 8px rgba(0, 123, 255, 0.3);
            outline: none;
        }

        /* Stylish button */
        .input-container button {
            padding: 12px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .input-container button:hover {
            background: linear-gradient(135deg, #0056b3, #004080);
            transform: translateY(-2px);
        }

        .priority-selector, .category-selector {
            margin-top: 10px;
        }

        .task-added-message {
            margin-top: 15px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            display: none;
            animation: fadeIn 0.5s;
        }

        /* Fade-in effect for task added message */
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Calendar task display styles */
        .calendar-tasks {
            margin-top: 10px;
            max-height: 300px;
            overflow-y: auto;
        }

        .task-item {
            padding: 10px;
            margin: 5px 0;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .task-item .task-info {
            flex-grow: 1;  /* Allow task details to take up available space */
        }

        .task-item img {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-left: 10px;
        }
         /* Added style for done task icon */
         .task-item img.done {
            width: 20px;
            height: 20px;
            cursor: pointer;
            margin-left: 10px;
        }

        /* Styling for Task View header and filter dropdown */
        .task-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            width: 100%;
        }

        .task-header h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-right: 15px;
        }

        .task-header select {
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #fff;
            cursor: pointer;
            transition: border-color 0.3s ease;
        }

        .task-header select:hover,
        .task-header select:focus {
            border-color: #007bff;
        }

        /* Stylish button */
        .input-container button {
            padding: 12px;
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
            transition: background 0.3s ease, transform 0.2s;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.2);
        }

        .input-container button:hover {
            background: linear-gradient(135deg, #0056b3, #004080);
            transform: translateY(-2px);
        }

        .priority-selector, .category-selector {
            margin-top: 10px;
        }

        .task-added-message {
            margin-top: 15px;
            padding: 10px;
            background-color: #d4edda;
            color: #155724;
            border-radius: 5px;
            display: none;
            animation: fadeIn 0.5s;
        }

        /* Calendar section styles */
.calendar {
    background-color: #FFF6E3;
    height: 300px;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    align-items: center;
    padding: 10px;
}

.calendar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 100%;
    margin-bottom: 15px;
}

.calendar-nav-button {
    width: 30px;
    height: 30px;
    cursor: pointer;
}

.calendar-nav-button:hover {
    opacity: 0.7;
}

#calendar-month-year {
    font-size: 18px;
    font-weight: bold;
    color: #333;
    text-align: center;
}

.calendar-days {
    display: grid;
    grid-template-columns: repeat(7, 1fr);
    gap: 5px;
    width: 100%;
}

.calendar-day {
    text-align: center;
    padding: 10px;
    border-radius: 5px;
    cursor: pointer;
}

.calendar-day:hover {
    background-color: #ddd;
}

.calendar-day.current {
    background-color: #007bff;
    color: #fff;
    border-radius: 50%;
}
    </style>
</head>
<body>
    <?php include '../app/views/dashboard.php'; ?>
    <div class="container">
        <header class="header">
            <div class="dashboard-title">Todo List Dashboard</div>
        </header>

        <!-- Main Container for Sections -->
        <div class="main-container">
            <div class="first-column">
                <!-- Add/Edit/Remove Tasks Section -->
                <div class="section add-edit">
                    <h2>Tasks</h2>
                    <form method="POST" action="">
                        <div class="input-container">
                            <input type="text" name="task-name" placeholder="Add a Task" required>
                            <input type="date" name="task-date">
                            <div class="priority-selector">
                                <label for="task-priority">Priority:</label>
                                <select name="task-priority" id="task-priority">
                                    <option value="High">High</option>
                                    <option value="Medium">Medium</option>
                                    <option value="Low">Low</option>
                                </select>
                            </div>
                            <div class="category-selector">
                                <label for="task-category">Category:</label>
                                <select name="task-category" id="task-category">
                                    <option value="Work">Work</option>
                                    <option value="Home">Home</option>
                                    <option value="Entertainment">Entertainment</option>
                                </select>
                            </div>
                            <button type="submit" name="add-task">Add Task</button>
                        </div>
                    </form>
                    <?php if (!empty($message)) echo "<div class='task-added-message'>$message</div>"; ?>
                </div>

                <!-- Tasks Section -->
                <div class="section task">
                    <div class="task-header">
                        <h2>Task View</h2>
                        <select id="task-filter" onchange="applyFilter()">
                            <option value="none">Filter by Date and Priority</option>
                            <option value="date-old-new">Date: Old to New</option>
                            <option value="date-new-old">Date: New to Old</option>
                            <option value="priority-high-low">Priority: High to Low</option>
                            <option value="priority-low-high">Priority: Low to High</option>
                            <option value="category-work">Category: Work</option>
                            <option value="category-home">Category: Home</option>
                            <option value="category-entertainment">Category: Entertainment</option>
                        </select>
                    </div>
                    <div class="tasks" id="tasks">
                        <!-- Task items will appear here -->
                        <?php
                        // Fetch tasks for the logged-in user
                        $tasks = $task->fetchTasks();
                        if ($tasks->num_rows > 0) {
                            while ($task = $tasks->fetch_assoc()) {
                                $completedClass = $task['task_status'] === 'Complete' ? 'completed' : '';
                                $doneVisibility = $task['task_status'] === 'Complete' ? 'style="display:none;"' : '';

                                echo "<div class='task-item $completedClass' data-task-id='" . htmlspecialchars($task['id']) . "'>";
                                echo "<strong class='task_name'>" . htmlspecialchars($task['task_name']) . "  </strong> <br>";
                                echo " Date: " . htmlspecialchars($task['task_date']) . "<br>";
                                echo " Priority: " . htmlspecialchars($task['task_priority']) . "<br>";
                                echo " Category: " . htmlspecialchars($task['task_category']) . "<br>";
                                echo "<img src='images/done.png' alt='Done' class='done' $doneVisibility>";
                                echo "<img src='images/delete.png' alt='Delete' class='delete'>";
                                echo "</div>";
                            }
                        } else {
                            echo "<p>No tasks added yet.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>

            <!-- Last Column -->
            <div class="last-column">
                <!-- Calendar -->
                <div class="section calendar">
                    <h2>Calendar</h2>
                    <div class="calendar-header">
                        <img src="images/back.png" alt="" class="calendar-nav-button" id="prev-month" onclick="changeMonth(-1)">
                        <span id="calendar-month-year"></span>
                        <img src="images/next.png" alt="" class="calendar-nav-button" id="next-month" onclick="changeMonth(1)">
                    </div>
                    <div class="calendar-days" id="calendar-days"></div>
                </div>

                <!-- Graph Analysis Section -->
                <div class="section Graph">
                    <h2>Graph</h2>
                    <canvas id="doneTasksChart" width="400" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../public/js/user.js"></script>
</body>
</html>
