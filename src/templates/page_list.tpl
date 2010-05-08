{% extends 'base.html' %}

{% block body %}
{% if pages %}
  <ul>
  {% for page in pages %}
    <li>{{ page.title }} <a href="/admin/page/edit/{{page.id}}">editer</a> <a href="/admin/page/del/{{page.id}}">supprimer</a></li>
  {% endfor %}
  </ul>
{% else %}
  pas de page
{% endif %}
<p><a href="/admin/page/add" >ajouter un page</a><p>
{% endblock %}
