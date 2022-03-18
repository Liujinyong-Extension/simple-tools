<?php
    /**
     * Created by PhpStorm
     * @package L
     * User: Brahma
     * Date: 2022/3/18
     * Time: 4:36 下午
     */

    namespace Liujinyong\SimpleTools\Lib;


    trait Library
    {

        /**
         * @param        $url
         * @param array  $params
         * @param string $method
         * @param array  $options
         *
         * @return array
         *
         * author Brahma
         */
        public static function sendRequest($url, $params = [], $method = 'POST', $options = [])
        {
            $method = strtoupper($method);
            $protocol = substr($url, 0, 5);
            $query_string = is_array($params) ? http_build_query($params) : $params;

            $ch = curl_init();
            $defaults = [];
            if ('GET' == $method) {
                $geturl = $query_string ? $url . (stripos($url, "?") !== false ? "&" : "?") . $query_string : $url;
                $defaults[CURLOPT_URL] = $geturl;
            } else {
                $defaults[CURLOPT_URL] = $url;
                if ($method == 'POST') {
                    $defaults[CURLOPT_POST] = 1;
                } else {
                    $defaults[CURLOPT_CUSTOMREQUEST] = $method;
                }
                $defaults[CURLOPT_POSTFIELDS] = $params;
            }

            $defaults[CURLOPT_HEADER] = false;
            $defaults[CURLOPT_USERAGENT] = "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/45.0.2454.98 Safari/537.36";
            $defaults[CURLOPT_FOLLOWLOCATION] = true;
            $defaults[CURLOPT_RETURNTRANSFER] = true;
            $defaults[CURLOPT_CONNECTTIMEOUT] = 3;
            $defaults[CURLOPT_TIMEOUT] = 3;

            // disable 100-continue
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

            if ('https' == $protocol) {
                $defaults[CURLOPT_SSL_VERIFYPEER] = false;
                $defaults[CURLOPT_SSL_VERIFYHOST] = false;
            }

            curl_setopt_array($ch, (array)$options + $defaults);

            $ret = curl_exec($ch);
            $err = curl_error($ch);

            if (false === $ret || !empty($err)) {
                $errno = curl_errno($ch);
                $info = curl_getinfo($ch);
                curl_close($ch);
                return [
                    'ret'   => false,
                    'errno' => $errno,
                    'msg'   => $err,
                    'info'  => $info,
                ];
            }
            curl_close($ch);
            return [
                'ret' => true,
                'msg' => $ret,
            ];
        }
    }