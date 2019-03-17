<?php

namespace Caaqil\Models;

use Illuminate\Database\Eloquent\Model;


class Post extends Model {

    protected $table = 'post';

    // protected $fillable = [
    //     'email',
    //     'name',
    //     'password'
    // ];

    // public function setPassword($password) {
    //     $this->update([
    //         'password' => password_hash($password , PASSWORD_DEFAULT)
    //     ]);
    // }
}
