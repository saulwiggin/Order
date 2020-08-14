<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Order;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="create_order")
     */
    public function createOrder(): Response
    {
        // you can fetch the EntityManager via $this->getDoctrine()
        // or you can add an argument to the action: createProduct(EntityManagerInterface $entityManager)
        $entityManager = $this->getDoctrine()->getManager();
        $now = new \DateTime("now");

        $order = new Order();
        $order->setSent(false);
        $order->setTotal(110);
        $order->setNotes('This is a concurrent transaction from Erlang');
        $order->setCreatedAt($now);
        $order->setUpdatedAt($now);
        $order->setLocaleCode('EU_DE');
        $order->setTransaction('Order1');
        $order->setProcess('Erlang Transaction');
        $order->setMessage('Parse the incoming transaction, apply business logic and send voucher message');
        $order->setRedis('Update Redis Server for distributed computing');
        $order->setCommited('order has been commited');
        $order->setError('Error has been received. Rollback Order commit') ;
        $order->setSlave('update Redis slave from the master');
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($order);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();

        return new Response('Create new order with id '.$order->getId());
    }
}
