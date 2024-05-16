<?php

/**
 * My controller class for the Diner project
 * SDEV328/Diner/controllers/controller.php
 */

class Controller
{
    private $_f3;   // Fat-Free Router

    function __construct($f3)
    {
        $this->_f3 = $f3;
    }

    function home()
    {
        // Render a view page
        $view = new Template();
        echo $view->render('views/home-page.html');
    }

    function breakfast()
    {
        // Render a view page
        $view = new Template();
        echo $view->render('views/breakfast-menu.html');
    }

    function lunch()
    {
        // Render a view page
        $view = new Template();
        echo $view->render('views/lunch-menu.html');
    }

    function dinner()
    {
        // Render a view page
        $view = new Template();
        echo $view->render('views/dinner-menu.html');
    }

    function orderOne(){
        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            $food = "";
            // Get the data from the POST array
            if (Validate::validFood($_POST['food'])){
                $food = $_POST['food'];
            }else{
                $this->_f3->set('errors["food"]', 'Please enter a food');
            }

            $meal = "";
            if (isset($_POST['meal']) && Validate::validMeal($_POST['meal'])){
                $meal = $_POST['meal'];
            }else{
                $this->_f3->set('errors["meal"]', 'Please choose a meal');
            }

            // Add order to SESSION array
            $order = new Order($food, $meal);
            $this->_f3->set('SESSION.order', $order);

            // Check for any errors and reroute if none
            if (empty($this->_f3->get('errors'))){
                // Send user to next form
                $this->_f3->reroute('order2');
            }

        }else {
            echo "<p>You got here using the GET method</p>";
        }

        $meals = DataLayer::getMeals();
        $this->_f3->set('meals', $meals);

        // Render a view page
        $view = new Template();
        echo $view->render('views/order1.html');
    }

    function orderTwo(){
        // If the form has been posted
        if ($_SERVER['REQUEST_METHOD'] == "POST"){

            $condiments = 'None Selected';

            // Turn condiments into comma separated string
            if (isset($_POST['conds'])){
                $condiments = implode(', ', $_POST['conds']);
            }

            // Set order condiments in Session to
            $this->_f3->get('SESSION.order')->setCondiments($condiments);

            // Route user to summary page
            $this->_f3->reroute('order-summary');
        }

        // Set condiments choices from data layer
        $condimentChoices = DataLayer::getCondiments();
        $this->_f3->set('condiments', $condimentChoices);

        // Render a view page
        $view = new Template();
        echo $view->render('views/order2.html');
    }

    function orderSummary()
    {
        //var_dump($this->_f3->get('SESSION'));
        //session_destroy();

        // Render a view page
        $view = new Template();
        echo $view->render('views/order-summary.html');
    }
}