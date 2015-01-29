{% extends "layouts/login_tmp.volt" %}
{% block content %}
<div class="login">
    <h1>Login to Web App</h1>
    {{ get_content() }}
    {{ form("login", "method":"post") }}
        <p>{{ text_field("email", "placeholder":"Input Email...") }}</p>
        <p>{{ password_field("password", "placeholder":"Input Password...") }}</p>
        <p class="submit">{{ submit_button("Login") }}</p>
    {{ endform() }}
</div>
<div class="login-help">
    {{ link_to("register", "Click here to register.") }}
</div>
{% endblock %}