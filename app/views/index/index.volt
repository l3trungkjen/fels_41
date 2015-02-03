{% block content %}
<div class="article" style="width: 100%">
    <span class="float_right">{{ link_to("#", "Words") }}</span>
    <span class="float_right">{{ link_to("#", "Lessons") }}</span>
</div>
<div class="blog">
    <div class="date">
        <span>08-10</span>
        <span>2011</span>
    </div>
    <div>
        <h2>Newest applications</h2>
        <div>
            border
        </div>
    </div>
    <ul>
        <li>
            <div>
                <div>
                    {{ image("img/ring-a-posers.jpg", "alt":"") }}
                </div>
                <div>
                    <h3>Ring-a-posers</h3>
                </div>
            </div>
        </li>
        <li>
            <div>
                <div>
                    {{ image("img/ring-a-posers.jpg", "alt":"") }}
                </div>
                <div>
                    <h3>Ring-a-posers</h3>
                </div>
            </div>
        </li>
    </ul>
    <div class="section">
        {{ link_to("#", "back to top") }}
        {{ link_to("#", "Show All") }}
    </div>
</div>
{% endblock %}
