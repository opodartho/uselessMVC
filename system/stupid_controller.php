<?php
class StupidController{
    public $view = array();

    public function execute($action){
        $this->$action();
        $this->render($action);
    }

    public function render($action){
        $view = (object) $this->view;
        require_once $this->getView($action);
    }

    public function view($name, $value){
        $this->view[$name] = $value;
    }

    private function getView($action){
        $controller = get_called_class();
        $controller = decamelize($controller);
        return explode("_", $controller)[0] . DS . $action . ".phtml";
    }
}
