var AppFeed = {
	initFeed: function(){
    this.NewTweet()
    this.ShowTweetFeed()
    this.SearchTweets()
    this.SearchDate()
	},
  NewTweet: function(){
    $("form[name=FormNewTweet]").submit(function(event){
      event.preventDefault()
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../includes/ajax/ajaxTwitter.php',
        data: $('form[name=FormNewTweet]').serialize(),
        success: function(response, xhr, settings){
          if (response.rps) {
            $("#tweetText").val("");
            $(".tweet-cont").html(response.answer);
          }
        },error: function(response, xhr, settings){
          alert("Error");
        }
      });
    });
  },
  ShowTweetFeed: function(){
    $.ajax({
      type: 'POST',
      dataType: 'json',
      url: '../includes/ajax/ajaxTwitter.php',
      data: {"case":"ShowTweetFeed"},
      success: function(response, xhr, settings){
        if (response.rps) {
          $(".tweet-cont").html(response.answer);
        }
      },error: function(response, xhr, settings){
        alert("Error");
      }
    });
  },
  SearchTweets: function(){
    $("#searchTweet").on("keyup change", function(){
      var searchVal = $(this).val();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../includes/ajax/ajaxTwitter.php',
        data: {"case":"SearchTweet", "search":searchVal},
        success: function(response, xhr, settings){
          if (response.rps) {
            $(".tweet-cont").html(response.answer);
          }
        },error: function(response, xhr, settings){
          alert("Error");
        }
      });
    });
  },
  SearchDate: function(){
    $("input[name=dateFilter]").on('dp.change', function(){
      var searchVal = $(this).val();
      $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../includes/ajax/ajaxTwitter.php',
        data: {"case":"SearchDate", "date":searchVal},
        success: function(response, xhr, settings){
          if (response.rps) {
            $(".tweet-cont").html(response.answer);
          }
        },error: function(response, xhr, settings){
          alert("Error");
        }
      });
    });
  }
}