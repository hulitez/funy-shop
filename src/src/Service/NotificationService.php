<?php

namespace App\Service;

use App\Entity\Product;
use Psr\Log\LoggerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\NotifierInterface;

class NotificationService
{
    private $mailer;
    private $logger;
    private $notifier;

    /**
     * @var array
     */
    private $config;

    public function __construct(array $config, MailerInterface $mailer, NotifierInterface $notifier, LoggerInterface $logger)
    {
        $this->config = $config;
        $this->mailer = $mailer;
        $this->logger = $logger;
        $this->notifier = $notifier;
    }

    public function sendMail(Product $product)
    {
        $email = (new TemplatedEmail())
            ->from($this->config['from'])
            ->to(new Address($this->config['to']))
            ->subject('There is new one!')
            ->htmlTemplate('emails/new.product.html.twig')
            ->context([
                'product' => $product,
            ]);

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
            $this->logger->error('Something went wrong with sending email', ['message' => $e->getMessage()]);
        }
    }

    public function sendSlackMessage(Product $product)
    {
        $notification = (new Notification('There is new product in funy-shop'))
            ->content(sprintf(
                'Product name: %s%s Description: %s%s Price: %s%s',
                $product->getName(), PHP_EOL,
                $product->getDescription(), PHP_EOL,
                $product->getPrice(), $product->getCurrency()
            ))
            ->importance(Notification::IMPORTANCE_URGENT);

        $this->notifier->send($notification);
    }
}
