<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'client_master';
	
	protected $primaryKey  = 'id';

    protected $fillable = [
        'business_name','contact_name','contact_number','address','gst_number','payment_terms','client_type','status'
    ];
 
    public $timestamps = false;
}
