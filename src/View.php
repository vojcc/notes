<?php

declare(strict_types=1);

namespace App;

class View {
    //public - bo wywoływane z zewnątrz
    public function render(string $page, array $params): void {
        require_once("templates/layout.php");
    }
}

