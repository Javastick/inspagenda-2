<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InviteMail;
use Illuminate\Http\Request;

class CalendarController extends Controller
{
    /**
     * Return JSON data of schedules optimized for front-end calendar rendering.
     */
    public function index(Request $request)
    {
        // Query schedules with related division and auditors
        $query = InviteMail::with(['division', 'auditors']);

        // Optional filtering by division
        if ($request->has('division_id')) {
            $query->where('division_id', $request->division_id);
        }

        // Optional filtering by month and year
        if ($request->has('month') && $request->has('year')) {
            $query->whereMonth('masuk', $request->month)
                  ->whereYear('masuk', $request->year);
        }

        $schedules = $query->get();

        $today = \Carbon\Carbon::today();

        // Format data into standard FullCalendar event structure
        $events = $schedules->map(function ($schedule) use ($today) {
            // Determine active event date/time
            $eventDateTime = $schedule->hari ?: ($schedule->masuk ? \Carbon\Carbon::parse($schedule->masuk) : null);
            $className = 'event-future'; // default

            if ($eventDateTime) {
                $eventDate = \Carbon\Carbon::parse($eventDateTime)->startOfDay();
                if ($eventDate->eq($today)) {
                    $className = 'event-today';
                } elseif ($eventDate->lt($today)) {
                    $className = 'event-past';
                } else {
                    $className = 'event-future';
                }
            }

            return [
                'id' => $schedule->id,
                'title' => $schedule->kegiatan,
                'start' => $schedule->hari ? $schedule->hari->format('Y-m-d\TH:i:s') : null,
                'end' => null,
                'location' => $schedule->tempat,
                'sender' => $schedule->sender,
                'description' => $schedule->keterangan,
                'division' => $schedule->division ? $schedule->division->name : null,
                'auditors' => $schedule->auditors->pluck('name'),
                'status_pelaksanaan' => $schedule->status_pelaksanaan,
                'allDay' => false,
                'className' => $className
            ];
        });

        return response()->json($events);
    }
}
