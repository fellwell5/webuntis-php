<?php
  /*  WEBUNTIS-PHP
      Matthias SCHAFFER
      @fellwell5
      matthiasschaffer.com
  */
  
  
    class Webuntis{
        private static $server, $school, $user, $pass, $sessionid, $klasseid, $type, $studentid;
        
        private static function id(){
            $id = time().rand();
            $id = md5($id);
            return $id;
        }
        
        private static function request($json){
            if (!function_exists('curl_init')){
                die('Sorry cURL is not installed!');
            }
            
            if(isset(self::$sessionid)){
                $url = "https://".self::$server."/WebUntis/jsonrpc.do;jsessionid=".self::$sessionid."?school=".self::$school;
            }else{
                $url = "https://".self::$server."/WebUntis/jsonrpc.do?school=".self::$school;
            }
            
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $header = array("Content-type: application/json");
            curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $json);

            $json_response = curl_exec($curl);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            curl_close($curl);
            return json_decode($json_response, true);
        }
        
        public static function auth($tserver, $tschool, $tuser, $tpass){
            self::$server = $tserver; self::$school = $tschool; self::$user = $tuser; self::$pass = $tpass;
            
            $json = array(
                "id" => self::id(),
                "method" => "authenticate",
                "params" => array(
                    "user" => self::$user,
                    "password" => self::$pass,
                    "client" => "web"
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            $return = self::request($json);
            
            if(array_key_exists('error', $return)){
                die(json_encode($return["error"]));
            }
            
            self::$sessionid = $return["result"]["sessionId"];
            self::$klasseid = $return["result"]["klasseId"];
            self::$type = $return["result"]["personType"];
            self::$studentid = $return["result"]["personId"];
            
            return $return;
        }
        
        public static function logout(){
            $json = array(
                "id" => self::id(),
                "method" => "logout",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getTimegrid(){
            $json = array(
                "id" => self::id(),
                "method" => "getTimegridUnits",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getTimetable(){
            $json = array(
                "id" => self::id(),
                "method" => "getTimetable",
                "params" => array(
                    "id" => self::$studentid,
                    "type" => self::$type
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getSubjects(){
            $json = array(
                "id" => self::id(),
                "method" => "getSubjects",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getTeachers(){
            $json = array(
                "id" => self::id(),
                "method" => "getTeachers",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getKlassen(){
            $json = array(
                "id" => self::id(),
                "method" => "getKlassen",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
        
        public static function getRooms(){
            $json = array(
                "id" => self::id(),
                "method" => "getRooms",
                "params" => array(
                ),
                "jsonrpc" => "2.0"
            );
            $json = json_encode($json, true);
            return self::request($json);
        }
    }
?>
