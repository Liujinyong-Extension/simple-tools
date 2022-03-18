<h1 align="center"> simple-tools </h1>

<p align="center"> simple-tools of php.</p>


## Installing

```shell
$ composer require liujinyong/simple-tools 
```

## 使用

```php
<?php
    require __DIR__.'/vendor/autoload.php';
    
    $data = \Liujinyong\SimpleTools\Tools::httpClient("get","www.baidu.com");
    echo $data;
    
    $data = array(
        array( 'clicks' => 1, 'clickDate' =>'2015-10-11' ),
        array( 'clicks' => 2, 'clickDate' =>'2015-10-11' ),
        array( 'clicks' => 3, 'clickDate' =>'2015-10-09' ),
        array( 'clicks' => 4, 'clickDate' =>'2015-10-08' ),
    );
    $data = \Liujinyong\SimpleTools\Tools::page($data,3,2);
    print_r( $data);


     $data = \Liujinyong\SimpleTools\Tools::getAge("1999-02-01");
     echo $data;

```



## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/liujinyong/simple-tools/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/liujinyong/simple-tools/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT