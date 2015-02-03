<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Login Form</title>
    {% block css %}
        {{ stylesheet_link("css/login.css") }}
        {{ stylesheet_link("css/avatar.css") }}
    {% endblock %}
</head>
<body>
    <section class="container">
        {% block content %}
            {{ get_content() }}
        {% endblock %}
    </section>
</body>
</html>