<?php
namespace App\Utilities;

use Request;
use Carbon\Carbon;

class Helpers
{

    public static function checkRole($roles){
        $granted = false;
        foreach ($roles as $role) {
            if(auth()->user()->role == $role){
                $granted = true;
            }
        }
        if ($granted == false) {
            return self::errorRedirect('home', 'Akses anda terbatas!');
        }
        return true;
    }

    public static function checkRoleWithoutAction($roles){
        $granted = false;
        foreach ($roles as $role) {
            if(auth()->user()->role == $role){
                $granted = true;
            }
        }
        return $granted;
    }

    public static function checkUrlForMenu($path){
        if (Request::segment(1) == $path){
            return 'active';
        }
    }

    public static function errorRedirect($routeName, $message, $params = []){
        return redirect()->route($routeName, $params)->with('error', $message)->withInput()->send();
    }

    public static function successRedirect($routeName, $message, $params = []){
        return redirect()->route($routeName, $params)->with('success', $message)->send();
    }

    public static function formatCurrency($number = 0, $unit = '', $isSuffixUnit = false, $decimal = 0){
        if ($isSuffixUnit) {
            return number_format($number, $decimal, ',', '.').' '.$unit;
        } else {
            return $unit.' '.number_format($number, $decimal, ',', '.');
        }
    }

    public static function formatDate($date, $full = false){
        if ($date) {
            $dt = Carbon::parse($date);
            if ($full) {
                return self::IndonesianFormatDate($dt->format('d m Y H:i'));
            } else {
                return self::IndonesianFormatDate($dt->format('d m Y'));
            }
        } else {
            return '-';
        }
    }

    public static function IndonesianFormatDate($date)
    {
        $month = [
            1 => 'Januari',
            2 => 'Februari',
            3 => 'Maret',
            4 => 'April',
            5 => 'Mei',
            6 => 'Juni',
            7 => 'Juli',
            8 => 'Agustus',
            9 => 'September',
            10 => 'Oktober',
            11 => 'November',
            12 => 'Desember',
        ];
        $explode = explode(' ', $date);
        if (count($explode) === 4) {
            return $explode[0].' '.$month[(int)$explode[1]].' '.$explode[2].' '.$explode[3] ;
        }
        return $explode[0].' '.$month[(int)$explode[1]].' '.$explode[2] ;
    }
}
