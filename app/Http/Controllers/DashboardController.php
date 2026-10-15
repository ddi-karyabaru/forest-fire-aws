<?php

namespace App\Http\Controllers;


use App\Models\SensorLog;

class DashboardController extends Controller {
    public function index() {
        $latest = SensorLog::latest()->first();
        return view('dashboard', compact('latest'));
    }
}