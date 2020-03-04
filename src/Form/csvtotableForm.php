<?php
// Matthew Pellegrino Csv to table drupal 8.x module
/**
* @file
* Contains \Drupal\csvtotable\Form\csvtotableForm
*/

namespace Drupal\csvtotable\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\file\Entity\File;

class csvtotableForm extends ConfigFormBase {

/** 
   * Config settings.
   *
   * @var string
   */
  const SETTINGS = 'csvtotable.settings';

   /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

 /**
 * {@inheridoc}
 */
  public function getFormId(){

    return 'csvtotableForm';
  }

  /**
  * {@inheritdoc}
  */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    parent::submitForm($form, $form_state);

    // Get the config object.
    $config = $this->config('csvtotable.settings');

    $csv1 = $form_state->getValue('CSV_file1', 0);
    $csv2 = $form_state->getValue('CSV_file2', 0);
	$csv3 = $form_state->getValue('CSV_file3', 0);
	$csv4 = $form_state->getValue('CSV_file4', 0);
      
	  $csv = array($csv1[0], $csv2[0], $csv3[0], $csv4[0]);
	for($i=0; $i<sizeof($csv); $i++)
	{
		if (isset($csv[$i]) && !empty($csv[$i])) 
			{
			  $file = File::load($csv[$i]);
			  $file->setPermanent();
			  $file->save();
			}
	}
    // Set the values the user submitted in the form.
    $config->set('CSV_file1', $csv1)
      ->set('CSV_file2', $csv2)
      ->set('CSV_file3', $csv3)
      ->set('CSV_file4', $csv4)
      ->save();
  }
  
  /**
  * {@inheritdoc}
  */
	public function buildForm(array $form, FormStateInterface $form_state) 
	{

		$config = $this->config('csvtotable.settings');

		
		
		 $form['CSVconfig'] = array(
						'#type' => 'fieldset',
						'#title' => $this->t('CSV File locations'),
						'#description' => $this->t('Upload the .csv files you would like to display in the csv block'),
						'#collapsible' => FALSE,
					);


		 $form['CSV_file1'] = array(
					'#type' => 'managed_file',
					'#title' => $this->t('Csv-1 file path'),
					'#default_value' => $config->get('CSV_file1'),
					'#upload_location' => 'private://csv',
					'#description' => $this->t('Upload a .csv file to display'),
					'#upload_validators' => [
						'file_validate_extensions' => ['csv'],
					],
				);

		
		 $form['CSV_file2'] = array(
					'#type' => 'managed_file',
					'#title' => $this->t('Csv-2 file path'),
					'#default_value' => $config->get('CSV_file2'),
					'#upload_location' => 'private://csv',
					'#description' => $this->t('Upload a .csv file to display'),
					'#upload_validators' => [
						'file_validate_extensions' => ['csv'],
					],
				);



		  $form['CSV_file3'] = array(
					'#type' => 'managed_file',
					'#title' => $this->t('Csv-3 file path'),
					'#default_value' => $config->get('CSV_file3'),
					'#upload_location' => 'private://csv',
					'#description' => $this->t('Upload a .csv file to display'),
					'#upload_validators' => [
						'file_validate_extensions' => ['csv'],
					],
				);

				

		 $form['CSV_file4'] = array(
					'#type' => 'managed_file',
					'#title' => $this->t('Csv-4 file path'),
					'#default_value' => $config->get('CSV_file4'),
					'#upload_location' => 'private://csv',
					'#description' => $this->t('Upload a .csv file to display'),
					'#upload_validators' => [
						'file_validate_extensions' => ['csv'],
					],
				);
		

		return parent::buildForm($form, $form_state);

	}
}
?>