<?php

use Drupal\file\Entity\File;

function csvtotable($tablenum)

{
$config = \Drupal::config('csvtotable.settings');
// Csv file locations

 $csv1 = $config->get('CSV_file1');
 $csv2 = $config->get('CSV_file2');
 $csv3 = $config->get('CSV_file3');
 $csv4 = $config->get('CSV_file4');

switch($tablenum)
 {
 case 1:
  $file_object = File::load($csv1[0]);
  $file = $file_object->uri->value;
 break;
 
 case 2:
  $file_object = File::load($csv2[0]);
  $file = $file_object->uri->value;
 break;
 
 case 3:
  $file_object = File::load($csv3[0]);
  $file = $file_object->uri->value;
 break;
 
 case 4:
  $file_object = File::load($csv4[0]);
  $file = $file_object->uri->value;
 break;
 
}

//Read csv and display to html table

$blockcontent= "<table class='CSVtable'>\n\n";
if(file_exists($file))
{
	$f = fopen($file, "r");
	
    $i = 0;
	while (($line = fgetcsv($f)) !== false)
	{
			$blockcontent.= "<tr>";
			foreach ($line as $key => $cell) 
			{
				if($key===0&& $i!=0){$blockcontent.= "<td>"."<a target='_blank' href='https://finance.yahoo.com/quote/".$cell."'>". htmlspecialchars($cell) ."</a>". "</td>";}
				else{ $blockcontent.= "<td>" . htmlspecialchars($cell) . "</td>";}
			}
			$blockcontent.= "</tr>\n";
	 $i++;
	}
 fclose($f);
 $blockcontent.= "\n</table>";
 
}
else 
{
$blockcontent.= "File not Found :(";

$blockcontent.= "\n</table>";
$blockcontent.= $file;
}
return $blockcontent;
}


?>