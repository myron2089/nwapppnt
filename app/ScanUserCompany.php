<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScanUserCompany extends Model
{
    //
    protected $table = "scan_user_companies";

   	protected $primaryKey = 'id';

    protected $fillable = [
       'scanUserSource', 'scanCompanyDestination'
    ];

    public $timestamps = "true";
}
