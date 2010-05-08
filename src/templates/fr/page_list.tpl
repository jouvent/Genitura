{% extends 'organisation_base.tpl' %}

{% block content %}
{% if pages %}
  <ul>
  {% for page in pages %}
    <li>
        {{ page.title|safe }} 
        <a href="/page/edit/{{page.slug}}">editer</a>
        {*<a href="/page/del/{{page.slug}}">supprimer</a>*}
    </li>
  {% endfor %}
  </ul>
{% else %}
  pas de page
{% endif %}
{*<p><a href="/page/add" >ajouter un page</a><p>*}
{% endblock %}
