<?php

// SDEV328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once('vendor/autoload.php');
require_once('model/validate.php');

/* Test the Order class */
$order = new Order('pad thai', 'lunch', array('soy sauce', 'ketchup'));
//var_dump($order);

/* Test the Data Layer class */
//var_dump(DataLayer::getMeals());


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
$f3->route('GET|POST /order1', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $food = "";
        // Get the data from the POST array
        if (Validate::validFood($_POST['food'])){
            $food = $_POST['food'];
        }else{
            $f3->set('errors["food"]', 'Please enter a food');
        }

        $meal = "";
        if (isset($_POST['meal']) && Validate::validMeal($_POST['meal'])){
            $meal = $_POST['meal'];
        }else{
            $f3->set('errors["meal"]', 'Please choose a meal');
        }

        // Add order to SESSION array
        $order = new Order($food, $meal);
        $f3->set('SESSION.order', $order);

        // Check for any errors and reroute if none
        if (empty($f3->get('errors'))){
            // Send user to next form
            $f3->reroute('order2');
        }

    }else {
        echo "<p>You got here using the GET method</p>";
    }

    $meals = DataLayer::getMeals();
    $f3->set('meals', $meals);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Define an Order 1 route
$f3->route('GET|POST /order2', function($f3) {

    // If the form has been posted
    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        $condiments = 'None Selected';

        // Turn condiments into comma separated string
        if (isset($_POST['conds'])){
            $condiments = implode(', ', $_POST['conds']);
        }

        // Set order condiments in Session to
        $f3->get('SESSION.order')->setCondiments($condiments);

        // Route user to summary page
        $f3->reroute('order-summary');
    }

    // Set condiments choices from data layer
    $condimentChoices = DataLayer::getCondiments();
    $f3->set('condiments', $condimentChoices);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Define a Dinner Menu route
$f3->route('GET /order-summary', function($f3) {
    var_dump($f3->get('SESSION'));
    //session_destroy();

    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// Run fat free
$f3->run();