<?php

namespace Aslam\Test\public;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function setFlash($key, $value)
    {
        self::setSession($key, $value);
    }

    public static function getSession($key)
    {
        return $_SESSION[$key] ?? null;
    }

    public static function removeSession($key)
    {
        unset($_SESSION[$key]);
    }

    public static function sessionDestroy()
    {
        $_SESSION = [];
        session_destroy();
    }

    public static function getFlash($key)
    {
        $value = self::getSession($key);
        self::removeSession($key);

        return $value;
    }
}