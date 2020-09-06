<?php
    function kode_random($length){
        $data2 = '12345';
        $string2 = 'ZB-';

        for ($i=0; $i < $length; $i++) { 
        $pos2 = rand(0,strlen($data2)-1);
        $string2 .=$data2[$pos2];

        
        }
        return $string2;
    }
    $kode2 = kode_random(5);
    
?>