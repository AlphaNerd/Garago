<?php
use Cake\Event\CakeEventManager;

CakeEventManager::instance()
    ->on(
        'Controller.initialize',
        function (Cake\Event\Event $event) {
            $controller = $event->subject();
            if ($controller->components()->has('RequestHandler')) {
                $controller->RequestHandler->config('viewClassMap.pdf', 'CakePdf.Pdf');
            }
        }
    );
