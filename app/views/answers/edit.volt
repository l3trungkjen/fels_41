{% extends 'layouts/index.volt' %}
{% block content %}
<section class='container'>
    <div class='login'>
    <h1>Edit Answers</h1>
        {{ form('answers/save', 'method':'post') }}
            {{ get_content() }}
            <p>{{ hidden_field('id') }}</p>
            <p>{{ words }}</p>
            <p>{{ text_field('name', 'placeholder': 'Input answer...') }}</p>
            <p>{{ correct }}</p>
            <p class='submit'>{{ submit_button('Create') }}</p>
        {{ endform() }}
    </div>
</section>
{% endblock %}