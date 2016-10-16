<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(false);
/**
 * ADD EXT STYLES FOR BEM
 *
 */
$APPLICATION->AddHeadScript('/bitrix/templates/darkhorse/components/bitrix/iblock.element.add.form/frontend/script.js');
$APPLICATION->SetAdditionalCSS("/bitrix/templates/darkhorse/components/bitrix/iblock.element.add.form/frontend/styles.css");

/*
if (!empty($arResult["ERRORS"])):?>
	<?ShowError(implode("<br />", $arResult["ERRORS"]))?>
<?endif;
if (strlen($arResult["MESSAGE"]) > 0):?>
	<?ShowNote($arResult["MESSAGE"])?>
<?endif?>
<form name="iblock_add" action="<?=POST_FORM_ACTION_URI?>" method="post" enctype="multipart/form-data">
	<?=bitrix_sessid_post()?>
	<?if ($arParams["MAX_FILE_SIZE"] > 0):?><input type="hidden" name="MAX_FILE_SIZE" value="<?=$arParams["MAX_FILE_SIZE"]?>" /><?endif?>
	<table class="data-table">
		<thead>
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
		</thead>
		<?if (is_array($arResult["PROPERTY_LIST"]) && !empty($arResult["PROPERTY_LIST"])):?>
		<tbody>
			<?foreach ($arResult["PROPERTY_LIST"] as $propertyID):?>
				<tr>
					<td><?if (intval($propertyID) > 0):?><?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["NAME"]?><?else:?><?=!empty($arParams["CUSTOM_TITLE_".$propertyID]) ? $arParams["CUSTOM_TITLE_".$propertyID] : GetMessage("IBLOCK_FIELD_".$propertyID)?><?endif?><?if(in_array($propertyID, $arResult["PROPERTY_REQUIRED"])):?><span class="starrequired">*</span><?endif?></td>
					<td>
						<?
						if (intval($propertyID) > 0)
						{
							if (
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "T"
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] == "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "S";
							elseif (
								(
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "S"
									||
									$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] == "N"
								)
								&&
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"] > "1"
							)
								$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "T";
						}
						elseif (($propertyID == "TAGS") && CModule::IncludeModule('search'))
							$arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"] = "TAGS";

						if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y")
						{
							$inputNum = ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0) ? count($arResult["ELEMENT_PROPERTIES"][$propertyID]) : 0;
							$inputNum += $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE_CNT"];
						}
						else
						{
							$inputNum = 1;
						}

						if($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"])
							$INPUT_TYPE = "USER_TYPE";
						else
							$INPUT_TYPE = $arResult["PROPERTY_LIST_FULL"][$propertyID]["PROPERTY_TYPE"];

						switch ($INPUT_TYPE):
							case "USER_TYPE":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["~VALUE"] : $arResult["ELEMENT"][$propertyID];
										$description = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["DESCRIPTION"] : "";
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
										$description = "";
									}
									else
									{
										$value = "";
										$description = "";
									}
									echo call_user_func_array($arResult["PROPERTY_LIST_FULL"][$propertyID]["GetPublicEditHTML"],
										array(
											$arResult["PROPERTY_LIST_FULL"][$propertyID],
											array(
												"VALUE" => $value,
												"DESCRIPTION" => $description,
											),
											array(
												"VALUE" => "PROPERTY[".$propertyID."][".$i."][VALUE]",
												"DESCRIPTION" => "PROPERTY[".$propertyID."][".$i."][DESCRIPTION]",
												"FORM_NAME"=>"iblock_add",
											),
										));
								?><br /><?
								}
							break;
							case "TAGS":
								$APPLICATION->IncludeComponent(
									"bitrix:search.tags.input",
									"",
									array(
										"VALUE" => $arResult["ELEMENT"][$propertyID],
										"NAME" => "PROPERTY[".$propertyID."][0]",
										"TEXT" => 'size="'.$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"].'"',
									), null, array("HIDE_ICONS"=>"Y")
								);
								break;
							case "HTML":
								$LHE = new CHTMLEditor;
								$LHE->Show(array(
									'name' => "PROPERTY[".$propertyID."][0]",
									'id' => preg_replace("/[^a-z0-9]/i", '', "PROPERTY[".$propertyID."][0]"),
									'inputName' => "PROPERTY[".$propertyID."][0]",
									'content' => $arResult["ELEMENT"][$propertyID],
									'width' => '100%',
									'minBodyWidth' => 350,
									'normalBodyWidth' => 555,
									'height' => '200',
									'bAllowPhp' => false,
									'limitPhpAccess' => false,
									'autoResize' => true,
									'autoResizeOffset' => 40,
									'useFileDialogs' => false,
									'saveOnBlur' => true,
									'showTaskbars' => false,
									'showNodeNavi' => false,
									'askBeforeUnloadPage' => true,
									'bbCode' => false,
									'siteId' => SITE_ID,
									'controlsMap' => array(
										array('id' => 'Bold', 'compact' => true, 'sort' => 80),
										array('id' => 'Italic', 'compact' => true, 'sort' => 90),
										array('id' => 'Underline', 'compact' => true, 'sort' => 100),
										array('id' => 'Strikeout', 'compact' => true, 'sort' => 110),
										array('id' => 'RemoveFormat', 'compact' => true, 'sort' => 120),
										array('id' => 'Color', 'compact' => true, 'sort' => 130),
										array('id' => 'FontSelector', 'compact' => false, 'sort' => 135),
										array('id' => 'FontSize', 'compact' => false, 'sort' => 140),
										array('separator' => true, 'compact' => false, 'sort' => 145),
										array('id' => 'OrderedList', 'compact' => true, 'sort' => 150),
										array('id' => 'UnorderedList', 'compact' => true, 'sort' => 160),
										array('id' => 'AlignList', 'compact' => false, 'sort' => 190),
										array('separator' => true, 'compact' => false, 'sort' => 200),
										array('id' => 'InsertLink', 'compact' => true, 'sort' => 210),
										array('id' => 'InsertImage', 'compact' => false, 'sort' => 220),
										array('id' => 'InsertVideo', 'compact' => true, 'sort' => 230),
										array('id' => 'InsertTable', 'compact' => false, 'sort' => 250),
										array('separator' => true, 'compact' => false, 'sort' => 290),
										array('id' => 'Fullscreen', 'compact' => false, 'sort' => 310),
										array('id' => 'More', 'compact' => true, 'sort' => 400)
									),
								));
								break;
							case "T":
								for ($i = 0; $i<$inputNum; $i++)
								{

									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) > 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];
									}
									else
									{
										$value = "";
									}
								?>
						<textarea cols="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>" rows="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]?>" name="PROPERTY[<?=$propertyID?>][<?=$i?>]"><?=$value?></textarea>
								<?
								}
							break;

							case "S":
							case "N":
								for ($i = 0; $i<$inputNum; $i++)
								{
									if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
									{
										$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									}
									elseif ($i == 0)
									{
										$value = intval($propertyID) <= 0 ? "" : $arResult["PROPERTY_LIST_FULL"][$propertyID]["DEFAULT_VALUE"];

									}
									else
									{
										$value = "";
									}
								?>
								<input type="text" name="PROPERTY[<?=$propertyID?>][<?=$i?>]" size="25" value="<?=$value?>" /><br /><?
								if($arResult["PROPERTY_LIST_FULL"][$propertyID]["USER_TYPE"] == "DateTime"):?><?
									$APPLICATION->IncludeComponent(
										'bitrix:main.calendar',
										'',
										array(
											'FORM_NAME' => 'iblock_add',
											'INPUT_NAME' => "PROPERTY[".$propertyID."][".$i."]",
											'INPUT_VALUE' => $value,
										),
										null,
										array('HIDE_ICONS' => 'Y')
									);
									?><br /><small><?=GetMessage("IBLOCK_FORM_DATE_FORMAT")?><?=FORMAT_DATETIME?></small><?
								endif
								?><br /><?
								}
							break;

							case "F":
								for ($i = 0; $i<$inputNum; $i++)
								{
									$value = intval($propertyID) > 0 ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE"] : $arResult["ELEMENT"][$propertyID];
									?>
						<input type="hidden" name="PROPERTY[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" value="<?=$value?>" />
						<input type="file" size="<?=$arResult["PROPERTY_LIST_FULL"][$propertyID]["COL_COUNT"]?>"  name="PROPERTY_FILE_<?=$propertyID?>_<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>" /><br />
									<?

									if (!empty($value) && is_array($arResult["ELEMENT_FILES"][$value]))
									{
										?>
					<input type="checkbox" name="DELETE_FILE[<?=$propertyID?>][<?=$arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] ? $arResult["ELEMENT_PROPERTIES"][$propertyID][$i]["VALUE_ID"] : $i?>]" id="file_delete_<?=$propertyID?>_<?=$i?>" value="Y" /><label for="file_delete_<?=$propertyID?>_<?=$i?>"><?=GetMessage("IBLOCK_FORM_FILE_DELETE")?></label><br />
										<?

										if ($arResult["ELEMENT_FILES"][$value]["IS_IMAGE"])
										{
											?>
					<img src="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>" height="<?=$arResult["ELEMENT_FILES"][$value]["HEIGHT"]?>" width="<?=$arResult["ELEMENT_FILES"][$value]["WIDTH"]?>" border="0" /><br />
											<?
										}
										else
										{
											?>
					<?=GetMessage("IBLOCK_FORM_FILE_NAME")?>: <?=$arResult["ELEMENT_FILES"][$value]["ORIGINAL_NAME"]?><br />
					<?=GetMessage("IBLOCK_FORM_FILE_SIZE")?>: <?=$arResult["ELEMENT_FILES"][$value]["FILE_SIZE"]?> b<br />
					[<a href="<?=$arResult["ELEMENT_FILES"][$value]["SRC"]?>"><?=GetMessage("IBLOCK_FORM_FILE_DOWNLOAD")?></a>]<br />
											<?
										}
									}
								}

							break;
							case "L":

								if ($arResult["PROPERTY_LIST_FULL"][$propertyID]["LIST_TYPE"] == "C")
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "checkbox" : "radio";
								else
									$type = $arResult["PROPERTY_LIST_FULL"][$propertyID]["MULTIPLE"] == "Y" ? "multiselect" : "dropdown";

								switch ($type):
									case "checkbox":
									case "radio":
										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												if (is_array($arResult["ELEMENT_PROPERTIES"][$propertyID]))
												{
													foreach ($arResult["ELEMENT_PROPERTIES"][$propertyID] as $arElEnum)
													{
														if ($arElEnum["VALUE"] == $key)
														{
															$checked = true;
															break;
														}
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}

											?>
							<input type="<?=$type?>" name="PROPERTY[<?=$propertyID?>]<?=$type == "checkbox" ? "[".$key."]" : ""?>" value="<?=$key?>" id="property_<?=$key?>"<?=$checked ? " checked=\"checked\"" : ""?> /><label for="property_<?=$key?>"><?=$arEnum["VALUE"]?></label><br />
											<?
										}
									break;

									case "dropdown":
									case "multiselect":
									?>
							<select name="PROPERTY[<?=$propertyID?>]<?=$type=="multiselect" ? "[]\" size=\"".$arResult["PROPERTY_LIST_FULL"][$propertyID]["ROW_COUNT"]."\" multiple=\"multiple" : ""?>">
								<option value=""><?echo GetMessage("CT_BIEAF_PROPERTY_VALUE_NA")?></option>
									<?
										if (intval($propertyID) > 0) $sKey = "ELEMENT_PROPERTIES";
										else $sKey = "ELEMENT";

										foreach ($arResult["PROPERTY_LIST_FULL"][$propertyID]["ENUM"] as $key => $arEnum)
										{
											$checked = false;
											if ($arParams["ID"] > 0 || count($arResult["ERRORS"]) > 0)
											{
												foreach ($arResult[$sKey][$propertyID] as $elKey => $arElEnum)
												{
													if ($key == $arElEnum["VALUE"])
													{
														$checked = true;
														break;
													}
												}
											}
											else
											{
												if ($arEnum["DEF"] == "Y") $checked = true;
											}
											?>
								<option value="<?=$key?>" <?=$checked ? " selected=\"selected\"" : ""?>><?=$arEnum["VALUE"]?></option>
											<?
										}
									?>
							</select>
									<?
									break;

								endswitch;
							break;
						endswitch;?>
					</td>
				</tr>
			<?endforeach;?>
			<?if($arParams["USE_CAPTCHA"] == "Y" && $arParams["ID"] <= 0):?>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_TITLE")?></td>
					<td>
						<input type="hidden" name="captcha_sid" value="<?=$arResult["CAPTCHA_CODE"]?>" />
						<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
					</td>
				</tr>
				<tr>
					<td><?=GetMessage("IBLOCK_FORM_CAPTCHA_PROMPT")?><span class="starrequired">*</span>:</td>
					<td><input type="text" name="captcha_word" maxlength="50" value=""></td>
				</tr>
			<?endif?>
		</tbody>
		<?endif?>
		<tfoot>
			<tr>
				<td colspan="2">
					<input type="submit" name="iblock_submit" value="<?=GetMessage("IBLOCK_FORM_SUBMIT")?>" />
					<?if (strlen($arParams["LIST_URL"]) > 0):?>
						<input type="submit" name="iblock_apply" value="<?=GetMessage("IBLOCK_FORM_APPLY")?>" />
						<input
							type="button"
							name="iblock_cancel"
							value="<? echo GetMessage('IBLOCK_FORM_CANCEL'); ?>"
							onclick="location.href='<? echo CUtil::JSEscape($arParams["LIST_URL"])?>';"
						>
					<?endif?>
				</td>
			</tr>
		</tfoot>
	</table>
</form> */
?>
<div class="tabs">
    <h2 class="tabs__head">ВНИМАНИЕ: Точно указывайте все данные. Анкеты, заполненные не полностью или нечетко, рассматриваться не смогут.</h2>
    <div class="tabs__line"><a class="link link_pseudo link_theme_islands link_size_xl link__control tabs__link tabs-item i-bem" data-bem='{"link":{},"tabs__link":{},"tabs-item":{"id":"tab-1"}}' role="link" href="#link-1"><span class="image" role="img"><svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="482.032px" height="482.032px" viewBox="0 0 482.032 482.032" style="enable-background:new 0 0 482.032 482.032;" xml:space="preserve"> <g> <path d="M386.163,48.499L217.807,216.857c-7.646,1.901-15.05,1.533-20.277-3.687c-12.381-12.381,5.53-39.459,14.835-51.738 c2.679-3.528,1.751-4.749-2.27-2.877l-36.834,17.142c-4.015,1.872-7.902,6.927-8.846,11.257 c-2.914,13.387-9.812,40.158-20.3,50.646c-11.8,11.798-82.429,25.519-106.325,29.892c-4.358,0.781-7.938,4.98-8.299,9.405 c-2.96,36.347-21.045,78.954-28.722,95.669c-1.855,4.023-0.254,5.582,3.767,3.719c52.676-24.389,89.847-12.383,98.364-3.859 c7.402,7.406-14.757,78.178-22.421,101.781c-1.365,4.207,0.651,5.902,4.554,3.803l72.122-38.932 c3.901-2.101,7.801-7.326,8.782-11.65c4.711-20.73,18.372-76.357,32.366-90.355c12.106-12.106,32.801-15.608,44.144-16.639 c4.412-0.389,9.78-3.542,11.94-7.405l15.028-26.718c2.176-3.863,1.134-4.729-2.585-2.312c-11.27,7.334-34.737,19.188-50.468,3.455 c-6.854-6.854-5.67-18.459-0.974-31.05L405.423,66.358c3.418-2.843,11.95-9.004,19.119-6.083c0,0,27.139-32.226,45.456-31.881 c0,0,6.268-14.074,12.034-25.271L387.565,24.32C387.565,24.32,395.488,36.873,386.163,48.499z M155.207,330.984l-9.043,9.037 c-3.136,3.134-8.213,3.134-11.353,0l-24.115-24.109c-3.132-3.146-3.132-8.219,0-11.364l9.043-9.037 c3.132-3.138,8.209-3.138,11.349,0l24.119,24.108C158.339,322.765,158.339,327.839,155.207,330.984z M191.599,283.235 c3.136,3.131,3.136,8.204,0,11.346l-9.041,9.049c-3.132,3.126-8.211,3.126-11.351,0l-24.119-24.121 c-3.132-3.126-3.132-8.207,0-11.345l9.047-9.045c3.132-3.138,8.211-3.138,11.351,0l4.027,4.023l18.556,18.562L191.599,283.235z"/> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> </span><span>Музыканту</span></a><a class="link link_pseudo link_theme_islands link_size_xl link__control tabs__link tabs-item i-bem" data-bem='{"link":{},"tabs__link":{},"tabs-item":{"id":"tab-2"}}' role="link" href="#link-1"><span class="image" role="img"><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="475.085px" height="475.085px" viewBox="0 0 475.085 475.085" style="enable-background:new 0 0 475.085 475.085;" xml:space="preserve"> <g> <g> <path d="M237.541,328.897c25.128,0,46.632-8.946,64.523-26.83c17.888-17.884,26.833-39.399,26.833-64.525V91.365 c0-25.126-8.938-46.632-26.833-64.525C284.173,8.951,262.669,0,237.541,0c-25.125,0-46.632,8.951-64.524,26.84 c-17.893,17.89-26.838,39.399-26.838,64.525v146.177c0,25.125,8.949,46.641,26.838,64.525 C190.906,319.951,212.416,328.897,237.541,328.897z"/> <path d="M396.563,188.15c-3.606-3.617-7.898-5.426-12.847-5.426c-4.944,0-9.226,1.809-12.847,5.426 c-3.613,3.616-5.421,7.898-5.421,12.845v36.547c0,35.214-12.518,65.333-37.548,90.362c-25.022,25.03-55.145,37.545-90.36,37.545 c-35.214,0-65.334-12.515-90.365-37.545c-25.028-25.022-37.541-55.147-37.541-90.362v-36.547c0-4.947-1.809-9.229-5.424-12.845 c-3.617-3.617-7.895-5.426-12.847-5.426c-4.952,0-9.235,1.809-12.85,5.426c-3.618,3.616-5.426,7.898-5.426,12.845v36.547 c0,42.065,14.04,78.659,42.112,109.776c28.073,31.118,62.762,48.961,104.068,53.526v37.691h-73.089 c-4.949,0-9.231,1.811-12.847,5.428c-3.617,3.614-5.426,7.898-5.426,12.847c0,4.941,1.809,9.233,5.426,12.847 c3.616,3.614,7.898,5.428,12.847,5.428h182.719c4.948,0,9.236-1.813,12.847-5.428c3.621-3.613,5.431-7.905,5.431-12.847 c0-4.948-1.81-9.232-5.431-12.847c-3.61-3.617-7.898-5.428-12.847-5.428h-73.08v-37.691 c41.299-4.565,75.985-22.408,104.061-53.526c28.076-31.117,42.12-67.711,42.12-109.776v-36.547 C401.998,196.049,400.185,191.77,396.563,188.15z"/> </g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> <g> </g> </svg> </span><span>Вокалисту</span></a><a class="link link_pseudo link_theme_islands link_size_xl link__control tabs__link tabs-item i-bem" data-bem='{"link":{},"tabs__link":{},"tabs-item":{"id":"tab-3"}}' role="link" href="#link-1"><span class="image" role="img"><!DOCTYPE svg PUBLIC "-//W3C//DTD SVG 1.1//EN" "http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd"> <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="80.13px" height="80.13px" viewBox="0 0 80.13 80.13" style="enable-background:new 0 0 80.13 80.13;" xml:space="preserve" > <g> <path d="M48.355,17.922c3.705,2.323,6.303,6.254,6.776,10.817c1.511,0.706,3.188,1.112,4.966,1.112 c6.491,0,11.752-5.261,11.752-11.751c0-6.491-5.261-11.752-11.752-11.752C53.668,6.35,48.453,11.517,48.355,17.922z M40.656,41.984 c6.491,0,11.752-5.262,11.752-11.752s-5.262-11.751-11.752-11.751c-6.49,0-11.754,5.262-11.754,11.752S34.166,41.984,40.656,41.984 z M45.641,42.785h-9.972c-8.297,0-15.047,6.751-15.047,15.048v12.195l0.031,0.191l0.84,0.263 c7.918,2.474,14.797,3.299,20.459,3.299c11.059,0,17.469-3.153,17.864-3.354l0.785-0.397h0.084V57.833 C60.688,49.536,53.938,42.785,45.641,42.785z M65.084,30.653h-9.895c-0.107,3.959-1.797,7.524-4.47,10.088 c7.375,2.193,12.771,9.032,12.771,17.11v3.758c9.77-0.358,15.4-3.127,15.771-3.313l0.785-0.398h0.084V45.699 C80.13,37.403,73.38,30.653,65.084,30.653z M20.035,29.853c2.299,0,4.438-0.671,6.25-1.814c0.576-3.757,2.59-7.04,5.467-9.276 c0.012-0.22,0.033-0.438,0.033-0.66c0-6.491-5.262-11.752-11.75-11.752c-6.492,0-11.752,5.261-11.752,11.752 C8.283,24.591,13.543,29.853,20.035,29.853z M30.589,40.741c-2.66-2.551-4.344-6.097-4.467-10.032 c-0.367-0.027-0.73-0.056-1.104-0.056h-9.971C6.75,30.653,0,37.403,0,45.699v12.197l0.031,0.188l0.84,0.265 c6.352,1.983,12.021,2.897,16.945,3.185v-3.683C17.818,49.773,23.212,42.936,30.589,40.741z"/> </g></svg> </span><span>Коллективу</span></a></div>
    <div class="tabs__content">
        <div class="tabs__item tabs__item_open tabs-item i-bem" data-bem='{"tabs-item":{"id":"tab-1"}}'>
            <form class="profile-form i-bem" data-bem='{"profile-form":{}}' method="post" action="submit.php" enctype="multipart/form-data">
                <div class="profile-form__wrapper">
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Основная информация</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="first_name" placeholder="Фамилия Имя Отчество"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="datepicker i-bem" data-bem='{"datepicker":{}}'>
                            <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear datepicker__input i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="date_of_birth" placeholder="Дата рождения"/><span class="input__clear"></span></span>
                                </span>
                                <div class="popup popup_theme_islands popup_size_xl popup_autoclosable popup_target_anchor dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl i-bem" data-bem='{"popup":{"directions":["right-center","top-center"]},"dropdown":{"id":"uniq14765518831692"}}' aria-hidden="true" id="uniq14765518831692">
                                    <div class="control-group control-group_dropdown" role="group">
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"day","text":"Число"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq14765518831693 uniq14765518831694 uniq14765518831695 uniq14765518831696 uniq14765518831697 uniq14765518831698 uniq14765518831699 uniq147655188316910 uniq147655188316911 uniq147655188316912 uniq147655188316913 uniq147655188316914 uniq147655188316915 uniq147655188316916 uniq147655188316917 uniq147655188316918 uniq147655188316919 uniq147655188316920 uniq147655188316921 uniq147655188316922 uniq147655188316923 uniq147655188316924 uniq147655188316925 uniq147655188316926 uniq147655188316927 uniq147655188316928 uniq147655188316929 uniq147655188316930 uniq147655188316931 uniq147655188316932 uniq147655188316933" aria-labelledby="uniq147655188316934"><span class="button__text" id="uniq147655188316934">Число</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq14765518831693" aria-checked="false">1</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq14765518831694" aria-checked="false">2</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq14765518831695" aria-checked="false">3</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq14765518831696" aria-checked="false">4</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq14765518831697" aria-checked="false">5</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq14765518831698" aria-checked="false">6</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq14765518831699" aria-checked="false">7</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq147655188316910" aria-checked="false">8</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq147655188316911" aria-checked="false">9</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq147655188316912" aria-checked="false">10</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq147655188316913" aria-checked="false">11</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq147655188316914" aria-checked="false">12</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":13}}' role="option" id="uniq147655188316915" aria-checked="false">13</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":14}}' role="option" id="uniq147655188316916" aria-checked="false">14</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":15}}' role="option" id="uniq147655188316917" aria-checked="false">15</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":16}}' role="option" id="uniq147655188316918" aria-checked="false">16</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":17}}' role="option" id="uniq147655188316919" aria-checked="false">17</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":18}}' role="option" id="uniq147655188316920" aria-checked="false">18</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":19}}' role="option" id="uniq147655188316921" aria-checked="false">19</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":20}}' role="option" id="uniq147655188316922" aria-checked="false">20</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":21}}' role="option" id="uniq147655188316923" aria-checked="false">21</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":22}}' role="option" id="uniq147655188316924" aria-checked="false">22</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":23}}' role="option" id="uniq147655188316925" aria-checked="false">23</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":24}}' role="option" id="uniq147655188316926" aria-checked="false">24</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":25}}' role="option" id="uniq147655188316927" aria-checked="false">25</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":26}}' role="option" id="uniq147655188316928" aria-checked="false">26</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":27}}' role="option" id="uniq147655188316929" aria-checked="false">27</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":28}}' role="option" id="uniq147655188316930" aria-checked="false">28</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":29}}' role="option" id="uniq147655188316931" aria-checked="false">29</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":30}}' role="option" id="uniq147655188316932" aria-checked="false">30</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":31}}' role="option" id="uniq147655188316933" aria-checked="false">31</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"month","text":"Месяц"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq147655188316935 uniq147655188316936 uniq147655188316937 uniq147655188316938 uniq147655188316939 uniq147655188316940 uniq147655188316941 uniq147655188316942 uniq147655188316943 uniq147655188316944 uniq147655188316945 uniq147655188316946" aria-labelledby="uniq147655188316947"><span class="button__text" id="uniq147655188316947">Месяц</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq147655188316935" aria-checked="false">Январь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq147655188316936" aria-checked="false">Февраль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq147655188316937" aria-checked="false">Март</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq147655188316938" aria-checked="false">Апрель</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq147655188316939" aria-checked="false">Май</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq147655188316940" aria-checked="false">Июнь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq147655188316941" aria-checked="false">Июль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq147655188316942" aria-checked="false">Август</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq147655188316943" aria-checked="false">Сентябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq147655188316944" aria-checked="false">Октябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq147655188316945" aria-checked="false">Ноябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq147655188316946" aria-checked="false">Декабрь</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"year","text":"Год"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq147655188316948 uniq147655188316949 uniq147655188316950 uniq147655188316951 uniq147655188316952 uniq147655188316953 uniq147655188316954 uniq147655188316955 uniq147655188316956 uniq147655188316957 uniq147655188316958 uniq147655188316959 uniq147655188316960 uniq147655188316961 uniq147655188316962 uniq147655188316963 uniq147655188316964 uniq147655188316965 uniq147655188316966 uniq147655188316967 uniq147655188316968 uniq147655188316969 uniq147655188316970 uniq147655188316971 uniq147655188316972 uniq147655188316973 uniq147655188316974 uniq147655188316975 uniq147655188316976 uniq147655188316977 uniq147655188316978 uniq147655188316979 uniq147655188316980 uniq147655188316981 uniq147655188316982 uniq147655188316983 uniq147655188316984 uniq147655188316985 uniq147655188316986 uniq147655188316987" aria-labelledby="uniq147655188316988"><span class="button__text" id="uniq147655188316988">Год</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1976}}' role="option" id="uniq147655188316948" aria-checked="false">1976</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1977}}' role="option" id="uniq147655188316949" aria-checked="false">1977</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1978}}' role="option" id="uniq147655188316950" aria-checked="false">1978</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1979}}' role="option" id="uniq147655188316951" aria-checked="false">1979</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1980}}' role="option" id="uniq147655188316952" aria-checked="false">1980</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1981}}' role="option" id="uniq147655188316953" aria-checked="false">1981</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1982}}' role="option" id="uniq147655188316954" aria-checked="false">1982</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1983}}' role="option" id="uniq147655188316955" aria-checked="false">1983</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1984}}' role="option" id="uniq147655188316956" aria-checked="false">1984</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1985}}' role="option" id="uniq147655188316957" aria-checked="false">1985</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1986}}' role="option" id="uniq147655188316958" aria-checked="false">1986</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1987}}' role="option" id="uniq147655188316959" aria-checked="false">1987</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1988}}' role="option" id="uniq147655188316960" aria-checked="false">1988</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1989}}' role="option" id="uniq147655188316961" aria-checked="false">1989</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1990}}' role="option" id="uniq147655188316962" aria-checked="false">1990</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1991}}' role="option" id="uniq147655188316963" aria-checked="false">1991</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1992}}' role="option" id="uniq147655188316964" aria-checked="false">1992</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1993}}' role="option" id="uniq147655188316965" aria-checked="false">1993</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1994}}' role="option" id="uniq147655188316966" aria-checked="false">1994</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1995}}' role="option" id="uniq147655188316967" aria-checked="false">1995</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1996}}' role="option" id="uniq147655188316968" aria-checked="false">1996</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1997}}' role="option" id="uniq147655188316969" aria-checked="false">1997</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1998}}' role="option" id="uniq147655188316970" aria-checked="false">1998</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1999}}' role="option" id="uniq147655188316971" aria-checked="false">1999</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2000}}' role="option" id="uniq147655188316972" aria-checked="false">2000</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2001}}' role="option" id="uniq147655188316973" aria-checked="false">2001</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2002}}' role="option" id="uniq147655188316974" aria-checked="false">2002</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2003}}' role="option" id="uniq147655188316975" aria-checked="false">2003</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2004}}' role="option" id="uniq147655188316976" aria-checked="false">2004</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2005}}' role="option" id="uniq147655188316977" aria-checked="false">2005</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2006}}' role="option" id="uniq147655188316978" aria-checked="false">2006</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2007}}' role="option" id="uniq147655188316979" aria-checked="false">2007</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2008}}' role="option" id="uniq147655188316980" aria-checked="false">2008</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2009}}' role="option" id="uniq147655188316981" aria-checked="false">2009</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2010}}' role="option" id="uniq147655188316982" aria-checked="false">2010</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2011}}' role="option" id="uniq147655188316983" aria-checked="false">2011</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2012}}' role="option" id="uniq147655188316984" aria-checked="false">2012</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2013}}' role="option" id="uniq147655188316985" aria-checked="false">2013</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2014}}' role="option" id="uniq147655188316986" aria-checked="false">2014</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2015}}' role="option" id="uniq147655188316987" aria-checked="false">2015</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="button button_theme_islands button_size_xl button_view_action button__control dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl datepicker__dropdown i-bem" data-bem='{"button":{},"dropdown":{"id":"uniq14765518831692"}}' role="button" type="button"><span class="icon"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg></span></button>
                            </div>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="country_name" placeholder="Страна проживания"/><span class="input__clear"></span></span>
                            </span><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="city_name" placeholder="Город проживания"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group">
                            <div class="select select_mode_radio-check select_theme_islands select_size_xl i-bem" data-bem='{"select":{"name":"education_type","text":"Образование"}}'>
                                <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq147655188316989 uniq147655188316990 uniq147655188316991 uniq147655188316992" aria-labelledby="uniq147655188316993"><span class="button__text" id="uniq147655188316993">Образование</span><span class="icon select__tick"></span></button>
                                <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                    <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Среднее"}}' role="option" id="uniq147655188316989" aria-checked="false">Среднее</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Среднее специальное"}}' role="option" id="uniq147655188316990" aria-checked="false">Среднее специальное</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Высшее"}}' role="option" id="uniq147655188316991" aria-checked="false">Высшее</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Другое"}}' role="option" id="uniq147655188316992" aria-checked="false">Другое</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="education_name" placeholder="Название УО, Cпециальность "/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Музыкальное образование</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="has_music_education" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="has_music_education" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_education_name" placeholder="Название УО, специальность"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_proficiency" placeholder="Владение музыкальным инструментом(ми) каким(ми) и на каком уровне"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Творчество</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="creativity_motivation" placeholder="Что является мотивацией для Вашего развития? (ответ в свободной форме)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="kind_of_activity" placeholder="Вид деятельности на данный момент"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_implementation_style" placeholder="В каком стиле (стилях) предпочитаете исполнять музыку"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Авторские композиции</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Нет" checked="checked" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Профессиональная деятельность</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="professional_activity" placeholder="Профессиональное прошлое (в каких сферах работали и т.д.)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="group_activity_experience" placeholder="Опыт работы в музыкальных коллективах"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Сотрудничаете с каким-либо коллективом на данный момент?</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="current_group_relationship" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="current_group_relationship" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="current_group_relationship_names" placeholder="Укажите название коллектива(ов)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Опыт работы на большой сцене</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="text-label">Опыт работы по контракту</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="Нет" checked="checked" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Медиа</h2>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="photo_attaches"/><span class="button__text">Прикрепить 3-5 фото</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="music_attaches"/><span class="button__text">Прикрепить записи авторской музыки (при наличии)</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="video_links" placeholder="Cсылки на видео в интернете с демонстрацией ваших выступлений (если есть)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Контакты</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="agent_phone" placeholder="Контактный номер телефона (свой или представителя коллектива)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="email" placeholder="Адрес электронной почты"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <button class="button button_type_submit button_view_action button_theme_islands button_size_xl button__control submit i-bem" data-bem='{"button":{},"submit":{}}' role="button" type="submit" name="submit"><span class="button__text">Отправить</span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabs__item tabs__item_closed tabs-item i-bem" data-bem='{"tabs-item":{"id":"tab-2"}}'>
            <form class="profile-form i-bem" data-bem='{"profile-form":{}}' method="post" action="submit.php" enctype="multipart/form-data">
                <div class="profile-form__wrapper">
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Основная информация</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="first_name" placeholder="Фамилия Имя Отчество"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="datepicker i-bem" data-bem='{"datepicker":{}}'>
                            <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear datepicker__input i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="date_of_birth" placeholder="Дата рождения"/><span class="input__clear"></span></span>
                                </span>
                                <div class="popup popup_theme_islands popup_size_xl popup_autoclosable popup_target_anchor dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl i-bem" data-bem='{"popup":{"directions":["right-center","top-center"]},"dropdown":{"id":"uniq147655188316995"}}' aria-hidden="true" id="uniq147655188316995">
                                    <div class="control-group control-group_dropdown" role="group">
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"day","text":"Число"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq147655188316996 uniq147655188316997 uniq147655188316998 uniq147655188316999 uniq1476551883169100 uniq1476551883169101 uniq1476551883169102 uniq1476551883169103 uniq1476551883169104 uniq1476551883169105 uniq1476551883169106 uniq1476551883169107 uniq1476551883169108 uniq1476551883169109 uniq1476551883169110 uniq1476551883169111 uniq1476551883169112 uniq1476551883169113 uniq1476551883169114 uniq1476551883169115 uniq1476551883169116 uniq1476551883169117 uniq1476551883169118 uniq1476551883169119 uniq1476551883169120 uniq1476551883169121 uniq1476551883169122 uniq1476551883169123 uniq1476551883169124 uniq1476551883169125 uniq1476551883169126" aria-labelledby="uniq1476551883169127"><span class="button__text" id="uniq1476551883169127">Число</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq147655188316996" aria-checked="false">1</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq147655188316997" aria-checked="false">2</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq147655188316998" aria-checked="false">3</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq147655188316999" aria-checked="false">4</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq1476551883169100" aria-checked="false">5</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq1476551883169101" aria-checked="false">6</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq1476551883169102" aria-checked="false">7</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq1476551883169103" aria-checked="false">8</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq1476551883169104" aria-checked="false">9</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq1476551883169105" aria-checked="false">10</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq1476551883169106" aria-checked="false">11</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq1476551883169107" aria-checked="false">12</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":13}}' role="option" id="uniq1476551883169108" aria-checked="false">13</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":14}}' role="option" id="uniq1476551883169109" aria-checked="false">14</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":15}}' role="option" id="uniq1476551883169110" aria-checked="false">15</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":16}}' role="option" id="uniq1476551883169111" aria-checked="false">16</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":17}}' role="option" id="uniq1476551883169112" aria-checked="false">17</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":18}}' role="option" id="uniq1476551883169113" aria-checked="false">18</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":19}}' role="option" id="uniq1476551883169114" aria-checked="false">19</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":20}}' role="option" id="uniq1476551883169115" aria-checked="false">20</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":21}}' role="option" id="uniq1476551883169116" aria-checked="false">21</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":22}}' role="option" id="uniq1476551883169117" aria-checked="false">22</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":23}}' role="option" id="uniq1476551883169118" aria-checked="false">23</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":24}}' role="option" id="uniq1476551883169119" aria-checked="false">24</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":25}}' role="option" id="uniq1476551883169120" aria-checked="false">25</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":26}}' role="option" id="uniq1476551883169121" aria-checked="false">26</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":27}}' role="option" id="uniq1476551883169122" aria-checked="false">27</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":28}}' role="option" id="uniq1476551883169123" aria-checked="false">28</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":29}}' role="option" id="uniq1476551883169124" aria-checked="false">29</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":30}}' role="option" id="uniq1476551883169125" aria-checked="false">30</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":31}}' role="option" id="uniq1476551883169126" aria-checked="false">31</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"month","text":"Месяц"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169128 uniq1476551883169129 uniq1476551883169130 uniq1476551883169131 uniq1476551883169132 uniq1476551883169133 uniq1476551883169134 uniq1476551883169135 uniq1476551883169136 uniq1476551883169137 uniq1476551883169138 uniq1476551883169139" aria-labelledby="uniq1476551883169140"><span class="button__text" id="uniq1476551883169140">Месяц</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq1476551883169128" aria-checked="false">Январь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq1476551883169129" aria-checked="false">Февраль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq1476551883169130" aria-checked="false">Март</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq1476551883169131" aria-checked="false">Апрель</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq1476551883169132" aria-checked="false">Май</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq1476551883169133" aria-checked="false">Июнь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq1476551883169134" aria-checked="false">Июль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq1476551883169135" aria-checked="false">Август</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq1476551883169136" aria-checked="false">Сентябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq1476551883169137" aria-checked="false">Октябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq1476551883169138" aria-checked="false">Ноябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq1476551883169139" aria-checked="false">Декабрь</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"year","text":"Год"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169141 uniq1476551883169142 uniq1476551883169143 uniq1476551883169144 uniq1476551883169145 uniq1476551883169146 uniq1476551883169147 uniq1476551883169148 uniq1476551883169149 uniq1476551883169150 uniq1476551883169151 uniq1476551883169152 uniq1476551883169153 uniq1476551883169154 uniq1476551883169155 uniq1476551883169156 uniq1476551883169157 uniq1476551883169158 uniq1476551883169159 uniq1476551883169160 uniq1476551883169161 uniq1476551883169162 uniq1476551883169163 uniq1476551883169164 uniq1476551883169165 uniq1476551883169166 uniq1476551883169167 uniq1476551883169168 uniq1476551883169169 uniq1476551883169170 uniq1476551883169171 uniq1476551883169172 uniq1476551883169173 uniq1476551883169174 uniq1476551883169175 uniq1476551883169176 uniq1476551883169177 uniq1476551883169178 uniq1476551883169179 uniq1476551883169180" aria-labelledby="uniq1476551883169181"><span class="button__text" id="uniq1476551883169181">Год</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1976}}' role="option" id="uniq1476551883169141" aria-checked="false">1976</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1977}}' role="option" id="uniq1476551883169142" aria-checked="false">1977</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1978}}' role="option" id="uniq1476551883169143" aria-checked="false">1978</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1979}}' role="option" id="uniq1476551883169144" aria-checked="false">1979</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1980}}' role="option" id="uniq1476551883169145" aria-checked="false">1980</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1981}}' role="option" id="uniq1476551883169146" aria-checked="false">1981</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1982}}' role="option" id="uniq1476551883169147" aria-checked="false">1982</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1983}}' role="option" id="uniq1476551883169148" aria-checked="false">1983</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1984}}' role="option" id="uniq1476551883169149" aria-checked="false">1984</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1985}}' role="option" id="uniq1476551883169150" aria-checked="false">1985</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1986}}' role="option" id="uniq1476551883169151" aria-checked="false">1986</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1987}}' role="option" id="uniq1476551883169152" aria-checked="false">1987</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1988}}' role="option" id="uniq1476551883169153" aria-checked="false">1988</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1989}}' role="option" id="uniq1476551883169154" aria-checked="false">1989</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1990}}' role="option" id="uniq1476551883169155" aria-checked="false">1990</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1991}}' role="option" id="uniq1476551883169156" aria-checked="false">1991</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1992}}' role="option" id="uniq1476551883169157" aria-checked="false">1992</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1993}}' role="option" id="uniq1476551883169158" aria-checked="false">1993</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1994}}' role="option" id="uniq1476551883169159" aria-checked="false">1994</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1995}}' role="option" id="uniq1476551883169160" aria-checked="false">1995</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1996}}' role="option" id="uniq1476551883169161" aria-checked="false">1996</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1997}}' role="option" id="uniq1476551883169162" aria-checked="false">1997</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1998}}' role="option" id="uniq1476551883169163" aria-checked="false">1998</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1999}}' role="option" id="uniq1476551883169164" aria-checked="false">1999</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2000}}' role="option" id="uniq1476551883169165" aria-checked="false">2000</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2001}}' role="option" id="uniq1476551883169166" aria-checked="false">2001</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2002}}' role="option" id="uniq1476551883169167" aria-checked="false">2002</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2003}}' role="option" id="uniq1476551883169168" aria-checked="false">2003</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2004}}' role="option" id="uniq1476551883169169" aria-checked="false">2004</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2005}}' role="option" id="uniq1476551883169170" aria-checked="false">2005</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2006}}' role="option" id="uniq1476551883169171" aria-checked="false">2006</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2007}}' role="option" id="uniq1476551883169172" aria-checked="false">2007</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2008}}' role="option" id="uniq1476551883169173" aria-checked="false">2008</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2009}}' role="option" id="uniq1476551883169174" aria-checked="false">2009</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2010}}' role="option" id="uniq1476551883169175" aria-checked="false">2010</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2011}}' role="option" id="uniq1476551883169176" aria-checked="false">2011</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2012}}' role="option" id="uniq1476551883169177" aria-checked="false">2012</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2013}}' role="option" id="uniq1476551883169178" aria-checked="false">2013</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2014}}' role="option" id="uniq1476551883169179" aria-checked="false">2014</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2015}}' role="option" id="uniq1476551883169180" aria-checked="false">2015</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="button button_theme_islands button_size_xl button_view_action button__control dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl datepicker__dropdown i-bem" data-bem='{"button":{},"dropdown":{"id":"uniq147655188316995"}}' role="button" type="button"><span class="icon"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg></span></button>
                            </div>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="country_name" placeholder="Страна проживания"/><span class="input__clear"></span></span>
                            </span><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="city_name" placeholder="Город проживания"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group">
                            <div class="select select_mode_radio-check select_theme_islands select_size_xl i-bem" data-bem='{"select":{"name":"education_type","text":"Образование"}}'>
                                <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169182 uniq1476551883169183 uniq1476551883169184 uniq1476551883169185" aria-labelledby="uniq1476551883169186"><span class="button__text" id="uniq1476551883169186">Образование</span><span class="icon select__tick"></span></button>
                                <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                    <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Среднее"}}' role="option" id="uniq1476551883169182" aria-checked="false">Среднее</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Среднее специальное"}}' role="option" id="uniq1476551883169183" aria-checked="false">Среднее специальное</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Высшее"}}' role="option" id="uniq1476551883169184" aria-checked="false">Высшее</div>
                                        <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":"Другое"}}' role="option" id="uniq1476551883169185" aria-checked="false">Другое</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="education_name" placeholder="Название УО, Cпециальность "/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Музыкальное образование</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="has_music_education" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="has_music_education" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_education_name" placeholder="Название УО, специальность"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_proficiency" placeholder="Владение музыкальным инструментом(ми) каким(ми) и на каком уровне"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Творчество</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="creativity_motivation" placeholder="Что является мотивацией для Вашего развития? (ответ в свободной форме)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="kind_of_activity" placeholder="Вид деятельности на данный момент"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_implementation_style" placeholder="В каком стиле (стилях) предпочитаете исполнять музыку"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Авторские композиции</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Нет" checked="checked" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Профессиональная деятельность</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="professional_activity" placeholder="Профессиональное прошлое (в каких сферах работали и т.д.)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="group_activity_experience" placeholder="Опыт работы в музыкальных коллективах"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Сотрудничаете с каким-либо коллективом на данный момент?</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="current_group_relationship" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="current_group_relationship" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="current_group_relationship_names" placeholder="Укажите название коллектива(ов)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Опыт работы на большой сцене</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="Нет" checked="checked" />
                        </label>
                        </span>
                        <div class="text-label">Опыт работы по контракту</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="Нет" checked="checked" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Медиа</h2>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="photo_attaches"/><span class="button__text">Прикрепить 3-5 фото</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="music_attaches"/><span class="button__text">Прикрепить записи авторской музыки (при наличии)</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="video_links" placeholder="Cсылки на видео в интернете с демонстрацией ваших выступлений (если есть)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Контакты</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="agent_phone" placeholder="Контактный номер телефона (свой или представителя коллектива)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="email" placeholder="Адрес электронной почты"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <button class="button button_type_submit button_view_action button_theme_islands button_size_xl button__control submit i-bem" data-bem='{"button":{},"submit":{}}' role="button" type="submit" name="submit"><span class="button__text">Отправить</span></button>
                    </div>
                </div>
            </form>
        </div>
        <div class="tabs__item tabs__item_closed tabs-item i-bem" data-bem='{"tabs-item":{"id":"tab-3"}}'>
            <form class="profile-form i-bem" data-bem='{"profile-form":{}}' method="post" action="submit.php" enctype="multipart/form-data">
                <div class="profile-form__wrapper">
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Основная информация</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="group_name" placeholder="Название коллектива"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="group_members_name" placeholder="Фамилия Имя Отчество каждого участника"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="datepicker i-bem" data-bem='{"datepicker":{}}'>
                            <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear datepicker__input i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="date_of_birth" placeholder="Дата основания коллектива"/><span class="input__clear"></span></span>
                                </span>
                                <div class="popup popup_theme_islands popup_size_xl popup_autoclosable popup_target_anchor dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl i-bem" data-bem='{"popup":{"directions":["right-center","top-center"]},"dropdown":{"id":"uniq1476551883169188"}}' aria-hidden="true" id="uniq1476551883169188">
                                    <div class="control-group control-group_dropdown" role="group">
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"day","text":"Число"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169189 uniq1476551883169190 uniq1476551883169191 uniq1476551883169192 uniq1476551883169193 uniq1476551883169194 uniq1476551883169195 uniq1476551883169196 uniq1476551883169197 uniq1476551883169198 uniq1476551883169199 uniq1476551883169200 uniq1476551883169201 uniq1476551883169202 uniq1476551883169203 uniq1476551883169204 uniq1476551883169205 uniq1476551883169206 uniq1476551883169207 uniq1476551883169208 uniq1476551883169209 uniq1476551883169210 uniq1476551883169211 uniq1476551883169212 uniq1476551883169213 uniq1476551883169214 uniq1476551883169215 uniq1476551883169216 uniq1476551883169217 uniq1476551883169218 uniq1476551883169219" aria-labelledby="uniq1476551883169220"><span class="button__text" id="uniq1476551883169220">Число</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq1476551883169189" aria-checked="false">1</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq1476551883169190" aria-checked="false">2</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq1476551883169191" aria-checked="false">3</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq1476551883169192" aria-checked="false">4</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq1476551883169193" aria-checked="false">5</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq1476551883169194" aria-checked="false">6</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq1476551883169195" aria-checked="false">7</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq1476551883169196" aria-checked="false">8</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq1476551883169197" aria-checked="false">9</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq1476551883169198" aria-checked="false">10</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq1476551883169199" aria-checked="false">11</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq1476551883169200" aria-checked="false">12</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":13}}' role="option" id="uniq1476551883169201" aria-checked="false">13</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":14}}' role="option" id="uniq1476551883169202" aria-checked="false">14</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":15}}' role="option" id="uniq1476551883169203" aria-checked="false">15</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":16}}' role="option" id="uniq1476551883169204" aria-checked="false">16</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":17}}' role="option" id="uniq1476551883169205" aria-checked="false">17</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":18}}' role="option" id="uniq1476551883169206" aria-checked="false">18</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":19}}' role="option" id="uniq1476551883169207" aria-checked="false">19</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":20}}' role="option" id="uniq1476551883169208" aria-checked="false">20</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":21}}' role="option" id="uniq1476551883169209" aria-checked="false">21</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":22}}' role="option" id="uniq1476551883169210" aria-checked="false">22</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":23}}' role="option" id="uniq1476551883169211" aria-checked="false">23</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":24}}' role="option" id="uniq1476551883169212" aria-checked="false">24</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":25}}' role="option" id="uniq1476551883169213" aria-checked="false">25</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":26}}' role="option" id="uniq1476551883169214" aria-checked="false">26</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":27}}' role="option" id="uniq1476551883169215" aria-checked="false">27</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":28}}' role="option" id="uniq1476551883169216" aria-checked="false">28</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":29}}' role="option" id="uniq1476551883169217" aria-checked="false">29</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":30}}' role="option" id="uniq1476551883169218" aria-checked="false">30</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":31}}' role="option" id="uniq1476551883169219" aria-checked="false">31</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"month","text":"Месяц"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169221 uniq1476551883169222 uniq1476551883169223 uniq1476551883169224 uniq1476551883169225 uniq1476551883169226 uniq1476551883169227 uniq1476551883169228 uniq1476551883169229 uniq1476551883169230 uniq1476551883169231 uniq1476551883169232" aria-labelledby="uniq1476551883169233"><span class="button__text" id="uniq1476551883169233">Месяц</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1}}' role="option" id="uniq1476551883169221" aria-checked="false">Январь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2}}' role="option" id="uniq1476551883169222" aria-checked="false">Февраль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":3}}' role="option" id="uniq1476551883169223" aria-checked="false">Март</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":4}}' role="option" id="uniq1476551883169224" aria-checked="false">Апрель</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":5}}' role="option" id="uniq1476551883169225" aria-checked="false">Май</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":6}}' role="option" id="uniq1476551883169226" aria-checked="false">Июнь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":7}}' role="option" id="uniq1476551883169227" aria-checked="false">Июль</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":8}}' role="option" id="uniq1476551883169228" aria-checked="false">Август</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":9}}' role="option" id="uniq1476551883169229" aria-checked="false">Сентябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":10}}' role="option" id="uniq1476551883169230" aria-checked="false">Октябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":11}}' role="option" id="uniq1476551883169231" aria-checked="false">Ноябрь</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":12}}' role="option" id="uniq1476551883169232" aria-checked="false">Декабрь</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="select select_mode_radio-check select_theme_islands select_size_xl datepicker__select i-bem" data-bem='{"select":{"name":"year","text":"Год"}}'>
                                            <button class="button button_size_xl button_theme_islands button__control select__button i-bem" data-bem='{"button":{}}' role="listbox" type="button" aria-owns="uniq1476551883169234 uniq1476551883169235 uniq1476551883169236 uniq1476551883169237 uniq1476551883169238 uniq1476551883169239 uniq1476551883169240 uniq1476551883169241 uniq1476551883169242 uniq1476551883169243 uniq1476551883169244 uniq1476551883169245 uniq1476551883169246 uniq1476551883169247 uniq1476551883169248 uniq1476551883169249 uniq1476551883169250 uniq1476551883169251 uniq1476551883169252 uniq1476551883169253 uniq1476551883169254 uniq1476551883169255 uniq1476551883169256 uniq1476551883169257 uniq1476551883169258 uniq1476551883169259 uniq1476551883169260 uniq1476551883169261 uniq1476551883169262 uniq1476551883169263 uniq1476551883169264 uniq1476551883169265 uniq1476551883169266 uniq1476551883169267 uniq1476551883169268 uniq1476551883169269 uniq1476551883169270 uniq1476551883169271 uniq1476551883169272 uniq1476551883169273" aria-labelledby="uniq1476551883169274"><span class="button__text" id="uniq1476551883169274">Год</span><span class="icon select__tick"></span></button>
                                            <div class="popup popup_target_anchor popup_theme_islands popup_autoclosable i-bem" data-bem='{"popup":{"directions":["bottom-left","bottom-right","top-left","top-right"]}}' aria-hidden="true">
                                                <div class="menu menu_size_xl menu_theme_islands menu_mode_radio-check menu__control select__menu i-bem" data-bem='{"menu":{}}'>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1976}}' role="option" id="uniq1476551883169234" aria-checked="false">1976</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1977}}' role="option" id="uniq1476551883169235" aria-checked="false">1977</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1978}}' role="option" id="uniq1476551883169236" aria-checked="false">1978</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1979}}' role="option" id="uniq1476551883169237" aria-checked="false">1979</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1980}}' role="option" id="uniq1476551883169238" aria-checked="false">1980</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1981}}' role="option" id="uniq1476551883169239" aria-checked="false">1981</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1982}}' role="option" id="uniq1476551883169240" aria-checked="false">1982</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1983}}' role="option" id="uniq1476551883169241" aria-checked="false">1983</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1984}}' role="option" id="uniq1476551883169242" aria-checked="false">1984</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1985}}' role="option" id="uniq1476551883169243" aria-checked="false">1985</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1986}}' role="option" id="uniq1476551883169244" aria-checked="false">1986</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1987}}' role="option" id="uniq1476551883169245" aria-checked="false">1987</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1988}}' role="option" id="uniq1476551883169246" aria-checked="false">1988</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1989}}' role="option" id="uniq1476551883169247" aria-checked="false">1989</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1990}}' role="option" id="uniq1476551883169248" aria-checked="false">1990</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1991}}' role="option" id="uniq1476551883169249" aria-checked="false">1991</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1992}}' role="option" id="uniq1476551883169250" aria-checked="false">1992</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1993}}' role="option" id="uniq1476551883169251" aria-checked="false">1993</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1994}}' role="option" id="uniq1476551883169252" aria-checked="false">1994</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1995}}' role="option" id="uniq1476551883169253" aria-checked="false">1995</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1996}}' role="option" id="uniq1476551883169254" aria-checked="false">1996</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1997}}' role="option" id="uniq1476551883169255" aria-checked="false">1997</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1998}}' role="option" id="uniq1476551883169256" aria-checked="false">1998</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":1999}}' role="option" id="uniq1476551883169257" aria-checked="false">1999</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2000}}' role="option" id="uniq1476551883169258" aria-checked="false">2000</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2001}}' role="option" id="uniq1476551883169259" aria-checked="false">2001</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2002}}' role="option" id="uniq1476551883169260" aria-checked="false">2002</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2003}}' role="option" id="uniq1476551883169261" aria-checked="false">2003</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2004}}' role="option" id="uniq1476551883169262" aria-checked="false">2004</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2005}}' role="option" id="uniq1476551883169263" aria-checked="false">2005</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2006}}' role="option" id="uniq1476551883169264" aria-checked="false">2006</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2007}}' role="option" id="uniq1476551883169265" aria-checked="false">2007</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2008}}' role="option" id="uniq1476551883169266" aria-checked="false">2008</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2009}}' role="option" id="uniq1476551883169267" aria-checked="false">2009</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2010}}' role="option" id="uniq1476551883169268" aria-checked="false">2010</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2011}}' role="option" id="uniq1476551883169269" aria-checked="false">2011</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2012}}' role="option" id="uniq1476551883169270" aria-checked="false">2012</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2013}}' role="option" id="uniq1476551883169271" aria-checked="false">2013</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2014}}' role="option" id="uniq1476551883169272" aria-checked="false">2014</div>
                                                    <div class="menu-item menu-item_theme_islands i-bem" data-bem='{"menu-item":{"val":2015}}' role="option" id="uniq1476551883169273" aria-checked="false">2015</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <button class="button button_theme_islands button_size_xl button_view_action button__control dropdown dropdown_switcher_button dropdown_theme_islands dropdown_size_xl datepicker__dropdown i-bem" data-bem='{"button":{},"dropdown":{"id":"uniq1476551883169188"}}' role="button" type="button"><span class="icon"><svg fill="#000000" height="24" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg"> <path d="M9 11H7v2h2v-2zm4 0h-2v2h2v-2zm4 0h-2v2h2v-2zm2-7h-1V2h-2v2H8V2H6v2H5c-1.11 0-1.99.9-1.99 2L3 20c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V9h14v11z"/> <path d="M0 0h24v24H0z" fill="none"/> </svg></span></button>
                            </div>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="country_name" placeholder="Страна проживания"/><span class="input__clear"></span></span>
                            </span><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="city_name" placeholder="Город проживания"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_width_available input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="instruments_set" placeholder="Набор инструментов в коллективе"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Творчество</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="creativity_motivation" placeholder="Что является мотивацией для Вашего развития?  (ответ в свободной форме)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="music_implementation_style" placeholder="В каком стиле (стилях) предпочитаете исполнять музыку"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="text-label">Авторские композиции</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Да" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="original_compositions" value="Нет" checked="checked" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Профессиональная деятельность</h2>
                        <div class="text-label">Специализация исполнения</div><span class="checkbox-group checkbox-group_theme_islands checkbox-group_size_xl checkbox-group_type_button control-group i-bem" data-bem='{"checkbox-group":{}}' role="group"><label class="checkbox checkbox_type_button checkbox_theme_islands checkbox_size_xl checkbox_checked i-bem" data-bem='{"checkbox":{}}'><button class="button button_togglable_check button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="checkbox" type="button" aria-checked="true"><span class="button__text">Авторская</span></button>
                        <input class="checkbox__control" type="checkbox" autocomplete="off" name="special_performance" value="Авторская" checked="checked" />
                        </label>
                        <label class="checkbox checkbox_type_button checkbox_theme_islands checkbox_size_xl i-bem" data-bem='{"checkbox":{}}'>
                            <button class="button button_togglable_check button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="checkbox" type="button" aria-checked="false"><span class="button__text">Cover</span></button>
                            <input class="checkbox__control" type="checkbox" autocomplete="off" name="special_performance" value="Cover" />
                        </label>
                        </span>
                        <div class="text-label">Опыт работы на большой сцене</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="1" checked="checked" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="big_scene_experience" value="2" />
                        </label>
                        </span>
                        <div class="text-label">Опыт работы по контракту</div><span class="radio-group radio-group_theme_islands radio-group_size_xl radio-group_type_button control-group i-bem" data-bem='{"radio-group":{}}' role="radiogroup"><label class="radio radio_type_button radio_theme_islands radio_size_xl radio_checked i-bem" data-bem='{"radio":{}}'><button class="button button_togglable_radio button_checked button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="true"><span class="button__text">Да</span></button>
                        <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="1" checked="checked" />
                        </label>
                        <label class="radio radio_type_button radio_theme_islands radio_size_xl i-bem" data-bem='{"radio":{}}'>
                            <button class="button button_togglable_radio button_theme_islands button_size_xl button__control i-bem" data-bem='{"button":{}}' role="button" type="button" aria-pressed="false"><span class="button__text">Нет</span></button>
                            <input class="radio__control" type="radio" autocomplete="off" name="contract_work_experience" value="2" />
                        </label>
                        </span>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Медиа</h2>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="photo_attaches"/><span class="button__text">Прикрепить 3-5 фото</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="attach attach_theme_islands attach_size_xl i-bem" data-bem='{"attach":{}}'><span class="button button_size_xl button_theme_islands button__control i-bem" data-bem='{"button":{}}' role="button"><input class="attach__control" type="file" name="music_attaches"/><span class="button__text">Прикрепить записи авторской музыки (при наличии)</span></span><span class="attach__no-file">Файлы не выбраны</span></span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="video_links" placeholder="Cсылки на видео в интернете с демонстрацией ваших выступлений (если есть)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <h2 class="profile-form__section-head">Контакты</h2>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_width_available input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="agent_phone" placeholder="Контактный номер телефона (свой или представителя коллектива)"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                        <div class="control-group" role="group"><span class="input input_theme_islands input_size_xl input_has-clear i-bem" data-bem='{"input":{}}'><span class="input__box"><input class="input__control" name="email" placeholder="Адрес электронной почты"/><span class="input__clear"></span></span>
                            </span>
                        </div>
                    </div>
                    <div class="profile-form__section-group">
                        <button class="button button_type_submit button_view_action button_theme_islands button_size_xl button__control submit i-bem" data-bem='{"button":{},"submit":{}}' role="button" type="submit" name="submit"><span class="button__text">Отправить</span></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

