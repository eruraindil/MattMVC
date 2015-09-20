<?php
namespace MattMVC\Helpers;

class String
{
  /* credit: https://stackoverflow.com/a/14735386 */
  public static function generateRandomString($length = 47) {
    return base64_encode(openssl_random_pseudo_bytes($length));
  }
}
