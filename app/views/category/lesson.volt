{% extends 'layouts/index.volt' %}
{% block content %}
    <div class="article" style="width: 100%">
        <span class="float_right">{{ link_to("#", "Lesson") }}</span>
    </div>
    {{ form('category/lesson_save', 'method': 'post') }}
    <div class="blog">
        {% for word in words %}
            <div>
                <h2>{{ word.name }}</h2>
            </div>
            <ul>
                <li>
                    <div>
                        <div>
                        </div>
                        <div>
                            {{ hidden_field('word_id', 'value': word.id) }}
                            {{ hidden_field('lesson_id', 'value': lesson_id) }}
                            {% set answer =  answers.fetchByWordId(word.id) %}
                            {% for _answer in answer %}
                                <h3 class="answers">
                                    {{ radio_field('answer[' ~ _answer.word_id ~ ']', 'value':_answer.id) }}
                                    {{ _answer.name }}
                                </h3>
                            {% endfor %}
                        </div>
                    </div>
                </li>
            </ul>
        {% endfor %}
        <div style="text-align: center; width: 100%; margin-top: 10px;">{{ submit_button('Save') }}</div>
    </div>
    {{ endform() }}
{% endblock %}
