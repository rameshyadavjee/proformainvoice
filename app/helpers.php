<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Item;
use App\Models\Client;

    function AmountInWords(float $amount)
    {
        $amount_after_decimal = round($amount - ($num = floor($amount)), 2) * 100;

        // Check if there is any number after decimal
        $amt_hundred = null;
        $count_length = strlen($num);
        $x = 0;
        $string = array();
        $change_words = array(
            0 => 'Zero', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety'
        );
        $here_digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');

        while ($x < $count_length) {
            $get_divider = ($x == 2) ? 10 : 100;
            $amount_part = floor($num % $get_divider);
            $num = floor($num / $get_divider);
            $x += ($get_divider == 10) ? 1 : 2;

            if ($amount_part > 0) { // Only add if the part is greater than 0
                $add_plural = (($counter = count($string)) && $amount_part > 9) ? 's' : null;
                $amt_hundred = ($counter == 1 && $string[0]) ? ' and ' : null;
                if ($amount_part < 21) {
                    $string[] = $change_words[$amount_part] . ' ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
                } else {
                    $string[] = $change_words[floor($amount_part / 10) * 10] . ' ' . $change_words[$amount_part % 10] . ' ' . $here_digits[$counter] . $add_plural . ' ' . $amt_hundred;
                }
            }
        }

        $implode_to_Rupees = implode('', array_reverse($string));

        // Handle paise part only if the amount after decimal is greater than 0
        $get_paise = '';
        if ($amount_after_decimal > 0) {
            $paise_tens = floor($amount_after_decimal / 10);
            $paise_units = $amount_after_decimal % 10;

            // Avoid adding "Zero" to paise
            $paise_words = ($paise_tens > 0 ? $change_words[$paise_tens] : '') . 
                            ($paise_units > 0 ? ' ' . $change_words[$paise_units] : '');
            
            // Only append if paise words exist
            if (!empty(trim($paise_words))) {
                $get_paise = "And " . trim($paise_words) . ' Paise';
            }
        }

        return ($implode_to_Rupees ? $implode_to_Rupees . 'Rupees ' : '') . $get_paise;
    }

    function getFinancialYear() {
        $currentMonth = date('m'); // Get the current month (01 to 12)
        $currentYear = date('Y');  // Get the current year (4 digits)

        if ($currentMonth >= 4) {
            // Financial year starts in April, so current financial year is from current year to next year
            $startYear = substr($currentYear, 2, 2); // Get last two digits of current year
            $endYear = substr($currentYear + 1, 2, 2); // Get last two digits of next year
        } else {
            // Before April, financial year is from previous year to current year
            $startYear = substr($currentYear - 1, 2, 2); // Get last two digits of previous year
            $endYear = substr($currentYear, 2, 2); // Get last two digits of current year
        }

        return 'SDPL /'.$startYear . '-' . $endYear.'/'; // Return in the format YY-YY (e.g., 23-24)
    }
    

    function notification_count()
    {
        $user_loggedin = Auth::user();
        $id = $user_loggedin->id;  
        $sql =  DB::table('notification')
                ->where('read_status', 0)
                ->where('user_id',$id)
                ->count('read_status');
        echo $sql;                            
    } 

    function get_username($id)
    {         
        $records = User::where('id',$id)->first();                
        return $records->name;
    }

    function get_useremail($id)
    {         
        $records = User::where('id',$id)->first();                
        return $records->email;
    }

    function get_allusers()
    {         
        $records = User::where('status','Active')->get();        
        return $records;
    }

    function get_allitems()
    {         
        $records = Item::where('status','Active')->orderBy('id', 'desc')->get();        
        return $records;
    }

    function get_allclients()
    {         
        $records = Client::where('status','Active')->orderBy('id', 'desc')->get();        
        return $records;
    }

    function get_clientdata($id)
    {         
        $records = Client::where('id',$id)->get();                
        return $records->records;
    }
     
   
?>