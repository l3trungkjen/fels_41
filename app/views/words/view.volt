{% extends 'layouts/index.volt' %}
{% block content %}
<section class="container">
    <div class="table_form">
        <h1>Words</h1>
        {{ get_content() }}
        <span>{{ link_to('words/new', 'Add new') }}</span>
        <table>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Mean</td>
                <td>Categories</td>
                {% if user_id != '' %}
                    <td></td>
                {% endif %}
            </tr>
            {% for word in words.items %}
                <tr>
                    <td>{{ word.id }}</td>
                    <td width="50%">{{ link_to('words/edit/' ~ word.id, word.name | e) }}</td>
                    <td>{{ word.mean }}</td>
                    <td>{{ word.cate_name }}</td>
                    {% if permission(user_id) %}
                        <td>{{ link_to('words/delete/' ~ word.id, 'Delete') }}</td>
                    {% endif %}
                </tr>
            {% endfor %}
        </table>
    </div>
</section>
{% endblock %}