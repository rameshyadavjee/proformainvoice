<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proforma extends Model
{
    use HasFactory;

    protected $table = 'proforma_invoice';
	
	protected $primaryKey  = 'id';

    protected $fillable = [
       'client_id','business_name','address','ship_to','other_references','contact_name','contact_phone',
       'gst_number','payment_terms','total_box','total_qty','net_amount','freight_charges','scheme','basicamtminusscheme','gst','gst_amount','total_amount',
       'created_by','user_id','remarks','status'
    ];
 
    public $timestamps = true;
}
