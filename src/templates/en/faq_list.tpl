{% extends 'organisation_base.tpl' %}

{% block content %}
{% if faqs.size %}
  <ul>
  {% for faq in faqs %}
    <li>
        {{ faq.question|safe }}
        <a href="/faq/edit/{{faq.id}}">edit</a>
        {*<a href="/faq/del/{{faq.id}}">delete</a>*}
    </li>
  {% endfor %}
  </ul>
{% else %}
  no FAQ
{% endif %}
<p><a href="/faq/add" >add a FAQ</a><p>
{% endblock %}
