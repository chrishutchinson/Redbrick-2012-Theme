// ajaxLoop.js
jQuery(function($){
    var page = 1;
    var loading = true;
    var $window = $(window);
    var $content = $(".container");
    var load_posts = function(){
            $.ajax({
                type       : "GET",
                data       : {numPosts : 1, pageNumber: page},
                dataType   : "html",
                url        : "http://redbrickpaper.co.uk/new/wp-content/themes/redbrick/loopHandler.php?offset=" + (page * 6) + "&cat=" + category,
                beforeSend : function(){
                    if(page != 1){
                        $content.append('<div id="temp_load" style="text-align:center">\
                            <img src="../images/ajax-loader.gif" />\
                            </div>');
                    }
                },
                success    : function(data){
                    $data = $(data);
                    if($data.length){
                        $data.hide();
                        $content.append($data).masonry( 'appended', $data);
                        $data.fadeIn(500, function(){
                            $("#temp_load").remove();
                            loading = false;
                        });
                    } else {
                        $("#temp_load").remove();
                    }
                },
                error     : function(jqXHR, textStatus, errorThrown) {
                    $("#temp_load").remove();
                    alert(jqXHR + " :: " + textStatus + " :: " + errorThrown);
                }
        });
    }
    $window.scroll(function() {
        var content_offset = $content.offset();
        console.log(content_offset.top);
        if(!loading && ($window.scrollTop() +
            $window.height()) > ($content.scrollTop() + $content.height() + content_offset.top)) {
                loading = true;
                page++;
                load_posts();
        }
    });
    load_posts();
});