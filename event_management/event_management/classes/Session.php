<?php
class Session {
    public function start() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function destroy() {
        session_start();
        session_unset();
        session_destroy();
    }

    public function get($key) {
        return $_SESSION[$key] ?? null;
    }

    public function set($key, $value) {
        $_SESSION[$key] = $value;
    }
}
?>
