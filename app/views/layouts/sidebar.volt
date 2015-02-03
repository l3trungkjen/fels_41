<div class="sidebar">
    <div id="logo">
        <a href="users/avatar">
            {% if user.avatar != NULL %}
                {{ image(user.avatar, 'class': 'avatar') }}
            {% else %}
                {{ image('img/no_image_icon.gif', 'class': 'avatar') }}
            {% endif %}
        </a>
    </div>
    <br>
    <div class="connect margin_font_text_1">
        {{ user.name | e }}
    </div>
    <div class="connect margin_font_text_2">
        <label>Learned {{ learn_total }} words</label>
    </div>
</div>