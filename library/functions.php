<?php

function dd($var)
{
    print("<pre>");
    die(var_dump($var));
    print("</pre>");
}
