{% extends 'layouts/index.volt' %}
{% block content %}
<div class="apps">
    <div>
        <h2>All Users</h2>
        <div>
            border
        </div>
    </div>
    <ul id="friends">
        {% for user in users.items %}
            <li class="list_icon">
                <a href="#">
                    {% if user.avatar != '' %}
                        {{ image(user.avatar, 'class': 'icons') }}
                    {% else %}
                        {{ image('img/no_image_icon.gif', 'class': 'icons') }}
                    {% endif %}
                </a>
                <a href="javascript:void(0)" for-id="{{ user.id }}">
                    {% if userFriend(user.id) > 0 %}
                        UnFollow
                    {% else %}
                        Follow
                    {% endif %}
                </a>
            </li>
        {% endfor %}
    </ul>
</div>
<script type="text/javascript">
    $(function() {
        $.fn.userFollow.init();
    });
</script>
{% endblock %}