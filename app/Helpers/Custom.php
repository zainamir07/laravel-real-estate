<?php 

namespace App\Helpers;
use App\Models\User;
use App\Models\Category;

class Custom{
    public static function userName($user_id){
       $user = User::find($user_id);
       if($user_id == 1){
         return 'Admin';
       }else{
          return $user->name;
       }
    }

    public static function categoryName($cate_id){
        $cate = Category::find($cate_id);
        return $cate->category_name;
     }

      public static function oldPassword($password){
         $user_id = session()->get('user_id');
         $user = User::find($user_id);
         $oldPassword = $user->password;
         if(md5($password) == $oldPassword){
            return true;
         }else{
            return "Password Does Not Match";
         }
     }
}





