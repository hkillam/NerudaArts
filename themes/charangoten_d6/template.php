<?php
// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to charangoten_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: charangoten_breadcrumb()
 *
 *   where charangoten is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('charangoten_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
function charangoten_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function charangoten_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function charangoten_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function charangoten_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function charangoten_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */

 function charangoten_preprocess_ddblock_cycle_block_content(&$vars) {
  if ($vars['output_type'] == 'view_fields') {
    $content = array();
    // Add slider_items for the template 
    // If you use the devel module uncomment the following line to see the theme variables
    // dsm($vars['settings']['view_name']);  
    // dsm($vars['content'][0]);
    // If you don't use the devel module uncomment the following line to see the theme variables
    // drupal_set_message('<pre>' . var_export($vars['settings']['view_name'], true) . '</pre>');
    // drupal_set_message('<pre>' . var_export($vars['content'][0], true) . '</pre>');
    if ($vars['settings']['view_name'] == 'events_slideshow_c10') {
      if (!empty($vars['content'])) {
        foreach ($vars['content'] as $key1 => $result) {
          // add slide_image variable 
          if (isset($result->node_data_field_slideshow_image_field_slideshow_image_fid)) {
            // get image id
            $fid = $result->node_data_field_slideshow_image_field_slideshow_image_fid;
            // get path to image
            $filepath = db_result(db_query("SELECT filepath FROM {files} WHERE fid = %d", $fid));
            //  use imagecache (imagecache, preset_name, file_path, alt, title, array of attributes)
            if (module_exists('imagecache') && is_array(imagecache_presets()) && $vars['imgcache_slide'] <> '<none>'){
              $slider_items[$key1]['slide_image'] = 
              theme('imagecache', 
                    $vars['imgcache_slide'], 
                    $filepath,
                    check_plain($result->node_title));
            }
            else {          
              $slider_items[$key1]['slide_image'] = 
                '<img src="' . base_path() . $filepath . 
                '" alt="' . check_plain($result->node_title) . 
                '"/>';     
            }          
          }
          // add slide_text variable
          if (isset($result->node_data_field_slideshow_image_field_slide_text_value)) {
            $slider_items[$key1]['slide_text'] =  check_markup($result->node_data_field_slideshow_image_field_slide_text_value);
          }
          // add slide_title variable
          if (isset($result->node_title)) {
            $slider_items[$key1]['slide_title'] =  check_plain($result->node_title);
          }
          // add slide_read_more variable and slide_node variable
          if (isset($result->nid)) {
            $slider_items[$key1]['slide_read_more'] =  l('Read more...', 'node/' . $result->nid);
            $slider_items[$key1]['slide_node'] =  base_path() . 'node/' . $result->nid;
          }
        }
      }
    }    
    $vars['slider_items'] = $slider_items;
  }
}  
/**
 * Override or insert variables into the ddblock_cycle_pager_content templates.
 *   Used to convert variables from view_fields  to pager_items template variables
 *  Only used for custom pager items
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 *
 */
function charangoten_preprocess_ddblock_cycle_pager_content(&$vars) {
  if (($vars['output_type'] == 'view_fields') && ($vars['pager_settings']['pager'] == 'custom-pager')){
    $content = array();
    // Add pager_items for the template 
    // If you use the devel module uncomment the following lines to see the theme variables
    // dsm($vars['pager_settings']['view_name']);     
    // dsm($vars['content'][0]);     
    // If you don't use the devel module uncomment the following lines to see the theme variables
    // drupal_set_message('<pre>' . var_export($vars['pager_settings'], true) . '</pre>');
    // drupal_set_message('<pre>' . var_export($vars['content'][0], true) . '</pre>');
    if ($vars['pager_settings']['view_name'] == 'events_slideshow_c10') {
      if (!empty($vars['content'])) {
        foreach ($vars['content'] as $key1 => $result) {
          // add pager_item_image variable
          if (isset($result->node_data_field_slideshow_image_field_slideshow_image_fid)) {
            $fid = $result->node_data_field_slideshow_image_field_slideshow_image_fid;
            $filepath = db_result(db_query("SELECT filepath FROM {files} WHERE fid = %d", $fid));
            //  use imagecache (imagecache, preset_name, file_path, alt, title, array of attributes)
            if (module_exists('imagecache') && 
                is_array(imagecache_presets()) && 
                $vars['imgcache_pager_item'] <> '<none>'){
              $pager_items[$key1]['image'] = 
                theme('imagecache', 
                      $vars['pager_settings']['imgcache_pager_item'],              
                      $filepath,
                      check_plain($result->node_data_field_slideshow_image_field_pager_item_text_value));
            }
            else {          
              $pager_items[$key1]['image'] = 
                '<img src="' . base_path() . $filepath . 
                '" alt="' . check_plain($result->node_data_field_slideshow_image_field_pager_item_text_value) . 
                '"/>';     
            }          
          }
          // add pager_item _text variable
          if (isset($result->node_data_field_slideshow_image_field_pager_item_text_value)) {
            $pager_items[$key1]['text'] =  check_plain($result->node_data_field_slideshow_image_field_pager_item_text_value);
          }
        }
      }
    }
    $vars['pager_items'] = $pager_items;
  }    
}


/**
* Implementation of hook_form_alter.
*
* Adds a checkbox to node edit and comment forms.  This checkbox lets
* facebook users know that content may be published to their Wall,
* and gives them a chance to prevent that.
*/
function charangoten_custom_form_alter(&$form, $form_state, $form_id) {

  if (isset($GLOBALS['fb']) && fb_facebook_user()) {
    if ($form['#id'] == 'node-form') {
      // Add checkbox to control feed publish.
      $form['dff_custom']['stream_publish'] = array(
        '#type' => 'checkbox',
        '#title' => 'Share on Facebook',
        '#default_value' => TRUE,
      );
    }
    else if ($form['form_id']['#value'] == 'comment_form') {
      // Add checkbox to control feed publish.
      $form['dff_custom']['stream_publish'] = array(
        '#type' => 'checkbox',
        '#title' => 'Share on Facebook',
        '#default_value' => TRUE,
      );
    }
  }

}

/**
* Implementation of hook_nodeapi().
*
* Publish to facebook Walls when users submit nodes.
*/
function charangoten_custom_nodeapi(&$node, $op, $a3 = NULL, $a4 = NULL) {
  if ($op == 'insert' || $op == 'update') {
    if (isset($node->stream_publish) && $node->stream_publish) {
      //dpm($node, "dff_custom_nodeapi, publishing to stream");
      // http://wiki.developers.facebook.com/index.php/Attachment_(Streams)
      $attachment = array(
        'name' => $node->title,
        'href' => url('node/' . $node->nid, array('absolute' => TRUE)),
        'description' => $node->teaser,
      );

      $user_message = t('Check out my latest post on !site...',
                        array('!site' => variable_get('site_name', t('my Drupal for Facebook powered site'))));
      $actions = array();
      $actions[] = array('text' => t('Read More'),
                         'href' => url('node/'.$node->nid, array('absolute' => TRUE)),
      );
      fb_stream_publish_dialog(array('user_message' => $user_message,
                                     'attachment' => $attachment,
                                     'action_links' => $actions,
                               ));
    }
  }


}

/**
* Implementation of hook_comment().
*
* Publish to facebook Walls when users submit comments.
*/
function charangoten_custom_comment(&$a1, $op) {
  if ($op == 'insert' || $op == 'update') {
    if ($a1['stream_publish']) {
      //dpm($a1, "dff_custom_comment, publishing to stream");
      $node = node_load($a1['nid']);
     
      // http://wiki.developers.facebook.com/index.php/Attachment_(Streams)
      $attachment = array(
        'name' => $a1['subject'],
        'href' => url('node/' . $a1['nid'], array('absolute' => TRUE, 'fragment' => 'comment-' . $a1['cid'])),
        'description' => $a1['comment'],
        'properties' => array(t('In reply to') => array('text' => $node->title, 'href' => url("node/" . $node->nid, array('absolute' => TRUE)))),
      );

      $user_message = t('Check out my latest comment on !site...',
                        array('!site' => variable_get('site_name', t('my Drupal for Facebook powered site'))));
      $actions = array();
      $actions[] = array('text' => t('Read More'),
                         'href' => url('node/'.$a1['nid'], array('absolute' => TRUE)),
      );
      fb_stream_publish_dialog(array('user_message' => $user_message,
                                     'attachment' => $attachment,
                                     'action_links' => $actions,
                               ));
    }
  }

}

/* Implementation of Search Block Custom */


function charangoten_preprocess_search_block_form(&$vars, $hook) {
    // Modify elements of the search form
    unset($vars['form']['search_block_form']['#title']);

    // Set a default value for the search box
  $vars['form']['search_block_form']['#value'] = t('Search this site');
   
    // Add a custom class to the search box
    // Set yourtheme.css > #search-block-form .form-text { color: #888888; }
  $vars['form']['search_block_form']['#attributes'] = array(
       'onblur' => "if (this.value == '') {this.value = '".$vars['form']['search_block_form']['#value']."';} this.style.color = '#000000';",
         'onfocus' => "if (this.value == '".$vars['form']['search_block_form']['#value']."') {this.value = '';} this.style.color = '#996600';" );

    // Modify elements of the submit button
    unset($vars['form']['submit']);

    // Change text on the submit button
    //$vars['form']['submit']['#value'] = t('Go!');

    // Change submit button into image button - NOTE: '#src' leading '/' automatically added
    //$vars['form']['submit']['image_button'] = array('#type' => 'image_button', '#src' => base_path() . path_to_theme('sites/default/charangoten') . '/images/search-button.png');
	
	$vars['form']['submit']['#type'] = 'image_button';
	$vars['form']['submit']['#src'] = path_to_theme() . '/images/search-button.png';

    // Rebuild the rendered version (search form only, rest remains unchanged)
  unset($vars['form']['search_block_form']['#printed']);
  $vars['search']['search_block_form'] = drupal_render($vars['form']['search_block_form']);

    // Rebuild the rendered version (submit button, rest remains unchanged)
    unset($vars['form']['submit']['#printed']);
    $vars['search']['submit'] = drupal_render($vars['form']['submit']);
   
    // Collect all form elements to print entire form
  $vars['search_form'] = implode($vars['search']);
}