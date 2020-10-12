<?php

class ControllerManager
{
    public function render($view, $data)
    {
        ob_start();
        extract($data);
        include($view . '.php');
        $content = ob_get_clean();
        include('template.php');
    }

    public function isPostMethod()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            return true;
        }
        return false;
    }
}