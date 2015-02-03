$.fn.userAvatar = {}

$.fn.userAvatar.init = ()->
    $ document
        .on 'submit', '#uploadimage', $.fn.userAvatar.uploadFile
    $ document
        .on 'change', '#file', $.fn.userAvatar.changeFile

$.fn.userAvatar.uploadFile = (e)->
    e.preventDefault()
    $.ajax
        url: '/fels_41/users/upload_avatar'
        type: 'POST'
        data: new FormData(this)
        contentType: false
        cache: false
        processData: false
        success: (data)->
            $ '#message'
                .html data

$.fn.userAvatar.changeFile = (e)->
    file = this.files[0]
    image_file = file.type
    match = ['image/jpeg','image/png','image/jpg']
    if !((image_file==match[0]) || (image_file==match[1]) || (image_file==match[2]))
        $ '#previewing' 
            .attr 'src', 'img/no_image_icon.gif'
        $ '#message' 
            .html '<p>Please Select A valid Image File<br>Only jpeg, jpg and png Images type allowed</p>'
        false
    else
        reader = new FileReader()
        reader.onload = $.fn.userAvatar.imageLoad
        reader.readAsDataURL(this.files[0])

$.fn.userAvatar.imageLoad = (e)->
    $ '#file' 
        .css 'color', 'green'
    $ '#image_preview'
        .css 'display', 'block'
    $ '#previewing'
        .attr 'src', e.target.result
    $ '#previewing'
        .attr 'width', '250px'
    $ '#previewing'
        .attr 'height', '230px'
