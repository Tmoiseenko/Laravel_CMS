<?php

namespace App;


use App\Traits\FlushTagCache;

class Model extends \Illuminate\Database\Eloquent\Model
{
    use FlushTagCache;

    public $guarded = [];
}
