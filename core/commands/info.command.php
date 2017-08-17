<?php

/**
 * Ultima PHP - OpenSource Ultima Online Server written in PHP
 * Version: 0.1 - Pre Alpha
 */
class InfoCommand extends Command {
    public function __construct($client, $args = []) {

        if ($client === null) {
            return false;
        }
        
        if (isset($args[0]) && $args[0] == "gump") {
            //$packet = "DD03F300C4D746000003F7000000000000000000000144000003B2789C7D93DD6EC3200C85F7287E046C6C7E1EA7EB505BADEDAA964AD3A2BCFBCC4216E0A272C8C5779C83B1C9744F8FD34FBA9DF66003200944320698052886793A3C2F3715F3E99C3E400CA008A037405697231E32889714B2D4A4EC8F69FF99EEF9BEBB3E0693FFEF8105C133A061C6793AE6CBB9282004A8466C029081BF98A79CBE334435F216104BCAC6C854460DB395D986B9CA7863962A938649656E9EDE9F397F5DC1979D1D10A22FAFA04561296B93C9F4320DB2ED653BC8AE97B9972DB53296DD3B59469986110C536A7A12EB597D574E1C0DB58DB7DD21413B28621D9EE8944A75C41034B6B2D944BD60AAB2DAF0E2C2D5855EB8448DD72E525DD6D192D47BA18743D3C21816880D24AA99D442AE99AD27AD9EDCC2D5531A68574FD7C2D5D3575898B6DB79C0508FC05D236C6D4459FABFC4F298F9ED173B0DF9ED00000014000002900000069E789C8D544D6FD340101D242A55B412A2670E96903805CB8E9A162A8454B5548DA034820A0E88839B98D410C7A9ED7E70E037F11779F36613AF9520226B93DDD937F36666DFAE3C97D7329454A652E3B79437728CDF44C652C016C827B9C2AA9411E62F302EA42B876E7E0A8F89CC303B63841B79227D600319D02769613E226221B96CC95B606F2523C6B063A0B6C095224645D61AD69AABC7AD55804C8A565E0F31CF98FD869C60AF042E974DE7F51D9FD6553DD858AAD4729D2D725D9D6F88F911F62AF28EB05F61FCC008C0BB4E8400BC1360AF91997AA5B49DCB4FE07F317E63ED62E4C06A376B786BC5B7F00FC86A2C3519527068B55AA5F6A4D3CA53B3AC9967C288862C163CB1442EE6184C534630AE825DFA3F9F655D92A972B6902793BA3E696F0AE79FD3DB7CAC1ECB30C3CA9096D717A70ACD586374A89002B88A8A4C61ED3885CCD7F38853F8166B641ECAEF252DACD6A4E9FC9031E76A6A7866F4CD9DFA02A86FC2131FB9FA9B38153B6359CE5C655A63C2CE1B67EC9464BC095593703790DE922A4C95FF5695AFCAD4AB2D94A7F201F3217007D83B5E9CC3945E5A6F1FD60366D49557D04984D91EBE1D76BD747B111574CAEA2BCFB6037FEDAB8F3A63A5490BA5CCF72D94DDD8DCB36DCA3BC49FE03386481ED14F5F83AB05EB2EAC27F44C69E9CA3E462CDBF04E78423EB37ECFC075E37A5C30DBA4A59BCFA861E0CEAA742795F17EC4EC59C67B16CA9F251DAD7AABD679514344BA74116640A4BC599A095F2F309A7704640F673182AF9EE318D81AFDD1B3FB2AEF9D46EEE51BD697B4DEF10B11A3893BE4BB94F3E6EBF9E92BA477A9F6F2B8F06EED3976ADB37BF2D2C31CB95AEC247AD8DF05A2D9EFBBBB3FDF574545F8DFF7300364AF8AB53A1BAE58C2BF872F156B";            
            //Sockets::out($client, $packet);            
            $teste = new gump_test($client);
            $teste->show();
            
            return true;
        }

        if (isset($args[0]) && $args[0] == "around") {
            $position = UltimaPHP::$socketClients[$client]['account']->player->position;

            print_r([
                "NORTH"     => Map::getTerrainLand($position['x'], $position['y'] - 1, $position['z'], $position['map']),
                "NORTHEAST" => Map::getTerrainLand($position['x'] + 1, $position['y'] - 1, $position['z'], $position['map']),
                "EAST"      => Map::getTerrainLand($position['x'] + 1, $position['y'], $position['z'], $position['map']),
                "SOUTHEAST" => Map::getTerrainLand($position['x'] + 1, $position['y'] + 1, $position['z'], $position['map']),
                "SOUTH"     => Map::getTerrainLand($position['x'], $position['y'] + 1, $position['z'], $position['map']),
                "SOUTHWEST" => Map::getTerrainLand($position['x'] - 1, $position['y'] + 1, $position['z'], $position['map']),
                "WEST"      => Map::getTerrainLand($position['x'] - 1, $position['y'], $position['z'], $position['map']),
                "NORTHWEST" => Map::getTerrainLand($position['x'] - 1, $position['y'] - 1, $position['z'], $position['map']),
                "CENTER"    => Map::getTerrainLand($position['x'], $position['y'], $position['z'], $position['map']),
            ]);
            return true;
        }

        if (isset($args[0]) && $args[0] == "layers") {
            print_r(UltimaPHP::$socketClients[$client]['account']->player->layers[LayersDefs::BACKPACK]);
            return true;
        }

        if (isset($args[0]) && $args[0] == "serial") {
            print_r(Map::$serialData);
            print_r(Map::$serialDataHolded);
            return true;
        }

        if (isset($args[0]) && $args[0] == "chunk") {
            $chunk     = Map::getChunk(UltimaPHP::$socketClients[$client]['account']->player->position['x'], UltimaPHP::$socketClients[$client]['account']->player->position['y']);
            $chunkData = Map::$chunks[UltimaPHP::$socketClients[$client]['account']->player->position['map']][$chunk['x']][$chunk['y']];

            echo "Printing data from chunk position: \n";
            print_r(UltimaPHP::$socketClients[$client]['account']->player->position);
            print_r($chunkData);

            return true;
        }

        UltimaPHP::$socketClients[$client]['account']->player->attachTarget($client, ['method' => "InfoCommandCallback", 'args' => []]);
        return true;
    }
}