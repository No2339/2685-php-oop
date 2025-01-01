<?php

interface Shape
{

    static function calculateArea();
    static function calculateVolume();
    static function calculatePerimiter();
}

class Circle implements Shape
{
    function calculateArea()
    {
    }
    function calculatePerimiter()
    {
    }
    function calculateVolume()
    {
    }
}
class Oval implements Shape
{
}
class Rectangle implements Shape
{
}
class Square implements Shape
{
}
class Triangle implements Shape
{
}
class Polygon implements Shape
{
}
 