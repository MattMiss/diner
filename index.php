<?php

// SDEV328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once('vendor/autoload.php');
require_once('model/data-layer.php');
require_once('model/validate.php');
//var_dump(getMeals());

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
        if (validFood($_POST['food'])){
            $food = $_POST['food'];
        }else{
            $f3->set('errors["food"]', 'Please enter a food');
        }

        if (isset($_POST['meal']) && validMeal($_POST['meal'])){
            $meal = $_POST['meal'];
        }else{
            $f3->set('errors["meal"]', 'Please choose a meal');
        }


        // Add data to SESSION array
        $f3->set('SESSION.food', $food);
        $f3->set('SESSION.meal', $meal);

        if (empty($f3->get('errors'))){
            // Send user to next form
            $f3->reroute('order2');
        }

    }else {
        echo "<p>You got here using the GET method</p>";
    }

    $meals = getMeals();
    $f3->set('meals', $meals);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order1.html');
});

// Define an Order 1 route
$f3->route('GET|POST /order2', function($f3) {
    var_dump($f3->get('SESSION'));

    if ($_SERVER['REQUEST_METHOD'] == "POST"){

        if (!empty($_POST['conds'])){
            $condiments = 'None Selected';

            if (isset($_POST['conds'])){
                $condiments = implode(', ', $_POST['conds']);
            }
            $f3->set('SESSION.condiments', $condiments);

            $f3->reroute('order-summary');
        }
    }

    $condimentChoices = getCondiments();
    $f3->set('condiments', $condimentChoices);

    // Render a view page
    $view = new Template();
    echo $view->render('views/order2.html');
});

// Define a Dinner Menu route
$f3->route('GET /order-summary', function($f3) {
    // Render a view page
    $view = new Template();
    echo $view->render('views/order-summary.html');
});

// Run fat free
$f3->run();