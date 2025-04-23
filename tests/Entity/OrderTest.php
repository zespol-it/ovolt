<?php

namespace App\Tests\Entity;

use App\Entity\Order;
use App\Entity\OrderItem;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function testOrderCreation(): void
    {
        $order = new Order();
        
        $this->assertEquals('new', $order->getStatus());
        $this->assertCount(0, $order->getItems());
        $this->assertEquals(0.0, $order->getTotal());
    }

    public function testAddItem(): void
    {
        $order = new Order();
        $item = new OrderItem();
        $item->setProductId('1')
             ->setProductName('Test Product')
             ->setPrice('100.00')
             ->setQuantity(2);

        $order->addItem($item);

        $this->assertCount(1, $order->getItems());
        $this->assertEquals(200.0, $order->getTotal());
    }

    public function testRemoveItem(): void
    {
        $order = new Order();
        $item = new OrderItem();
        $item->setProductId('1')
             ->setProductName('Test Product')
             ->setPrice('100.00')
             ->setQuantity(2);

        $order->addItem($item);
        $order->removeItem($item);

        $this->assertCount(0, $order->getItems());
        $this->assertEquals(0.0, $order->getTotal());
    }
} 