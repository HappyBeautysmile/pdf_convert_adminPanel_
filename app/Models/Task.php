<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = ['task_name', 'task_ticket', 'start_date', 'end_date', 'status', 'author','folder_dir'];
    public $timestamps = false;
}
