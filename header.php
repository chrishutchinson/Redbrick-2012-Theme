<?php
/*
Theme: Redbrick 2012
Filename: header.php
Author(s): Chris Hutchinson and Josh Holder
Date started: 09/08/2012, 23:45
Last updated: 09/08/2012 23:45
About: This is an entirely custom theme build during the redesign in advance of the academic year 2012/2013 for Redbrick, student media group at the University of Birmingham.
*/
?>

<html>
<head>
<title></title>
<link href='http://fonts.googleapis.com/css?family=Tinos:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
<link rel="stylesheet" type="text/css" media="all" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
<?php
if(is_home())
{
	//This is the homepage
	get_template_part('slider'); // Include slider, slider.php //
}
?>

<?php get_template_part('nav'); // Include navigation, nav.php // ?>

<?php get_template_part('ticker'); // Include navigation, nav.php // ?>