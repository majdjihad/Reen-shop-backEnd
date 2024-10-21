<?php
    function get_session_success($name_session,$content) {
        $_SESSION[$name_session] = '
        <div class="alert alert-success w-auto position-fixed me-3 bottom-0 end-0 zindex-tooltip" role="alert">
            '.$content.'
        </div>';
        return $_SESSION[$name_session];
    }
    function get_session_danger($name_session,$content) {
        $_SESSION[$name_session] = '
        <div class="alert alert-danger w-auto position-fixed me-3 bottom-0 end-0 zindex-tooltip" role="alert">
            '.$content.'
        </div>';
        return $_SESSION[$name_session];
    }
?>