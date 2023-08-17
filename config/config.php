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
        'field' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm block mt-1 w-full',
        'form_error' => 'mb-4 font-bold text-white bg-red-800 p-3 rounded-md',
        'group' => 'mb-4',
        'label' => 'block font-medium text-sm text-gray-700 dark:text-white',
        'required' => 'text-red-800',
    ],
];
