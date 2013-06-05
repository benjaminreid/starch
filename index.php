<?php

namespace Starch\Core;

try {
    Router::route($post);
} catch (\Exception $e) {
    new Error($e);
}