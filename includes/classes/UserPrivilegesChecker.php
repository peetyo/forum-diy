<?php


/*
* Privileges proposal:
* role id:
* - 5 - banned user
* - 4 - normal user
* - 2 - moderator
* - 1 - admin
*/

class UserPrivilegesChecker
{
    public static function is_privileged($toCompare){
        /*
         * Check if user har rights to edit the post
         * There are three scenarios
         * 1 - owner of the post can edit the post.
         * 2 - moderator can edt the post (edit info will be appended)
         * 3 - admin can edit the post (edit info will be appended)
         *
         * Therefore we need to get user's information first
         */


        // get the logged in user
        if(isset($_SESSION['User']['id'])){
            $iUserId = (int)$_SESSION['User']['id'];
        } else{
            $iUserId = 0;
        }

        // get their role
        $user = new Users();
        $userRoleId = $user->select_user_role_by_id($iUserId);
        $roleId = $userRoleId['user_role_id'];

        // compare the tole to the user passed
        if (
            ($toCompare != $iUserId) &&
            ($roleId != 2) &&
            ($roleId != 1)
        ) {
            return false;
            die();
        }
        return true;
    }

}