# AutoDatabase

# Necessary Software
I used MAMP to run the MySQL server. MAMP is available at https://www.mamp.info/en/downloads/.

I used visual studio to develop the code.

To view the project you can simply type localhost/"INSERT FILE PATH TO index.php HERE" into the URL bar. 

Note that the project uses the MySQL database so if you do not have the database and tables set up you will get an error. You must set up the database before using the application. To do so you must run MAMP and then open phpMyAdmin

Then make a database like so:

And insert the table like so:

CREATE TABLE autos (
        autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
        make VARCHAR(255),
        model VARCHAR(255),
        year INTEGER,
        mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

# Video Demo
The project demo can be seen at https://youtu.be/Rm7Lrn7NDuY. 

Note that there is no audio, it is just a quick demo to show the database updating ad how to use the application.

# Description
This is an automobile database developed using PHP, MySQL, HTML, and CSS. It was developed to have CRUD functionality and follows a Model-View-Controller design. 

You can sign in to the web application and then create, read, update, and delete automobiles. Each automobile has a make, model, year and mileage and there is data validation before inserting the data into the database.

I used htmlentities() and PDO prepare statements to avoid SQL and HTML injection.

Features Implemented
- Login Page
- Create: You can create automobiles through the 
