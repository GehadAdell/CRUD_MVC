<?php
class HomeController
{

    public function index($id = "")
    {
        View::load('home');
    }
}
