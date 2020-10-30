<?php

namespace Drupal\hello\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class NewsletterForm.
 */
class NewsletterForm extends FormBase {


  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'newsletter_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('The name of the subscriber'),
      '#maxlength' => 15,
      '#size' => 20,
      '#weight' => '0',
    ];
    $form['email'] = [
      '#type' => 'email',
      '#title' => $this->t('Email'),
      '#description' => $this->t('Email of the subscriber'),
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Submit'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
//    foreach ($form_state->getValues() as $key => $value) {
//      drupal_set_message($key . ': ' . $value);
//    }


    $subscription = \Drupal\web_subscription\Entity\Subscription::create([
      'name' => $form_state->getValue('name'),
      'email' => $form_state->getValue('email'),
      'user_id' => $user = \Drupal::currentUser()->id(),
      'status' => 1

    ]);
    $subscription->save();
    \Drupal::messenger()->addMessage('Your subscription has been registered ');

  }

}
