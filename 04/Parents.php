<?php


class GrandFather
{
    static $villa;
}

class Father extends GrandFather
{
    static $car;
    // Has a car, as well as the villa

}

class Child extends Father
{
    static $PS5;

    // Has a car and a villa, as well as the PS5
}