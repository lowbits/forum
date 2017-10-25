<?php
/**
 * Created by PhpStorm.
 * User: Root
 * Date: 09.10.2017
 * Time: 12:07
 */

namespace App\Inspections;
use Exception;

class InvalidKeywords

{
    protected $keywords = [
        'yahoo customer support'

    ];

    public function detect($body)

    {

        foreach ($this->keywords as $keyword){
            if (stripos($body, $keyword) !== false) {
                throw new Exception('Your reply contains spam.');
            }
        }

    }


}
