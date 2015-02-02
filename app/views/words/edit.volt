{% extends 'layouts/index.volt' %}
{% block content %}
<section class="container">
    <div class="login">
    <h1>Edit Words</h1>
        {{ form('words/save', 'method':'post') }}
            {{ get_content() }}
            <p>{{ hidden_field('id') }}</p>
            <p>{{ text_field('name', 'placeholder':'Input word...') }}</p>
            <p>{{ text_field('mean', 'placeholder':'Input mean...') }}</p>
            <p>{{ categories }}</p>
            <p class="submit">{{ submit_button('Save') }}</p>
        {{ endform() }}
    </div>
</section>
{% endblock %}
