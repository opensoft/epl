<?php
/*
* This file is part of ProFIT
*
* Copyright (c) 2011 Farheap Solutions (http://www.farheap.com)
*
* The unauthorized use of this code outside the boundaries of
* Farheap Solutions Inc. is prohibited.
*/


/**
 * @author Dmitry Petrov <dmitry.petrov@opensoftdev.ru>
 */
spl_autoload_register(function($class)
{
   if (0 === strpos($class, 'Epl\Tests\\')) {
       $path = __DIR__.'/../tests/'.strtr($class, '\\', '/').'.php';
       if (file_exists($path) && is_readable($path)) {
           require_once $path;

           return true;
       }
   } else if (0 === strpos($class, 'Epl\\')) {
       $path = __DIR__.'/../src/'.($class = strtr($class, '\\', '/')).'.php';
       if (file_exists($path) && is_readable($path)) {
           require_once $path;

           return true;
       }
   }
});

