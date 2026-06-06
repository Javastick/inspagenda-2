<?php

namespace App\Http\Controllers;

use App\Models\Auditor;
use App\Models\Division;
use Illuminate\Http\Request;

class AuditorController extends Controller
{
    /**
     * Return all auditors with their division as JSON.
     */
    public function index()
    {
        $auditors = Auditor::with('division')->withCount('inviteMails')->orderBy('division_id')->orderBy('name')->get();
        return response()->json($auditors);
    }

    /**
     * Display the specified auditor profile.
     */
    public function show($id)
    {
        $auditor = Auditor::with(['division', 'inviteMails' => function($q) {
            $q->orderBy('hari', 'desc');
        }])->findOrFail($id);

        $groupedMails = $auditor->inviteMails->groupBy(function ($mail) {
            return $mail->hari ? $mail->hari->format('F Y') : 'Unknown Date';
        });

        return view('auditors.profile', compact('auditor', 'groupedMails'));
    }

    /**
     * Store a new auditor.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $auditor = Auditor::create($validated);
        $auditor->load('division');

        return response()->json([
            'success' => true,
            'message' => 'Auditor berhasil ditambahkan.',
            'data'    => $auditor,
        ], 201);
    }

    /**
     * Update an existing auditor.
     */
    public function update(Request $request, $id)
    {
        $auditor = Auditor::findOrFail($id);

        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'division_id' => 'required|exists:divisions,id',
        ]);

        $auditor->update($validated);
        $auditor->load('division');

        return response()->json([
            'success' => true,
            'message' => 'Auditor berhasil diperbarui.',
            'data'    => $auditor,
        ]);
    }

    /**
     * Delete an auditor.
     */
    public function destroy($id)
    {
        $auditor = Auditor::findOrFail($id);

        // Detach from any associated invite_mails (pivot table)
        $auditor->inviteMails()->detach();
        $auditor->delete();

        return response()->json([
            'success' => true,
            'message' => 'Auditor berhasil dihapus.',
        ]);
    }
}
