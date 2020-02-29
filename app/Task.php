<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use Sortable;
    use SoftDeletes;

    protected $table = 'tasks';
    protected $softDelete = true;
    protected $fillable = ['details', 'category_id', 'priority_id', 'status'];
}
