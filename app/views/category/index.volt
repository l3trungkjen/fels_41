{% extends 'layouts/index.volt' %}
{% block content %}
    <div class="article" style="width: 100%">
        <span class="float_right">{{ link_to("#", "Categories") }}</span>
    </div>
    {{ get_content() }}
    {% for category in categories.items %}
        <div class="blog">
            <div>
                <h2>{{ category.name }} : </h2>
                <span class="lear_result">
                    You've learned {{ userLearnWords(category.id) }}/{{ wordsByCategoryId(category.id) }}
                </span>
            </div>
            <ul>
                <li>
                    <div>
                        <div>
                        </div>
                        <div>
                            <h3>Ring-a-posers</h3>
                        </div>
                    </div>
                </li>
                <li class="button">
                    <div>{{ link_to('category/lesson/' ~ category.id, 'Start') }}</div>
                </li>
            </ul>
        </div>
    {% endfor %}
{% endblock %}
