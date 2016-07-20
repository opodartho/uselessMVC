<?php
class StupidController{
    public function execute($action){
        $this->$action();
        $this->render($action);
    }

    public function render($action){
        require_once $this->getView($action);
    }

    private function getView($action){
        $controller = get_called_class();
        $controller = decamelize($controller);
        return explode("_", $controller)[0] . DS . $action . ".phtml";
    }
}
