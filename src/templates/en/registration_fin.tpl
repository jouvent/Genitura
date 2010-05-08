{% extends "base.html" %}

{% block head %}
{% endblock %}

{% block body %}
<h3>Your registration is now complete.</h3>
<p> TODO , inserer ici texte explicatif sur le deroulement de l'organisation du diner en Blanc</p>
<h3>Your Bus Chief</h3>
<table>
<tr><td>{{bus_chief.name}}</td><td>{{bus_chief.login_email}}</td></tr>
</table>
<h3>Your Group Chief</h3>
<table>
<tr><td>{{group_chief.name}}</td><td>{{group_chief.login_email}}</td></tr>
</table>
{% endblock %}
