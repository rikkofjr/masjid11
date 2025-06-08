<?php

namespace App\Helpers;
use Alkoumi\LaravelHijriDate\Hijri;

class Helper {

    public static function qurbanNomorHewan($model, $nowHijriYear, $jenis_hewan){

        switch ($jenis_hewan){
            case 'Sapi':
                $data = $model::where('jenis_hewan', 'Sapi')->whereYear('hijri', $nowHijriYear)->orderBy('created_at', 'DESC')->first();
                if(!$data){
                    $lastNumber = 1;
                }else{
                    
                    $getLastNumber = (int)filter_var($data->nomor_hewan, FILTER_SANITIZE_NUMBER_INT);
                    $lastNumber = $getLastNumber + 1;    
                }
                // return $jenis_hewan.'_'.$lastNumber;
                return $lastNumber;
            break;

            case 'Kambing' :
                $data = $model::where('jenis_hewan', 'Kambing')->whereYear('hijri', $nowHijriYear)->orderBy('created_at', 'DESC')->first();
                if(!$data){
                    $lastNumber = 1;
                }else{
                    $getLastNumber = (int)filter_var($data->nomor_hewan, FILTER_SANITIZE_NUMBER_INT);
                    $lastNumber = $getLastNumber + 1;    
                }
                // return $jenis_hewan.'_'.$lastNumber;
                return $lastNumber;
            break;
        }
        

    }
} 