<?php

/**
 * @file
 * Contains custom_module.php - rename to custom_module.module... You should know how to create a module :) 
 * This module redirects to the user page instead of the user/edit page (Drupal's default behavior). 
 */

use Drupal\Core\Url;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Drupal\Core\Form\FormStateInterface;

/**
 * Implements hook_form_FORM_ID_alter(). If you'd only like to redirect after editing a new user and not after creating 
 * a new user change function to custom_module_form_user_edit_form_alter
 */
function custom_module_form_user_form_alter(&$form, FormStateInterface $form_state, $form_id) {

  $form['actions']['submit']['#submit'][] = '_custom_module_user_form_submit';
    
}

/**
 * Custom submit handler for user form.
 */
function _custom_module_user_form_submit($form, FormStateInterface $form_state) {
  
  //get user ID from form state. This works for both editing and creating new users
  $user = $form_state->getFormObject()->getEntity();
  $uid = $user->id();
    
  //create URL to user page
  $url = Url::fromUri('internal:/user/'.$uid);
    
  //redirect to url created above    
  $form_state->setRedirectUrl($url);
    
}
