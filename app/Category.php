<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'categories';
    protected $softDelete = true;
    protected $fillable = ['name','status'];
}
