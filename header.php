<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>
	<head>
		
		<title><?$APPLICATION->ShowTitle();?></title>
		<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
		<meta name="viewport" content="width=device-width,initial-scale=1.0">
		<?$APPLICATION->ShowHead();?>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/jquery-2.2.0.min.js"></script>
		<script src="<?=SITE_TEMPLATE_PATH?>/js/js.js"></script>
	</head>
	<body>
	<?$APPLICATION->ShowPanel();?>
	<div class="top"><div class="top__nav">
	<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"a",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(""),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N"
	)
);?>
	<div class="top__phone">+375 29 586-53-03</div></div></div>
	<div class="wrap">