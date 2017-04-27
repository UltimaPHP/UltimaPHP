<?php
/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */

abstract class itemLayersDefs {
    /// <summary>
    /// Invalid layer.
    /// </summary>
    const INVALID = 0x00;
    /// <summary>
    /// First valid layer. Equivalent to <c>Layer.OneHanded</c>.
    /// </summary>
    const FIRSTVALID = 0x01;
    /// <summary>
    /// One handed weapon.
    /// </summary>
    const ONEHANDED = 0x01;
    /// <summary>
    /// Two handed weapon or shield.
    /// </summary>
    const TWOHANDED = 0x02;
    /// <summary>
    /// Shoes.
    /// </summary>
    const SHOES = 0x03;
    /// <summary>
    /// Pants.
    /// </summary>
    const PANTS = 0x04;
    /// <summary>
    /// Shirts.
    /// </summary>
    const SHIRT = 0x05;
    /// <summary>
    /// Helmets; hats; and masks.
    /// </summary>
    const HELM = 0x06;
    /// <summary>
    /// Gloves.
    /// </summary>
    const GLOVES = 0x07;
    /// <summary>
    /// Rings.
    /// </summary>
    const RING = 0x08;
    /// <summary>
    /// Talismans.
    /// </summary>
    const TALISMAN = 0x09;
    /// <summary>
    /// Gorgets and necklaces.
    /// </summary>
    const NECK = 0x0A;
    /// <summary>
    /// Hair.
    /// </summary>
    const HAIR = 0x0B;
    /// <summary>
    /// Half aprons.
    /// </summary>
    const WAIST = 0x0C;
    /// <summary>
    /// Torso; inner layer.
    /// </summary>
    const INNERTORSO = 0x0D;
    /// <summary>
    /// Bracelets.
    /// </summary>
    const BRACELET = 0x0E;
    /// <summary>
    /// Unused.
    /// </summary>
    const UNUSED_XF = 0x0F;
    /// <summary>
    /// Beards and mustaches.
    /// </summary>
    const FACIALHAIR = 0x10;
    /// <summary>
    /// Torso; outer layer.
    /// </summary>
    const MIDDLETORSO = 0x11;
    /// <summary>
    /// Earings.
    /// </summary>
    const EARRINGS = 0x12;
    /// <summary>
    /// Arms and sleeves.
    /// </summary>
    const ARMS = 0x13;
    /// <summary>
    /// Cloaks.
    /// </summary>
    const CLOAK = 0x14;
    /// <summary>
    /// Backpacks.
    /// </summary>
    const BACKPACK = 0x15;
    /// <summary>
    /// Torso; outer layer.
    /// </summary>
    const OUTERTORSO = 0x16;
    /// <summary>
    /// Leggings; outer layer.
    /// </summary>
    const OUTERLEGS = 0x17;
    /// <summary>
    /// Leggings; inner layer.
    /// </summary>
    const INNERLEGS = 0x18;
    /// <summary>
    /// Last valid non-internal layer. Equivalent to <c>Layer.InnerLegs</c>.
    /// </summary>
    const LASTUSERVALID = 0x18;
    /// <summary>
    /// Mount item layer.
    /// </summary>
    const MOUNT = 0x19;
    /// <summary>
    /// Vendor 'buy pack' layer.
    /// </summary>
    const SHOPBUY = 0x1A;
    /// <summary>
    /// Vendor 'resale pack' layer.
    /// </summary>
    const SHOPRESALE = 0x1B;
    /// <summary>
    /// Vendor 'sell pack' layer.
    /// </summary>
    const SHOPSELL = 0x1C;
    /// <summary>
    /// Bank box layer.
    /// </summary>
    const BANK = 0x1D;
    /// <summary>
    /// Last valid layer. Equivalent to <c>Layer.Bank</c>.
    /// </summary>
    const LASTVALID = 0x1D;

}

abstract class playerLayerDef {
    /// <summary>
    /// Invalid layer.
    /// </summary>
    const INVALID = 0x00;
    /// <summary>
    /// First valid layer. Equivalent to <c>Layer.OneHanded</c>.
    /// </summary>
    const FIRSTVALID = 0x01;
    /// <summary>
    /// One handed weapon.
    /// </summary>
    const ONEHANDED = 0x01;
    /// <summary>
    /// Two handed weapon or shield.
    /// </summary>
    const TWOHANDED = 0x02;
    /// <summary>
    /// Shoes.
    /// </summary>
    const SHOES = 0x03;
    /// <summary>
    /// Pants.
    /// </summary>
    const PANTS = 0x04;
    /// <summary>
    /// Shirts.
    /// </summary>
    const SHIRT = 0x05;
    /// <summary>
    /// Helmets; hats; and masks.
    /// </summary>
    const HELM = 0x06;
    /// <summary>
    /// Gloves.
    /// </summary>
    const GLOVES = 0x07;
    /// <summary>
    /// Rings.
    /// </summary>
    const RING = 0x08;
    /// <summary>
    /// Talismans.
    /// </summary>
    const TALISMAN = 0x09;
    /// <summary>
    /// Gorgets and necklaces.
    /// </summary>
    const NECK = 0x0A;
    /// <summary>
    /// Hair.
    /// </summary>
    const HAIR = 0x0B;
    /// <summary>
    /// Half aprons.
    /// </summary>
    const WAIST = 0x0C;
    /// <summary>
    /// Torso; inner layer.
    /// </summary>
    const INNERTORSO = 0x0D;
    /// <summary>
    /// Bracelets.
    /// </summary>
    const BRACELET = 0x0E;
    /// <summary>
    /// Unused.
    /// </summary>
    const UNUSED_XF = 0x0F;
    /// <summary>
    /// Unused.
    /// </summary>
    const FACE = 0x0F;
    /// <summary>
    /// Beards and mustaches.
    /// </summary>
    const FACIALHAIR = 0x10;
    /// <summary>
    /// Torso; outer layer.
    /// </summary>
    const MIDDLETORSO = 0x11;
    /// <summary>
    /// Earings.
    /// </summary>
    const EARRINGS = 0x12;
    /// <summary>
    /// Arms and sleeves.
    /// </summary>
    const ARMS = 0x13;
    /// <summary>
    /// Cloaks.
    /// </summary>
    const CLOAK = 0x14;
    /// <summary>
    /// Backpacks.
    /// </summary>
    const BACKPACK = 0x15;
    /// <summary>
    /// Torso; outer layer.
    /// </summary>
    const OUTERTORSO = 0x16;
    /// <summary>
    /// Leggings; outer layer.
    /// </summary>
    const OUTERLEGS = 0x17;
    /// <summary>
    /// Leggings; inner layer.
    /// </summary>
    const INNERLEGS = 0x18;
    /// <summary>
    /// Last valid non-internal layer. Equivalent to <c>Layer.InnerLegs</c>.
    /// </summary>
    const LASTUSERVALID = 0x18;
    /// <summary>
    /// Mount item layer.
    /// </summary>
    const MOUNT = 0x19;
    /// <summary>
    /// Vendor 'buy pack' layer.
    /// </summary>
    const SHOPBUY = 0x1A;
    /// <summary>
    /// Vendor 'resale pack' layer.
    /// </summary>
    const SHOPRESALE = 0x1B;
    /// <summary>
    /// Vendor 'sell pack' layer.
    /// </summary>
    const SHOPSELL = 0x1C;
    /// <summary>
    /// Bank box layer.
    /// </summary>
    const BANK = 0x1D;
    /// <summary>
    /// Last valid layer. Equivalent to <c>Layer.Bank</c>.
    /// </summary>
    const LASTVALID = 0x1D;
}