{% extends 'organisation_base.tpl' %}

{% block content %}
{% include 'snipp/message.tpl' %}
    <form method="post" action="" >
    <p> Key </p>
    <input type="text" name="slug" value="{{page.slug}}" /><br />
    <p> Title Fr</p>
    <input type="text" name="title_fr" value="{{page.title_fr}}" /><br />
    <p> Content Fr</p>
    <textarea name="content_fr" >{{page.content_fr}}</textarea><br />
    <p> Title En</p>
    <input type="text" name="title_en" value="{{page.title_en}}" /><br />
    <p> Content En</p>
    <textarea name="content_en" >{{page.content_en}}</textarea><br />
    <input type="submit" value="Save"/>
    </form>
{% endblock %}
