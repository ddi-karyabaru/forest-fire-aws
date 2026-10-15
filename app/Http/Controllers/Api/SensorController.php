<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SensorLog;
// use Illuminate\Support\Facades\DB;


class SensorController extends Controller
{
    

public function getHourlyAverageData() {
    try {
        // Mengambil data dan mengelompokkannya menggunakan collection PHP agar terhindar dari error SQL strict mode
        $logs = SensorLog::orderBy('created_at', 'desc')->take(200)->get();

        $hourlyData = $logs->groupBy(function($item) {
            // Mengelompokkan berdasarkan Tahun-Bulan-Hari Jam (contoh: 2026-10-13 14:00)
            return \Carbon\Carbon::parse($item->created_at)->format('Y-m-d H:00:00');
        })->map(function ($group, $key) {
            return [
                'time_hour' => $key,
                'avg_temperature' => $group->avg('temperature'),
                'avg_humidity' => $group->avg('humidity'),
                'avg_soil_moisture' => $group->avg('soil_moisture'),
                'avg_mq2_value' => $group->avg('mq2_value'),
            ];
        })->values();

        return response()->json([
            'status' => 'success',
            'data' => $hourlyData
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage()
        ], 500);
    }
}
    // Menerima data dari ESP32
    public function store(Request $request) {
        $log = SensorLog::create([
            'temperature' => $request->temperature,
            'humidity' => $request->humidity,
            'soil_moisture' => $request->soil_moisture,
            'mq2_value' => $request->mq2_value,
            'flame_status' => $request->flame_status,
            'status_warning' => $request->status_warning,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Data sensor berhasil disimpan!',
            'data' => $log
        ], 200);
    }

    // Mengambil data terbaru untuk Dashboard
     public function getLatest() {
        $latest = SensorLog::latest()->first();
        return response()->json($latest);
    }
}
