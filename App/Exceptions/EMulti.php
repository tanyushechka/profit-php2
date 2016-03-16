<?php

namespace App\Exceptions;

use App\Classes\TCollection;

class EMulti
    extends \Exception
    implements \ArrayAccess, \Iterator
{
    use TCollection;
}