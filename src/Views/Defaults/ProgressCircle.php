<?php

namespace Views\Defaults;

use Views\View;

class ProgressCircle extends View
{
    public function __construct(int $progress, int $size, int $strokeWidth=30, float $speed=0.3, string $onclick='')
    {
        $text = $this->build('text')->attr('x', '50%')->attr('y', '50%')->attr('font-size', '65')->attr('text-anchor', 'middle')->attr('dominant-baseline', 'middle')->attr('onclick', $onclick)->content($progress. '%')->create();
        $svg = $this->build('svg')->attr('class', 'circular-progress')->attr('width', $size)->attr('height', $size)->attr('viewBox', '0 0 250 250');
        $circleBg = $this->build('circle')->attr('class', 'bg')->create();
        $circleFg = $this->build('circle')->attr('class', 'fg')->create();
        $svg->content($circleBg.$circleFg.$text);

        $GLOBALS['css'] = 
            '<style>
            .circular-progress text {
                cursor: pointer;
            }

            .circular-progress {
                --size: 250px;
                --half-size: calc(var(--size) / 2);
                --stroke-width: '.$strokeWidth.'px;
                --radius: calc((var(--size) - var(--stroke-width)) / 2);
                --circumference: calc(var(--radius) * pi * 2);
                --dash: calc((var(--progress) * var(--circumference)) / 100);
                animation: progress-animation 0.5s linear 0s 1 forwards;
            }
            
            .circular-progress circle {
                cx: var(--half-size);
                cy: var(--half-size);
                r: var(--radius);
                stroke-width: var(--stroke-width);
                fill: none;
                stroke-linecap: round;
            }
            
            .circular-progress circle.bg {
                stroke: #ddd;
            }
            
            .circular-progress circle.fg {
                transform: rotate(-90deg);
                transform-origin: var(--half-size) var(--half-size);
                stroke-dasharray: var(--dash) calc(var(--circumference) - var(--dash));
                transition: stroke-dasharray '.$speed.'s linear 0s;
                stroke: #5394fd;
            }
            
            @property --progress {
                syntax: "<number>";
                inherits: false;
                initial-value: 0;
            }
            
            @keyframes progress-animation {
                from {
                --progress: 0;
                }
                to {
                --progress: '.$progress.';
                }
            }
            </style>
        ';

        $this->element = $svg->attr('class', 'w3-container w3-cell');
    }

}