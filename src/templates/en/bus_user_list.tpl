{% extends 'organisation_base.tpl'%}
{% block content %}
<h3>Guests list for bus {{bus.name}}</h3>
{% include 'snipp/user_list.tpl' %}
{% endblock %}
