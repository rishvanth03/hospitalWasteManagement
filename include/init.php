<?php

$_home = '/hwms';
$http = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
$_path = $http . $_SERVER['HTTP_HOST'] . $_home;

function checkSession()
{
    require 'session.php';
}

function head()
{

    require 'head.php';
}

function menu()
{
    $path = $GLOBALS['_home'];
    require "menu.php";
}

function navbar()
{
    require 'navbar.php';
}

function footer()
{
    require 'script.php';
}


function settings(){
    require 'settings.php';
}
