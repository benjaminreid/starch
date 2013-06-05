<?php

namespace Starch\Controller;
use Starch\Core;
use Starch\Core\View;

class Post extends Template
{
    public function before()
    {
        parent::before();
        $this->template->set('id', 'post');
    }

    public function action_single()
    {
        $this->template->set('title', $this->post->title . ' &raquo; ' . $this->template->get('title'));
        $this->content->set(View::render('post/single', array('post' => $this->post)));
    }

    public function action_archive()
    {
        $this->template->set('title', 'Posts &raquo; ' . $this->template->get('title'));

        $content = new Core\Content();

        $this->loop(function ($post) use ($content) {
            $content->append(View::render('post/archive-part', array('post' => $post)));
        });

        $this->content->set($content);
    }
}