<?php

namespace Starch\Controller;

class Attachment extends Template
{
    public function before() {
        parent::before();
        $this->template->set('id', 'attachment');
    }

    public function action_single() {}
    public function action_archive() {}
}