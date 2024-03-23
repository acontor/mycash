<?php

function breadcrumbs($category, $name)
{
    if (!$category->parent_id) {
        return $name;
    }
    $parent = $category->parent;
    $name = $parent->name . ' &raquo; ' . $name;
    return breadcrumbs($parent, $name);
}

