<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 09.10.2017
 * Time: 12:07
 */

namespace App\Inspections;
use Exception;

class KeyHeldDown

{


    public function detect($body)

    {

        if (preg_match('/(.)\\1{4,}/', $body)){
            throw new Exception('Your reply contains spam.');
        }

    }


}
