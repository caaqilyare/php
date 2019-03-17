<?php

namespace Caaqil\Models;

use Illuminate\Database\Eloquent\Model;


class Cat extends Model {

    protected $table = 'cat';

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
