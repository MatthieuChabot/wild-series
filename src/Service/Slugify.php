<?php

namespace App\Service;

class Slugify
{
    public function generate(string $input, string $divider = '-')
    {
        $input = str_replace(' ', $divider, $input);

        $input = preg_replace('~[^\pL\d]+~u', $divider, $input);

        $input = preg_replace('~[^-\w]+~', '', $input);

        $input = iconv('utf-8', 'us-ascii//TRANSLIT', $input);

        $input = trim($input, $divider);

        $input = preg_replace('~-+~', $divider, $input);

        $input = strtolower($input);


        return $input;
    }
}
