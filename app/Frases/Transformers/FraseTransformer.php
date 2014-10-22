<?php namespace Frases\Transformers;

class FraseTransformer extends Transformer
{

    public function transform($frase)
    {
        return [
            'id' => $frase['id'],
            'autor' => $frase['autor'],
            'texto' => $frase['texto'],
        ];
    }
}