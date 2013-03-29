<?php
// vim: set et sw=4 ts=4 sts=4 fdm=marker ff=unix fenc=utf8 nobomb:
/**
 * 公共函数库
 *
 * @author mingcheng<i.feelinglucky#gmail.com>
 * @date   2011-02-17
 * @link   http://www.gracecode.com/
 */


/**
 * 安全获取 GET/POST 的参数
 *
 * @param  String $request_name
 * @param  Mixed  $default_value
 * @param  String $method 'post', 'get', 'all' default is 'all'
 * @return String
 */
function getRequestParam($request_name, $default_value = null, $method = "all")
{
    $magic_quotes = ini_get("magic_quotes_gpc") ? true : false;
    $method = strtolower($method);

    switch (strtolower($method)) {
    default:
    case "all":
        if (isset($_POST[$request_name])) {
            return $magic_quotes ? stripslashes($_POST[$request_name]) : $_POST[$request_name];
        } else if (isset($_GET[$request_name])) {
            return $magic_quotes ? stripslashes($_GET[$request_name]) : $_GET[$request_name];
        } else {
            return $default_value;
        }
        break;

    case "get":
        if (isset($_GET[$request_name])) {
            return $magic_quotes ? stripslashes($_GET[$request_name]) : $_GET[$request_name];
        } else {
            return $default_value;
        }
        break;

    case "post":
        if (isset($_POST[$request_name])) {
            return $magic_quotes ? stripslashes($_POST[$request_name]) : $_POST[$request_name];
        } else {
            return $default_value;
        }
        break;

    default:
        return $default_value;
        break;
    }
}


/**
 * 判断是否是属于 DXY 的链接
 */
function isDXYUrl($url) {
    $url_array = parse_url($url);
    if (!isset($url_array['host'])) {
        return false;
    }

    $dxy_domains = "dxy.me|dxy.cn|dxy.com|pubmed.cn|pubmed.com|biomart.cn|dxyer.cn";
    $preg_matchers = sprintf("/(%s)$/", str_replace(".", "\.", $dxy_domains));

    return preg_match($preg_matchers, $url_array['host']);
}


/**
 * 错误
 */
function raiseErros($messages, $error_id = -1) {
    $result = array ("error" => $error_id, "message" => $messages);
    die(json_encode($result));
}
