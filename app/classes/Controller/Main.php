<?php

namespace Starch\Controller;
use Starch\Core\View;
use Starch\Core\Router;

class Main extends Template
{
    /**
     * Setup in routes, on /logout/ url
     * @return void
     */
    public function action_logout()
    {
        wp_logout();

        if (!Router::previous()) {
            Router::redirect('/');
        }
    }

    /**
     * Called when the search page is requested
     * @return void
     */
    public function action_search()
    {
        $this->template->set('id', 'search');

    // Search code here...
    /*
        // The search query
        $query = Input::get('s');

        // Setup a results array
        $results = array();

        // Populate results array...

        // Load in a template
        $this->content->set(View::render('main/search', array('results' => $results)));
    */
    }

    /**
     * Called when no posts are found
     * @return void
     */
    public function action_nothing_found()
    {
        $this->template->set('id', 'not-found');
        $this->content->set(View::render('main/nothing-found'));
    }

    /**
     * Called when a 404 page is requested
     * @return void
     */
    public function action_404()
    {
        $this->template->set('id', 'error-404');
        $this->content->set(View::render('main/404'));
    }

    /**
     * Called when a non-404 error occurs (generally 500 errors)
     * @param Integer $type The error response code
     * @return void
     */
    public function action_error($type)
    {
        $this->template->set('id', 'error-page');
        $this->content->set(View::render('main/error'));
    }
}