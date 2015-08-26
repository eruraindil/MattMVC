<?php
namespace MattMVC\Helpers;

class DateTime extends \DateTime
{
  public function __construct($time = "now", DateTimeZone $timezone = NULL)
  {
    parent::__construct($time,$timezone);
  }

  /*
   * from https://stackoverflow.com/questions/2690504/php-producing-relative-date-time-from-timestamps
   */
  public function relativeFormat()
  {
    $ts = $this->getTimestamp();

    $diff = time() - $ts;
    if($diff == 0) {
      return 'now';
    } elseif($diff > 0) {
      $day_diff = floor($diff / 86400);
      if($day_diff == 0) {
        if($diff < 60) return 'just now';
        if($diff < 120) return '1 minute ago';
        if($diff < 3600) return floor($diff / 60) . ' minutes ago';
        if($diff < 7200) return '1 hour ago';
        if($diff < 86400) return floor($diff / 3600) . ' hours ago';
      }
      if($day_diff == 1) return 'Yesterday';
      if($day_diff < 7) return $day_diff . ' days ago';
      if($day_diff < 31) return ceil($day_diff / 7) . ' weeks ago';
      if($day_diff < 60) return 'last month';
      return date('F Y', $ts);
    }
  }

  public function isOlderThanOneYear()
  {
    return $this->diff(new DateTime("yesterday"))->days > 365;
  }

  public static function formatForSite($timestamp)
  {
    $ts = new self();
    $ts->setTimestamp($timestamp);
    if($ts->isOlderThanOneYear()) {
      return $ts->format("F j, Y, g:i a");
    } else {
      return $ts->relativeFormat();
    }
  }

  public static function formatPercise($timestamp)
  {
    $ts = new self();
    $ts->setTimestamp($timestamp);
    return $ts->format("F j, Y, g:i a");
  }
}
