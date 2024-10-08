<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceItemList  extends Model
{
    use HasFactory;

    protected $table = 'invoice_itemlist';
	
	protected $primaryKey  = 'id';

    protected $fillable = [
       'prinv_id','nav_id','sku','item_name','item_number','dimension','case_pack',
       'case_order','qty_pcs','rate_case','total_amount',
    ];
 
    public $timestamps = false;
}
