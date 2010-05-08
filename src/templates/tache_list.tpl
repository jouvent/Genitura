{% extends 'base.html' %}

{% block body %}
{% if taches %}
  <ul>
  {% for tache in taches %}
    <li>{{ tache.title }} <a href="/admin/tache/edit/{{tache.id}}">editer</a> <a href="/admin/tache/toggle/{{tache.id}}">clore</a></li>
  {% endfor %}
  </ul>
{% else %}
  pas de tache
{% endif %}
<p><a href="/admin/tache/add" >ajouter un tache</a><p>
{% endblock %}
