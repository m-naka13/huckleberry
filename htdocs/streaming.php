<?php
require_once('./lib/Phirehose.php');
require_once('./lib/OauthPhirehose.php');

/**
 * Example of using Phirehose to display a live filtered stream using track words
 */
class FilterTrackConsumer extends OauthPhirehose
{
  /**
   * Enqueue each status
   *
   * @param string $status
   */
  public function enqueueStatus($status)
  {
    /*
     * In this simple example, we will just display to STDOUT rather than enqueue.
     * NOTE: You should NOT be processing tweets at this point in a real application, instead they should be being
     *       enqueued and processed asyncronously from the collection process.
     */
    $data = json_decode($status, true);
    if (is_array($data) && isset($data['user']['screen_name'])) {
      print $data['user']['screen_name'] . ': ' . urldecode($data['text']) . "\n";
    }
  }
}

// The OAuth credentials you received when registering your app at Twitter
define("TWITTER_CONSUMER_KEY", "wrDOpqO4MYzxR3lEohadAZ1NO");
define("TWITTER_CONSUMER_SECRET", "MSyDK50GjonIOSpFJk6x7fh00Enq1sgoxKqFDgXJ5ezWBUKp90");


// The OAuth data for the twitter account
define("OAUTH_TOKEN", "	3323166961-MIyxen0TKfxpAnS3oLw7VwS1H6YO6xsHA3b6PqP");
define("OAUTH_SECRET", "z9WGYT4ehxGWzIP4bK7qObzLVJVAFpnSODcjgu5XsqWl6");

// Start streaming
$sc = new FilterTrackConsumer(OAUTH_TOKEN, OAUTH_SECRET, Phirehose::METHOD_FILTER);
$sc->setTrack(array('amazarashi', 'goodnight'));
$sc->setLang(“ja”);
$sc->consume();
