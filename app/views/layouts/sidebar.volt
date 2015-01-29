<div class="sidebar">
    <div id="logo">
        <a href="#">
            {% if user.avatar != NULL %}
                {{ image(user.avatar) }}
            {% else %}
                {{ image("img/no_image_icon.gif") }}
            {% endif %}
        </a>
    </div>
    <br>
    <div class="connect margin_font_text_1">
        {{ user.name | e }}
    </div>
    <div class="connect margin_font_text_2">
        <label>Learned 192 words</label>
    </div>
</div>