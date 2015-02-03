<html>
<head>
    <meta charset="UTF-8">
    <title>Fels Demo</title>
    {% block css %}
        {{ stylesheet_link('css/style.css') }}
    {% endblock %}
</head>
<body>
    <div class="page">
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