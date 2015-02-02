{% extends 'layouts/index.volt' %}
{% block content %}
<section class='container'>
    <div class='table_form'>
    <h1>Categories</h1>
    {{ get_content() }}
    <table>
        <tr>
            <td>#</td>
            <td>Name</td>
            <td>Created</td>
            <td></td>
        </tr>
        {% for category in categories.items %}
            <tr>
                <td>{{ category.id }}</td>
                <td width='50%'>{{ link_to('category/edit/' ~ category.id, category.name | e) }}</td>
                <td>{{ category.created }}</td>
                <td>{{ link_to('category/delete/' ~ category.id, 'Delete') }}</td>
            </tr>
        {% endfor %}
    </table>
</div>
</section>
{% endblock %}