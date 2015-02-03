{% extends 'layouts/index.volt' %}
{% block content %}
<section class='container'>
    <div class='table_form'>
    <h1>Answers</h1>
    {{ get_content() }}
    <table>
        <tr>
            <td>#</td>
            <td>Word</td>
            <td></td>
            <td></td>
        </tr>
        {% for answer in answers.items %}
            <tr>
                <td>{{ answer.id }}</td>
                <td>{{ link_to('answers/edit/' ~ answer.id, answer.word_name | e) }}</td>
                <td>
                    {% if answer.correct == 1 %}
                        Correct
                    {% else %}
                        InCorrect
                    {% endif %}
                </td>
                <td>{{ link_to('answers/delete/' ~ answer.id, 'Delete') }}</td>
            </tr>
        {% endfor %}
    </table>
</div>
</section>
{% endblock %}