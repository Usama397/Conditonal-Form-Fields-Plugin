<?php
/*
Plugin Name: Harry's Foo Plugin
Description: This is a custom WordPress plugin created by Harry for demonstration.
Version: 1.0
Author: Harry
*/

// Check if we are in the WordPress environment
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

// Activation hook
register_activation_hook(__FILE__, 'harry_fo_activate');

function harry_fo_activate() {
    // Code to run when the plugin is activated
}

function harry_fo_display_select_box() {
    ob_start(); // Start output buffering

    // Display the first select box
    ?>
    <div class="container">
        <div class="row">
        <div id="output"></div>
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select">TYPE:</label>
                <select class="form-control" name="harry_fo_select" id="harry_fo_select">
                    <option value="0">Select Type</option>
                    <option value="1">Car</option>
                </select>
                </div>
            </div>
           
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select_2" id="harry_fo_select_2_label" style="display: block;">MAKE:</label>
                <select class="form-control" name="harry_fo_select_2" id="harry_fo_select_2" style="display: block;">
                    <!-- Options will be populated via JavaScript -->
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select_2" id="harry_fo_select_3_label" style="display: block;">MODEL:</label>
                <select class="form-control" name="harry_fo_select_3" id="harry_fo_select_3" style="display: block;">
                    <!-- Options will be populated via JavaScript -->
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select_4" id="harry_fo_select_4_label" style="display: block;">GENERATION:</label>
                <select class="form-control" name="harry_fo_select_4" id="harry_fo_select_4" style="display: block;">
                    <!-- Options will be populated via JavaScript -->
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select_6" id="harry_fo_select_4_label" style="display: block;">YEAR:</label>
                <select class="form-control" name="harry_fo_select_6" id="harry_fo_select_6" style="display: block;">
                    <!-- Options will be populated via JavaScript -->
                </select>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="form-group">
                <label for="harry_fo_select_5" id="harry_fo_select_5_label" style="display: block;">TRIM:</label>
                <select class="form-control" name="harry_fo_select_5" id="harry_fo_select_5" style="display: block;">
                    <!-- Options will be populated via JavaScript -->
                </select>
                </div>
            </div>
        </div>
    </div>
   
   
    <?php

    // Display the second select box (initially hidden)
    ?>
    
    <?php

    return ob_get_clean(); // Return the select boxes content
}

// Add the select box to a post or page using a shortcode
add_shortcode('harry_fo_select_box', 'harry_fo_display_select_box');



function harry_fo_enqueue_scripts() {
    
    wp_enqueue_style('harry-fo-bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');

    wp_enqueue_script('harry-fo-papa', 'https://cdnjs.cloudflare.com/ajax/libs/PapaParse/5.3.0/papaparse.min.js', array('jquery'), '1.0', true);
   
    wp_enqueue_script('harry-fo-script', plugin_dir_url(__FILE__) . 'harry-fo-script.js', array('jquery'), '1.0', true);
    wp_localize_script('harry-fo-script', 'harry_fo_ajax', array('ajax_url' => admin_url('admin-ajax.php')));
}
add_action('wp_enqueue_scripts', 'harry_fo_enqueue_scripts');


add_action('wp_ajax_harry_fo_get_api_response', 'harry_fo_get_api_response');
add_action('wp_ajax_nopriv_harry_fo_get_api_response', 'harry_fo_get_api_response');

function harry_fo_get_api_response() {
    $jsonData = file_get_contents(plugin_dir_path(__FILE__).'car_make.json');
    if ($jsonData === false) {
        die('Failed to read the JSON file.');
    }
    // Parse the JSON data
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Failed to parse JSON data.');
    }
    
    $options = array();
    foreach ($data as $item) {
        $options[] = array(
            'id' => $item['id_car_make'],
            'name' => $item['name']
        );
    }
    $optionsJson = json_encode($options);
    echo $optionsJson;

    wp_die();
}

add_action('wp_ajax_harry_fo_get_api_response_genration', 'harry_fo_get_api_response_genration');
add_action('wp_ajax_nopriv_harry_fo_get_api_response_genration', 'harry_fo_get_api_response_genration');


function harry_fo_get_api_response_genration() {
    $serach_model =  $_GET['model'];
    $jsonData = file_get_contents(plugin_dir_path(__FILE__).'car_model.json');
    if ($jsonData === false) {
        die('Failed to read the JSON file.');
    }
    // Parse the JSON data
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Failed to parse JSON data.');
    }
    
    $options = array();
    foreach ($data as $item) {
        if($item['id_car_make'] == $serach_model){
            $options[] = array(
                'id' => $item['id_car_model'],
                'name' => $item['name']
            );
        }
    }
    $optionsJson = json_encode($options);
    echo $optionsJson ;

    wp_die();
}


add_action('wp_ajax_harry_fo_get_api_response_trim', 'harry_fo_get_api_response_trim');
add_action('wp_ajax_nopriv_harry_fo_get_api_response_trim', 'harry_fo_get_api_response_trim');



function harry_fo_get_api_response_trim() {
   
    
    $serach_generation =  $_GET['generation'];
    $jsonData = file_get_contents(plugin_dir_path(__FILE__).'car_generation.json');
    if ($jsonData === false) {
        die('Failed to read the JSON file.');
    }
    // Parse the JSON data
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Failed to parse JSON data.');
    }
    
    $options = array();
    foreach ($data as $item) {
        if($item['id_car_model'] == $serach_generation){
            $options[] = array(
                'id' => $item['id_car_model'],
                'name' => $item['name']
            );
        }
    }
    $optionsJson = json_encode($options);
    echo $optionsJson ;

    wp_die();
}


add_action('wp_ajax_harry_fo_get_api_response_trim_2', 'harry_fo_get_api_response_trim_2');
add_action('wp_ajax_nopriv_harry_fo_get_api_response_trim_2', 'harry_fo_get_api_response_trim_2');



function harry_fo_get_api_response_trim_2() {
   
    
    $serach_generation =  $_GET['trim'];
    $jsonData = file_get_contents(plugin_dir_path(__FILE__).'csvjson.json');
    if ($jsonData === false) {
        die('Failed to read the JSON file.');
    }
    // Parse the JSON data
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Failed to parse JSON data.');
    }
    
    $options = array();
    foreach ($data as $item) {
        if($item['id_car_model'] == $serach_generation){
            $options[] = array(
                'id' => $item['id_car_model'],
                'name' => $item['name']
            );
        }
    }
    $optionsJson = json_encode($options);
    echo $optionsJson ;

    wp_die();
}


add_action('wp_ajax_harry_fo_get_api_response_year', 'harry_fo_get_api_response_year');
add_action('wp_ajax_nopriv_harry_fo_get_api_response_year', 'harry_fo_get_api_response_year');



function harry_fo_get_api_response_year() {
   
    
    $serach_generation =  $_GET['trim'];
    $jsonData = file_get_contents(plugin_dir_path(__FILE__).'year.json');
    if ($jsonData === false) {
        die('Failed to read the JSON file.');
    }
    // Parse the JSON data
    $data = json_decode($jsonData, true);
    if ($data === null) {
        die('Failed to parse JSON data.');
    }
    
    $options = array();
    foreach ($data as $item) {
        if($item['id_car_model'] == $serach_generation){
            $options[] = array(
                'id' => $item['year'],
                'name' => $item['year']
            );
        }
    }
    $optionsJson = json_encode($options);
    echo $optionsJson ;

    wp_die();
}