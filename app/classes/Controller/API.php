<?php

namespace Starch\Controller;

class API extends \Starch\Core\APIController
{
    public function action_main() {
        $this->response = array('hello');
    }
}