{% extends 'layouts/index.volt' %}
{% block content %}
<section class='container'>
    <div class='login'>
    <h1>Create Categories</h1>
        {{ form('category/create', 'method':'post') }}
            {{ get_content() }}
            <p>{{ text_field('name', 'placeholder':'Input name...') }}</p>
            <p class='submit'>{{ submit_button('Create') }}</p>
        {{ endform() }}
    </div>
</section>
{% endblock %}
