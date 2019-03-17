<?php

namespace Caaqil\Auth;
use Caaqil\Models\User;
class Auth {


        public function iskuday($email , $password) {
            $user = User::where('email' , $email)->first();

            if(!$user) {
                return false;
            }

            if(password_verify($password , $user->password)) {
                $_SESSION['user_id'] = $user->id;
                return true;
            } 
            return false;

        }
        public function check() {
            return isset($_SESSION['user_id']);
        }

        public function user() {
            if (isset($_SESSION['user_id'])) {
                return User::find($_SESSION['user_id']);
              }
        }
        public function kabax() {
           unset($_SESSION['user_id']);
        }
}
