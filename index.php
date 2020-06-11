<?php 
session_start();
//https://medium.com/@nitinpatel_20236/challenge-of-building-a-calendar-with-pure-javascript-a86f1303267d
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous"> -->
    <title>Calendar</title>
</head>
<body>
    <div id="logout" hidden>
        <button id="logout_btn">Logout</button>
    </div>

    <div id="loginSignup">
        <h2>Login: </h2>
        <input type="text" name="username" id="username" placeholder="Username...">
        <input type="password" name="pwd" id="pwd" placeholder="Password...">
        <button id="login_btn">Log In</button>
        <br>
        <h2>Signup: </h2>
        <input type="text" name="username" id="usernameCreate" placeholder="Username...">
        <input type="password" name="pwd" id="pwdCreate" placeholder="Password...">
        <input type="password" name="pwd-repeat" id="pwd-repeat" placeholder="Repeat Password...">
        <button id="signup_btn">Signup</button>
    </div>
    <h1 id="monthAndYear"></h1>
    <button id="prevBtn"><i class="fas fa-arrow-left"></i></button>
    <button id="createEventBtn" hidden>Create Event</button>
    <button id="nextBtn"><i class="fas fa-arrow-right"></i></button>
    <br>
    <br>
    <!-- Table for the initial calendar, in javascript a new table is create when a new month is loaded -->
    <table id="calendarTable">
        <!-- This part will be added via javascript the table heading will be regenerated several times -->
        <!-- <thead>
            <tr>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>
        </thead> -->
    </table>
    <div id="createEvent" hidden>
        <button id="closeCreateBtn">&#10006</button>
        <h3>Create New Event</h3>
        <label for="eventTitle">Title: </label>
        <input type="text" class="createEl" name="eventTitle" id="eventTitle" placeholder="Title..."><br>
        <label for="eventDate">Date: </label>
        <input type="date" class="createEl" name="eventDate" id="eventDate"><br>
        <label for="eventTime">Time: </label>
        <input type="time" class="createEl" name="eventTime" id="eventTime"><br>
        <button id="createBtn">Create</button>
    </div>

    <div id='eventPopUp' hidden>
        <button id="closeEventBtn">&#10006</button>
        <div id="eventTextArea">

        </div>
        <div id="editEvent" hidden>
            <h3>Edit Event</h3>
            <label for="editTitle">Title: </label>
            <input type="text" class="editEl" name="editTitle" id="editTitle" placeholder="Title..."><br>
            <label for="eventDate">Date: </label>
            <input type="date" class="editEl" name="editDate" id="editDate"><br>
            <label for="eventTime">Time: </label>
            <input type="time" class="editEl" name="editTime" id="editTime"><br>
            <button id="changeEvent">Make Changes</button>
        </div>
        <button id="editEventBtn">Edit</button>
        <button id="deleteEvent">Delete</button>
    </div>
</body>
<script src="main.js"></script>
</html>