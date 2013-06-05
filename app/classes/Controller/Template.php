<?php

namespace Starch\Controller;
use Starch\Core;
use Starch\Core\View;

class Template extends Core\TemplateController {
    public function before() {
        parent::before();

        $this->template->set('title', get_bloginfo('name'));
        $this->template->set('description', get_bloginfo('description'));
        $this->template->set('charset', get_bloginfo('charset'));
        $this->template->set('copyright', get_bloginfo('name'));
        $this->template->set('id', 'default');
    }
}