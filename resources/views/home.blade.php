@extends('layouts.admin')
@section('content')

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
    /* General Styles */
    .row.text-center {
        display: flex;
        flex-wrap: nowrap;
        overflow-x: auto;
        justify-content: space-between;
    }

    .stat-box {
        flex: 1;
        white-space: nowrap;
        text-align: center;
        padding: 10px;
        margin: 5px;
        background: linear-gradient(to right, rgb(52, 81, 128), rgb(73, 97, 135), rgb(128, 128, 128));
        color: white;
        border-radius: 10px;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
    }

    .calendar {
        border: 1px solid #ccc;
        padding: 20px;
        border-radius: 15px;
        background: white;
        box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.1);
    }

    .month-nav {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }

    .month-nav button {
        background: linear-gradient(to right, #007bff, #0056b3);
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .month-nav button:hover {
        background: linear-gradient(to right, #0056b3, #003366);
    }

    .calendar td {
        width: 50px;
        height: 50px;
        text-align: center;
        cursor: pointer;
        position: relative;
        transition: all 0.3s ease;
    }

    .calendar td:hover {
        background-color: #f0f8ff;
        transform: scale(1.1);
    }

    .calendar td.today {
        background: #007bff;
        color: white;
    }

    .task-marker {
        position: absolute;
        bottom: 5px;
        right: 5px;
        width: 8px;
        height: 8px;
        background: #28a745;
        border-radius: 50%;
    }

    .task-marker:hover {
        background: #218838;
    }

    /* Modal (Custom Task Alert) Styles */
    .task-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        transition: opacity 0.3s ease;
    }

    .task-modal-content {
        background-color: rgb(255, 255, 255);
        padding: 30px;
        border-radius: 12px;
        width: 400px;
        box-shadow: 0px 5px 20px rgba(0, 0, 0, 0.3);
        text-align: center;
        animation: slideIn 0.3s ease-out;
        transform: translateY(-50px);
    }

    .task-modal-close {
        position: absolute;
        top: 10px;
        right: 10px;
        font-size: 20px;
        cursor: pointer;
        color: #007bff;
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    /* Input and Button Styles */
    .task-modal textarea {
        width: 100%;
        height: 150px;
        padding: 12px;
        margin-top: 10px;
        border-radius: 10px;
        border: 1px solid rgba(0, 0, 0, 0.1);
        font-size: 16px;
        box-sizing: border-box;
        transition: all 0.3s ease;
    }

    .task-modal textarea:focus {
        border: 1px solid #007bff;
        outline: none;
    }

    .task-modal button {
        background: linear-gradient(to right, #007bff, #0056b3);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-top: 15px;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    .task-modal button:hover {
        background: linear-gradient(to right, #0056b3, #003366);
    }

    .clear-task-btn {
        background: linear-gradient(to right, #dc3545, #e83e8c);
        color: white;
        padding: 12px 25px;
        border-radius: 8px;
        border: none;
        cursor: pointer;
        margin-top: 10px;
        font-size: 16px;
        transition: background 0.3s ease;
    }

    .clear-task-btn:hover {
        background: linear-gradient(to right, #c82333, #bd2130);
    }

    .clear-task-btn:disabled {
        background: #ccc;
        cursor: not-allowed;
    }

    /* Make the chart container responsive */
    .chart-container {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        margin-top: 20px;
        padding: 20px;
        border-radius: 10px;
        background: white;
        box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }

    .chart-container canvas {
        max-width: 100%;
        width: 100%;  /* Makes the canvas take the full width of its container */
        height: auto; /* Maintain aspect ratio */
    }

    /* Pie chart specific responsiveness */
    #taskPieChart {
        max-width: 250px; /* Max size for larger screens */
        max-height: 250px;
        width: 100%; /* Adjusts to screen size */
    }

    @media (max-width: 768px) {
        #taskPieChart {
            max-width: 250px; /* Reduce size on smaller screens */
            max-height: 250px;
        }
    }

    @media (min-width: 1800px) {
        #taskPieChart {
            max-width: 350px; /* Reduce size on smaller screens */
            max-height: 350px;
        }
    }

    /* Notice Bar Styling */
    .notice-bar {
        background: linear-gradient(to right, rgb(60, 60, 60), rgb(100, 100, 100), rgb(128, 128, 128));
        color: white;
        padding: 6px;
        font-size: 14px;
        font-weight: bold;
        text-align: center;
        border-radius: 5px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .marquee-container {
        background: #fff;
        padding: 8px;
        border-radius: 0 5px 5px 0;
        box-shadow: inset 0 0 5px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        display: flex;
        align-items: center;
    }

    .marquee-text {
        color: #a00;
        font-size: 16px;
        font-weight: bold;
        white-space: nowrap;
    }

    marquee {
        width: 100%;
        padding-left: 10px;
    }

</style>

<!-- Notice Marquee Section -->
<div class="row mb-2" style="background-color: white; border-radius: 5px;">
            <div class="col-md-2 text-center notice-bar">
                Notice
            </div>
            <div class="col-md-10">
                <marquee class="marquee-text" behavior="scroll" direction="left">
                    {{$noticeFirst->title}}
                </marquee>
            </div>
        </div>

<!-- Statistics and Charts Section -->
<div class="row text-center">
    <div class="col-md-2 col-6 stat-box">Total Task <h3>{{ $totalTasks }}</h3></div>
    <div class="col-md-2 col-6 stat-box">Today's Task <h3>{{ $todaysTasks }}</h3></div>
    <div class="col-md-2 col-6 stat-box">Pending Task <h3>{{ $pendingTasks }}</h3></div>
    <div class="col-md-2 col-6 stat-box">Completed Task <h3>{{ $completedTasks }}</h3></div>
    <div class="col-md-2 col-6 stat-box">Total Client <h3>{{ $totalClients }}</h3></div>
    <div class="col-md-2 col-6 stat-box">Notice Board <h3>{{ $notices }}</h3></div>
</div>

<!-- Task Charts Section -->
<div class="row">
    <div class="col-md-6 chart-container">
        <h5>Task Status</h5>
        <canvas id="taskPieChart"></canvas>
    </div>
    <div class="col-md-6 chart-container">
        <h5>Task Status Overview</h5>
        <canvas id="taskBarChart"></canvas>
    </div>
</div>

<!-- Calendar Section -->
<div class="row mt-4">
    <div class="col-md-12 calendar">
        <div class="month-nav">
            <button onclick="changeMonth(-1)">◀</button>
            <h5 id="calendar-title"></h5>
            <button onclick="changeMonth(1)">▶</button>
        </div>
        <table class="table table-bordered text-center" id="calendar-table">
            <thead>
                <tr>
                    <th>Sun</th><th>Mon</th><th>Tue</th><th>Wed</th><th>Thu</th><th>Fri</th><th>Sat</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div><br><br>

<!-- Custom Task Modal -->
<div id="taskModal" class="task-modal">
    <div class="task-modal-content">
        <span class="task-modal-close" onclick="closeTaskModal()">×</span>
        <h4>Add Your Task</h4>
        <textarea id="taskInput" placeholder="Enter your task here..."></textarea>
        <button onclick="saveTask()">Save</button>
        <button class="clear-task-btn" id="clearTaskBtn" onclick="clearTask()" disabled>Clear</button>
    </div>
</div>

<script>
    const taskData = {
        total: {{ $totalTasks }},
        pending: {{ $pendingTasks }},
        completed: {{ $completedTasks }}
    };

    // Pie Chart
    new Chart(document.getElementById('taskPieChart'), {
        type: 'pie',
        data: {
            labels: ['Pending', 'Completed'],
            datasets: [{
                data: [taskData.pending, taskData.completed],
                backgroundColor: ['#FFC107', '#28A745']
            }]
        }
    });

    // Bar Chart
    new Chart(document.getElementById('taskBarChart'), {
        type: 'bar',
        data: {
            labels: ['Total', 'Pending', 'Completed'],
            datasets: [{
                data: [taskData.total, taskData.pending, taskData.completed],
                backgroundColor: ['#007BFF', '#FFC107', '#28A745']
            }]
        }
    });
</script>

<script>
    let tasks = JSON.parse(localStorage.getItem('tasks')) || {};
    let currentMonth = new Date().getMonth();
    let currentYear = new Date().getFullYear();
    let today = new Date().getDate();
    let todayMonth = new Date().getMonth();
    let todayYear = new Date().getFullYear();
    let selectedDate = null;

    function generateCalendar(month, year) {
        let firstDay = new Date(year, month, 1).getDay();
        let daysInMonth = new Date(year, month + 1, 0).getDate();
        document.getElementById('calendar-title').innerText = new Date(year, month).toLocaleString('default', { month: 'long', year: 'numeric' });
        let calendarBody = document.querySelector('#calendar-table tbody');
        calendarBody.innerHTML = '';
        let row = document.createElement('tr');
        for (let i = 0; i < firstDay; i++) {
            row.appendChild(document.createElement('td'));
        }
        for (let day = 1; day <= daysInMonth; day++) {
            let cell = document.createElement('td');
            cell.innerText = day;
            cell.onclick = () => openTaskModal(day, month, year);
            let key = `${year}-${month}-${day}`;
            
            // Add task-related color-coding
            if (tasks[key]) {
                let marker = document.createElement('div');
                marker.classList.add('task-marker');
                cell.appendChild(marker);

                let taskText = document.createElement('div');
                taskText.innerText = tasks[key].length > 15 ? tasks[key].slice(0, 15) + '...' : tasks[key];
                taskText.style.fontSize = '12px';
                taskText.style.color = 'black';
                cell.appendChild(taskText);
                cell.style.backgroundColor = '#d4edda';  // Color code for having a task
            }

            if (today === day && todayMonth === month && todayYear === year) {
                cell.classList.add('today');
            }
            row.appendChild(cell);
            if (row.children.length === 7) {
                calendarBody.appendChild(row);
                row = document.createElement('tr');
            }
        }
        if (row.children.length > 0) {
            calendarBody.appendChild(row);
        }
    }
    
    function openTaskModal(day, month, year) {
        selectedDate = { day, month, year };
        let key = `${year}-${month}-${day}`;
        let task = tasks[key] || '';
        document.getElementById('taskInput').value = task;
        
        // Enable/Disable the clear button
        const clearBtn = document.getElementById('clearTaskBtn');
        if (task) {
            clearBtn.disabled = false;
        } else {
            clearBtn.disabled = true;
        }
        
        document.getElementById('taskModal').style.display = 'flex';
    }
    
    function closeTaskModal() {
        document.getElementById('taskModal').style.display = 'none';
    }
    
    function saveTask() {
        let task = document.getElementById('taskInput').value;
        if (!selectedDate) return;
        let key = `${selectedDate.year}-${selectedDate.month}-${selectedDate.day}`;
        tasks[key] = task;
        localStorage.setItem('tasks', JSON.stringify(tasks));
        closeTaskModal();
        generateCalendar(selectedDate.month, selectedDate.year);
    }

    function clearTask() {
        if (confirm("Are you sure you want to clear this task?")) {
            let key = `${selectedDate.year}-${selectedDate.month}-${selectedDate.day}`;
            delete tasks[key];
            localStorage.setItem('tasks', JSON.stringify(tasks));
            closeTaskModal();
            generateCalendar(selectedDate.month, selectedDate.year);
        }
    }

    function changeMonth(direction) {
        currentMonth += direction;
        if (currentMonth < 0) { currentMonth = 11; currentYear--; }
        if (currentMonth > 11) { currentMonth = 0; currentYear++; }
        generateCalendar(currentMonth, currentYear);
    }
    
    generateCalendar(currentMonth, currentYear);
</script>

@endsection
