<?php

namespace Starch\Controller;
use Starch\Core\View;

class Page extends Template
{
    public function before()
    {
        parent::before();
        $this->template->set('id', 'page');
    }

    /**
     * Called if front page is set to a page
     * @return void
     */
    public function action_index()
    {
        $this->template->set('id', 'home');
        $this->content->set(View::render('main/index', array('post' => $this->post)));
    }

    /**
     * Called on a single page
     * @return void
     */
    public function action_single()
    {
        $this->template->set('title', $this->post->title . ' &raquo; ' . $this->template->get('title'));
        $this->content->set(View::render('page/single', array('post' => $this->post)));
    }
}