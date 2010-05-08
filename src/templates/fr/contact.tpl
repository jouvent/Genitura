{% extends "base.html" %}

{% block head %}
{% endblock %}

{% block body %}
<h3>Votre chef de bus</h3>
<table>
<tr><td>{{bus_name}}</td><td>{{bus_email}}</td></tr>
</table>
<h3>Votre chef de groupe</h3>
<table>
<tr><td>{{group_name}}</td><td>{{group_email}}</td></tr>
</table>
{% endblock %}