 // Dummy Task Data
 let tasks = [];
 let completedTasksCount = 0;
  // Initialize the chart
const ctx = document.getElementById('doneTasksChart').getContext('2d');
const doneTasksChart = new Chart(ctx, {
 type: 'bar',
 data: {
     labels: ['Completed Tasks'],
     datasets: [{
         label: 'Tasks Done',
         data: [completedTasksCount],
         backgroundColor: 'rgba(75, 192, 192, 0.2)',
         borderColor: 'rgba(75, 192, 192, 1)',
         borderWidth: 1
     }]
 },
 options: {
     scales: {
         y: {
             beginAtZero: true,
             max: 10 // You can adjust the max value based on expected task completions
         }
     }
 }
});
 // Add Task Function
 function addTask() {
     const taskName = document.getElementById('task-name').value;
     const taskDate = document.getElementById('task-date').value;
     const taskPriority = document.getElementById('task-priority').value;
     const taskCategory = document.getElementById('task-category').value;
     
     if (taskName && taskDate && taskPriority && taskCategory) {
         const task = {
             name: taskName,
             date: taskDate,
             priority: taskPriority,
             category: taskCategory
         };
         tasks.push(task);
         displayTasks();
         document.getElementById('task-name').value = '';
         document.getElementById('task-date').value = '';
         document.getElementById('task-priority').value = '';
         document.getElementById('task-category').value = '';
         document.getElementById('task-message').style.display = 'block';
         setTimeout(() => {
             document.getElementById('task-message').style.display = 'none';
         }, 2000);
     }
 }



function markAsDone(taskIndex) {
const task = tasks[taskIndex];
// Mark the task as done
const taskElement = document.querySelectorAll('.task-item')[taskIndex];
if (taskElement) {
 taskElement.style.textDecoration = "line-through";
 completedTasksCount++;
 updateChart();
}
}
// Update chart data
function updateChart() {
 doneTasksChart.data.datasets[0].data[0] = completedTasksCount;
 doneTasksChart.update();
}

 // Delete Task Function
 function deleteTask(taskName) {
     tasks = tasks.filter(task => task.name !== taskName);
     displayTasks();
 }

 // Apply Filter Function
 function applyFilter() {
const filter = document.getElementById('task-filter').value;

switch (filter) {
 case 'date-old-new':
     tasks.sort((a, b) => new Date(a.date) - new Date(b.date));
     break;
 case 'date-new-old':
     tasks.sort((a, b) => new Date(b.date) - new Date(a.date));
     break;
 case 'priority-high-low':
     tasks.sort((a, b) => a.priority === 'High' ? -1 : (b.priority === 'High' ? 1 : 0));
     break;
 case 'priority-low-high':
     tasks.sort((a, b) => a.priority === 'Low' ? -1 : (b.priority === 'Low' ? 1 : 0));
     break;
 case 'category-work':
     // Sort tasks to bring 'Work' category to the top, without deleting others
     tasks.sort((a, b) => {
         if (a.category === 'Work' && b.category !== 'Work') return -1;
         if (a.category !== 'Work' && b.category === 'Work') return 1;
         return 0; // Keep original order for other categories
     });
     break;
 case 'category-home':
     // Sort tasks to bring 'Home' category to the top, without deleting others
     tasks.sort((a, b) => {
         if (a.category === 'Home' && b.category !== 'Home') return -1;
         if (a.category !== 'Home' && b.category === 'Home') return 1;
         return 0; // Keep original order for other categories
     });
     break;
 case 'category-entertainment':
     // Sort tasks to bring 'Entertainment' category to the top, without deleting others
     tasks.sort((a, b) => {
         if (a.category === 'Entertainment' && b.category !== 'Entertainment') return -1;
         if (a.category !== 'Entertainment' && b.category === 'Entertainment') return 1;
         return 0; // Keep original order for other categories
     });
     break;
 default:
     break;
}

// Display tasks after sorting
displayTasks();
}


 let currentMonth = new Date().getMonth();
let currentYear = new Date().getFullYear();

// Function to change month
function changeMonth(direction) {
currentMonth += direction;
if (currentMonth < 0) {
 currentMonth = 11;
 currentYear--;
} else if (currentMonth > 11) {
 currentMonth = 0;
 currentYear++;
}
renderCalendar();
}

// Function to render the calendar
function renderCalendar() {
const calendarDays = document.getElementById("calendar-days");
const monthYearDisplay = document.getElementById("calendar-month-year");

const firstDay = new Date(currentYear, currentMonth, 1);
const lastDay = new Date(currentYear, currentMonth + 1, 0);

const totalDays = lastDay.getDate();
const startingDay = firstDay.getDay(); // 0 = Sunday, 6 = Saturday

calendarDays.innerHTML = ''; // Clear previous calendar days

// Display the month and year in the header
const monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
monthYearDisplay.textContent = `${monthNames[currentMonth]} ${currentYear}`;

// Add empty cells for the days before the 1st of the month
for (let i = 0; i < startingDay; i++) {
 const emptyCell = document.createElement('div');
 emptyCell.classList.add('calendar-day');
 calendarDays.appendChild(emptyCell);
}

// Add day numbers to the calendar
for (let day = 1; day <= totalDays; day++) {
 const dayCell = document.createElement('div');
 dayCell.classList.add('calendar-day');
 dayCell.textContent = day;
 calendarDays.appendChild(dayCell);
}
}

// Initial render of the calendar
renderCalendar();



document.addEventListener('DOMContentLoaded', function () {
    document.getElementById('tasks').addEventListener('click', function (event) {
        const taskItem = event.target.closest('.task-item');
        const taskId = taskItem.getAttribute('data-task-id');

        if (event.target.classList.contains('delete') && taskId) {
            if (confirm("Are you sure you want to delete this task?")) {
                fetch('user.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ task_id: taskId, action: 'delete' })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            taskItem.remove();
                        } else {
                            alert("Error deleting task: " + data.message);
                        }
                    })
                    .catch(error => console.error("Error:", error));
            }
        }

        if (event.target.classList.contains('done') && taskId) {
            fetch('user.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ task_id: taskId, action: 'done' })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        taskItem.querySelector('.task_name').classList.add('completed');
                        event.target.style.display = 'none';
                    } else {
                        alert("Error updating task: " + data.message);
                    }
                })
                .catch(error => console.error("Error:", error));
        }
    });
});