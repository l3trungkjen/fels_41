{% extends 'layouts/login_tmp.volt' %}
{% block content %}
<div class='login'>
    <h1>Register User</h1>
    {{ get_content() }}
    {{ form('users/create', 'method':'post') }}
        <p>{{ text_field('name', 'size':30, 'placeholder':'Input Fullname') }}</p>
        <p>{{ text_field('email', 'size':30, 'placeholder':'Input Email') }}</p>
        <p>{{ password_field('password', 'size':30, 'placeholder':'Input Password') }}</p>
        <p>{{ password_field('re_password', 'size':30, 'placeholder':'Input Re-Password') }}</p>
        <p class='submit'>{{ submit_button('Create', 'name':'create') }}</p>
    {{ endform() }}
</div>
<div class='login-help'>
    {{ link_to('register', 'Click here to login.') }}
</div>
{% endblock %}