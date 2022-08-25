<?php

namespace App;

class TestAlgorithm {

    public function __construct() {
        $this->test();
    }

    private function test() {
        $tests = [
            [5, 2, 4, 6, 3, 7], // 5
            [5, 3, 1, 2, 4, 1], // 2
            [4, 2, 1, 2, 4], // 4
            [2, 2, 1, 2, 4, 2, 6] // 3
        ];

        foreach ($tests as $test) {
            $solution = $this->solution($test);
        }
    }

    private function solution($A) {
        $minInputLength = 5;
        $minsMaxLength = 4;
        $length = count($A);
        $mins = [];
        $result = 0;

        if ($length >= $minInputLength) {
            for ($i = 0; $i < $length; ++$i) {
                if (
                        count($mins) < $minsMaxLength ||
                        $A[$i] < $A[$mins[$minsMaxLength - 1]]
                ) {
                    for ($j = min(count($mins) - 1, 2); $j >= 0; --$j) {
                        if ($A[$i] >= $A[$mins[$j]]) {
                            break;
                        }

                        $mins[$j + 1] = $mins[$j];
                    }

                    $mins[$j + 1] = $i;
                }
            }

            $result = PHP_INT_MAX;
            $minsLength = count($mins);

            for ($i = 0; $i < $minsLength - 1; ++$i) {
                for ($j = $i + 1; $j < $minsLength; ++$j) {
                    if (abs($mins[$i] - $mins[$j]) > 1) {
                        $sum = $A[$mins[$i]] + $A[$mins[$j]];
                        $result = $result > $sum ? $sum : $result ;

                        if ($j < $i + 3) {
                            return $result;
                        }

                        break;
                    }
                }
            }
        }

        return $result;
    }
}
