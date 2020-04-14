<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Priority extends Model
{
    use Sortable;
    use SoftDeletes;
    
    protected $table = 'priorities';
    protected $softDelete = true;
    protected $fillable = ['name', 'time', 'status'];
}
