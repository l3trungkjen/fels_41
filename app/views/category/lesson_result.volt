{% extends 'layouts/index.volt' %}
{% block content %}
    <div class="blog">
        {% for word in words %}
            <ul>
                <li>
                    <div>
                        <div>
                        </div>
                        <div class="word_name">
                            {{ word.word_name }}
                        </div>
                        <div class="word_mean">
                            {% if fetchByLessonId(word.word_id) %}
                                {{ fetchByLessonId(word.word_id).word_mean }}
                            {% else %}
                                Not Answer
                            {% endif %}
                        </div>
                        <div class="word_correct">
                            {% if fetchByLessonId(word.word_id) %}
                                {% if fetchByLessonId(word.word_id).correct == 1 %}
                                    Correct
                                {% else %}
                                    Incorrect
                                {% endif %}
                            {% else %}
                                Incorrect
                            {% endif %}
                        </div>
                    </div>
                </li>
            </ul>
        {% endfor %}
    </div>
{% endblock %}