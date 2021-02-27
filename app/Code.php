<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Code extends Model
{
    //

   protected $table = "codes";
   protected $primaryKey = 'id';
   protected $fillable = [
        'code', 'codeStatus','user_id'
    ];

   public $timestamps = "true";



    public function scopeGetCodes(){


    	$codes = Code::from('codes as c')
    	             ->join('users as u', 'u.id', 'c.user_id')
    	             ->select([\DB::raw('c.id as codeId, c.code as code, DATE_FORMAT(c.created_at, "%d-%m-%Y") as codeDate, c.codeRecipient as codeRecipient,  CONCAT(u.userFirstName, " ", u.userLastName) as userFullName, c.codeStatus as codeStatus')])
    	             ->get();	

    	return $codes;

    }


}


