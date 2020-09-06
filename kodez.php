<?php
    function kode_random($length){
        $data = '12345';
        $string = 'ZS-';

        for ($i=0; $i < $length; $i++) { 
        $pos = rand(0,strlen($data)-1);
        $string .=$data[$pos];

        
        }
        return $string;
    }
    $kode = kode_random(5);
    
    function kode_random2($length){
        $data2 = '12345';
        $string2 = 'ZB-';

        for ($i=0; $i < $length; $i++) { 
        $pos2 = rand(0,strlen($data2)-1);
        $string2 .=$data2[$pos2];

        
        }
        return $string2;
    }
    $kode2 = kode_random2(5);
?>
