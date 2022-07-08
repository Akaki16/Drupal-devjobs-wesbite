<?php

namespace Drupal\jb_module\Form;
use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class SearchForm extends FormBase {

    public function getFormId() {
        return 'search_form';
    }

    public function buildForm($form, FormStateInterface $form_state) {
        $form['job_name'] = [
            '#type' => 'textfield',
            '#required' => true,
            '#attributes' => ['class' => array('border', 'outline-hidden')]
        ];
        $form['job_name']['#attributes']['placeholder'] = t('Filter by job title');

        $form['company_location'] = [
            '#type' => 'textfield',
            '#required' => true,
            '#attributes' => ['class' => array('border', 'outline-hidden')]
        ];
        $form['company_location']['#attributes']['placeholder'] = t('Filter by location');

        $form['full_time_only'] = [
            '#type' => 'checkbox',
            '#title' => t('Full Time Only')
        ];

        $form['#method'] = 'get';

        $form['actions']['#type'] = 'actions';
        $form['my_button'] = [
            '#type' => 'submit',
            '#value' => t('Search')
        ];

        return $form;
    }

    public function submitForm(array &$form, FormStateInterface $form_state) {
        // submit form here
    }
}