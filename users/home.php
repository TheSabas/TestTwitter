<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Twitter</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 4.5 -->
  <link rel="stylesheet" href="../assets/bootstrap/css/bootstrap.min.css">

  <link rel="stylesheet" href="../assets/css/style.css">

  <link rel="stylesheet" href="../assets/font-awesome/css/font-awesome.min.css">

  <link rel="stylesheet" href="../assets/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css">

</head>
<body>
    <div class="feed-container">
        <div class="card tweet-container">
            <div class="card-body">
                <h3 class="card-title">Twitter Feed</h3>
                <form class="form-inline">
                    <i class="fa fa-search" aria-hidden="true"></i>
                    <input class="form-control form-control-sm ml-3 w-50" type="text" id="searchTweet" name="searchTweet" placeholder="Search"
                    aria-label="Search">
                    <input type='text' class="form-control form-control-sm ml-1 w-20" id='datetimepicker1' name="dateFilter" placeholder="YYYY.MM.DD"/>
                </form>
                <div class="tweet-submit">
                    <form action="" id="FormNewTweet" name="FormNewTweet">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-lg" id="tweetText" name="tweetText" placeholder="What's Happening?" required>
                        </div>
                        <input type="hidden" name="case" value="NewTweet">
                        <button type="submit" class="btn btn-primary" id="btnTweet">Tweet</button>
                    </form>
                </div>
                <div class="tweet-cont">
                    <div class="tweet-box">                                            
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- jQuery 3.5 -->
<script src="../assets/bootstrap/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap 4.5 -->
<script src="../assets/bootstrap/js/bootstrap.min.js"></script>
<script src="../assets/js/appTwitter.js"></script>
<script src="../assets/moment/moment.js"></script>
<script src="../assets/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
    $(document).ready(function(){
        AppFeed.initFeed();   
        $('#datetimepicker1').datetimepicker({ 
            format:'YYYY.MM.DD'
        });
    });
</script>
</body>
</html>
