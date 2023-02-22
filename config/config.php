<?php

/*
 * formulate configuration
 */
return [
    'form_error_message' => 'Whoops! Something went wrong.',

    'component_prefix' => 'formulate',

    'highlight_optional_fields' => false,

    'classes' => [
        'field_error' => 'mt-2 text-red-800 border-red-800',
        'field' => 'rounded-md shadow-sm border-gray-300 focus:border-teal-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 block mt-1 w-full',
        'form_error' => 'mb-4 font-bold text-white bg-red-800 p-3 rounded-md',
        'group' => 'mb-4',
        'label' => 'block font-medium text-sm text-gray-700',
        'required' => 'text-red-800',
    ],
];
