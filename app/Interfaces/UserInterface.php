<?php

namespace App\Interfaces;

use GuzzleHttp\Psr7\Request;

interface UserInterface
{
    public function register($request);
    public function authenticate($request);

    public function model();
    public function Update($request ,$id);

    public function destroyUser($id);
}
