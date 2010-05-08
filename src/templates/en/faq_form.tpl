{% extends 'organisation_base.tpl' %}

{% block content %}
{% include 'snipp/message.tpl' %}
    <form method="post" action="" >
    <input type="hidden" name="id" value="{{faq.id}}" /><br />
    <p> Question Fr</p>
    <input type="text" name="question_fr" value="{{faq.question_fr}}" /><br />
    <p> Response Fr</p>
    <textarea name="response_fr" >{{faq.response_fr}}</textarea><br />
    <p> Question En</p>
    <input type="text" name="question_en" value="{{faq.question_en}}" /><br />
    <p> Response En</p>
    <textarea name="response_en" >{{faq.response_en}}</textarea><br />
    <input type="submit" value="Go"/>
    </form>
{% endblock %}
