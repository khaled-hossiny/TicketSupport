<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\TicketReply;
use App\Http\Requests\CreateTicketRequest;
use App\Ticket;
use App\User;
use Auth;
class TicketsController extends Controller
{
    //
    public function show(Ticket $ticket){
        $ticket_replies = TicketReply::where('ticket_id',$ticket->id)->get();
        $users = array();
        foreach($ticket_replies as $ticketReply){
            $user = User::find($ticketReply->user_id);
             array_push($users,$user);
        }
        return view('tickets.show', [
        'ticket_replies' => $ticket_replies,
        'ticket' => $ticket,
        'users' => $users
    ]);
    }
    public function edit(Ticket $ticket){
        $agents = User::all();
        return view('tickets.edit',[
        'ticket' => $ticket,
        'agents' => $agents
    ]);
    }
    public function update(CreateTicketRequest $request, Ticket $ticket){
        $ticket->support_id = $request->support_id;
        $ticket->status = $request->status;
        $ticket->urgency = $request->urgency;
        $ticket->save();
        return redirect(action('HomeController@index'));
    }
}
