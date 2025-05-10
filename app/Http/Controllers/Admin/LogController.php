<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\File;
use Illuminate\Pagination\LengthAwarePaginator;

class LogController extends Controller
{
    public function index()
    {
        $selectedDate = request()->get('date', now()->format('Y-m-d'));
        $adminLogFile = storage_path("logs/admin/admin-{$selectedDate}.log");

        // Get available log dates
        $logDates = collect(glob(storage_path('logs/admin/admin-*.log')))
            ->map(function ($file) {
                return str_replace(['admin-', '.log'], '', basename($file));
            })
            ->sort()
            ->reverse();

        $adminLogs = collect(file_exists($adminLogFile) ? array_reverse(file($adminLogFile)) : [])
            ->map(function ($line) {
                if (preg_match('/^#\d+/', $line)) {
                    return null;
                }

                $parts = explode(' ', $line, 4);

                if (count($parts) >= 3 && !empty($parts[0]) && !empty($parts[1])) {
                    return [
                        'timestamp' => $parts[0] . ' ' . $parts[1],
                        'level' => trim($parts[2], '[]'),
                        'message' => isset($parts[3]) ? trim($parts[3]) : '',
                        'source' => 'admin'
                    ];
                }
                return null;
            })->filter();

        $page = request()->get('page', 1);
        $perPage = 50;

        $paginatedLogs = new LengthAwarePaginator(
            $adminLogs->forPage($page, $perPage),
            $adminLogs->count(),
            $perPage,
            $page,
            ['path' => request()->url()]
        );

        return view('admin.logs.index', compact('paginatedLogs', 'logDates', 'selectedDate'));
    }


    public function logSpecificAction($data)
    {
        // Write to admin specific log
        Log::channel('admin')->info('Admin action performed', $data);

        // This will write to both main log and admin log due to stack configuration
        Log::info('Action logged in main file', $data);
    }
}
