{% extends "layouts/index.volt" %}
{% block content %}
<section class="container">
    <div class="table_form">
    <h1>Categories</h1>
    <table>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Created</td>
        </tr>
        {% for category in categories.items %}
            <tr>
                <td>{{ category.id }}</td>
                <td width="70%">{{ category.name | e }}</td>
                <td>{{ category.created }}</td>
            </tr>
        {% endfor %}
    </table>
</div>
</section>
{% endblock %}