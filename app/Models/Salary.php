<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'employee_id', 'amount', 'salary_date', 'salary_month', 'salary_year'
    ];

    /**
     * This Model relationship with employee Model.
     *
     * @function belongsTo
     */

    function get_employee() {

        return $this->belongsTo('App\Models\Employee', 'employee_id');

    }
}
