<?php

namespace Views\Defaults;

use Views\View;

class ProgressCircle extends View
{
    public int $progress;
    public int $size;
    public int $strokeWidth;
    public float $speed;
    public string $onclick;

    public function __construct(string $id, int $progress, int $size, int $strokeWidth=30, float $speed=0.3, string $onclick='', array $attributes=[])
    {
        $this->id = $id;
        $this->progress = $progress;
        $this->size = $size;
        $this->strokeWidth = $strokeWidth;
        $this->speed = $speed;
        $this->onclick = $onclick;
        $this->attributes = $attributes;

        $this->createIndicator();
    }


    public function createIndicator()
    {
        $text = $this->build('text')->attr('x', '50%')->attr('y', '50%')->attr('font-size', '65')->attr('text-anchor', 'middle')->attr('dominant-baseline', 'middle')->attr('onclick', $this->onclick)->content($this->progress. '%')->create();
        $svg = $this->build('svg')->attr('class', 'circular-progress')->attr('width', $this->size)->attr('height', $this->size)->attr('viewBox', '0 0 250 250');
        $circleBg = $this->build('circle')->attr('class', 'bg')->create();
        $circleFg = $this->build('circle')->attr('class', 'fg')->create();
        $svg = $svg->content($circleBg.$circleFg.$text)->create();

        parent::__construct($this->id, $svg, $this->attributes);

        $this->bundle['css'] = [

            '.circular-progress text {cursor: pointer;}',

            '#'.$this->id.' .circular-progress 
            {
                --size: 250px;
                --half-size: calc(var(--size) / 2);
                --stroke-width: '.$this->strokeWidth.'px;
                --radius: calc((var(--size) - var(--stroke-width)) / 2);
                --circumference: calc(var(--radius) * pi * 2);
                --dash: calc((var(--progress) * var(--circumference)) / 100);
                animation: '.$this->id.'-animation 0.5s linear 0s 1 forwards;
            }',

            '.circular-progress circle 
            {
                cx: var(--half-size);
                cy: var(--half-size);
                r: var(--radius);
                stroke-width: var(--stroke-width);
                fill: none;
                stroke-linecap: round;
            }',

            '.circular-progress circle.bg {stroke: #ddd;}',

            '#'.$this->id.' .circular-progress circle.fg {
                transform: rotate(-90deg);
                transform-origin: var(--half-size) var(--half-size);
                stroke-dasharray: var(--dash) calc(var(--circumference) - var(--dash));
                transition: stroke-dasharray '.$this->speed.'s linear 0s;
                stroke: #5394fd;
            }',

            '@property --progress {
                syntax: "<number>";
                inherits: false;
                initial-value: 0;
            }',

            ' @keyframes '.$this->id.'-animation {
                from {
                --progress: 0;
                }
                to {
                --progress: '.$this->progress.';
                }
            }'

        ];     
    }
}