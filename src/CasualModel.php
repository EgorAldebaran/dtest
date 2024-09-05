<?php

namespace Dtest;

class CasualModel
{
    const RANGE = 20;
    protected ?array $baseGroup = [];
    protected ?array $g1 = [];
    protected ?array $g2 = [];
    public ?int $iterations = null;
    static $sameGroupCount;

    private function setIterations(?int $iterations)
    {
        if ($iterations == NULL) {
            throw new \Exception("установи число итераций\n");
        }
        $this->iterations = $iterations;
        return $this;
    }

    private function fillGroup()
    {
        foreach ($this->baseGroup as $element) {
            if (rand(0, 1) === 0) {
                $this->g1[] = $element;
            } else {
                $this->g2[] = $element;
            }
        }
    }

    /**
     * Основной метод запускающий моделирование ситуации
     * @param $iterations 
     */
    public function run(?int $iterations)
    {
        $countSameGroup = 0;
        $this->setIterations($iterations);
        $this->baseGroup = range(1, self::RANGE);

        for ($i = 0; $i < $this->iterations; $i++) {
            
            $this->g1 = [];
            $this->g2 = [];
            $this->fillGroup($this->g1, $this->g2, $this->baseGroup);

            $is19inGroup1 = in_array(19, $this->g1);
            $is20inGroup1 = in_array(20, $this->g1);
            $is19inGroup2 = in_array(19, $this->g2);
            $is20inGroup2 = in_array(20, $this->g2);

            if (($is19inGroup1 && $is20inGroup1) || ($is19inGroup2 && $is20inGroup2)) {
                $countSameGroup++;
            }

        }
        $probability = ($countSameGroup / $iterations) * 100;
        echo "19 и 20 оказались в одной группе с вероятностью: $probability%\n";
        
    }

}
