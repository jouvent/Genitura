{% extends 'organisation_base.tpl'%}
{% block content %}
<h3>Liste des Invites du group {{group.name}}</h3>
{% include 'snipp/user_list.tpl' %}
{% endblock %}
