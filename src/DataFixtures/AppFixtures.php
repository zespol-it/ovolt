<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $products = [
            ['id' => '1', 'name' => 'Product A', 'price' => '100.00'],
            ['id' => '2', 'name' => 'Product B', 'price' => '50.00'],
            ['id' => '3', 'name' => 'Product C', 'price' => '75.00'],
        ];

        $statuses = ['new', 'paid', 'shipped', 'cancelled'];

        for ($i = 0; $i < 10; $i++) {
            $order = new Order();
            
            // Add 1-3 random products to each order
            $numItems = rand(1, 3);
            for ($j = 0; $j < $numItems; $j++) {
                $product = $products[array_rand($products)];
                $item = new OrderItem();
                $item->setProductId($product['id'])
                     ->setProductName($product['name'])
                     ->setPrice($product['price'])
                     ->setQuantity(rand(1, 5));
                $order->addItem($item);
            }

            // Set random status
            $order->setStatus($statuses[array_rand($statuses)]);
            
            $manager->persist($order);
        }

        $manager->flush();
    }
} 