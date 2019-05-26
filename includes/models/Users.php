<?php
// for testing this class we need to include the Model.php
// require_once 'Model.php';
class Users extends Model
{
    public function read_users()
    {
        try {
            $sQuery = $this->db->prepare('SELECT * FROM users');
            $sQuery->execute();
            $users = $sQuery->fetchAll();
            if (count($users)) {
                echo print_r($users);
                exit;
            }
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'users.txt');
        }
    }

    //prepared insert stament, which is used in sign_up controller
    public function sign_up_user($username, $hashed_pass, $email)
    {
        try {
            $checkUserQuery = $this->db->prepare('SELECT username, email FROM users WHERE email = :email OR username = :username');
            $checkUserQuery->bindValue(':email', $email);
            $checkUserQuery->bindValue(':username', $username);
            $checkUserQuery->execute();
            // check if the user exists in the dabase
            if (!empty($checkUserQuery->fetch())) {
                // return false to the controllers
                // return false;
                //PETER: the response here is sent to AJAX and AJAX expects a JSON
                // These 2 have to be separated to show something meaningful to the user
                // we gotta tell them if the email is already in use of if the username is already in use
                // specifically.
                echo '{"status":"0","message":"Duplicating username or email"}';
                exit;
            }
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'users.txt');
        }

        try {
            $sQuery = $this->db->prepare('INSERT INTO users
         VALUES(null, :userName, :hashed_password, :email, :date_created, :user_role, :active )');
            $sQuery->bindValue(':userName', $username);
            $sQuery->bindValue(':hashed_password', $hashed_pass);
            $sQuery->bindValue(':email', $email);
            $sQuery->bindValue(':date_created', date('Y/m/d H:i:s'));
            $sQuery->bindValue(':user_role', 4);
            $sQuery->bindValue(':active', 0);
            $sQuery->execute();
            if ($sQuery->rowCount()) {
                echo '{"status":"1", "message":"User created"}';
                exit;
            }
            echo '{"status":"0","message":"User was not created"}';
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'users.txt');
        }
    }

    // :MORTIMUS the results of function  will be used to check if the username exist or not
    // the function takes the username from table
    public function select_username($username)
    {
        try {
            $sQuery = $this->db->prepare('SELECT username from users WHERE username = :usersname');
            $sQuery->bindValue(':usersname', $username);
            $sQuery->execute();
            $aUser = $sQuery->fetchAll();

            return $aUser;
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'users.txt');
        }
    }

    public function select_username_and_password($username)
    {
        try {
            $sQuery = $this->db->prepare('SELECT id,username,password_hashed,email  from users WHERE username = :usersname');
            $sQuery->bindValue(':usersname', $username);
            $sQuery->execute();
            $aUser = $sQuery->fetchAll();

            return $aUser;
        } catch (PDOException $error) {
            LogSaver::save_the_log($error, 'users.txt');
        }
    }
}
// for testing
// $modeltest = new Users;
// $modeltest->read_users();
