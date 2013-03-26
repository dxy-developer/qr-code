<?php
// vim: set et sw=4 ts=4 sts=4 ft=php fdm=marker ff=unix fenc=utf8 nobomb:
/**
 * @author mingcheng<lucky#gracecode.com>
 * @date   2013-03-21
 */

require_once __DIR__.'/libs/qrlib.php';
require_once __DIR__.'/common.inc.php';

$ERRORS = array(
    "NOT_DXY_URL" => array(
        "id" => -2, "message" => "Sorry, Its not DXY's url."
    ),

    "NOT_WRITABLE" => array(
        "id" => -3, "message" => "Sorry, Cache directory not writable."
    )
);

$url = getRequestParam("url", null, "get");
if (!isDXYUrl($url)) {
    raiseErros($ERRORS["NOT_DXY_URL"]["message"], $ERRORS["NOT_DXY_URL"]["id"]);
}

$format = getRequestParam("format", "png", "get");
$size   = getRequestParam("size",   "5",   "get"); // 27px
$margin = getRequestParam("margin", "1",   "get");
$level  = getRequestParam("level",  "l",   "get");

switch(strtolower($level)) {
    case 'l':
        $level = QR_ECLEVEL_L;
     break;

    case 'm':
        $level = QR_ECLEVEL_M;
     break;

    case 'q':
        $level = QR_ECLEVEL_Q;
     break;

    case 'h':
        $level = QR_ECLEVEL_H;
     break;

    default: 
        $level = QR_ECLEVEL_L;
}

switch($format) {
    case 'text': 
        $data = QRcode::text($url, false, $level, $size, $margin);
        header("Content-type:text/plain");
        foreach($data as $d) {
            echo $d."\n";
        }
        break;

    default:
        header("Content-type:image/png");
        QRcode::png($url, false, $level, $size, $margin);
}

