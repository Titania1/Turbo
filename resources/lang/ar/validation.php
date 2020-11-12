<?php

declare(strict_types=1);

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'        => ':attribute يجب أن يكون مقبولا.',
    'active_url'      => ':attribute ليس عنوان URL صالحًا.',
    'after'           => ':attribute يجب أن يكون تاريخًا بعد :date.',
    'after_or_equal'  => ':attribute يجب أن يكون تاريخًا يساوي أو بعد :date.',
    'alpha'           => ':attribute يجب أن يحتوي على أحرف فقط.',
    'alpha_dash'      => ':attribute يجب أن يحتوي فقط على أحرف وأرقام وشرطات.',
    'alpha_num'       => ':attribute يجب أن يحتوي على أحرف وأرقام فقط.',
    'array'           => ':attribute يجب أن يكون مصفوفة.',
    'before'          => ':attribute يجب أن يكون تاريخًا قبل :date.',
    'before_or_equal' => ':attribute يجب أن يكون تاريخًا يساوي أو قبل :date.',
    'between'         => [
        'numeric' => ':attribute يجب أن يكون بين :min و :max.',
        'file'    => ':attribute يجب أن يكون بين :min و :max كيلوبايت.',
        'string'  => ':attribute يجب أن يكون بين :min و :max حرف.',
        'array'   => ':attribute يجب أن يحتوي بين :min و :max عنصر.',
    ],
    'boolean'        => ':attribute حقل يجب أن يكون صحيح أو خطأ.',
    'confirmed'      => ':attribute التأكيد غير متطابق.',
    'date'           => ':attribute ليس تاريخًا صالحًا.',
    'date_equals'    => ':attribute يجب أن يكون تاريخا يساوي :date.',
    'date_format'    => ':attribute لا يتطابق مع الشكل :format.',
    'different'      => ':attribute و :other يجب أن يكونا مختلفان.',
    'digits'         => ':attribute يجب أن يكون :digits رقم.',
    'digits_between' => ':attribute يجب أن يكون بين :min و :max رقم.',
    'dimensions'     => ':attribute أبعاد الصورة غير صالحة.',
    'distinct'       => ':attribute الحقل له قيمة مكررة.',
    'email'          => ':attribute يجب أن يكون عنوان بريد إلكتروني صالح.',
    'ends_with'      => ':attribute يجب أن ينتهي بإحدى : :values التالية.',
    'exists'         => ':attribute المحدد غير صالح.',
    'file'           => ':attribute يجب أن يكون ملفًا.',
    'filled'         => ':attribute حقل يجب ان تكون له قيمة.',
    'gt'             => [
        'numeric' => ':attribute يجب أن يكون أكبر من :value.',
        'file'    => ':attribute يجب أن يكون أكبر من :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أكبر من :value حرف.',
        'array'   => ':attribute يجب أن يحتوي أكبر من :value عنصر.',
    ],
    'gte' => [
        'numeric' => ':attribute يجب أن يكون أكبر من أو يساوي :value.',
        'file'    => ':attribute يجب أن يكون أكبر من أو يساوي :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أكبر من أو يساوي :value حرف.',
        'array'   => ':attribute يجب أن يحتوي على :value عنصر أو أكثر.',
    ],
    'image'    => ':attribute يجب أن يكون صورة.',
    'in'       => ':attribute المحددة غير صالحة.',
    'in_array' => ':attribute حقل غير موجود في :other.',
    'integer'  => ':attribute يجب أن يكون عددًا صحيحًا.',
    'ip'       => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'ipv4'     => ':attribute يجب أن يكون عنوان IPv4 صالحًا.',
    'ipv6'     => ':attribute يجب أن يكون عنوان IP صالحًا.',
    'json'     => ':attribute يجب أن تكون سلسلة JSON صالحة.',
    'lt'       => [
        'numeric' => ':attribute يجب أن يكون أقل من :value.',
        'file'    => ':attribute يجب أن يكون أقل من :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أقل من :value حرف.',
        'array'   => ':attribute يجب أن يحتوي أقل من :value عنصر.',
    ],
    'lte' => [
        'numeric' => ':attribute يجب أن يكون أصغر من أو يساوي :value.',
        'file'    => ':attribute يجب أن يكون أصغر من أو يساوي :value كيلوبايت.',
        'string'  => ':attribute يجب أن يكون أصغر من أو يساوي :value حرف.',
        'array'   => ':attribute لا يجب أن يحتوي على أكثر من :value عنصر.',
    ],
    'max' => [
        'numeric' => ':attribute لا يمكن أن يكون أكثر من :max.',
        'file'    => ':attribute لا يمكن أن يكون أكثر من :max كيلوبايت.',
        'string'  => ':attribute لا يمكن أن يكون أكثر من :max حرف.',
        'array'   => ':attribute لا يمكن أن يحتوي أكثر من :max عنصر.',
    ],
    'mimes'     => ':attribute يجب أن يكون ملفًا من نوع : :values.',
    'mimetypes' => ':attribute يجب أن يكون ملفًا من نوع : :values.',
    'min'       => [
        'numeric'	=> ':attribute يجب أن يكون على الأقل :min.',
        'file' 		 => ':attribute يجب أن يكون على الأقل :min كيلوبايت.',
        'string'	 => ':attribute يجب أن يكون على الأقل :min حرف.',
        'array'		 => ':attribute يجب أن يحتوي على الأقل :min عنصر.',
    ],
    'not_in' 				           => ':attribute المحدد غير صالح.',
    'not_regex' 			         => ':attribute الشكل غير صالح.',
    'numeric' 				          => ':attribute يجب أن يكون رقما.',
    'password' 				         => 'كلمة المرور غير صحيحة.',
    'present' 				          => ':attribute يجب أن يكون الحقل موجودًا.',
    'regex' 				            => ':attribute الشكل غير صالح.',
    'required' 				         => ':attribute الحقل مطلوب.',
    'required_if' 			       => ':attribute الحقل مطلوب عندما يكون :other هو :value.',
    'required_unless' 		    => ':attribute الحقل مطلوب ما لم يكن :other هو :values.',
    'required_with' 		      => ':attribute الحقل مطلوب عندما يكون :values موجود.',
    'required_with_all' 	   => ':attribute الحقل مطلوب عندما تكون :values موجودة.',
    'required_without' 		   => ':attribute الحقل مطلوب عندما تكون :values غير موجود.',
    'required_without_all' 	=> ':attribute الحقل مطلوب عندما لا تكون أي :values موجودة.',
    'same' 					            => ':attribute و :other يجب أن تتطابق.',
    'size' 					            => [
        'numeric' 	=> ':attribute يجب أن يكون :size.',
        'file' 		  => ':attribute يجب أن يكون :size كيلوبايت.',
        'string' 	 => ':attribute يجب أن يكون :size حرف.',
        'array' 	  => ':attribute يجب أن يحتوي :size عنصر.',
    ],
    'starts_with' 	=> ':attribute يجب أن يبدأ بإحدى القيم التالية : :values.',
    'string' 		    => ':attribute يجب أن يكون سلسلة نصية.',
    'timezone' 		  => ':attribute يجب أن تكون منطقة صالحة.',
    'unique' 		    => ':attribute مستخدم سابقا.',
    'uploaded' 		  => ':attribute فشل التحميل.',
    'url' 			      => ':attribute شكل غير صالح.',
    'uuid' 			     => ':attribute يجب أن يكون UUID صالحًا.',

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
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [],

];
