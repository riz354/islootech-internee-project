<?php

namespace App\Http\Controllers;

use App\Http\Requests\GenerateTicketRequest;
use App\Interfaces\TicketInterface;
use App\Models\AgentTicket;
use App\Models\Category;
use App\Models\GenerateTicket;
use App\Models\Label;
use App\Models\Priority;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Ticket;

class ticketController extends Controller
{

    public function __construct(public TicketInterface $ticketInterface)
    {
    }

    public function index()
    {
        $priority = Priority::all();
        $label = Label::all();
        $category = Category::all();
        $ticket = GenerateTicket::count();


        return view('create_ticket', ['priority' => $priority, 'label' => $label, 'category' => $category,'tickets'=>$ticket]);
    }


    public function create(GenerateTicketRequest $request)
    {

        try {
            $this->ticketInterface->create($request);
            return redirect()->route('ticket.view');
        } catch (Exception $error) {
            return redirect()->route('ticket.view')->withErrors(" Error in new Ticket generating");
        }
    }


    public function showTickets()
    {
        try {
            $data = $this->ticketInterface->model();
            return view('tickets', $data);
        } catch (Exception $error) {
            return redirect()->route('user.authenticate')->withErrors("Tickets data can not be loaded");
        }
    }

    public function ticketDetails($id)
    {
        try {
            $detail = $this->ticketInterface->detail($id);
            return view('view-ticket-detail', ['data' => $detail]);
        } catch (Exception $error) {
            return redirect()->route('ticket.view')->withErrors(" Error in view Tickets detail");
        }
    }



    public function editTicket($id)
    {
        $ticket = GenerateTicket::find($id);
        $labels = Label::get();
        $category = Category::get();
        $priority = Priority::get();

        // dd($ticket->all());

        return view('edit-ticket', ['ticket' => $ticket, 'label' => $labels, 'category' => $category, 'priority' => $priority]);
    }

    public function storeTicket(Request $request, $id)
    {
        try {
            $tickets = $this->ticketInterface->Update($request, $id);
            return redirect()->route('ticket.view')->withSuccess("Ticket Updated Succcessfully");;
        } catch (Exception $error) {
            return redirect()->route('ticket.edit', $request->id)->withErrors(" user data not updated");
        }
    }

    public function destroy(Request $request, $id)
    {
        try {
            $this->ticketInterface->destroyTicket($id);
            return response()->json(['success' => true]);
        } catch (Exception $error) {
            return back()->withErrors([
                'message' => 'User can not be updated'
            ]);
        }
    }



    public function selectAgent($id)
    {

        $agents = $this->ticketInterface->selectAgent($id);
        // $agents = User::whereHas('roles', function ($query) {
        //     $query->where('role_name', 'Agent');
        // })->get();

        return view('assign-ticket', ['id' => $id, "agent" => $agents]);
    }


    public function assignedTicket(Request $request, $id)
    {

        $this->ticketInterface->assignedTicket($request,$id);

        // foreach ($request->agent as $agent) {

        //     $assignTicket = AgentTicket::updateOrCreate([
        //         'agent_id' => $agent,
        //         'ticket_id' => $id
        //     ]);
        // }
        return redirect()->route('ticket.view')->withSuccess('Signed successfully');
    }
}
