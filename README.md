# AutoDatabase

## Necessary Software
I used MAMP to run the MySQL server. MAMP is available at https://www.mamp.info/en/downloads/.

I used visual studio to develop the code.

To view the project you can simply type localhost/"INSERT FILE PATH TO index.php HERE" into the URL bar. 

Note that the project uses the MySQL database so if you do not have the database and tables set up you will get an error. You must set up the database before using the application. To do so, run MAMP and then open phpMyAdmin by going to tools > phpMyAdmin.

Then make a database like so:

<pre>
create database autosdb;

GRANT ALL ON autosdb.* TO 'fred'@'localhost' IDENTIFIED BY 'zap';
GRANT ALL ON autosdb.* TO 'fred'@'127.0.0.1' IDENTIFIED BY 'zap';
</pre>

This makes the databse and gives access to fred using the credentials above. Now insert the table like so:

<pre>
CREATE TABLE autos (
        autos_id INTEGER NOT NULL KEY AUTO_INCREMENT,
        make VARCHAR(255),
        model VARCHAR(255),
        year INTEGER,
        mileage INTEGER
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
</pre>

This defines the table used in the application. Feel free to insert a view automobiles too.

## Video Demo
The project demo can be seen at https://youtu.be/Rm7Lrn7NDuY. 

Note that there is no audio, it is just a quick demo to show the database updating ad how to use the application.

## Description
This is an automobile database developed using PHP, MySQL, HTML, and CSS. It was developed to have CRUD functionality and follows a Model-View-Controller design. 

You can sign in to the web application and then create, read, update, and delete automobiles. Each automobile has a make, model, year and mileage and there is data validation before inserting the data into the database.

I used htmlentities() and PDO prepare statements to avoid SQL and HTML injection.

Features Implemented
- Login Page
- Create: You can create automobiles through the "Add New Entry" feature
- Read: A table is shown for viewing the data
- Update: Click the edit link to update an entry
- Delete: Click the delete link to delete an entry

## How to Use
1. There is no specified username, just make sure to inclue '@' in the username. 
2. The password is 'php123'.
3. Login and use the application!

## Pictures

<img src = "https://user-images.githubusercontent.com/53048085/129656221-75789672-cea0-4fde-8415-5ea6d6a5c36c.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656299-5894fe97-a96b-4934-8b46-529961b8f2bd.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656324-09fde596-762a-42e2-9fef-3b0bf6515abf.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656358-283d76db-aea6-40ca-9c14-3e6a857f6daa.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656380-451b6743-eba7-4d07-9adf-27a1b24d085b.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656415-cfd50e39-138c-454e-8ec4-5df0b6afc9c2.png"/>

<img src = "https://user-images.githubusercontent.com/53048085/129656444-15bae644-c849-406f-8a56-0f7491e1d390.png"/>
