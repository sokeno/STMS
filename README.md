# STMS
This is a simple time management system that does the following:

User  creates an account and logs in

User can add (and edit and delete) a row what he has worked on, what date, for how long

User can add a setting (Preferred working hours per day)

If on a certain date a user has worked under the PreferredWorkingHourPerDay, these rows are red, otherwise green.

Implement at least three roles with different permission levels: a regular user would only be able to CRUD on their owned records, a user manager would be able to CRUD users, and an admin would be able to CRUD all records and users.

Filter entries by date from-to

Export the filtered times to a sheet in HTML:

Date: 21.5
Total time: 9h
Notes:
Note1
Note2
Note3

REST API. Make it possible to perform all user actions via the API, including authentication 
In any case, you should be able to explain how a REST API works and demonstrate that by creating functional tests that use the REST Layer directly. Please be prepared to use REST clients like Postman, cURL, etc for this purpose.
All actions are done client side using AJAX, refreshing the page is not acceptable. 
Bonus: unit and e2e tests!

