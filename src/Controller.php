<?php

declare(strict_types=1);
namespace App;
require_once("src/View.php");

class Controller {
    const DEFAULT_ACTION = 'list';

    private array $request;
    private View $view;

    public function __construct(array $request) {
        $this->request = $request;
        $this->view = new View;
    }

    public function run() : void {
        //operator ?? - jeśli element (w tym przypadku tablica) istnieje to weź wartość z niego i przypisz do zmiennej / w przeciwnym wypadku przypisz 'list'
        $viewParams = [];

        switch($this->action()) {
            case 'create':
                $page = 'create';
                $created = false;

                $data = $this->getRequestPost();
                //jeśli wchodzimy przez POST to zmieniamy created na true i dopisujemy wartości do tablicy
                if (!empty($data)) {
                    $created = true;
                    $viewParams = [
                        'title' => $data['title'],
                        'description' => $data['description']
                    ];
                }
                //do wartości tablicy created przypisujemy $created
                //jeśli wchodzimy przez 'list' to page ma być 'list'
                $viewParams['created'] = $created;
                break;
            case 'show':
                $viewParams = [
                    'title' => 'Moja notatka',
                    'description' => 'Opis'
                ];
                break;
            default:
                $page = 'list';
                $viewParams['resultList'] = 'wyświetlamy notatki!';
                break;
        }

        $this->view->render($page, $viewParams);
    }

    private function action() : string {
        $data = $this->getRequestGet();
        //jesli istnieje wartość w tablicy pod kluczem action, jesli nie to zwraca DEFAULT_ACTION
        return $data['action'] ?? self::DEFAULT_ACTION;
    }

    private function getRequestGet() : array {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost() : array {
        return $this->request['post'] ?? [];
    }
}
