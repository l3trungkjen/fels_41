{% extends 'layouts/index.volt' %}
{% block content %}
<div class="main">
<h1>Avatar Upload</h1><br/>
    <hr>
    {{ get_content() }}
    {{ form('', 'method': 'post', 'enctype': 'multipart/form-data', 'id': 'uploadimage') }}
        <div id="image_preview">
            {% if user.avatar != '' %}
                {{ image(user.avatar, 'id': 'previewing', 'class':'avatar') }}
            {% else %}
                {{ image('img/no_image_icon.gif', 'id': 'previewing', 'class':'avatar') }}
            {% endif %}
        </div>
        <div id="selectImage">
            <label>Select Your Image</label><br/>
            {{ hidden_field('id', 'value': user.id) }}
            {{ file_field('file') }}
            {{ submit_button('Upload', 'class': 'submit') }}
        </div>
    {{ endform() }}
</div>
<h4 id='loading' style="display:none;position:absolute;top:50px;left:850px;font-size:25px;">loading...</h4>
<div id="message">
</div>
<script type="text/javascript">
    $(function() {
        $.fn.userAvatar.init();
    });
</script>
{% endblock %}