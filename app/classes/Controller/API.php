<?php

namespace Starch\Controller;

class API extends \Starch\Core\APIController
{
    public function action_main($request) {
        $this->response = array('request' => $request);
    }
}