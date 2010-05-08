{% extends 'base.html' %}

{% block title %} {{page.title}} {% endblock %}
{% block body %}
{{page.content | safe }}
{% endblock %}

