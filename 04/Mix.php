<?php

interface Instruction
{
    function teach();
}

class Teacher
{
    static $name;
}

class ArabicTeacher extends Teacher implements Instruction
{
    static $x;
    function teach()
    {
    }
}

class MathTeacher extends Teacher implements Instruction
{
    static $cric;
    function teach()
    {
    }
}