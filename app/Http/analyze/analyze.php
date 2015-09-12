<?php echo '<pre>';

spl_autoload_register(function($class_name){
	$file_name = str_replace('\\', '/', $class_name);
	$file_name = str_replace('_', '/', $file_name);
	$file = dirname(__FILE__) . "/src/$file_name.php";
	if(is_file($file)) include $file;
});



$tokenizer = new HybridLogic\Classifier\Basic;
$classifier = new HybridLogic\Classifier($tokenizer);


include 'dataset/train.php';

//$groups = $classifier->classify('bạn bị nhớ nhà');
//var_dump($groups);

?>