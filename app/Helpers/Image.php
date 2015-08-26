<?php
namespace MattMVC\Helpers;

class Image {
  public static function viewSqlBlobAsImg($blob)
  {
    return "data:image/jpeg;base64,$blob";
  }
}
