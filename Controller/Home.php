<?php

namespace Controller;

class Home
{
    public function get()
    {
        return [1, 2, 3, 4, 5];
    }

    public function post()
    {
        return ['POST', 1, 2, 3, 4, 5];
    }
}
