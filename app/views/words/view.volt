{% extends 'layouts/index.volt' %}
{% block content %}
<section class="container">
    <div class="table_form">
        <h1>Words</h1>
        {{ get_content() }}
        <table>
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Mean</td>
                <td>Categories</td>
                <td></td>
            </tr>
            {% for word in words.items %}
                <tr>
                    <td>{{ word.id }}</td>
                    <td width="50%">{{ link_to('words/edit/' ~ word.id, word.name | e) }}</td>
                    <td>{{ word.mean }}</td>
                    <td>{{ word.cate_name }}</td>
                    <td>{{ link_to('words/delete/' ~ word.id, 'Delete') }}</td>
                </tr>
            {% endfor %}
        </table>
    </div>
</section>
{% endblock %}