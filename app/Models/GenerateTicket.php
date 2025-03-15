<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GenerateTicket extends Model
{
    use HasFactory;
    protected $table = 'tickets';
    public $timestamps = false;
    protected $fillable = ['title','message','labels','categoryies','priority', 'image_path'];


    public function agents(){
        // return $this->belongsToMany(User::class,'agent_ticket');
        return $this->belongsToMany(User::class, 'agent_ticket', 'ticket_id', 'agent_id');
    }
}
