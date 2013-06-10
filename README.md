# Starch (for WordPress)
**v1.0.3**

Starch is an empty WordPress theme with an MVC style underpinning. Using it you can rapidly develop maintainable WordPress sites of high complexity.

- **Routing**: Starch handles routing for you, sending requests to the appropriate controller
- **Models**: Starch lets you easily interact with posts and custom post types using an ORM style system
- **Custom Post Types**: Set up and interact with complex custom post types in a few minutes
- **Templates**: Starch makes using (and reusing) templates easy - you can even use templating engines like Smarty or Mustache
- **Composer Support**: Starch supports the [Composer](http://getcomposer.org) dependency management system
- **whoops! Support**: Built in support for [whoops!](http://filp.github.io/whoops/) for easy debugging in development mode

## Why?

WordPress provides an excellent content management system with a great user experience. Furthermore it is widely used, meaning that many people already have experience using it. This combination makes it a great choice for your users.

However, WordPress was originally built long ago, back when PHP had poor support for classes and objects and a procedural style was more common. If you're used to a modern MVC PHP framework, like FuelPHP, this can feel like a bit of a step backwards. Starch provides some wrapper classes and a simple directory structure so that you can create WordPress sites using a fully object oriented approach.

Starch is entirely built on top of WordPress's public API and does not use any hacks, so it should remain compatible as much as any other theme.

## Requirements

Starch requires PHP 5.3 or above. It uses namespaces and closures heavily and these are not supported by earlier versions of PHP. If your hosting does not support PHP 5.3 or above then you should consider changing host (PHP 5.3 is four years old now).

Starch does not use any features of PHP 5.4, but if your development and production servers support this there is no reason not to use these.

You also need to be running WordPress 3.0 or above. As you are likely using this for new builds this shouldn't be an issue.

Starch has been tested on PHP 5.3.14 and WordPress 3.5.1.

## Performance

Starch adds very little overhead to your WordPress installation. However, you should always run WordPress with some sort of caching mechanism. Both **W3 Total Cache** and **WP Super Cache** have been tested with Starch.

## Quick Start

### Installation

The following steps assume you have already got WordPress installed and running.

#### Git (Recommended)

To install go to your `wp-content/themes` directory and use `git clone https://github.com/smallhadroncollider/starch theme-name` (where `theme-name` is the directory name for your theme). Then go into your directory and run `git submodule init && git submodule update` - this will pull in the Core files (these are in a separate repository to make updating Starch easier).

    git clone https://github.com/smallhadroncollider/starch theme-name
    cd theme-name
    git submodule init && git submodule update

#### Old School

Download the latest version from [https://github.com/smallhadroncollider/starch/archive/master.zip](https://github.com/smallhadroncollider/starch/archive/master.zip) and extract into a directory in your `wp-content/themes/` directory. You'll also need to download [https://github.com/smallhadroncollider/starch-core/archive/master.zip](https://github.com/smallhadroncollider/starch-core/archive/master.zip) and extract the contents into `theme-name/app/classes/Core`.

### Customising the Theme

You'll probably want to edit the `style.css` file to change the name, creator, and description of the theme. You will also want to swap the `screenshot.png` file to something appropriate. Finally, you'll probably want to go to `assets/admin/admin.css` and edit the `body.login` styles to remove the Starch theming.

### Settings

Login to Admin and go to the *Appearance -> Themes* and select the new theme. Then go to *Settings -> Permalinks* and make sure **Post Name** is chosen from the *Common Settings* options.

### Adding a Post Type

Go to the `app/config/general.php` file and edit the `post_types` array to add your new post types. For example, if you wanted to add a Event and News post types you would have:

```php
'post_types' => array('Event', 'News')
```

All post types require a matching `Starch\Model` and `Starch\Controller`. Create two files, both called `Event.php`, one in `app/classes/Controller` and one in `app/classes/Model`.

**NB:** Starch uses autoloading to load in classes. As long as you name files correctly and put them in the right location they should load automatically. You should never need to manually `include` or `require` class files.

#### Model

Models let you easily interact with posts and add extra fields. Post type models should always inherit from `Starch\Core\PostType` and at a minimum have a `public static $type` property.

```php
<?php

// Models are declared in the Starch\Model namespace
namespace Starch\Model;
use Starch\Core\PostType;

// All post type models must inherit from Starch\Core\PostType
class Event extends PostType
{
    // For WordPress's internal post type reference
    public static $type = 'events';
}
```

You can also customise the display name, admin fields, and much more in the model class. See the Model documentation for more.

#### Controller

Your Controller is where requests will be routed when someone tries to view your new post type. It will generally have an `action_archive` (called for archive pages, e.g. `/events/`) and an `action_single` (called on individual pages, e.g. `/events/an-event/`) method.

A basic Event controller would look like the following:

```php
<?php

// Controllers are declared in the Starch\Controller namespace
namespace Starch\Controller;
use Starch\Model;
use Starch\Core\View;
use Starch\Core\Content;

// Template can be found in controllers/template.php
class Event extends Template
{
    // Called on a single event page, e.g. /events/an-event
    public function action_single()
    {
        // $this->content is the main area on the template (see views/template.php)
        // Render the post using the views/post/single.php template
        // We pass it $this->post, which is a reference to the post
        $this->content->set(View::render('post/single', array('post' => $this->post)));
    }

    // Call on the events archive page, e.g. /events/
    public function action_archive()
    {
        // Get all the events
        $events = Model\Event::all();
        // Set up a content container
        $content = new Content();

        // Append each event to the content container
        foreach ($events as $event) {
            // Render each $event using the views/post/archive-part.php template
            $content->append(View::render('post/archive-part', array('post' => $event)));
        }

        // Set the content
        $this->content->set($content);
    }
}
```

## Version History

### v1.0.3
- Added `exists()` method to `PostType`
- Changed `$post->slug` to `$post->name`

### v1.0.2
- Changed default log location from `app/log.txt` to `app/starch.log`
- Added `.gitignore` file

### v1.0.1

- Added support for [whoops!](http://filp.github.io/whoops/) (to setup run `composer install` in the `app` directory)
- Fixed a bug in Router::error
- Fixed a bug in PostType::create

## Acknowledgements

This project owes a lot to FuelPHP. None of the code is taken directly from Fuel, but it certainly inspired many of the design decisions. Thanks also to Benjamin Reid (@nouveller) for feedback on earlier versions of Starch.

## License

The MIT License (MIT)

Copyright (c) 2013, Small Hadron Collider

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.