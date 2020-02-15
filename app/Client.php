<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    const CPF = 0;
    const CNPJ = 1;
    
    protected $fillable = [
        'person_type',
        'register_number',
        'corporate_name',
        'fantasy_name'
    ];
    
    public function contacts()
    {
        return $this->hasMany(ClientContact::class);
    }

    // /**
    //  * Get client main contact
    //  */
    // public function main_contact($id)
    // {
    //     return self::where('is_main_contact', 1)
    //         ->where('client_id', $id)
    //         ->get()
    //     ;
    // }
}
