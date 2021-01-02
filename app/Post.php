<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    // Table Name
    protected $table = 'posts';
    // Primary Key
    protected $fillable = [
        'title',
        'body',
        'created_at',
        'updated_at',
        'user_id',
        'recipe_image'
    ];
    public $primaryKey = 'id';
    public $timestamps = true;

    // public function user(){
    //     return $this->belongsTo('App\User');
    // }

    public function user(){
            return $this->belongsTo(User::class);
    }


}
