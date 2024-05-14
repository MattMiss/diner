<?php

/* Validate data for the diner app */


class Validate
{
    // Return true if food is valid
    static function validFood($food){
        return strlen(trim($food)) >= 3;
    }

    // Return true if meal is valid
    static function validMeal($meal){
        return in_array($meal, DataLayer::getMeals());
    }
}

