$.fn.userFollow = {}

$.fn.userFollow.init = ()->
    $ document
        .on 'click', '.list_icon a', $.fn.userFollow.follow

$.fn.userFollow.follow = ()->
    id = $ this
        .attr 'for-id'
    $.ajax
        url: "/fels_41/users/follow/#{id}"
        type: "POST"
        success: (data)->
            $ '#friends'
                .html data