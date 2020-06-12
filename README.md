# Ajax-Calendar

Basic calendar that supports creation of user accounts and the ablitity to create, edit, and delete events. Using ajax all of these operations are done without refreshing the page. There is a function, however, that checks if a user session has been created every time a page is reloaded to prevent the user from being logged out on page reload. Using Javascript fetch api, the input fields are converted to json and sent to the appropriate php file. There inputs are decoded into php variable and used to query the MySQL database. Lastly, a json array is sent back to the javascript file saying whether the query was successful.

http://ec2-3-136-161-0.us-east-2.compute.amazonaws.com/~jcstone/module5/calendar/index.php
