<?php

/* This is my data layer
   This belongs to our model
*/

class DataLayer
{
    // Get the meals for the Diner app
    static function getMeals(){
        return array('breakfast', 'lunch', 'dinner', 'dessert');
    }

    // Get the condiments for the Diner app
    static function getCondiments(){
        return array('ketchup', 'mustard', 'sriracha', 'mayo');
    }
}
