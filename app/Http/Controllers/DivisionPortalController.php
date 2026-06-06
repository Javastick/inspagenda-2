<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\InviteMail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DivisionPortalController extends Controller
{
    /**
     * Display the portal for a specific division, including schedules
     * and a list of auditors with their monthly assignment frequency.
     */
    public function show(Request $request, $divisionId)
    {
        // 1. Fetch division with auditors and calculate current month's audit count for each auditor
        $division = Division::with(['auditors' => function ($query) {
            $query->withCount(['inviteMails' => function ($q) {
                $q->whereMonth('hari', Carbon::now()->month)
                  ->whereYear('hari', Carbon::now()->year);
            }]);
        }])->findOrFail($divisionId);

        // 2. Fetch all schedules assigned to this division
        $schedules = InviteMail::where('division_id', $divisionId)
            ->with('auditors')
            ->latest()
            ->get();

        // 3. Return JSON or Render View
        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'division' => [
                    'id' => $division->id,
                    'name' => $division->name,
                    'auditors' => $division->auditors->map(function ($auditor) {
                        return [
                            'id' => $auditor->id,
                            'name' => $auditor->name,
                            'status' => $auditor->status,
                            // This is the crucial logic for task equalization (pemerataan tugas)
                            'audit_count_this_month' => $auditor->invite_mails_count
                        ];
                    })
                ],
                'schedules' => $schedules
            ]);
        }

        return view('divisions.portal', [
            'division' => $division,
            'schedules' => $schedules,
            'currentMonthName' => Carbon::now()->isoFormat('MMMM YYYY')
        ]);
    }
}
