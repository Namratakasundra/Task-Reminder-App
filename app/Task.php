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
    protected $time = [
        'created_at'
    ];

    public function category()
    {
        return $this->belongsTo('App\Category','category_id');
    }

    public function priority()
    {
        return $this->belongsTo('App\Priority','priority_id');
    }
}
