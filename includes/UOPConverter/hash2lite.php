<?php
function hashLittle2($inStr) {
    //echo $inStr;
    //echo "\n";
    // $inStr  hash Input
    // $c IN main Start Integer
    // $b IN second Start Integer

    $length = strlen($inStr);
    $a = $b = $c = 3735928559 + $length;
    // 3735928559 = 0xDEADBEEF

    //roll through inStr one byte at a time until length is less than 13
    $i = 0; // Use increase $i to push to next byte
    while ($length > 12) {
        $a += ord($inStr[$i]);
        $a += ord($inStr[$i + 1]) << 8;
        $a += ord($inStr[$i + 2]) << 16;
        $a += ord($inStr[$i + 3]) << 24;
        $b += ord($inStr[$i + 4]);
        $b += ord($inStr[$i + 5]) << 8;
        $b += ord($inStr[$i + 6]) << 16;
        $b += ord($inStr[$i + 7]) << 24;
        $c += ord($inStr[$i + 8]);
        $c += ord($inStr[$i + 9]) << 8;
        $c += ord($inStr[$i + 10]) << 16;
        $c += ord($inStr[$i + 11]) << 24;

        $a = castUInt($a);
        $b = castUInt($b);
        $c = castUInt($c);

        $a -= $c;
        $a ^= ($c << 4) | ($c >> 28); //rot($c,4);
        $c += $b;

        $a = castUInt($a);

        $b -= $a;
        $b ^= ($a << 6) | ($a >> 26); //rot($a,6);
        $a += $c;

        $b = castUInt($b);

        $c -= $b;
        $c ^= ($b << 8) | ($b >> 24); //rot($b,8);
        $b += $a;

        $c = castUInt($c);

        $a -= $c;
        $a ^= ($c << 16) | ($c >> 16); //rot($c,16);
        $c += $b;

        $a = castUInt($a);
        $b = castUInt($b);
        $c = castUInt($c);

        $b -= $a;
        $b ^= ($a << 19) | ($a >> 13); //rot($a,19);
        $a += $c;

        $b = castUInt($b);

        $c -= $b;
        $c ^= ($b << 4) | ($b >> 28); //rot($b,4);
        $b += $a;

        $length -= 12;
        $i += 12;
    }

    $a = castUInt($a);
    $c = castUInt($c);
    $b = castUInt($b);

    if ($length != 0) {
        switch ($length) {
            // add each remaining byte according to length left
            case 12:$c += ord($inStr[$i + 11]) << 24;
            case 11:$c += ord($inStr[$i + 10]) << 16;
            case 10:$c += ord($inStr[$i + 9]) << 8;
            case 9:$c += ord($inStr[$i + 8]);
                $c = castUInt($c);

            case 8:$b += ord($inStr[$i + 7]) << 24;
            case 7:$b += ord($inStr[$i + 6]) << 16;
            case 6:$b += ord($inStr[$i + 5]) << 8;
            case 5:$b += ord($inStr[$i + 4]);
                $b = castUInt($b);

            case 4:$a += ord($inStr[$i + 3]) << 24;
            case 3:$a += ord($inStr[$i + 2]) << 16;
            case 2:$a += ord($inStr[$i + 1]) << 8;
            case 1:$a += ord($inStr[$i]);
                $a = castUInt($a);

                break;
                //case 0:return array($c, $b, $a); // do NOT finalize if there are no changes (additions)
        }

        //final($a,$b,$c);
        $c ^= $b;
        $c -= ($b << 14) | ($b >> 18); //rot($b,14);
        $c = castUInt($c);

        $a ^= $c;
        $a -= ($c << 11) | ($c >> 21); //rot($c,11);
        $a = castUInt($a);

        $b ^= $a;
        $b -= ($a << 25) | ($a >> 7); //rot($a,25);
        $b = castUInt($b);

        $c ^= $b;
        $c -= ($b << 16) | ($b >> 16); //rot($b,16);
        $c = castUInt($c);

        $a ^= $c;
        $a -= ($c << 4) | ($c >> 28); //rot($c,4);
        $a = castUInt($a);

        $b ^= $a;
        $b -= ($a << 14) | ($a >> 18); //rot($a,14);
        $b = castUInt($b);

        $c ^= $b;
        $c -= ($b << 24) | ($b >> 8); //rot($b,24);
        $c = castUInt($c);
    }
    // print_r([$a, $b, $c]);
    //echo $a . ' - ' . $b . ' - ' . $c . "\n";

    $z = gmp_shiftl($b, 32);
    $z = gmp_or($c, $z);
    return gmp_strval($z);
}

function castUInt($x) {
    $x &= 0xFFFFFFFF;
    return $x;
}

function gmp_shiftl($x, $n) { // shift left
    return (gmp_mul($x, gmp_pow(2, $n)));
}

// HashLittle2("build/map0legacymul/00000000.dat");
// HashLittle2("build/map0legacymul/00000001.dat");
