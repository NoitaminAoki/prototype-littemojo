<?php

namespace App\Helpers;
use Illuminate\Support\Str;

class Converter
{
    public static function formatBytes($size, $precision = 2)
    {
        if ($size > 0) {
            $size = (int) $size;
            $base = log($size) / log(1024);
            $suffixes = array(' bytes', ' KB', ' MB', ' GB', ' TB');
            
            return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
        } else {
            return $size;
        }
    }
    
    public static function pageToOffset($page, $limit)
    {
        return ($page - 1) * $limit;
    }
    
    public static function NumberFormattedAttribute($number, $prefix, $start_length = 3, $end_length = 2)
    {
        $length = Str::length($number);
        $prefix_len = ($length-($start_length+$end_length));
        $prefixes = Str::padBoth('', $prefix_len, $prefix);
        return substr($number, 0, $start_length) . $prefixes . substr($number, (-1*$end_length));
    }
    
    public static function maskEmail($email) {
        
        function mask($str, $first, $last) {
            $len = strlen($str);
            $toShow = $first + $last;
            return substr($str, 0, $len <= $toShow ? 0 : $first).str_repeat("*", $len - ($len <= $toShow ? 0 : $toShow)).substr($str, $len - $last, $len <= $toShow ? 0 : $last);
        }
        
        $mail_parts = explode("@", $email);
        
        $mail_parts[0] = mask($mail_parts[0], 3, 2); // show first 3 letters and last 2 letter
        
        return implode("@", $mail_parts);
    }
}