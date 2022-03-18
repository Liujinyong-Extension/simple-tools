<?php
    /**
     * Created by PhpStorm
     * @package Liujinyong\SimpleTools
     * User: Brahma
     * Date: 2022/3/18
     * Time: 4:17 下午
     */

    namespace Liujinyong\SimpleTools;


    use Liujinyong\SimpleTools\Exception\MethodInvalidateException;
    use Liujinyong\SimpleTools\Exception\ParamInvalidateException;
    use Liujinyong\SimpleTools\Exception\UrlInvalidateException;
    use Liujinyong\SimpleTools\Lib\Library;

    class Tools
    {

        use Library;


        /**
         * @param string $method  请求方式
         * @param string $url     请求地址
         * @param array  $params  参数
         * @param array  $options 设置
         *
         * @return mixed|string
         *  简单http请求
         * author Brahma
         */
        public static function httpClient($method = "get", $url = "", $params = [], $options = [])
        {
            if ($url == "" || empty($url)) {
                throw new UrlInvalidateException("url不能为空");
            }
            if (strtolower($method) == "get") {
                $req = self::sendRequest($url, $params, 'GET', $options);
            } elseif (strtolower($method) == "post") {
                $req = self::sendRequest($url, $params, 'POST', $options);
            } else {
                throw new MethodInvalidateException("请求方式错误");
            }

            return $req['ret'] ? $req['msg'] : '';

        }

        /**
         * @param array $data  初始数据
         * @param int   $page  页码
         * @param int   $limit 偏移量
         *
         * @return array|mixed
         *  简单分页
         * author Brahma
         * @throws \Liujinyong\SimpleTools\Exception\ParamInvalidateException
         */
        public static function page($data = [], $page = 1, $limit = 10)
        {
            if (empty($data)) {
                throw new ParamInvalidateException("原始数据不能为空");
            }
            if (!is_numeric($page) || !is_numeric($limit)) {
                throw new ParamInvalidateException("页码或偏移量类型错误");
            }

            return array_slice($data, ($page - 1) * $limit, $limit);
        }

        /**
         * @param string $birthday 生日
         *
         * @return int|mixed|string
         *  获取年龄
         * author Brahma
         */
        public static function getAge($birthday="")
        {

            $date = date("Y-m-d");
            list($y, $m, $d) = explode("-", $birthday);
            list($xy, $xm, $xd) = explode("-", $date);
            $age = $xy - $y;
            if ($xm > $m || $xm == $m && $xd > $d) {
                $age = $age + 1;
            }
            return $age;
        }

    }