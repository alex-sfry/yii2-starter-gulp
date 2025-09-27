<?php

use Symfony\Component\VarDumper\VarDumper;
use yii\helpers\Html;

/**
 * Html::encode() wrapper
 *
 * @param string $val
 * @param bool $doubleEncode
 * @return string
 */
function e(string $val, bool $doubleEncode = true): string
{
    return Html::encode($val, $doubleEncode);
}

/**
 * VarDumper::dump() wrapper
 *
 * @param mixed $var
 * @param bool $die
 * @return void
 */
function d(mixed $var, bool $die = true): void
{
    VarDumper::dump($var);
    $die && die();
}

/**
 * Wrapper around Url helper
 *
 * @param string|array $url
 * @param bool $scheme
 * @return string
 */
function url(string|array $url = '', bool $scheme = false): string
{
    return \yii\helpers\Url::to($url, $scheme);
}
