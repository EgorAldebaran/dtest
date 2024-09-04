<?php

namespace Dtest;

class CasualModel
{
    protected ?array $baseGroup = [];
    protected ?array $g1 = [];
    protected ?array $g2 = [];
    public ?int $iterations = null;
    private ?int $sameGroupCount = null;

    public function __construct(?int $rangeMax)
    {
        if ($rangeMax == NULL) {
            throw new \Exception("укажите максимальное значения для предела в базовой группе.");
        }
        
        $this->baseGroup = range(1, $rangeMax);
        $this->g1 = [];
        $this->g2 = [];
    }

    private function setIteragions(?int $iterations)
    {
        if ($iterations == NULL) {
            throw new \Exception("установи число итераций\n");
        }
        $this->iterations = $iterations;
        return $this;
    }

    /**
     * Основной метод запускающий моделирование ситуации
     * @param $iterations 
     * @var $sameGroupCount;
     */
    public function run(?int $iterations)
    {
        $sameGroupCount = null;
        $this->setIteragions($iterations);
        $this->baseGroup = range(1, $this->iterations);
        for ($i = 0; $i < $this->iterations; $i++) {
            shuffle($this->baseGroup);

            foreach ($this->baseGroup as $value) {
                /// случайный образ выбора добавления элемента в массив
                if (rand(0, 1) === 0) {
                    $this->g1[] = $value;
                } else {
                    $this->g2[] = $value;
                }
            }

            /// проверка попадания в группу 19 and 20
            if ((in_array(19, $this->g1) && in_array(20, $this->g1)) || (in_array(19, $this->g2) && in_array(20, $this->g2))) {
                $this->sameGroupCount++;
            }
        }
        return $this;
    }

     public function prettyLook()
    {
        $percentage = ($this->sameGroupCount / $this->iterations) * 100;

        echo "Результаты моделирования:\n";
        echo "---------------------------------\n";
        echo "Всего итераций: {$this->iterations}\n";
        echo "Числа 19 и 20 оказались в одной группе в {$this->sameGroupCount} случаях.\n";
        echo "Процент случаев: " . number_format($percentage, 2) . "%\n";
        echo "---------------------------------\n";
    }
}
