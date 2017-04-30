<?php

$types = ['t_normal','t_container','t_door','t_key','t_food','t_food_raw','t_armor','t_weapon_mace_smith','t_weapon_mace_sharp','t_weapon_sword','t_weapon_fence','t_weapon_bow','t_wand','t_book','t_rune','t_potion','t_fire','t_clock','t_trap','t_musical','t_spell','t_gem','t_water','t_clothing','t_scroll','t_carpentry','t_moongate','t_chair','t_forge','t_ore','t_log','t_tree','t_rock','t_multi','t_reagent','t_ship','t_ship_plank','t_ship_side','t_ship_tiller','t_fish','t_sand','t_cloth','t_hair','t_beard','t_ingot','t_coin','t_crops','t_drink','t_anvil','t_bed','t_gold','t_map','t_weapon_mace_staff','t_trash_can','t_armor_leather','t_seed','t_junk','t_crystal_ball','t_snow','t_web','t_grass','t_weapon_mace_crook','t_weapon_mace_pick','t_leather','t_spellbook','t_corpse','t_weapon_arrow','t_weapon_bolt','t_deed','t_loom','t_bee_hive','t_archery_butte','t_bandage','t_campfire','t_spy_glass','t_sextant','t_scroll','t_fruit','t_water_wash','t_weapon_axe','t_weapon_crossbow','t_keyring','t_table','t_floor','t_roof','t_feather','t_wool','t_fur','t_blood','t_foliage','t_grain','t_scissors','t_thread','t_yarn','t_spinwheel','t_fish_pole','t_shaft','t_lockpick','t_kindling','t_train_dummy','t_train_pickpocket','t_bedroll','t_hide','t_cloth_bolt','t_board','t_pitcher','t_dye_vat','t_dye','t_mortar','t_hair_dye','t_sewing_kit','t_tinker_tools','t_wall','t_window','t_cotton','t_bone','t_ship_hold','t_lava','t_shield','t_jewelry','t_dirt','t_multi_custom','t_weapon_throwing','t_pilot','t_rope'];
sort($types);

$classes = [];

foreach($types as $type) {
	$tmp = explode("_", str_replace("t_", "", $type));

	$className = $classFileName = $constName = "";
	foreach ($tmp as $x => $val) {
		$className .= ucfirst($val);
		$constName .= strtolower($val) . ($x < (count($tmp) -1) ? "\\" : "");
		$classFileName .= $val;
	}

	$classes[] = $className;

	$file = "<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class Type$className extends Object {
	public function typeStart() {}
}";

	file_put_contents("../core/types/$classFileName.type.php", $file);
	// echo "const TYPE_$constName = \"$className\";\n";
}
