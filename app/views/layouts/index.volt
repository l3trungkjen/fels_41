<html>
<head>
    <meta charset="UTF-8">
    <title>Fels Demo</title>
    {% block css %}
        {{ stylesheet_link('css/style.css') }}
    {% endblock %}
    {% block javascript %}
        {{ javascript_include('js/jquery.min.js') }}
        {{ javascript_include('coffee/user_avatar.js') }}
        {{ javascript_include('coffee/user_follow.js') }}
    {% endblock %}
</head>
<body>
    <div class="page">
        <div style="background-color: #00000;">
            <span class="head_float_right">{{ link_to("users/show_all", "User Show", "class": "zindex") }}</span>
            <span class="head_float_right">{{ link_to("#", "Result", "class": "zindex") }}</span>
            <span class="head_float_right">{{ link_to("#", "Lesson", "class": "zindex") }}</span>
            <span class="head_float_right">{{ link_to("category", "Categories", "class": "zindex") }}</span>
            <span class="head_float_right">{{ link_to("words/view", "Word List", "class": "zindex") }}</span>
            <span class="head_float_right">{{ link_to("index", "Home", "class": "zindex") }}</span>
        </div>
        {% block sidebar %}
            {% if sidebar %}
                {{ partial("layouts/sidebar") }}
            {% endif %}
        {% endblock %}
        <div class="content">
            {% block content %}
                {{ get_content() }}
            {% endblock %}
        </div>
    </div>
</body>
</html>