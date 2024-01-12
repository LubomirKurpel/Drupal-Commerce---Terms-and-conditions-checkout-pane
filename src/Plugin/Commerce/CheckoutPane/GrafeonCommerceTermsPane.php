<?php

namespace Drupal\grafeon_commerce_terms\Plugin\Commerce\CheckoutPane;

use Drupal\commerce_checkout\Plugin\Commerce\CheckoutPane\CheckoutPaneBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a Terms and Conditions checkout pane.
 *
 * @CommerceCheckoutPane(
 *   id = "grafeon_commerce_terms_checkbox",
 *   label = @Translation("Terms and Conditions"),
 *   display_label = @Translation("Terms and Conditions"),
 *   default_step = "_sidebar",
 *   wrapper_element = "fieldset",
 * )
 */
class GrafeonCommerceTermsPane extends CheckoutPaneBase
{
    /**
     * {@inheritdoc}
     */
    public function defaultConfiguration() {
        return [
            'terms_and_conditions_checkbox' => 'terms_and_conditions',
        ] + parent::defaultConfiguration();
    }
	
	public function buildConfigurationSummary() {
        return $this->t('Link: @terms_and_conditions_link', [
            '@terms_and_conditions_link' => $this->configuration['terms_and_conditions_link'],
        ]);
    }

    public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
        $form = parent::buildConfigurationForm($form, $form_state);		
		$form['terms_and_conditions_link'] = [
			'#type' => 'textfield',
			'#title' => $this->t('Link to Terms and Conditions'),
			'#default_value' => $this->configuration['terms_and_conditions_link'],
		];

        return $form;
    }

    public function submitConfigurationForm(array &$form, FormStateInterface $form_state) {
        parent::submitConfigurationForm($form, $form_state);

        if (!$form_state->getErrors()) {
            $values = $form_state->getValue($form['#parents']);
            $this->configuration['terms_and_conditions_link'] = $values['terms_and_conditions_link'];
        }
    }

    public function buildPaneForm(array $pane_form, FormStateInterface $form_state, array &$complete_form) {
        $terms_and_conditions = $this->order->getData('terms_and_conditions');
        $pane_form['terms_and_conditions_checkbox'] = [
            '#type' => 'checkboxes',
			'#options' => array('terms_and_conditions' => $this->t('I agree with <a href="@terms_and_conditions">Terms and Conditions</a>.', array('@terms_and_conditions' => $this->configuration['terms_and_conditions_link']))),
            '#default_value' => $this->configuration['terms_and_conditions_checkbox'],
			'#required' => TRUE,
        ];
        return $pane_form;
    }

    public function submitPaneForm(array &$pane_form, FormStateInterface $form_state, array &$complete_form) {
        $values = $form_state->getValue($pane_form['#parents']);
        $this->order->setData('terms_and_conditions', $values['terms_and_conditions']);
    }
}