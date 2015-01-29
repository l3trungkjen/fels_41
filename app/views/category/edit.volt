{% extends "layouts/index.volt" %}
{% block content %}
<section class="container">
    <div class="login">
    <h1>Create Categories</h1>
        {{ form("category/update", "method":"post") }}
        	<p>{{ hidden_field("id") }}</p>
            <p>{{ text_field("name", "placeholder":"Input name...") }}</p>
            <p class="submit">{{ submit_button("Save") }}</p>
        {{ endform() }}
    </div>
</section>
{% endblock %}
