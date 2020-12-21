<?php
function show_status($done, $total, $size=30) {
    static $start_time;
    // if we go over our bound, just ignore it
    if($done > $total) return;
    if(empty($start_time)) $start_time=time();
    $now = time();
    $perc=(double)($done/$total);
    $bar=floor($perc*$size);
    $status_bar="\r[";
    $status_bar.=str_repeat("■", $bar);
    if($bar<$size){
        $status_bar.=" ";
        $status_bar.=str_repeat(" ", $size-$bar);
    } else {
        $status_bar.="■";
    }
        $disp=number_format($perc*100, 0);
    $status_bar.="] $disp%  $done/$total";
    $rate = ($now-$start_time)/$done;
    $left = $total - $done;
    $eta = round($rate * $left, 2);
    $elapsed = $now - $start_time;
    $status_bar.= " осталось: ".number_format($eta)." сек.  прошло: ".number_format($elapsed)." сек.";
    echo "$status_bar  ";
    flush();
    if($done == $total) {
        echo PHP_EOL;
    }
}

function clear()
{
    for ($i = 0; $i < 50; $i++) echo "\r\n";
}

function formatSize($bytes) {

    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' ГБ';
    }

    elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' МБ';
    }

    elseif ($bytes >= 1024) {
        $bytes = number_format($bytes / 1024, 2) . ' КБ';
    }

    elseif ($bytes > 1) {
        $bytes = $bytes . ' байт';
    }

    elseif ($bytes == 1) {
        $bytes = $bytes . ' байт';
    }

    else {
        $bytes = '0 байт';
    }

    return $bytes;
}