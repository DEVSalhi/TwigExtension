<?php

namespace App\Twig;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TwigBootstrapExtension extends  AbstractExtension {

    public function getFilters()
    {
        return [
            new TwigFilter('badge',[$this,'badgeFilter'],['is_safe'=>['html']]),
            new TwigFilter('booleanBadge',[$this,'booleanFilter'],['is_safe'=>['html']])
        ];
    }

    public function badgeFilter($content,array $options=[]):string
    {
        $default_option=['color'=>'primary','rounded'=>false];
        $options=array_merge($default_option,$options);
        $color=$options['color'];
        $pill=$options['rounded']?"badge-pill":"";
        return '<span class="badge badge-'.$color.' '.$pill.'">'.$content.'</span>';
    }

    public function booleanFilter(bool $content,array $options=[]) :string {
        $default=[
            'trueText'=>'oui',
            'falseText'=>'Non'
        ];
        $options=array_merge($default,$options);


        if($content){
            return $this->badgeFilter($options['trueText']);
        }else{
            return $this->badgeFilter($options['falseText'],['color'=>'danger']);
        }

    }
}