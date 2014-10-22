<?php namespace Frases\Transformers;


abstract class Transformer {

    public function transformCollection(array $items, $method = 'transform')
    {
        return array_map([$this,$method], $items);
    }

    public abstract function transform($item);
} 