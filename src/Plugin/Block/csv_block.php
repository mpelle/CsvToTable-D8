<?php

/**
 * @file
 */
namespace Drupal\csvtotable\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Block\BlockPluginInterface;

/**
 * Provides a 'Csv' Block
 * @Block(
 * id = "csv_block",
 * admin_label = @Translation("Csv to table block"),
 * )
 */
class csv_block extends BlockBase implements BlockPluginInterface {

/**
* {@inheritdoc}
*/
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['Csv_num'] = [
      '#type' => 'number',
      '#title' => $this->t('Csv number'),
      '#description' => $this->t('Which CSV file would you like to display?'),
      '#default_value' => isset($config['Csv_num']) ? $config['Csv_num'] : '',
    ];

    return $form;
  }

   /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['Csv_num'] = $values['Csv_num'];
  }


 /**
 *
 * {@inheritdoc}
 *
 */
 public function build() {

  $config = $this->getConfiguration();
  $number = $config['Csv_num'];

  $block = array();

		//$block['subject'] = t($number);
		$block['#markup'] = theblock_contents($number);

	  return $block;
 }
}

	// Function for the block content
	function theblock_contents($blocknumber) {
	  module_load_include('inc', 'csvtotable', 'csvtotable');
    return csvtotable($blocknumber);

	}
