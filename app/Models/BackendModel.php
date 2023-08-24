<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class BackendModel extends Model
{
    use HasFactory;


    function get_all_active_order(){
        return DB::table('order')->where('order_status','<>',7)->get();
      //  $query = $this->db->table('order');
      //  $query->select('order.*');
      //  $query->where('order.order_status <>',7);
      // return $query->get()->getResult();
    }
    
    function get_all_sales(){
                
       $array['sale'] = DB::table('order')->where('order_status',6)->sum('total');
       $array['total'] = DB::table('order')->sum('total'); 
        return $array;
    }


     
      function get_latest_order(){
     

        $query = DB::table('order AS ord')
            ->join('order_status AS os', 'ord.order_status', '=', 'os.id')
            ->select('ord.*', 'os.name AS order_status')
            ->where('ord.status',1)
            ->orderBy('ord.id','desc')
            ->limit(10)
            ->get();
      return $query;

    }


   public function getwithLimitOrde1rBy($tbl,$start_limit,$end_limit,$col,$order)
    {  
         $query = DB::table($tbl)
                ->select('*')
                ->orderBy($col, $order)
                ->limit($start_limit, $end_limit)
                ->get();
          return $query; 
    }
    

    function get_order_all(){
      $query = DB::table('order')
             ->selectRaw('year(date_added) as year, month(date_added) as month, sum(total) as total')
            ->groupBy('year','month')
            ->orderByRaw('min(date_added) desc')
            ->get();
       // echo '<pre>';
       // print_r($query); exit;
      return $query; 
      
      //   $query = $this->db->table('order');    
      //   $query->select('order.date_added,order.total');
      //   $query->orderBy('date_added','desc');
      //   $query->groupBy('DATE(date_added), MONTH(date_added), YEAR(date_added)');
      // return  $query->get()->getResult();
    }
    
    function get_order_all_calendar_month(){

         $query = DB::table('order')
             ->selectRaw('monthname(date_added) as month, sum(total) as total')
            ->groupBy('month')
            ->orderByRaw('min(date_added) desc')
            ->get();
              
        $query = $this->db->table('order');
        $query->select('order.*,sum(total) as total');
        $query->orderBy('date_added','desc');
        $query->groupBy('Month(date_added)');
        return  $query->get()->getResult();
    }
    
    function get_order_all_calendar_year(){
        $query = $this->db->table('order');
        $query->select('order.date_added,sum(total) as total');
        $query->orderBy('date_added','desc');
        $query->groupBy('year(date_added)');
        return  $query->get()->getResult();
    }
    
    function get_order_all_calendar_week(){
        $query = $this->db->table('order');
        $query->select('order.date_added,sum(total) as total');
        $query->orderBy('date_added','desc');
        $query->groupBy('DAYNAME(date_added)');
        return  $query->get()->getResult();
    }

    function get_total_price(){ 
    $this->db->select_sum('price');
$this->db->from('product_option_value');
    $query= $this->db->get();
    return $query->result();
}



function get_world_map($country_id){
  $this->db->select('*');
$this->db->from('order');
$this->db->where_in('payment_country_id', $country_id);
    $query= $this->db->get();
    return $query->result();
}

}
