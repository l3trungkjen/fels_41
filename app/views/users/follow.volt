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