<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientContact extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'email',
        'phone',
        'email_receive_nfe',
        'email_receive_charge',
        'is_main_contact',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
