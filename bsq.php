<?php

class Bsq
{
    public $file = [];
    public $height_size = 0;
    public $width_size = 0;
    public $count = 0;
    public $max = 0;

    public function __construct($file)
    {
        $file = file($file, 0);
        $this->height_size = count($file);
        for ($i = 1; $i < $this->height_size; $i++) {
            $arr_str = str_split($file[$i]);
            array_pop($arr_str);
            array_push($this->file, $arr_str);
        }
        $this->width_size = count($arr_str);
    }

    public function get_file_value()
    {
        for ($y = 0; $y < $this->height_size - 1; $y++) {
            for ($x = 0; $x < $this->width_size; $x++) {
                $this->arr_value_to_integer($y, $x);
            }
        }
    }

    public function arr_value_to_integer($y, $x)
    {
        if ($this->file[$y][$x] == '.') {
            $this->file[$y][$x] = 1;
        } else {
            $this->file[$y][$x] = 0;
        }
    }

    public function space()
    {
        for ($y = 0; $y < $this->height_size - 1; $y++) {
            for ($x = 0; $x < $this->width_size; $x++) {
                $this->get_space($y, $x);
            }
        }
        for ($y = 0; $y < $this->height_size - 1; $y++) {
            for ($x = 0; $x < $this->width_size; $x++) {
                $this->get_max($y , $x);
            }
        }
      
    }

    public function get_space($y, $x)
    {
        $count = 0;
        if ($y == 0 || $x == 0) {
            return;
        }

        if ($this->file[$y][$x] == 0) {
            return;
        }

        $a = $this->file[$y - 1][$x];
        $b = $this->file[$y - 1][$x - 1];
        $c = $this->file[$y][$x - 1];

        if ($a != 0) {
            $count++;
        }
        if ($b != 0) {
            $count++;
        }
        if ($c != 0) {
            $count++;
        }
        if ($count == 3) {
            $max = 0;
            $this->file[$y][$x] = $this->file[$y][$x] + 1;
            $this->file[$y][$x - 1] = $this->file[$y][$x - 1] + 1;
            $this->file[$y - 1][$x - 1] = $this->file[$y - 1][$x - 1] + 1;
            $this->file[$y -  1][$x] = $this->file[$y - 1][$x] + 1;
            $a = $this->file[$y - 1][$x];
            $b = $this->file[$y - 1][$x - 1];
            $c = $this->file[$y][$x - 1];
            $d = $this->file[$y][$x];
            $max = max([$a , $b , $c , $d]);
            if($this->max < $max ) {
                $this->max = $max;  
            }
        }
    }

    public function get_max($y , $x)
    {
        if($this->file[$y][$x] == $this->max) {
            
        }
    }

    public function display()
    {
        $arr = [];
        for ($y = 0; $y < $this->height_size - 1; $y++) {
            $value = implode('', $this->file[$y]);
            array_push($arr, $value);
        }
        // $value = implode("\n" ,$arr);
        // echo $value . "\n";
        var_dump($arr);
    }
}

if (isset($argv[1]) && is_file($argv[1])) {

    $bsq = new Bsq($argv[1]);
    $bsq->get_file_value();
    $bsq->space();
    $bsq->display();
}
