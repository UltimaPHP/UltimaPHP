<?php
class FlowPath {
    /* Directions */
    const DIR_NORTH     = 0x00;
    const DIR_NORTHEAST = 0x01;
    const DIR_EAST      = 0x02;
    const DIR_SOUTHEAST = 0x03;
    const DIR_SOUTH     = 0x04;
    const DIR_SOUTHWEST = 0x05;
    const DIR_WEST      = 0x06;
    const DIR_NORTHWEST = 0x07;

    /* Arrows */
    const ARROW_NORTH     = '⇑';
    const ARROW_NORTHEAST = '⇗';
    const ARROW_EAST      = '⇒';
    const ARROW_SOUTHEAST = '⇘';
    const ARROW_SOUTH     = '⇓';
    const ARROW_SOUTHWEST = '⇙';
    const ARROW_WEST      = '⇐';
    const ARROW_NORTHWEST = '⇖';

    /* Types */
    const TYPE_FREE        = 0x00;
    const TYPE_SOURCE      = 0x01;
    const TYPE_DESTINATION = 0x02;
    const TYPE_WALL        = 0x04;
    const TYPE_AVOID       = 0x08;
    const TYPE_FRIEND      = 0x10;
    const TYPE_ENEMY       = 0x20;

    /* Variables */
    public $map;
    public $mapFlow;
    public $mapPathSteps;
    public $canWalkDiagonally;

    public $steps = 0;

    public $blockX = 0;
    public $blockY = 0;

    public $source;
    public $destination;
    public $reached = false;

    public function __construct($map = [], $canWalkDiagonally = false) {
        $this->canWalkDiagonally = $canWalkDiagonally;
        if (count($map) > 0) {
            $this->setMap($map);
        }
    }

    private function getDirection($from = [], $destination = [], $checkFlow = false, $step = null, $doNotTest = false) {
        $dir = (
            $destination[0] == $from[0] ?
            (
                $destination[1] < $from[1] ?
                FlowPath::DIR_NORTH :
                FlowPath::DIR_SOUTH
            ) : (
                $destination[1] == $from[1] ?
                (
                    $destination[0] < $from[0] ?
                    FlowPath::DIR_WEST :
                    FlowPath::DIR_EAST
                ) : (
                    $destination[0] < $from[0] ?
                    (
                        $destination[1] < $from[1] ?
                        FlowPath::DIR_NORTHWEST :
                        FlowPath::DIR_SOUTHWEST
                    ) : (
                        $destination[1] < $from[1] ?
                        FlowPath::DIR_NORTHEAST :
                        FlowPath::DIR_SOUTHEAST
                    )
                )
            )
        );

        /* Test if can go to the desired direction */
        if (!$doNotTest && !$this->canGoTo($from, $dir, $checkFlow, $step)) {
            $dir = $this->getBestDirection($from, $dir, $checkFlow, $step);
        }
        return $dir;
    }

    private function getBestDirection($from = [], $direction = 0, $checkFlow = false, $step = null) {
        $actual = $direction;
        for ($test = 0; $test <= 7; $test++) {
            if ($this->canGoTo($from, $actual, $checkFlow, $step)) {
                return $actual;
            } else {
                $actual++;
                if ($actual > 7) {
                    $actual = 0;
                }
            }
        }

        /* Can't go any where */
        return false;
    }

    public function canGoTo($from = [], $direction = 0, $checkFlow = false, $step = null) {
        if (!$checkFlow) {
            if ($this->getNodeFrom($from, $direction) === FlowPath::TYPE_WALL) {
                return false;
            }
            return true;
        }

        $stepT = $this->getFlowNodeFrom($from, $direction);

        if ($stepT != $step) {
            return false;
        }
        return true;
    }

    public function setMap($map = []) {
        $this->map         = $map;
        $this->blockX      = count($map[0]);
        $this->blockY      = count($map);
        $this->source      = $this->getSource();
        $this->destination = $this->getDestination();
        $this->mapFlow     = [];

        /* Build the empty map flow */
        for ($x = 0; $x < $this->blockX; $x++) {
            for ($y = 0; $y < $this->blockY; $y++) {
                $this->mapFlow[$y][$x] = ($this->map[$y][$x] == FlowPath::TYPE_SOURCE || $this->map[$y][$x] == FlowPath::TYPE_DESTINATION || $this->map[$y][$x] == FlowPath::TYPE_WALL ? -1 : 0);
            }
        }

        $this->calculateMapFlow();
        $this->calculateMapPath();
    }

    public function dumpFlow() {
        echo "\t  X";
        for ($x = 0; $x < $this->blockX; $x++) {
            echo "|" . str_pad($x, 2, "0", STR_PAD_LEFT);
        }
        echo "\n\t Y ";
        for ($x = 0; $x < $this->blockX; $x++) {
            echo "---";
        }
        echo "\n";

        for ($y = 0; $y < $this->blockY; $y++) {
            echo "\t" . str_pad($y, 2, "0", STR_PAD_LEFT) . " |";
            for ($x = 0; $x < $this->blockX; $x++) {
                echo ($x > 0 ? " " : "");

                if ($this->map[$y][$x] == 1) {
                    echo "S ";
                } else if ($this->map[$y][$x] == 2) {
                    echo "D ";
                } else if ($this->mapFlow[$y][$x] == -1) {
                    echo "⛆⛆";
                } else {
                    echo str_pad($this->mapFlow[$y][$x], 2, "0", STR_PAD_LEFT);
                }
            }
            echo "\n";
        }
    }

    public function getPath() {
        $ret = [];

        $from = $this->source;

        if (!$this->mapPathSteps || empty($this->mapPathSteps)) {
            return false;
        }
        
        foreach ($this->mapPathSteps as $stepId => $node) {
            $ret[] = $this->getDirection($from, $node);
            $from = $node;
        }

        $ret[] = $this->getDirection($from, $this->destination);
        
        return $ret;
    }

    public function dumpPath($return = false) {
        if (!$return) {
            echo "\t  X";
        } else {
            $ret = "\t  X";
        }
        for ($x = 0; $x < $this->blockX; $x++) {
            if (!$return) {
                echo "|" . ($x > 9 ? ($x % 10) : $x);
            } else {
                $ret .= "|" . ($x > 9 ? ($x % 10) : $x);
            }
        }
        if (!$return) {
            echo "\n\tY  ";
        } else {
            $ret .= "\n\tY  ";
        }
        for ($x = 0; $x < $this->blockX; $x++) {
            if (!$return) {
                echo "--";
            } else {
                $ret .= "--";
            }
        }
        if (!$return) {
            echo "\n";
        } else {
            $ret .= "\n";
        }

        for ($y = 0; $y < $this->blockY; $y++) {
            if (!$return) {
                echo "\t" . ($y > 9 ? ($y % 10) : $y) . " |";
            } else {
                $ret .= "\t" . ($y > 9 ? ($y % 10) : $y) . " |";
            }
            for ($x = 0; $x < $this->blockX; $x++) {
                if (!$return) {
                    echo ($x > 0 ? " " : "");
                } else {
                    $ret .= ($x > 0 ? " " : "");
                }

                if ($this->map[$y][$x] == 1) {
                    if (!$return) {
                        echo "S";
                    } else {
                        $ret .= "S";
                    }
                } else if ($this->map[$y][$x] == 2) {
                    if (!$return) {
                        echo "D";
                    } else {
                        $ret .= "D";
                    }
                } else if ($this->mapFlow[$y][$x] == -1) {
                    if (!$return) {
                        echo "X";
                    } else {
                        $ret .= "X";
                    }
                } else {
                    $dir = null;
                    if ($this->mapPathSteps !== null) {
                        foreach ($this->mapPathSteps as $sk => $step) {
                            if ($step[1] == $y && $step[0] == $x) {
                                if ($sk == 0) {
                                    $dir = $this->getDirection($this->source, [$x, $y]);
                                } else if ($sk == count($this->mapPathSteps) - 1) {
                                    $dir = $this->getDirection([$x, $y], $this->destination);
                                } else {
                                    $dir = $this->getDirection($this->mapPathSteps[$sk - 1], $step);
                                }
                            }
                        }
                    }

                    if ($dir === null) {
                        if (!$return) {
                            echo " ";
                        } else {
                            $ret .= " ";
                        }
                    } else {
                        if (!$return) {
                            echo $this->getDirArrow($dir);
                        } else {
                            $ret .= $this->getDirArrow($dir);
                        }
                    }
                }
            }
            if (!$return) {
                echo "\n";
            } else {
                $ret .= "\n";
            }
        }

        if ($return) {
            return $ret;
        }
    }

    public function calculateMapPath() {
        if ($this->steps == 0) {
            $min = 9999999;
            foreach ($this->getAroundFlowNodes($this->source) as $node) {
                if ($node[3] <= 0) {
                    continue;
                }

                if ($node[3] < $min) {
                    $min = $node[3];
                }
            }
            $this->steps = $min;
        }

        $this->getPathFromFlow();
    }

    public function getPathFromFlow($from = null, $steps = null) {
        if ($from === null) {
            $from = $this->source;
        }

        if ($steps === null) {
            $steps = $this->steps;
        }

        $dir  = $this->getDirection($from, $this->destination, true, $steps);
        $next = $this->getFlowNodeFrom($from, $dir);

        if ($next == $steps) {
            $nDir = $this->getNodeDir($from, $dir);
            $this->mapPathSteps[] = $nDir;
            $this->getPathFromFlow($nDir, $steps - 1);
        }
    }

    public function getNodeDir($from, $dir) {
        return $this->getAroundNodes($from)[$dir];
    }

    public function calculateMapFlow($from = null) {
        if ($from === null) {
            $from = $this->destination;
        }

        /* Creates the step one around destination */
        $nodes = $this->getAroundNodes($from);

        foreach ($nodes as $dir => $node) {
            if ($node[3] == FlowPath::TYPE_SOURCE) {
                $this->reached = true;
                continue;
            }

            if ($node[0] < 0 || $node[0] > $this->blockX || $node[1] < 0 || $node[1] > $this->blockY || $node[3] == FlowPath::TYPE_WALL) {
                continue;
            }

            if ($this->mapFlow[$node[1]][$node[0]] > 1 || $this->mapFlow[$node[1]][$node[0]] == FlowPath::TYPE_FREE) {
                $this->mapFlow[$node[1]][$node[0]] = 1;
            }
        }

        $this->doMapFlow(2);
    }

    public function doMapFlow($actualStep = 1) {
        $new = false;
        foreach ($this->getNodeStep($actualStep-1) as $node) {
            if ($node[0] < 0 || $node[0] > $this->blockX || $node[1] < 0 || $node[1] > $this->blockY) {
                continue;
            }

            $nodes = $this->getAroundNodes($node);

            foreach ($nodes as $dir => $node) {
                if ($node[3] & FlowPath::TYPE_SOURCE) {
                    $this->reached = true;
                    continue;
                }

                if ($node[0] < 0 || $node[0] > $this->blockX || $node[1] < 0 || $node[1] > $this->blockY || $node[3] == FlowPath::TYPE_WALL) {
                    continue;
                }

                if ($this->mapFlow[$node[1]][$node[0]] > $actualStep || $this->mapFlow[$node[1]][$node[0]] == FlowPath::TYPE_FREE) {
                    $this->mapFlow[$node[1]][$node[0]] = $actualStep;
                    $new                               = true;
                }
            }
        }

        if ($new && !$this->reached) {
            $this->doMapFlow($actualStep+1);
        }
    }

    public function getNodeStep($stepNum = false) {
        $ret = [];
        for ($x = 0; $x < $this->blockX; $x++) {
            for ($y = 0; $y < $this->blockY; $y++) {
                if ($this->mapFlow[$y][$x] == $stepNum) {
                    $ret[] = [0 => $x, 1 => $y];
                }
            }
        }
        return $ret;
    }

    public function getSource() {
        for ($x = 0; $x < $this->blockX; $x++) {
            for ($y = 0; $y < $this->blockY; $y++) {
                if ($this->map[$y][$x] == 1) {
                    return [0 => $x, 1 => $y];
                }
            }
        }
    }

    public function getDestination() {
        for ($x = 0; $x < $this->blockX; $x++) {
            for ($y = 0; $y < $this->blockY; $y++) {
                if ($this->map[$y][$x] == 2) {
                    return [0 => $x, 1 => $y];
                }
            }
        }
    }

    public function getNodeFrom($from = [], $direction) {
        switch ($direction) {
            case self::DIR_NORTH:
                if (!isset($this->map[($from[1] - 1)]) || !isset($this->map[($from[1] - 1)][($from[0])])) {
                    return FlowPath::TYPE_WALL;
                }

                return (isset($this->map[($from[1] - 1)][($from[0])]) ? $this->map[($from[1] - 1)][($from[0])] : FlowPath::TYPE_WALL);
            case self::DIR_NORTHEAST:
                if (!isset($this->map[$from[1] - 1]) || !isset($this->map[$from[1] - 1][$from[0] + 1])) {
                    return FlowPath::TYPE_WALL;
                }
                $node = (isset($this->map[($from[1] - 1)][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1] - 1)][($from[0] + 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                $test1 = (isset($this->map[($from[1] - 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->map[($from[1] - 1)][($from[0])] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);
                $test2 = (isset($this->map[($from[1])][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1])][($from[0] + 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                if ($test1 == 0 && $test2 == 0) {
                    return $node;
                } else {
                    return FlowPath::TYPE_WALL;
                }
            case self::DIR_EAST:
                if (!isset($this->map[$from[1]]) || !isset($this->map[$from[1]][$from[0] + 1])) {
                    return FlowPath::TYPE_WALL;
                }
                return (isset($this->map[($from[1])][($from[0] + 1)]) ? $this->map[($from[1])][($from[0] + 1)] : FlowPath::TYPE_WALL);
            case self::DIR_SOUTHEAST:
                if (!isset($this->map[$from[1] + 1]) || !isset($this->map[$from[1] + 1][$from[0] + 1])) {
                    return FlowPath::TYPE_WALL;
                }
                $node = (isset($this->map[($from[1] + 1)][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1] + 1)][($from[0] + 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                $test1 = (isset($this->map[($from[1])][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1])][($from[0] + 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);
                $test2 = (isset($this->map[($from[1] + 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->map[($from[1] + 1)][($from[0])] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                if ($test1 == 0 && $test2 == 0) {
                    return $node;
                } else {
                    return FlowPath::TYPE_WALL;
                }

            case self::DIR_SOUTH:
                if (!isset($this->map[$from[1] + 1]) || !isset($this->map[$from[1] + 1][$from[0]])) {
                    return FlowPath::TYPE_WALL;
                }
                return (isset($this->map[($from[1] + 1)][($from[0])]) ? $this->map[($from[1] + 1)][($from[0])] : FlowPath::TYPE_WALL);
            case self::DIR_SOUTHWEST:
                if (!isset($this->map[($from[1] - 1)]) || !isset($this->map[($from[1]-1)][($from[0] - 1)])) {
                    return FlowPath::TYPE_WALL;
                }
                $node = (isset($this->map[($from[1] + 1)][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1] + 1)][($from[0] - 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                $test1 = (isset($this->map[($from[1])][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1])][($from[0] - 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);
                $test2 = (isset($this->map[($from[1] + 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->map[($from[1] + 1)][($from[0])] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                if ($test1 == 0 && $test2 == 0) {
                    return $node;
                } else {
                    return FlowPath::TYPE_WALL;
                }
            case self::DIR_WEST:
                if (!isset($this->map[$from[1]]) || !isset($this->map[$from[1]][$from[0] - 1])) {
                    return FlowPath::TYPE_WALL;
                }
                return (isset($this->map[($from[1])][($from[0] - 1)]) ? $this->map[($from[1])][($from[0] - 1)] : FlowPath::TYPE_WALL);
            case self::DIR_NORTHWEST:
                if (!isset($this->map[$from[1] - 1]) || !isset($this->map[$from[1] - 1][$from[0] - 1])) {
                    return FlowPath::TYPE_WALL;
                }
                $node = (isset($this->map[($from[1] - 1)][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1] - 1)][($from[0] - 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                $test1 = (isset($this->map[($from[1] - 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->map[($from[1] - 1)][($from[0])] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);
                $test2 = (isset($this->map[($from[1])][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->map[($from[1])][($from[0] - 1)] : FlowPath::TYPE_WALL) : FlowPath::TYPE_WALL);

                if ($test1 == 0 && $test2 == 0) {
                    return $node;
                } else {
                    return FlowPath::TYPE_WALL;
                }
            default:
                return false;
        }
    }

    public function getAroundNodes($from = []) {
        return [
            self::DIR_NORTH     => [0 => ($from[0]), 1 => ($from[1] - 1), 3 => $this->getNodeFrom($from, self::DIR_NORTH)],
            self::DIR_NORTHEAST => [0 => ($from[0] + 1), 1 => ($from[1] - 1), 3 => $this->getNodeFrom($from, self::DIR_NORTHEAST)],
            self::DIR_EAST      => [0 => ($from[0] + 1), 1 => ($from[1]), 3 => $this->getNodeFrom($from, self::DIR_EAST)],
            self::DIR_SOUTHEAST => [0 => ($from[0] + 1), 1 => ($from[1] + 1), 3 => $this->getNodeFrom($from, self::DIR_SOUTHEAST)],
            self::DIR_SOUTH     => [0 => ($from[0]), 1 => ($from[1] + 1), 3 => $this->getNodeFrom($from, self::DIR_SOUTH)],
            self::DIR_SOUTHWEST => [0 => ($from[0] - 1), 1 => ($from[1] + 1), 3 => $this->getNodeFrom($from, self::DIR_SOUTHWEST)],
            self::DIR_WEST      => [0 => ($from[0] - 1), 1 => ($from[1]), 3 => $this->getNodeFrom($from, self::DIR_WEST)],
            self::DIR_NORTHWEST => [0 => ($from[0] - 1), 1 => ($from[1] - 1), 3 => $this->getNodeFrom($from, self::DIR_NORTHWEST)],
        ];
    }

    public function getFlowNodeFrom($from = [], $direction) {
        switch ($direction) {
            case self::DIR_NORTH:
                return (isset($this->mapFlow[($from[1] - 1)][($from[0])]) ? $this->mapFlow[($from[1] - 1)][($from[0])] : -1);
            case self::DIR_NORTHEAST:
                $node = (isset($this->mapFlow[($from[1] - 1)][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] - 1)][($from[0] + 1)] : -1) : -1);

                if (!isset($this->mapFlow[($from[1] - 1)]) || !isset($this->mapFlow[$from[0]])) {
                    return -1;
                }
                if (!isset($this->mapFlow[($from[1])]) || !isset($this->mapFlow[$from[0] + 1])) {
                    return -1;
                }

                $test1 = (isset($this->mapFlow[($from[1] - 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] - 1)][($from[0])] : -1) : -1);
                $test2 = (isset($this->mapFlow[($from[1])][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1])][($from[0] + 1)] : -1) : -1);

                if ($node != -1 && $test1 != -1 && $test2 != -1) {
                    return $node;
                } else {
                    return -1;
                }
            case self::DIR_EAST:
                return (isset($this->mapFlow[($from[1])][($from[0] + 1)]) ? $this->mapFlow[($from[1])][($from[0] + 1)] : -1);
            case self::DIR_SOUTHEAST:
                $node = (isset($this->mapFlow[($from[1] + 1)][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] + 1)][($from[0] + 1)] : -1) : -1);

                if (!isset($this->mapFlow[($from[1])]) || !isset($this->mapFlow[$from[0] + 1])) {
                    return -1;
                }
                if (!isset($this->mapFlow[($from[1] + 1)]) || !isset($this->mapFlow[$from[0]])) {
                    return -1;
                }

                $test1 = (isset($this->mapFlow[($from[1])][($from[0] + 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1])][($from[0] + 1)] : -1) : -1);
                $test2 = (isset($this->mapFlow[($from[1] + 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] + 1)][($from[0])] : -1) : -1);

                if ($node != -1 && $test1 != -1 && $test2 != -1) {
                    return $node;
                } else {
                    return -1;
                }
            case self::DIR_SOUTH:
                return (isset($this->mapFlow[($from[1] + 1)][($from[0])]) ? $this->mapFlow[($from[1] + 1)][($from[0])] : -1);
            case self::DIR_SOUTHWEST:
                $node = (isset($this->mapFlow[($from[1] + 1)][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] + 1)][($from[0] - 1)] : -1) : -1);

                if (!isset($this->mapFlow[($from[1])]) || !isset($this->mapFlow[$from[0] - 1])) {
                    return -1;
                }
                if (!isset($this->mapFlow[($from[1] + 1)]) || !isset($this->mapFlow[$from[0]])) {
                    return -1;
                }

                $test1 = (isset($this->mapFlow[($from[1])][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1])][($from[0] - 1)] : -1) : -1);
                $test2 = (isset($this->mapFlow[($from[1] + 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] + 1)][($from[0])] : -1) : -1);

                if ($node != -1 && $test1 != -1 && $test2 != -1) {
                    return $node;
                } else {
                    return -1;
                }
            case self::DIR_WEST:
                return (isset($this->mapFlow[($from[1])][($from[0] - 1)]) ? $this->mapFlow[($from[1])][($from[0] - 1)] : -1);
            case self::DIR_NORTHWEST:
                $node = (isset($this->mapFlow[($from[1] - 1)][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] - 1)][($from[0] - 1)] : -1) : -1);

                if (!isset($this->mapFlow[($from[1] - 1)]) || !isset($this->mapFlow[$from[0]])) {
                    return -1;
                }
                if (!isset($this->mapFlow[($from[1])]) || !isset($this->mapFlow[$from[0] -1])) {
                    return -1;
                }
                $test1 = (isset($this->mapFlow[($from[1] - 1)][($from[0])]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1] - 1)][($from[0])] : -1) : -1);
                $test2 = (isset($this->mapFlow[($from[1])][($from[0] - 1)]) ? ($this->canWalkDiagonally ? $this->mapFlow[($from[1])][($from[0] - 1)] : -1) : -1);

                if ($node != -1 && $test1 != -1 && $test2 != -1) {
                    return $node;
                } else {
                    return -1;
                }
            default:
                return false;
        }
    }

    public function getAroundFlowNodes($from = []) {
        $ret = [
            self::DIR_NORTH     => [0 => ($from[0]), 1 => ($from[1] - 1), 3 => $this->getFlowNodeFrom($from, self::DIR_NORTH)],
            self::DIR_NORTHEAST => [0 => ($from[0] + 1), 1 => ($from[1] - 1), 3 => $this->getFlowNodeFrom($from, self::DIR_NORTHEAST)],
            self::DIR_EAST      => [0 => ($from[0] + 1), 1 => ($from[1]), 3 => $this->getFlowNodeFrom($from, self::DIR_EAST)],
            self::DIR_SOUTHEAST => [0 => ($from[0] + 1), 1 => ($from[1] + 1), 3 => $this->getFlowNodeFrom($from, self::DIR_SOUTHEAST)],
            self::DIR_SOUTH     => [0 => ($from[0]), 1 => ($from[1] + 1), 3 => $this->getFlowNodeFrom($from, self::DIR_SOUTH)],
            self::DIR_SOUTHWEST => [0 => ($from[0] - 1), 1 => ($from[1] + 1), 3 => $this->getFlowNodeFrom($from, self::DIR_SOUTHWEST)],
            self::DIR_WEST      => [0 => ($from[0] - 1), 1 => ($from[1]), 3 => $this->getFlowNodeFrom($from, self::DIR_WEST)],
            self::DIR_NORTHWEST => [0 => ($from[0] - 1), 1 => ($from[1] - 1), 3 => $this->getFlowNodeFrom($from, self::DIR_NORTHWEST)],
        ];

        foreach ($ret as $nk => $node) {
            if ($node[3] <= 0) {
                unset($ret[$nk]);
                continue;
            }
        }

        return $ret;
    }

    public function getDirArrow($direction) {
        switch ($direction) {
            case self::DIR_NORTH:
                return self::ARROW_NORTH;
            case self::DIR_NORTHEAST:
                return self::ARROW_NORTHEAST;
            case self::DIR_EAST:
                return self::ARROW_EAST;
            case self::DIR_SOUTHEAST:
                return self::ARROW_SOUTHEAST;
            case self::DIR_SOUTH:
                return self::ARROW_SOUTH;
            case self::DIR_SOUTHWEST:
                return self::ARROW_SOUTHWEST;
            case self::DIR_WEST:
                return self::ARROW_WEST;
            case self::DIR_NORTHWEST:
                return self::ARROW_NORTHWEST;
            default:
                return;
        }
    }
}