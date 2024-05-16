<?php

// SDEV328/diner/index.php
// This is my controller

// Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Require the necessary files
require_once('vendor/autoload.php');

/* Test the Order class */
$order = new Order('pad thai', 'lunch', array('soy sauce', 'ketchup'));
//var_dump($order);

/* Test the Data Layer class */
//var_dump(DataLayer::getMeals());


// Create an instance of the Base class
$f3 = Base::instance();
$con = new Controller($f3);

// Define a default route
$f3->route('GET /', function() {
    // Render Home Page
    $GLOBALS['con']->home();
});

// Define a Breakfast Menu route
$f3->route('GET /menus/breakfast', function() {
    // Render the Breakfast Page
    $GLOBALS['con']->breakfast();
});

// Define a Lunch Menu route
$f3->route('GET /menus/lunch', function() {
    // Render the Lunch Page
    $GLOBALS['con']->lunch();
});

// Define a Dinner Menu route
$f3->route('GET /menus/dinner', function() {
    // Render the Dinner Page
    $GLOBALS['con']->dinner();
});

// Define an Order 1 route
$f3->route('GET|POST /order1', function() {
    // Render the Order 1 Page
    $GLOBALS['con']->orderOne();
});

// Define an Order 2 route
$f3->route('GET|POST /order2', function() {
    // Render the Order 2 Page
    $GLOBALS['con']->orderTwo();
});

// Define a Dinner Menu route
$f3->route('GET /order-summary', function() {
    // Render the Summary Page
    $GLOBALS['con']->orderSummary();
});

// Run fat free
$f3->run();