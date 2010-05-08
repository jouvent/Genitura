{% extends 'organisation_base.tpl'%}
{% block content %}
<h3>Guests List for group {{group.name}}</h3>
{% include 'snipp/user_list.tpl' %}
{% endblock %}
