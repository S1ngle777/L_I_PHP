<?php
class Page
{
    public static function part($title)
    {
        include __DIR__ . "/../views/components/$title.php";
    }

    public static function handler($title)
    {
        include __DIR__ . "/../handlers/$title.php";
    }
}
