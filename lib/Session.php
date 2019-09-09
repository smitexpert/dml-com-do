<?php
/**
*Session Class
**/
class Session{

     public static function init(){
       session_start();
     }

     public static function set($key, $val){
        $_SESSION[$key] = $val;
     }

     public static function get($key){
        if (isset($_SESSION[$key])) {
         return $_SESSION[$key];
        } else {
         return false;
        }
     }

     public static function checkSession(){
        self::init();
        if (self::get("login")== false) {
         self::destroy();
         header("Location:login.php");
        }
     }

     public static function checkClientSession(){
        self::init();
        if (self::get("ClientLogin")== false) {
         self::destroy();
         header("Location:login.php");
        }
     }

     public static function checkAgentSession(){
        self::init();
        if (self::get("agent_login")== false) {
         self::destroy();
         header("Location:../client_login.php");
        }
     }

     public static function checkLogin(){
        self::init();
        if (self::get("login")== true) {
         header("Location:dashboard.php");
        }
     }

    public static function destroy(){
      session_destroy();
      header("Location:login.php");
     }

    public static function clientDestroy(){
        self::destroy();
      session_destroy();
      header("Location:../client_login.php");
     }


  }

?>
