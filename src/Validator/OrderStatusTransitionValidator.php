<?php

namespace App\Validator;

use App\Entity\Order;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class OrderStatusTransitionValidator extends ConstraintValidator
{
    private const ALLOWED_TRANSITIONS = [
        'new' => ['paid', 'cancelled'],
        'paid' => ['shipped', 'cancelled'],
        'shipped' => ['cancelled'],
        'cancelled' => []
    ];

    public function validate($value, Constraint $constraint): void
    {
        if (!$constraint instanceof OrderStatusTransition) {
            throw new UnexpectedTypeException($constraint, OrderStatusTransition::class);
        }

        if (null === $value || '' === $value) {
            return;
        }

        $order = $this->context->getObject();
        if (!$order instanceof Order) {
            return;
        }

        $oldStatus = $order->getOriginalStatus();
        $newStatus = $value;

        if ($oldStatus === $newStatus) {
            return;
        }

        if (!isset(self::ALLOWED_TRANSITIONS[$oldStatus]) || 
            !in_array($newStatus, self::ALLOWED_TRANSITIONS[$oldStatus])) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ from }}', $oldStatus)
                ->setParameter('{{ to }}', $newStatus)
                ->addViolation();
        }
    }
} 