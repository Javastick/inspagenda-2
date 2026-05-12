<?php

namespace App\Http\Controllers;

use App\Models\InviteMail;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    /**
     * Display a listing of schedules.
     */
    public function index(Request $request)
    {
        $schedules = InviteMail::with(['division', 'auditors'])->latest()->get();

        if ($request->wantsJson()) {
            return response()->json($schedules);
        }

        return view('schedules.index', compact('schedules'));
    }

    /**
     * Store a newly created schedule.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'sender' => 'required|string|max:255',
            'masuk' => 'required|date',
            'hari' => 'required|date',
            'kegiatan' => 'required|string|max:255',
            'tempat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'division_id' => 'nullable|exists:divisions,id',
            'status_pelaksanaan' => 'nullable|string|max:255',
            'auditor_ids' => 'nullable|array',
            'auditor_ids.*' => 'exists:auditors,id'
        ]);

        $inviteMail = InviteMail::create($validated);

        if (!empty($validated['auditor_ids'])) {
            $inviteMail->auditors()->sync($validated['auditor_ids']);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule created successfully.',
                'data' => $inviteMail->load('auditors')
            ], 201);
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule created successfully.');
    }

    /**
     * Display the specified schedule.
     */
    public function show(Request $request, $id)
    {
        $schedule = InviteMail::with(['division', 'auditors'])->findOrFail($id);

        if ($request->wantsJson()) {
            return response()->json($schedule);
        }

        return view('schedules.show', compact('schedule'));
    }

    /**
     * Update the specified schedule.
     */
    public function update(Request $request, $id)
    {
        $schedule = InviteMail::findOrFail($id);

        $validated = $request->validate([
            'sender' => 'sometimes|required|string|max:255',
            'masuk' => 'sometimes|required|date',
            'hari' => 'sometimes|required',
            'kegiatan' => 'sometimes|required|string|max:255',
            'tempat' => 'sometimes|required|string|max:255',
            'keterangan' => 'nullable|string',
            'division_id' => 'nullable|exists:divisions,id',
            'status_pelaksanaan' => 'nullable|string|max:255',
            'auditor_ids' => 'nullable|array',
            'auditor_ids.*' => 'exists:auditors,id'
        ]);

        $schedule->update($validated);

        if (isset($validated['auditor_ids'])) {
            $schedule->auditors()->sync($validated['auditor_ids']);
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule updated successfully.',
                'data' => $schedule->load('auditors')
            ]);
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule updated successfully.');
    }

    /**
     * Remove the specified schedule from storage.
     */
    public function destroy(Request $request, $id)
    {
        $schedule = InviteMail::findOrFail($id);
        $schedule->auditors()->detach();
        $schedule->delete();

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Schedule deleted successfully.'
            ]);
        }

        return redirect()->route('schedules.index')->with('success', 'Schedule deleted successfully.');
    }
}
