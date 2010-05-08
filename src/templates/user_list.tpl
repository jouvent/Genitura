{% extends 'base.html' %}

{% block body %}
{% if users %}
  <ul>
  {% for user in users %}
    <li>{{ user.username }} <a href="/admin/user/edit/{{user.id}}">editer</a> <a href="/admin/user/del/{{user.id}}">supprimer</a></li>
  {% endfor %}
  </ul>
{% else %}
  pas de user
{% endif %}
<p><a href="/admin/user/add" >ajouter un user</a><p>
{% endblock %}
