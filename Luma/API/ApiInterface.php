<?php

namespace Luma\API;

interface ApiInterface
{
    public static function call(string $url, string $method = 'GET', array $parameters = [], array $headers = []): string;
}