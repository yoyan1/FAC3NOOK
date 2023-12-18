<?php

function getTimeLapse($timestamp){
    date_default_timezone_set('Asia/Manila');

    $currentTime = time();
    $timestamp = strtotime($timestamp);
    $diff = $currentTime - $timestamp;
    $isPast = ($diff >= 0);
    $diff = abs($diff);

    if($diff < 60){
        return $isPast ? $diff ."s ago" : "in " . $diff . "s";
    }else if($diff < 3600){
        $minutes = floor($diff / 60);
        return $isPast ? $minutes ."m ago" : "in " . $minutes . "m";
    }else if($diff < 86400){
        $hours = floor($diff / 3600);
        return $isPast ? $hours ."h ago" : "in " . $hours . "h";
    }else if ($diff < 2592000) {
        $days = floor($diff / 86400);
        return $isPast ? $days ."d ago" : "in " . $days . "d";
    }else if($diff < 31104000){
        $months = floor($diff / 2592000);
        return $isPast ? $months ."months ago " : "in " . $days . "months";
    }else{
        $year = floor($diff / 31104000);
        return $isPast ? $year ."yr ago" : "in " . $year . "yr";
    }
}