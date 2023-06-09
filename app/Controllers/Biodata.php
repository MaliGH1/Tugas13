<?php

namespace App\Controllers;

class Biodata extends BaseController
{
    public function index()
    {
        return view('templates/header')
            . view('biodata/dataDiri')
            . view('templates/footer');
    }
}
