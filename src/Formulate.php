<?php

namespace AppKit\Formulate;

use AppKit\Formulate\Components\CheckablesComponent;
use AppKit\Formulate\Components\FieldErrorComponent;
use AppKit\Formulate\Components\FieldGroupComponent;
use AppKit\Formulate\Components\FormComponent;
use AppKit\Formulate\Components\InputComponent;
use AppKit\Formulate\Components\LabelComponent;
use AppKit\Formulate\Components\OptionComponent;
use AppKit\Formulate\Components\SelectComponent;
use AppKit\Formulate\Components\TextareaComponent;
use Illuminate\Contracts\Container\BindingResolutionException;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Database\Eloquent\Collection as EloquentCollection;
use Illuminate\Database\Eloquent\InvalidCastException;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\LazyLoadingViolationException;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Js;
use Illuminate\View\ComponentAttributeBag;
use LogicException;
use stdClass;

class Formulate
{
    /**
     * The Laravel Application
     * @var mixed|Application
     */
    private $app;

    protected $form;

    /**
     * A collection of fields that are used within the current form
     * @var Collection
     */
    protected $fields;

    /**
     * The form data that is being presented in the current form
     * @var array | Model
     */
    protected $formData;

    /**
     * The current field that is being processed
     * @var InputComponent
     */
    protected $currentField;

    /**
     * The value fo the field that is being processed
     * @var mixed
     */
    protected $currentFieldValue;

    /**
     * Create a new instance of Formulate
     *
     * @return void
     * @throws BindingResolutionException
     */
    public function __construct()
    {
        $this->app = app();
        $this->fields = new Collection();
    }

    public function registerComponents(string $prefix = '')
    {
        // define the blade components that this package exposes
        $components = [
            'checkables' => CheckablesComponent::class,
            'field-errors' => FieldErrorComponent::class,
            'field-group' => FieldGroupComponent::class,
            'form' => FormComponent::class,
            'input' => InputComponent::class,
            'label' => LabelComponent::class,
            'option' => OptionComponent::class,
            'select' => SelectComponent::class,
            'textarea' => TextareaComponent::class,
        ];

        // loop through them
        foreach ($components as $name => $componentClass) {
            // and register them
            Blade::component($componentClass, $name, $prefix);
        }
    }

    public function registerForm($form)
    {
        // store the form instance
        $this->form = $form;

        // reset the fields and form data
        $this->fields = new Collection();
        $this->formData = [];
    }

    /**
     * Populate the form data for the current form
     *
     * @param array|Model $data
     * @return void
     */
    public function populateFormData(array | Model $data)
    {
        $this->formData = $data;
    }

    /**
     * Return the current form data
     *
     * @return array|Model
     */
    public function getFormData()
    {
        return $this->formData;
    }

    /**
     * Add a new field into the collection of form fields
     *
     * @param InputComponent $field
     * @return void
     */
    public function registerField(InputComponent $field)
    {
        $this->fields[] = $field;
    }

    /**
     * Get the collection of form fields
     *
     * @return Collection
     */
    public function getFields()
    {
        return $this->fields;
    }

    /**
     * Get the current field
     *
     */
    public function getCurrentField(): InputComponent
    {
        return $this->currentField;
    }

    /**
     * Get the value of the current field
     *
     * @return mixed
     */
    public function getCurrentFieldValue()
    {
        return $this->currentFieldValue;
    }

    /**
     * Get the value of a particular field in the form
     *
     * @param string $field
     * @param mixed $defaultValue
     * @return mixed
     * @throws InvalidCastException
     * @throws LazyLoadingViolationException
     * @throws LogicException
     */
    public function getFieldValue(string $field, $defaultValue = null)
    {
        // set the current field
        $this->currentField = $field;

        // we will start by assuming that it's the default value
        $value = $defaultValue;

        // if we are an array field, we need to strip off the brackets
        if (str_contains($field, '[]')) {
            $field = str_replace('[]', '', $field);
        }

        // if we have a value in the "old" request, it should come next
        if (!is_null($this->app['request']->old($field))) {
            $value = $this->app['request']->old($field);
        } elseif ($this->formData instanceof Model && !empty($this->formData->getAttribute($field))) {
            // then we try and get the attribute from a model
            $value = $this->formData->getAttribute($field);
        } elseif (is_array($this->formData) && array_key_exists($field, $this->formData)) {
            // or from an array
            $value = $this->formData[$field];
        }

        // if the value is now a collection of models, we need to return the keys
        if ($value instanceof EloquentCollection) {
            $value = $value->modelKeys();
        } elseif ($value instanceof Model) {
            // if the value if a model, we are going to want its key
            $value = $value->getKey();
        }

        // set the current field value
        $this->currentFieldValue = $value;

        // return the value
        return $value;
    }

    /**
     * Generate an ID for a field that does not have one given
     *
     * @param InputComponent $field
     * @return string
     */
    public function generateFieldId(InputComponent $field)
    {
        // get the name
        $name = $field->name;

        // find out how many instances of that name we already have
        $index = $this->fields->where('name', $name)->count();

        // check if this is an array type field based on the name
        $array = false;
        if (str_contains($name, '[]')) {
            $array = true;

            // remove the brackets from the end of the field name
            $name = str_replace('[]', '', $name);
        }

        // if the index is more than one, or if its an array, the name is appended with the index
        if ($index != 1 || $array) {
            return $name . '-' . $index;
        }

        // otherwise, we just use the name
        return $name;
    }

    public function applyDynamicFormAttributes(ComponentAttributeBag $attributes)
    {
        if ($this->form->xData) {
            $xData = [];

            $xData = $this->fields->mapWithKeys(function ($field) {
                return [$field->name => $field->value ?? ''];
            });

            // we need to generate xdata
            $attributes['x-data'] = Js::from($xData, JSON_FORCE_OBJECT);

            // dd($attributes);
        }

        return $attributes;
    }

    /**
     * Get the dynamic name of a component, based on a name
     *
     * @param string $name
     * @return string
     */
    public function getDynamicComponentName(string $name)
    {
        // allow prefixing of components
        $componentPrefix = config('formulate.component_prefix', '');

        if ($componentPrefix && !str_ends_with($componentPrefix, '-')) {
            $componentPrefix = $componentPrefix . '-';
        }

        return $componentPrefix. $name;
    }

    /**
     * Signal that the form label should show optional fields, not required fields
     *
     * @return void
     */
    public function highlightOptionalFields(): void
    {
        config(['formulate.highlight_optional_fields' => true]);
    }

    /**
     * Signal that the form label should show required fields, not optional fields
     *
     * @return void
     */
    public function highlightRequiredFields(): void
    {
        config(['formulate.highlight_optional_fields' => false]);
    }
}
