<?php

namespace App\Http\Controllers;

use App\Models\ProjectParticipant;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewTicketController extends Controller
{
    /**
     * Create a new ticket and assign it to a project participant
     */
    public function store(Request $request)
    {
        $request->validate([
            'description'   => 'required|string|max:500',
            'assigned_to'   => 'required|exists:project_participants,id',
        ]);

        $ticket = Ticket::create([
            'description' => $request->description,
            'status'      => 'Open',
            'created_by'  => Auth::id(),
            'assigned_to' => $request->assigned_to,
        ]);

        return response()->json([
            'message' => 'Ticket created successfully',
            'data'    => $ticket->load('assignedParticipant.participant'),
        ], 201);
    }

    /**
     * Get all project participants for a given project
     */
    public function getParticipants($projectId)
    {
        $participants = ProjectParticipant::with('participant')
            ->where('project_id', $projectId)
            ->get();

        return response()->json($participants);
    }

    /**
     * Get tickets created by the logged-in user
     */
    public function myTickets()
    {



        $tickets = Ticket::where('created_by', Auth::id())
            ->with('assignedParticipant.participant')
            ->get();

        return response()->json(['data' => $tickets], 200);
    }

    /**
     * Get tickets assigned to the logged-in user (if he's a participant)
     */
    public function assignedTickets()
    {
        // 1. جيب اليوزر الحالي
        $authId = Auth::id();
        $user = User::find($authId);

        $user_id = null;

        // 2. تحقق من كل علاقة بالترتيب
        if ($user->engineer()->where('user_id', $authId)->exists()) {
            $user_id = $user->engineer()->where('user_id', $authId)->first()->id;
        } elseif ($user->realEstateManager()->where('user_id', $authId)->exists()) {
            $user_id = $user->realEstateManager()->where('user_id', $authId)->first()->id;
        } elseif ($user->consulting_engineers()->where('user_id', $authId)->exists()) {
            $user_id = $user->consulting_engineers()->where('user_id', $authId)->first()->id;
        } elseif ($user->projectManager()->where('user_id', $authId)->exists()) {
            $user_id = $user->projectManager()->where('user_id', $authId)->first()->id;
        }
         // 3. إذا وجدنا participant_id
        if ($user_id) {
            $participantIds = ProjectParticipant::where('participant_id', $user_id)
                 ->pluck('id');

            $tickets = Ticket::whereIn('assigned_to', $participantIds)->get();

        return response()->json(['data' => $tickets], 200);

        }

        // 4. إذا ما وجد participant_id
        return response()->json(['message' => 'No participant found for this user'], 404);
    }


    /**
     * Update ticket status (open/close)
     */
    public function updateStatus( $ticketId, $status)
    {
         
        $ticket = Ticket::with('assignedParticipant')->findOrFail($ticketId);

        // // Only creator or assigned participant can update
        // $isCreator = $ticket->created_by === Auth::id();
        // $isAssigned = $ticket->assignedParticipant &&
            $ticket->assignedParticipant->participant_id === Auth::id();

        // if (!($isCreator || $isAssigned)) {
        //     return response()->json(['message' => 'Unauthorized'], 403);
        // }

        $ticket->status = $status;
        $ticket->save();

        return response()->json([
            'message' => 'Ticket status updated',
            'data'    => $ticket->load('assignedParticipant.participant'),
        ]);
    }
}
