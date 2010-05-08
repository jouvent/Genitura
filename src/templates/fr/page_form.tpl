{% extends 'organisation_base.tpl' %}

{% block content %}
{% include 'snipp/message.tpl' %}
    <form method="post" action="" >
    <p> Cle </p>
    <input type="text" name="slug" value="{{page.slug}}" /><br />
    <p> Titre Fr</p>
    <input type="text" name="title_fr" value="{{page.title_fr}}" /><br />
    <p> Contenus Fr</p>
    <textarea name="content_fr" >{{page.content_fr}}</textarea><br />
    <p> Titre En</p>
    <input type="text" name="title_en" value="{{page.title_en}}" /><br />
    <p> Contenus En</p>
    <textarea name="content_en" >{{page.content_en}}</textarea><br />
    <input type="submit" value="Go"/>
    </form>
{% endblock %}
