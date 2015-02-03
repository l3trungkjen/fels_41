{% block content %}
<div class="article" style="width: 100%">
    <span class="float_right">{{ link_to("#", "Words") }}</span>
    <span class="float_right">{{ link_to("#", "Lessons") }}</span>
</div>
<div class="blog">
    <div>
        <h2>Activities</h2>
        <div>
            border
        </div>
    </div>
    <ul>
        {% for lesson in lessons.items %}
            <li>
                <div>
                    <div>
                        {% if lesson.avatar != '' %}
                            {{ image(lesson.avatar, "alt":"", "class": "icons") }}
                        {% else %}
                            {{ image("img/no_image_icon.gif", "alt":"", "class": "icons") }}
                        {% endif %}
                    </div>
                    <div>
                        <h3>{{ lesson.category_name }} - ( {{ convertDate(lesson.created) }} )</h3>
                    </div>
                </div>
            </li>
        {% endfor %}
    </ul>
</div>
{% endblock %}
