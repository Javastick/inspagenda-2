<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Auditor;
use App\Models\InviteMail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminController extends Controller
{
    /**
     * Admin dashboard: show all invite_mails sorted by latest.
     */
    public function dashboard()
    {
        $schedules = InviteMail::with(['division', 'auditors'])
            ->latest('masuk')
            ->get()
            ->map(function ($schedule) {
                $now = Carbon::today();
                $eventDate = $schedule->hari ? $schedule->hari->startOfDay() : null;

                if (!$eventDate) {
                    $schedule->status_badge = 'unknown';
                } elseif ($eventDate->lt($now)) {
                    $schedule->status_badge = 'past';
                } elseif ($eventDate->eq($now)) {
                    $schedule->status_badge = 'today';
                } else {
                    $schedule->status_badge = 'future';
                }

                return $schedule;
            });

        $divisions = Division::all();
        $totalSchedules = $schedules->count();
        $todaySchedules = $schedules->where('status_badge', 'today')->count();
        $futureSchedules = $schedules->where('status_badge', 'future')->count();

        return view('admin.dashboard', compact('schedules', 'divisions', 'totalSchedules', 'todaySchedules', 'futureSchedules'));
    }

    /**
     * Show form to create a new schedule.
     */
    public function create()
    {
        $divisions = Division::with('auditors')->get();
        return view('admin.surat.create', compact('divisions'));
    }

    /**
     * Store a new schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender'        => 'required|string|max:255',
            'masuk'         => 'required|date',
            'hari'          => 'required|date',
            'kegiatan'      => 'required|string|max:255',
            'tempat'        => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
            'division_id'   => 'nullable|exists:divisions,id',
            'auditor_ids'   => 'nullable|array',
            'auditor_ids.*' => 'exists:auditors,id',
        ]);

        $inviteMail = InviteMail::create($validated);

        if (!empty($validated['auditor_ids'])) {
            $inviteMail->auditors()->sync($validated['auditor_ids']);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Surat undangan berhasil ditambahkan.');
    }

    /**
     * Show form to edit a schedule.
     */
    public function edit($id)
    {
        $schedule = InviteMail::with(['division', 'auditors'])->findOrFail($id);
        $divisions = Division::with('auditors')->get();
        return view('admin.surat.edit', compact('schedule', 'divisions'));
    }

    /**
     * Update the schedule.
     */
    public function update(Request $request, $id)
    {
        $schedule = InviteMail::findOrFail($id);

        $validated = $request->validate([
            'sender'        => 'required|string|max:255',
            'masuk'         => 'required|date',
            'hari'          => 'required|date',
            'kegiatan'      => 'required|string|max:255',
            'tempat'        => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
            'division_id'   => 'nullable|exists:divisions,id',
            'auditor_ids'   => 'nullable|array',
            'auditor_ids.*' => 'exists:auditors,id',
        ]);

        $schedule->update($validated);
        $schedule->auditors()->sync($validated['auditor_ids'] ?? []);

        return redirect()->route('admin.dashboard')->with('success', 'Surat undangan berhasil diperbarui.');
    }

    /**
     * Delete the schedule.
     */
    public function destroy($id)
    {
        $schedule = InviteMail::findOrFail($id);
        $schedule->auditors()->detach();
        $schedule->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Surat undangan berhasil dihapus.');
    }
}
