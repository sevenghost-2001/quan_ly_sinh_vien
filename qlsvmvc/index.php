<?php
session_start();
//import config & connerctDb
require 'config.php';
require 'connectDB.php';
//import models
require 'model/student.php';
require 'model/StudentRepository.php';

require 'model/subject.php';
require 'model/SubjectRepository.php';

require 'model/register.php';
require 'model/RegisterRepository.php';
//điều hướng đến controller cụ thể dựa vào tham số
$c = $_GET['c'] ?? 'student';
$a = $_GET['a'] ?? 'index';
$controller = ucfirst($c) . 'Controller'; //studentcontroller
//import controller vào hệ thống
require "controller/$controller.php";
$controller = new $controller();
$controller->$a();