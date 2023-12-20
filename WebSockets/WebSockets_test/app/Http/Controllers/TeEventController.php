<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\TestingEvent;


class TeEventController extends Controller
{
    //
    function testingEvents()
    {
     event(new TestingEvent);
    }
}
