<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InviteMail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DivisionCalendarController extends Controller
{
    /**
     * Return JSON calendar events for a specific division portal.
     * Only schedules assigned to the given division_id are returned.
     */
    public function index(Request $request, $divisionId)
    {
        $query = InviteMail::with(['auditors'])
            ->where('division_id', $divisionId);

        // Optional filtering by month and year
        if ($request->has('month') && $request->has('year')) {
            $query->whereMonth('masuk', $request->month)
                  ->whereYear('masuk', $request->year);
        }

        $schedules = $query->get();

        $now = now()->startOfDay();

        // Format data into standard FullCalendar event structure
        $events = $schedules->map(function ($schedule) use ($now) {
            $eventDate = $schedule->hari ? $schedule->hari->startOfDay() : null;
            $className = 'fc-event-future';
            $statusLabel = 'Mendatang';

            if ($eventDate) {
                if ($eventDate->lt($now)) {
                    $className = 'fc-event-past';
                    $statusLabel = 'Terlewat';
                } elseif ($eventDate->eq($now)) {
                    $className = 'fc-event-today';
                    $statusLabel = 'Hari Ini';
                }
            }

            return [
                'id'          => $schedule->id,
                'title'       => $schedule->kegiatan,
                'start'       => $schedule->hari ? $schedule->hari->format('Y-m-d\TH:i:s') : null,
                'end'         => null,
                'location'    => $schedule->tempat,
                'sender'      => $schedule->sender,
                'description' => $schedule->keterangan,
                'auditors'    => $schedule->auditors->pluck('name'),
                'status'      => $statusLabel,
                'allDay'      => false,
                'className'   => $className,
            ];
        });

        return response()->json($events);
    }
}
