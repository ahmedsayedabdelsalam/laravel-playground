<?php


namespace App;

use Exception;
use Illuminate\Database\Eloquent\Model as Eloquent;


class Model extends Eloquent
{
    public function getRelationshipFromMethod($method)
    {
        $class = get_class($this);

        throw new Exception("Lazy-loading relationships is not allowed ($class::$method).");
    }
}
