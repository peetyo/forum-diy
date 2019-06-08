<?php
// Used when the submitted login password doesn't match the username.
class WrongPass {

    public static function save_attempt($username){
        $ipAddress = self::get_ip_address();
        $ipLocation = self::get_ip_location($ipAddress);

        $model = new Model;

        try {
            $sQuery = $model->db->prepare('INSERT INTO failed_login 
            VALUES(null, :username, null , :ip, :location)');
            $sQuery->bindValue(':username', $username);
            $sQuery->bindValue(':ip', $ipAddress);
            $sQuery->bindValue(':location', $ipLocation);
            $sQuery->execute();

            if (!$sQuery->rowCount()) {
                echo '{"status":"0","message":"attempt not saved"}';
                exit;
            }

            self::count_attempts($username);
        } catch (PDOException $error) {
            // LogSaver::save_the_log($error, 'users.txt');
            echo '{"status":"0","message":"attempt not saved"}';
            exit;
        }
    }

    public static function count_attempts($username){
        $model = new Model;
        try {
            $sQuery = $model->db->prepare('SELECT COUNT(username) AS failed_attempts
            FROM failed_login WHERE username = :username;');
            $sQuery->bindValue(':username', $username);
            $sQuery->execute();
            $result = $sQuery->fetch();
            if($result['failed_attempts']>4){
               self::deactivate_user($username);
            }else{
                echo '{"status":"0","message":"Wrong user name or password"}';
            }

        } catch (PDOException $error) {
            // LogSaver::save_the_log($error, 'users.txt');
            echo '{"status":"0","message":"Internal server error"}';
            exit;
        }
    }

    public static function deactivate_user($username){
        $model = new Model;
        try{
            $sQuery = $model->db->prepare('UPDATE users SET active = 0 WHERE username = :username;');
            $sQuery->bindValue(':username', $username);
            $sQuery->execute();
            if(!$sQuery->rowCount()){
                echo '{"status":"0","message":"User was not deactivated "';
                    exit;
                }
                echo '{"status":"0","message":"User was deactivated "}';
        }catch(PDOException $e){
            echo '{"status":"0","message":"Something went wrong, please contact the support"}';
            // LogSaver::save_the_log($e, '???.txt');
        }
    }
    // source: https://stackoverflow.com/questions/13646690/how-to-get-real-ip-from-visitor
    public static function get_ip_address(){
        if( array_key_exists('HTTP_X_FORWARDED_FOR', $_SERVER) && !empty($_SERVER['HTTP_X_FORWARDED_FOR']) ) {
            if (strpos($_SERVER['HTTP_X_FORWARDED_FOR'], ',')>0) {
                $addr = explode(",",$_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($addr[0]);
            } else {
                return $_SERVER['HTTP_X_FORWARDED_FOR'];
            }
        }
        else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
    // source: https://stackoverflow.com/questions/409999/getting-the-location-from-an-ip-address
    public static function get_ip_location($ip){
        // TODO: get rid of placeholder, Peter: localhost ip is ::1 and doesnt return any location I added an ip here for testing
        $ip = '195.249.188.115';
        $details = json_decode(file_get_contents("http://ipinfo.io/{$ip}/json"));

        return $details->city.', '.$details->country;
    }
}