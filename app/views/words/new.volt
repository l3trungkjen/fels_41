{% extends 'layouts/index.volt' %}
{% block content %}
<section class="container">
    <div class="login">
    <h1>Create Words</h1>
        {{ form('words/create', 'method':'post') }}
            {{ get_content() }}
            <p>{{ text_field('name', 'placeholder':'Input word...') }}</p>
            <p>{{ text_field('mean', 'placeholder':'Input mean...') }}</p>
            <p>{{ categories }}</p>
            <p class="submit">{{ submit_button('Create') }}</p>
        {{ endform() }}
    </div>
</section>
{% endblock %}
