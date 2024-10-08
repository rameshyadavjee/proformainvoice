<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $table = 'item_master';
	
	protected $primaryKey  = 'id';

    protected $fillable = [
        'nav_id','sku','item_number','item_name','dimension','case_pack','dealer_rate','trader_rate','msp_rate'
    ];
 
    public $timestamps = false;
}
