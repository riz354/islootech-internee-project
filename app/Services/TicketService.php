<?php


namespace App\Services;

use App\Interfaces\TicketInterface;
use App\Interfaces\UserInterface;
use App\Models\AgentTicket;
use App\Models\GenerateTicket;
use App\Models\Role;
use App\Models\User;
use App\Models\UserRole;
use Generator;
use GuzzleHttp\Psr7\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use function Laravel\Prompts\alert;

class TicketService implements TicketInterface
{


    public function model()
    {

        $ticket =  GenerateTicket::with('agents')->get();
        $count = GenerateTicket::count();
        return ['tickets'=>$ticket,'count'=>$count];
    }




    public function detail($id)
    {

        return GenerateTicket::find($id);
    }


    public function create($request)
    {
        DB::transaction(function () use ($request) {
            $ticketImagesPaths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = time() . '-' . $image->extension(); // Adjust naming convention as needed
                    $image->move(public_path('images'), $path);
                    $ticketImagesPaths[] = 'images/' . $path;
                }
            }

            // $path = time() . '-' . $request->title . "." . $request->image->extension();

            $ticket = GenerateTicket::create([
                "title" => $request->title,
                "message" => $request->message,
                "labels" => json_encode($request->label_checkbox),
                "categoryies" => json_encode($request->category_checkbox),
                "priority" => $request->priority,
                // "image_path" => json_encode('images/' . $path),
                "image_path" => json_encode($ticketImagesPaths)

            ]);
        });
    }

    public function Update($request, $id)
    {

        DB::transaction(function () use ($request, $id) {
            $ticketImagesPaths = [];

            if ($request->hasFile('image')) {
                foreach ($request->file('image') as $image) {
                    $path = time() . '-' . $image->extension(); // Adjust naming convention as needed
                    $image->move(public_path('images'), $path);
                    $ticketImagesPaths[] = 'images/' . $path;
                }
            }
            $tickets = GenerateTicket::where('id', $id)->update([
                "title" => $request->title,
                "message" => $request->message,
                "labels" => json_encode($request->label_checkbox),
                "categoryies" => json_encode($request->category_checkbox),
                "priority" => $request->priority,
                "image_path" => json_encode($ticketImagesPaths)



            ]);
            // dd($ticketImagesPaths);

        });
    }

    public function destroyTicket($id)
    {

        DB::transaction(function () use ($id) {
            $ticket_record = GenerateTicket::find($id);


            if ($ticket_record) {

                $ticket_record->delete();
            }
        });
    }


    public function selectAgent($id)
    {
        $agents = User::whereHas('roles', function ($query) {
            $query->where('role_name', 'Agent');
        })->get();

        return $agents;
    }


    public function assignedTicket($request, $id)
    {
        foreach ($request->agent as $agent) {

            $assignTicket = AgentTicket::updateOrCreate([
                'agent_id' => $agent,
                'ticket_id' => $id
            ]);
        }
    }
}
