<?php
$router->get('/auth/register', 'UserController@create');
$router->get('/auth/login', 'UserController@login');