<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class JWTSubscriber implements EventSubscriberInterface
{
    public function onLexikJwtAuthenticationOnJwtCreated($event): void
    {
       $data = $event->getData();
       $data['prenom']=$event->getUser()->getPrenom();
       $data['nom']=$event->getUser()->getNom();
       $data['adresse']=$event->getUser()->getAdresse();
       $event->setData($data);

    }

    public static function getSubscribedEvents(): array
    {
        return [
            'lexik_jwt_authentication.on_jwt_created' => 'onLexikJwtAuthenticationOnJwtCreated',
        ];
    }
}
