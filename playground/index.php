<?php
$files		 = scandir('classes/');
$ignore		 = array('.', '..');
$menu		 = "<div class='menu'>";
$main_body	 = '';
$dump_test	 = '';
$class       = '';
foreach($files as $file)
{
	if(!in_array($file, $ignore))
	{
		include('classes/' . $file);
		$name_parts	 = explode('.', $file);
		$class_name	 = str_replace(' ', '', ucwords(str_replace('_', ' ', $name_parts[0])));
		new $class_name;

		$menu .= "<a href='?view={$class_name}' class='menu_anchor'><div class='menu_item'>$class_name</div></a>";
	}
}
$menu .= "</div>";
//print_r($files);

if(isset($_GET['view']))
{
	$class = htmlentities($_GET['view']);
	ob_start();
	ob_clean();
	if(method_exists($class, 'view'))
	{
		$dump_test = $class::view();
	}
	$main_body = ob_get_contents();
	ob_clean();
}
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="windows-1252">
        <title>Coding Playground</title>
		<style>
			h3
			{
				color: cornflowerblue;
			}
			.menu 
			{
				width: 100%;
				margin-bottom: 20px;
			}
			.menu_item
			{
				display: inline-block;
				padding:4px;
				padding-left: 15px;
				padding-right: 15px;
				margin:2px;
				background-color: lavender;
				color: darkorange;
				font-weight:bold;
				font-family: tahoma;
				font-size: 12pt;
				border: 1px solid lavendar;
				border-right: 1px solid cornflowerblue;
				border-bottom: 1px solid cornflowerblue;
			}
			.menu_item:hover
			{
				background-color: darkorange;
				color: cornflowerblue;	
				border: 1px solid lavendar;
				border-left: 1px solid cornflowerblue;
				border-top: 1px solid cornflowerblue;
			}
			.menu_anchor
			{
				text-decoration: none;
			}
			.dump_box
			{
				margin: 40px;
				padding: 10px;
				border: 1px solid #333333;
				width: 90%;
				min-height: 200px;
			}
		</style>
    </head>
    <body>
<?php echo $menu ?>
		<h3>Playground<?php echo " - " . $class ?></h3>
		<?php echo $main_body ?>
		<div class='dump_box'>
			<pre>
				<?php print_r($dump_test); ?>
			</pre>
		</div>
    </body>
</html>
