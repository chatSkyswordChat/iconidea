<?php
    if (class_exists('SitePress')) {
        Lusion_WPML::show_language_dropdown();
    }else{
        Lusion_WPML::show_language_dropdown_demo();
    }
