<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Question extends Model
{
     /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';
    protected $keyType ='string';
    use SoftDeletes;

    public function answer(){
        return $this->hasMany('App\Answer');
    }
    use Notifiable;
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

    protected $fillable = [
       'id', 'question', 'type','subject'
    ];

   /**
    * The attributes that should be cast to native types.
    *
    * @var array
    */
    protected $casts = [
       'created_at' => 'datetime',
       'updated_at' => 'datetime',
       'created_by' => 'string',
       'updated_by' => 'string'
    ];
}
