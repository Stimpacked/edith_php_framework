<?php
/**
 * This is Edith, a PHP framework built on the principles of MVC.
 *
 * @Author Stefan Sjönnebring <stefansjonnebring@hotmail.com>
 *
 */

spl_autoload_register(function ($class) {
    require_once('lib/' . $class . '.php');
});


$boot = new Bootstrap();

?> 