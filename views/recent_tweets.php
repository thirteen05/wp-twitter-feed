   <?php
        
        use Abraham\TwitterOAuth\TwitterOAuth;
        //Configuration
        $twitterHandle = get_option('twitterHandle');
        $tweetQuantity = intval( get_option('tweetQuantity') );
        $consumerKey = get_option('twitterAPI');
        $consumerSecret = get_option('twitterSecret');
        $accessToken = "";
        $accessTokenSecret = ""; 

        if($twitterHandle && $consumerKey && $consumerSecret) {
              //Authentication with twitter
              $twitterConnection = new TwitterOAuth(
                  $consumerKey,
                  $consumerSecret,
                  $accessToken,
                  $accessTokenSecret
              );
              //Get user timeline feeds
              $twitterData = $twitterConnection->get(
                  'statuses/user_timeline',
                  array(
                      'screen_name'     => $twitterHandle,
                      'count'           => $tweetQuantity,
                      'exclude_replies' => true,
                      
                  )
              );
?>

           <div class="tweet-list">
             <div class="container">
                <div class="row">

                  <?php $tweet_number = 0; ?>
                 
                  <?php if(!empty($twitterData)): ?>
                    <?php foreach($twitterData as $tweet):
                            $tweet_number++;
                            $latestTweet = $tweet->text;
                            $latestTweet = preg_replace('/http:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">http://$1</a>', $latestTweet);
                            $latestTweet = preg_replace('/https:\/\/([a-z0-9_\.\-\+\&\!\#\~\/\,]+)/i', '<a href="http://$1" target="_blank">https://$1</a>', $latestTweet);
                            $latestTweet = preg_replace('/@([a-z0-9_]+)/i', '<a class="tweet-author" href="http://twitter.com/$1" target="_blank">@$1</a>', $latestTweet);
                            $tweetTime = date("l, F j",strtotime($tweet->created_at));
                    ?>

                      <div class="tweet-wrapper col-md-4" id="twitter-column-<?php echo $tweet_number; ?>">
                          <div class="tweet-thumb">
                            <span class="had-thumb"><a href="<?php echo $tweet->user->url; ?>" title="<?php echo $tweet->user->name; ?>"><img alt="" src="<?php echo $tweet->user->profile_image_url; ?>"></a></span>
                            <h5 class="font-white tweeter-name"><?php echo $tweet->user->name; ?></h5>
                          </div>
                          <div class="tweet-content">
                              <h4 class="title font-white" title="<?php echo $tweet->text; ?>"><?php echo $latestTweet; ?></h4>
                          </div>
                        <div class="tweet-meta">
                          <p class="meta font-white"><?php echo $tweetTime; ?></p>
                        </div>
                      </div>
                  
                      <?php if(in_array($tweet_number, array(3,6,9,12,15,18,21,24))): ?>
               </div>
               <div class="row">
                  
                      <?php endif; ?>

                    <?php endforeach; ?>
                    
                  </div>

                  <?php else: ?>
                    <li class="tweet-wrapper">Tweets not found for the given username.</li>
                  <?php endif; ?>
             </div>
           </div>
        <?php
        }else{
            echo 'Authentication failed, please try again.';
        }
      
      ?>