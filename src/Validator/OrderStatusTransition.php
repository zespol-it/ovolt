<?php

namespace App\Validator;

use Symfony\Component\Validator\Constraint;

#[\Attribute]
class OrderStatusTransition extends Constraint
{
    public string $message = 'Invalid status transition from "{{ from }}" to "{{ to }}".';
} 