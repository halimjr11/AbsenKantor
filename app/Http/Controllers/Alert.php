<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Alert extends Controller
{
    protected $message;
    public function warning($message){
        return redirect()->back()->with('alert', $message);
    }

    public function error($message){
        return redirect()->back()->with('error', $message);
    }

    public function success($message){
        return redirect()->back()->with('success', $message);
    }
}
