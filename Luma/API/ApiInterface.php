<?php

namespace Luma\API;

interface ApiInterface
{
    public static function get(string $url, array $parameters = [], array $headers = []): string;
    public static function post(string $url, array $parameters = [], array $headers = []): string;
    public static function put(string $url, array $parameters = [], array $headers = []): string;
    public static function patch(string $url, array $parameters = [], array $headers = []): string;
    public static function delete(string $url, array $parameters = [], array $headers = []): string;
}