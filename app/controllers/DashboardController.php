<?php

namespace Animal\Controllers;

use Animal\Models\Loss;
use Tecgdcs\Response;
use Tecgdcs\View;

class DashboardController
{
    public function show()
    {
        if(!isset($_SESSION['user'])){
            Response::abort(Response::UNAUTHORIZED);
        }
        $losses = Loss::all();
        View::make('dashboard.show', compact('losses'));
    }
}