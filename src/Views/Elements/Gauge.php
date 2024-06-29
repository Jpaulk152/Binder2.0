<?php

namespace Views\Elements;

use Views\View;
use \config;

/** https://www.30secondsofcode.org/css/s/circular-progress-bar/ **/

class Gauge extends View
{
    public string $id;
    public int $progress;
    public string $textColor;
    public int $size;
    public int $strokeWidth;
    public float $speed;
    public string $onclick;

    public function __construct(string $id, int $progress, string $textColor='black', array $attributes=[])
    {
        $this->id = $id;
        $this->progress = $progress;
        $this->textColor = $textColor;
        $this->size = 100;
        $this->strokeWidth = 30;
        $this->speed = 0.5;
        $this->attributes = $attributes;


        $text =  new Element('text', $progress.'%', ['x'=>'50%', 'y'=>'50%', 'font-size'=>'65', 'text-anchor'=>'middle', 'dominant-baseline'=>'middle', 'fill'=>$this->textColor]);
        $backgroundCircle = new Element('circle', '', ['class'=>'background']);
        $foregroundCircle = new Element('circle', '', ['class'=>'foreground']);

        parent::__construct($backgroundCircle, $foregroundCircle, $text);

        $this->setTagName('svg');

        $this->addAttributes(['id'=>$this->id, 'class'=>'circular-progress', 'width'=>$this->size, 'viewBox'=>'0 0 250 250']);


        $cssById = '

            #'.$this->id.'
            {
                --size: 250px;
                --half-size: calc(var(--size) / 2);
                --stroke-width: '.$this->strokeWidth.'px;
                --radius: calc((var(--size) - var(--stroke-width)) / 2);
                --circumference: calc(var(--radius) * pi * 2);
                --dash: calc((var(--progress) * var(--circumference)) / 100);
                animation: '.$this->id.'-animation 0.5s linear 0s 1 forwards;
            }

            #'.$this->id.' circle.foreground {
                transform: rotate(-90deg);
                transform-origin: var(--half-size) var(--half-size);
                stroke-dasharray: var(--dash) calc(var(--circumference) - var(--dash));
                transition: stroke-dasharray '.$this->speed.'s linear 0s;
            }


             @keyframes '.$this->id.'-animation {
                from {
                --progress: 0;
                }
                to {
                --progress: '.$this->progress.';
                }
            }
        ';
        
        $css = '
            .circular-progress circle 
            {
                cx: var(--half-size);
                cy: var(--half-size);
                r: var(--radius);
                stroke-width: var(--stroke-width);
                fill: none;
                stroke-linecap: round;
            }

            @property --progress {
                syntax: "<number>";
                inherits: false;
                initial-value: 0;
            }

            .circular-progress circle.background {
                stroke: #ddd;
            }

            .circular-progress circle.foreground {
                /* stroke: #56BCFF; */
                stroke: #7BF558;
                /* stroke: #56BCFF; */
            }
        ';

        config::includes(['stylesheet'=>$cssById], ['stylesheet'=>$css]);
    }


}