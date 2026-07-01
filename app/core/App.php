<?php
class App {
    public function __construct() {
        $url = $_GET['url'] ?? 'home/index';
        $arr = explode('/', trim($url, '/'));

        $controller = ucfirst($arr[0]) . "Controller";
        $method = $arr[1] ?? 'index';
        $params = array_slice($arr, 2);

        require_once "../app/controllers/$controller.php";
        $obj = new $controller();

        call_user_func_array([$obj, $method], $params);
    }
}

?>
