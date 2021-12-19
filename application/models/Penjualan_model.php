<?php

class Penjualan_model extends CI_Model
{

        public function getOmzetMonthly($limit,$start){
            $sql = "SELECT COALESCE(SUM(t.bill_total),0) AS Omzet,COALESCE(m.merchant_name,'') AS MerchantName,m.selected_date AS Day
        FROM (select selected_date from 
        (select adddate('1970-01-01',t4*10000 + t3*1000 + t2*100 + t1*10 + t0) selected_date from
         (select 0 t0 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0,
         (select 0 t1 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1,
         (select 0 t2 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2,
         (select 0 t3 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3,
         (select 0 t4 union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v
        WHERE selected_date between '2021-11-01' and '2021-11-30') m 
        LEFT JOIN transactions t ON CAST(COALESCE(t.updated_at,t.created_at) AS DATE)= CAST(m.selected_date AS DATE)
        LEFT JOIN merchants m ON m.id=t.merchant_id
        LEFT JOIN users u ON u.id = m.user_id
        GROUP BY m.selected_date ORDER BY m.selected_date ASC
        "; 
        return $this->db->query($sql,$limit,$start)->result_array();
        }
}