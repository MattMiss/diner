<?php

// SDEV328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the autoload file
require_once('vendor/autoload.php');

// Create an instance of the Base class
$f3 = Base::instance();

// Define a default route
$f3->route('GET /', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/home-page.html');
});

// Define a Breakfast Menu route
$f3->route('GET /menus/breakfast', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/breakfast-menu.html');
});

// Define a Lunch Menu route
$f3->route('GET /menus/lunch', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/lunch-menu.html');
});

// Define a Dinner Menu route
$f3->route('GET /menus/dinner', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/dinner-menu.html');
});

// Define an Order 1 route
$f3->route('GET|POST /order1', function() {
    global $f3;
    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        echo "<p>You got here using the POST method</p>";
        var_dump($_POST);

        // Get the data from the POST array
        $food = $_POST['food'];
        $meal = $_POST['meal'];

        if (true){
            $f3->set('SESSION.food', $food);
            $f3->set('SESSION.meal', $meal);
        }
    }else {
        echo "<p>You got here using the GET method</p>";
    }
    // Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Define an Order 1 route
$f3->route('GET /order2', function() {
    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Run fat free
$f3->run();