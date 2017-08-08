<?php
/**
 * Created by PhpStorm.
 * User: Shaikan
 * Date: 8/6/2017
 * Time: 12:26
 */

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ImgFacade extends Facade
{
    protected static function getFacadeAccessor() { return 'Img'; }
}