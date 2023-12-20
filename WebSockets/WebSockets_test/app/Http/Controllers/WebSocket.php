<?php

namespace App\Http\Controllers;

use App\Events\PublicMessageEvent;
use Illuminate\Http\Request;


class WebSocket extends Controller
{
    //
    public function status () {
        broadcast(new PublicMessageEvent());
   }
}
