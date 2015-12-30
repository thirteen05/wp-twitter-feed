           <div class="tweet-list">
             <div class="container">
                <div class="row tweet-row">
                  
                  <?php $twitterData = get_twitter1305(); ?>

                  <?php $tweet_number = 0; ?>
                 
                  <?php if(!empty($twitterData)): ?>
                  
                    <?php foreach($twitterData as $tweet):
                            $tweet_number++;
                            $tweetText = $tweet->text;
                            $tweetText = linkify_tweet($tweetText);
                            $tweetTime = date("l, F j",strtotime($tweet->created_at));
                    ?>

                      <div class="tweet-wrapper col-md-4" id="twitter-column-<?php echo $tweet_number; ?>">
                          <div class="tweet-thumb">
                            <span class="had-thumb"><a href="<?php echo $tweet->user->url; ?>" title="<?php echo $tweet->user->name; ?>"><img alt="" src="<?php echo $tweet->user->profile_image_url; ?>"></a></span>
                            <h5 class="font-white tweeter-name"><?php echo $tweet->user->name; ?></h5>
                          </div>
                          <div class="tweet-content">
                              <h4 class="title font-white" title="<?php echo $tweet->text; ?>"><?php echo $tweetText; ?></h4>
                          </div>
                        <div class="tweet-meta">
                          <p class="meta font-white"><?php echo $tweetTime; ?></p>
                        </div>
                      </div>
                  
                      <?php if(in_array($tweet_number, array(3,6,9,12,15,18,21,24))): ?>
               </div>
               <div class="row tweet-row">
                  
                      <?php endif; ?>

                    <?php endforeach; ?>
                    
                  </div>

                  <?php else: ?>
                    <li class="tweet-wrapper">Tweets not found for the given username.</li>
                  <?php endif; ?>
             </div>
           </div>
      
      ?>