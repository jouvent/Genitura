{% extends 'organisation_base.tpl' %}

{% block content %}
{% if pages %}
  <ul>
  {% for page in pages %}
    <li>
        {{ page.title|safe }}
        <a href="/page/edit/{{page.slug}}">edit</a>
        {*<a href="/page/del/{{page.slug}}">delete</a>*}
    </li>
  {% endfor %}
  </ul>
{% else %}
  no page
{% endif %}
{*<p><a href="/page/add" >add a page</a><p>*}
{% endblock %}
