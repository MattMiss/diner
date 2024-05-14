<?php

/** Order class represents a diner order */

class Order
{
    private $_food;
    private $_meal;
    private $_condiments;

    /**
     * Constructor creates an Order object
     *
     * @param $_food String the food the user orders
     * @param $_meal String selected meal
     * @param $_condiments String selected condiments
     */
    public function __construct($_food="", $_meal="", $_condiments="")
    {
        $this->_food = $_food;
        $this->_meal = $_meal;
        $this->_condiments = $_condiments;
    }

    /**
     * @return String
     */
    public function getFood()
    {
        return $this->_food;
    }

    /**
     * @param String $food
     */
    public function setFood($food)
    {
        $this->_food = $food;
    }

    /**
     * @return String
     */
    public function getMeal()
    {
        return $this->_meal;
    }

    /**
     * @param String $meal
     */
    public function setMeal($meal)
    {
        $this->_meal = $meal;
    }

    /**
     * Returns the selected condiments
     * @return Array An array of condiments
     */
    public function getCondiments()
    {
        return $this->_condiments;
    }

    /**
     * @param String $condiments
     */
    public function setCondiments($condiments)
    {
        $this->_condiments = $condiments;
    }
}
