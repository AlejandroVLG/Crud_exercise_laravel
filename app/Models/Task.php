<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    //Estas dos variables habria que ponerlas en caso de que el 
    //nombre de la tabla no estuviera hecho por convencion, 
    //task viene de la tabla tasks, pero si en vez de tasks esa tabla
    //se llamara tasks_done, ya no valdria 

    //protected $table = 'tasks';
    //protected $primaryKey = 'id';

    protected $fillable = ['title', 'status', 'user_id'];
}
