<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some de these rules have multiple versions such
    | as the size rules. Feel free to tweak each de these messages here.
    |
    */

    'accepted' => 'El :attribute debe ser aceptado.',
    'active_url' => 'El :attribute no es una URL válida.',
    'after' => 'El :attribute debe ser una fecha posterior :date.',
    'after_or_equal' => 'El :attribute debe ser una fecha posterior o igual a :date.',
    'alpha' => 'El :attribute solo debe contener letras.',
    'alpha_dash' => 'El :attribute solo debe contener letras, números, guiones y guiones bajos.',
    'alpha_num' => 'El :attribute solo debe contener letras y números.',
    'array' => 'El :attribute debe ser una matriz.',
    'before' => 'El :attribute debe ser una fecha antes :date.',
    'before_or_equal' => 'El :attribute debe ser una fecha anterior o igual a :date.',
    'between' => [
        'numeric' => 'El :attribute debe estar entre :min y :max.',
        'file' => 'El :attribute debe estar entre :min y :max kilobytes.',
        'string' => 'El :attribute debe estar entre :min y :max caracteres.',
        'array' => 'El :attribute debe tener entre :min y :max elementos.',
    ],
    'boolean' => 'El :attribute debe ser verdadero o falso.',
    'confirmed' => 'El :attribute la confirmación no coincide.',
    'date' => 'El :attribute no es una fecha válida.',
    'date_equals' => 'El :attribute debe ser una fecha igual a :date.',
    'date_format' => 'El :attribute no coincide con el formato :format.',
    'different' => 'El :attribute y :other debe ser diferente.',
    'digits' => 'El :attribute debe ser :digits dígitos.',
    'digits_between' => 'El :attribute debe estar entre :min y :max dígitos.',
    'dimensions' => 'El :attribute tiene dimensiones de imagen no válidas.',
    'distinct' => 'El :attribute tiene un valor duplicado.',
    'email' => 'El :attribute debe ser una dirección de correo electrónico válida.',
    'ends_with' => 'El :attribute debe terminar con uno de los siguientes: :values.',
    'exists' => 'El :attribute seleccionado es inválido.',
    'file' => 'El :attribute debe ser un archivo.',
    'filled' => 'El :attribute debe tener un valor.',
    'gt' => [
        'numeric' => 'El :attribute debe ser mas grande que :value.',
        'file' => 'El :attribute debe ser mas grande que :value kilobytes.',
        'string' => 'El :attribute debe ser mas grande que :value caracteres.',
        'array' => 'El :attribute debe tener más de :value elementos.',
    ],
    'gte' => [
        'numeric' => 'El :attribute debe ser mas grande que o igual :value.',
        'file' => 'El :attribute debe ser mas grande que o igual :value kilobytes.',
        'string' => 'El :attribute debe ser mas grande que o igual :value caracteres.',
        'array' => 'El :attribute debe ser :value elementos ó más.',
    ],
    'image' => 'El :attribute debe ser una image.',
    'in' => 'El selected :attribute es invalido.',
    'in_array' => 'El :attribute no existe en :other.',
    'integer' => 'El :attribute debe ser an integer.',
    'ip' => 'El :attribute debe ser a valido IP dirección.',
    'ipv4' => 'El :attribute debe ser a valido IPv4 dirección.',
    'ipv6' => 'El :attribute debe ser a valido IPv6 dirección.',
    'json' => 'El :attribute debe ser a valido JSON texto.',
    'lt' => [
        'numeric' => 'El :attribute debe ser menos que :value.',
        'file' => 'El :attribute debe ser menos que :value kilobytes.',
        'string' => 'El :attribute debe ser menos que :value caracteres.',
        'array' => 'El :attribute debe ser menos que :value elementos.',
    ],
    'lte' => [
        'numeric' => 'El :attribute debe ser menos que o igual :value.',
        'file' => 'El :attribute debe ser menos que o igual :value kilobytes.',
        'string' => 'El :attribute debe ser menos que o igual :value caracteres.',
        'array' => 'El :attribute no debe tener más de :value elementos.',
    ],
    'max' => [
        'numeric' => 'El :attribute no debe ser mas grande que :max.',
        'file' => 'El :attribute no debe ser mas grande que :max kilobytes.',
        'string' => 'El :attribute no debe ser mas grande que :max caracteres.',
        'array' => 'El :attribute no debe tener más de :max elementos.',
    ],
    'mimes' => 'El :attribute debe ser un archivo de type: :values.',
    'mimetypes' => 'El :attribute debe ser un archivo de type: :values.',
    'min' => [
        'numeric' => 'El :attribute debe ser at least :min.',
        'file' => 'El :attribute debe ser at least :min kilobytes.',
        'string' => 'El :attribute debe ser at least :min caracteres.',
        'array' => 'El :attribute debe ser at least :min elementos.',
    ],
    'multiple_of' => 'El :attribute debe ser un multiple de :value.',
    'not_in' => 'El selected :attribute es invalido.',
    'not_regex' => 'El :attribute format es invalido.',
    'numeric' => 'El :attribute debe ser un número.',
    'password' => 'La contraseña en incorrecta.',
    'present' => 'El :attribute campo debe ser presente.',
    'regex' => 'El :attribute format es invalido.',
    'required' => 'El campo de :attribute es requerido.',
    'required_if' => 'El :attribute es obligatorio cuando :other es :value.',
    'required_unless' => 'El :attribute es obligatorio a menos que :other es en :values.',
    'required_with' => 'El :attribute es obligatorio cuando :values is present.',
    'required_with_all' => 'El :attribute es obligatorio cuando :values esta presente.',
    'required_without' => 'El :attribute es obligatorio cuando :values no esta presente.',
    'required_without_all' => 'El :attribute es obligatorio cuando ninguno de :values esta presente.',
    'prohibited' => 'El :attribute está prohibido.',
    'prohibited_if' => 'El :attribute está prohibido cuando :other es :value.',
    'prohibited_unless' => 'El :attribute está prohibido a menos :other es en :values.',
    'same' => 'El :attribute y :other debe coincidir con.',
    'size' => [
        'numeric' => 'El :attribute debe ser :size.',
        'file' => 'El :attribute debe ser :size kilobytes.',
        'string' => 'El :attribute debe ser :size caracteres.',
        'array' => 'El :attribute debe contener :size elementos.',
    ],
    'starts_with' => 'El :attribute debe comenzar con uno de los siguientes: :values.',
    'string' => 'El :attribute debe ser un texto.',
    'timezone' => 'El :attribute debe ser un valido zona.',
    'unique' => 'El :attribute ya se encuentra registrado.',
    'uploaded' => 'El :attribute no se pudo cargar.',
    'url' => 'El :attribute format es invalido.',
    'uuid' => 'El :attribute debe ser un valido UUID.',

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
        'client' => [
            'required' => 'El Número de cliente es obligatorio',
        ],
        'client_number' => [
            'required' => 'El Número de cliente es obligatorio',
        ],
        'firstname' => [
            'required' => 'El Nombre es obligatorio',
        ],
        'name' => [
            'required' => 'El Nombre es obligatorio',
        ],
        'brand' => [
            'required' => 'La Marca es obligatoria',
        ],
        'discount' => [
            'required' => 'El Descuento es obligatorio',
        ],
        'division' => [
            'required' => 'La División es obligatoria',
        ],
        'material' => [
            'required' => 'El Material es obligatorio',
        ],
        'email' => [
            'required' => 'El Email es obligatorio',
            'unique' => 'El Email ya se encuentra registrado',
            'email' => 'El Email tiene un formato invalido',
        ],
        'firstname' => [
            'required' => 'El Nombre es obligatorio',
            'min' => 'El Nombre debe contener al menos 3 caracteres',
        ],
        'password' => [
            'required' => 'La Contraseña es obligatoria',
            'confirmed' => 'La Contraseña debe ser confirmada',
            'min' => 'La Contraseña debe contener al menos 6 caracteres',
        ],
        'token' => [
            'required' => 'El Token es obligatorio',
        ],
        'material' => [
            'required' => 'El Material es obligatorio',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail dirección" instead
    | de "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
