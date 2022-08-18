<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | A(O) following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => 'A(O) :attribute deve ser aceitado.',
    'active_url'           => 'A(O) :attribute é not a valid URL.',
    'after'                => 'A(O) :attribute deve ser uma data após :date.',
    'alpha'                => 'A(O) :attribute pode apenas conter letras.',
    'alpha_dash'           => 'A(O) :attribute pode apenas conter letras, números, e traços.',
    'alpha_num'            => 'A(O) :attribute pode apenas conter letras e números.',
    'array'                => 'A(O) :attribute deve ser um array.',
    'before'               => 'A(O) :attribute deve ser uma data antes de :date.',
    'between'              => [
        'numeric' => 'A(O) :attribute deve ser entre :min e :max.',
        'file'    => 'A(O) :attribute deve ser entre :min e :max kilobytes.',
        'string'  => 'A(O) :attribute deve ser entre :min e :max caractéres.',
        'array'   => 'A(O) :attribute deve possuir entre :min e :max itens.',
    ],
    'boolean'              => 'A(O) campo :attribute deve ser verdadeiro ou falso.',
    'confirmed'            => 'A confirmação da senha não confere.',
    'date'                 => 'A(O) :attribute não é uma data válida.',
    'date_format'          => 'A(O) :attribute não obedece o formato :format.',
    'different'            => 'A(O) :attribute e :other devem ser diferentes.',
    'digits'               => 'A(O) :attribute deve possuir :digits digitos.',
    'digits_between'       => 'A(O) :attribute deve ter entre :min e :max digitos.',
    'distinct'             => 'A(O) campo :attribute possui um valor duplicado.',
    'email'                => 'A(O) :attribute deve ser endereço de e-mail válido.',
    'exists'               => 'A(O) :attribute selecionado é inválido.',
    'filled'               => 'A(O) campo :attribute é obrigatório.',
    'image'                => 'A(O) :attribute deve ser uma imagem.',
    'in'                   => 'A(O) :attribute selecionado é inválido.',
    'in_array'             => 'A(O) campo :attribute não existe em :other.',
    'integer'              => 'A(O) :attribute deve ser um inteiro.',
    'ip'                   => 'A(O) :attribute deve ser um endereço de IP válido.',
    'json'                 => 'A(O) :attribute deve ser uma string JSON válida.',
    'max'                  => [
        'numeric' => 'A(O) :attribute não pode ser maior que :max.',
        'file'    => 'A(O) :attribute não pode ser maior que :max kilobytes.',
        'string'  => 'A(O) :attribute não pode ser maior que :max caractéres.',
        'array'   => 'A(O) :attribute não pode possuir mais que :max itens.',
    ],
    'mimes'                => 'A(O) :attribute deve ser um arquivo do tipo: :values.',
    'min'                  => [
        'numeric' => 'A(O) :attribute deve ser no mínimo :min.',
        'file'    => 'A(O) :attribute deve ser no mínimo :min kilobytes.',
        'string'  => 'A(O) :attribute deve ser no mínimo :min caractéres.',
        'array'   => 'A(O) :attribute must have no mínimo :min itens.',
    ],
    'not_in'               => 'A(O) :attribute selecionado é inválido.',
    'numeric'              => 'A(O) :attribute deve ser a number.',
    'present'              => 'A(O) campo :attribute deve ser present.',
    'regex'                => 'A(O) :attribute format é inválido.',
    'required'             => 'Esse campo é obrigatório.',
    'required_if'          => 'A(O) campo :attribute é obrigatório quando :other é :value.',
    'required_unless'      => 'A(O) campo :attribute é obrigatório a não ser que :other esteja em :values.',
    'required_with'        => 'A(O) campo :attribute é obrigatório quando :values está presente.',
    'required_with_all'    => 'A(O) campo :attribute é obrigatório quando :values está presente.',
    'required_without'     => 'A(O) campo :attribute é obrigatório quando :values não está presente.',
    'required_without_all' => 'A(O) campo :attribute é obrigatório quando nenhum de :values está presente.',
    'same'                 => 'A(O) :attribute e :other devem ser iguais.',
    'size'                 => [
        'numeric' => 'A(O) :attribute deve ser :size.',
        'file'    => 'A(O) :attribute deve ser :size kilobytes.',
        'string'  => 'A(O) :attribute deve ser :size caractéres.',
        'array'   => 'A(O) :attribute deve conter :size itens.',
    ],
    'string'               => 'A(O) :attribute deve ser uma string.',
    'timezone'             => 'A(O) :attribute deve ser uma zona válida.',
    'unique'               => 'A(O) :attribute já é utilizado.',
    'url'                  => 'O formator de :attribute é inválido.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | A(O) following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
