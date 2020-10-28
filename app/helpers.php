<?php
if (!function_exists('flash')) {
    function flash($message, $message_type = 'success') {
        session()->flash('message', $message);
        session()->flash('message_type', $message_type);
    }
}
