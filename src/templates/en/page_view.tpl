{% extends 'base.html' %}

{% block title %} {{page.title}} {% endblock %}
{% block body %}
<h3>{{page.title | safe }}</h3>
{{page.content | safe }}
{% endblock %}

