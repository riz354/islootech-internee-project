<?php

namespace App\Interfaces;

use GuzzleHttp\Psr7\Request;

interface TicketInterface
{
    public function model();
    public function detail($id);
    public function create($request);
    public function destroyTicket($id);

    public function Update($request ,$id);

    public function selectAgent($id);
    public function assignedTicket($request, $id);


}
