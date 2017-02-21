<?php defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('render_icon')) {
  function render_icon($icon_type) {
    return '<i class="fa fa-fw fa-'.$icon_type.'"></i>';
  }
}