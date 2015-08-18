<?php

namespace Country\InputFilter;


use Zend\InputFilter\InputFilter;

class CountryInputFilter extends InputFilter
{

    /**
     * Constructor
     *
     */
    public function __construct()
    {
        $this->add(
            [
                'name' => 'id',
                'required' => false,
                'filters' => [
                    [
                        'name' => 'Digits'
                    ],
                ],
            ]
        );
        $this->add(
            [
                'name' => 'name',
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ]
        );
        $this->add(
            [
                'name' => 'lc2',
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ]
        );
        $this->add(
            [
                'name' => 'lc3',
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ]
        );
        $this->add(
            [
                'name' => 'created',
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ]
        );
        $this->add(
            [
                'name' => 'modified',
                'filters' => [
                    ['name' => 'StripTags'],
                    ['name' => 'StringTrim'],
                ],
            ]
        );
    }
}
