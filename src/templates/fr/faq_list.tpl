{% extends 'organisation_base.tpl' %}

{% block content %}
{% if faqs.size %}
  <ul>
  {% for faq in faqs %}
    <li>
        {{ faq.question|safe }} 
        <a href="/faq/edit/{{faq.id}}">editer</a>
        {*<a href="/faq/del/{{faq.id}}">supprimer</a>*}
    </li>
  {% endfor %}
  </ul>
{% else %}
  pas de faq
{% endif %}
<p><a href="/faq/add" >ajouter une faq</a><p>
{% endblock %}
