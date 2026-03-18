<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\EditRequest;
use App\Models\ObligationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EditRequestController extends Controller
{
    /**
     * Display a listing of pending edit requests for the Director.
     */
    public function index()
    {
        // Only allow users with Director role to see the list
        if (Auth::user()->role_code !== 'FMS Director') {
            return response()->json(['message' => 'Unauthorized access.'], 403);
        }

        $requests = EditRequest::with(['requester', 'obligationRequest'])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json($requests);
    }

    /**
     * Store a newly created edit request in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'obligation_request_id' => 'required|exists:obligation_requests,id',
            'reason' => 'required|string|max:1000',
            'payload' => 'required|array',
        ]);

        $editRequest = EditRequest::create([
            'obligation_request_id' => $validated['obligation_request_id'],
            'requested_by_user_id' => Auth::id(),
            'reason' => $validated['reason'],
            'payload' => $validated['payload'],
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Edit request submitted successfully.',
            'data' => $editRequest
        ], 201);
    }

    /**
     * Approve the specified edit request.
     */
    public function approve(Request $request, $id)
    {
        if (Auth::user()->role_code !== 'FMS Director') {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $editRequest = EditRequest::findOrFail($id);

        if ($editRequest->status !== 'pending') {
            return response()->json(['message' => 'Request is already processed.'], 400);
        }

        DB::transaction(function () use ($editRequest) {
            // Apply the payload to the ObligationRequest
            $target = ObligationRequest::findOrFail($editRequest->obligation_request_id);
            $target->update($editRequest->payload);

            // Update EditRequest status
            $editRequest->update([
                'status' => 'approved',
                'approved_by_user_id' => Auth::id(),
            ]);

            // Unlock the record if it was locked (logic per MRS)
            if ($target->is_locked) {
                $target->update(['is_locked' => false]);
            }
        });

        return response()->json(['message' => 'Edit request approved and changes applied.']);
    }

    /**
     * Reject the specified edit request.
     */
    public function reject(Request $request, $id)
    {
        if (Auth::user()->role_code !== 'FMS Director') {
            return response()->json(['message' => 'Unauthorized action.'], 403);
        }

        $editRequest = EditRequest::findOrFail($id);

        if ($editRequest->status !== 'pending') {
            return response()->json(['message' => 'Request is already processed.'], 400);
        }

        $editRequest->update([
            'status' => 'rejected',
            'approved_by_user_id' => Auth::id(),
        ]);

        return response()->json(['message' => 'Edit request has been rejected.']);
    }
}
