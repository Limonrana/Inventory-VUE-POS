<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'nid', 'join', 'salary', 'photo', 'status'
    ];

    /**
     * This Model relationship with employee Model.
     *
     * @function belongsTo
     */

    function get_salary() {

        return $this->hasOne('App\Models\Salary', 'employee_id');

    }
}
