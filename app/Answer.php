<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $keyType ='string';

    public $timestamps = true;
    protected $fillable = [
        'id', 'answer', 'is_correct'
     ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
     protected $casts = [
        'question_id'=>'bigint',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'created_by' => 'string',
        'updated_by' => 'string'
     ];
}
