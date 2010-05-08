{% extends 'base.html' %}

{% block body %}
<dl>
{% for faq in faqs %}
<dt>{{faq.question}}</dt>
<dd>{{faq.response}}</dd>
{% endfor %}
</dl>
{% endblock %}
