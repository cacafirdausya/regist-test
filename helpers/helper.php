<?php

if (!function_exists('toastr')) {
    /**
     * @param $type
     * @param $title
     * @param $message
     * @return void
     */
    function toastr($type, $title, $message = false)
    {
        if (!in_array($type, ['success', 'info', 'warning', 'error'])) {
            $type = 'info';
        }
        $messageData['title'] = $title;
        $messageData['type'] = $type;
        if ($message) {
            $messageData['message'] = $message;
        }
        session()->flash('toastr', $messageData);
    }
}
