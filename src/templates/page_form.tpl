{% extends 'base.html' %}

{% block body %}
    <p>{{ message }}</p>
    <form method="post" action="" >
    <input type="hidden" name="id" value="{{page.id}}" /><br />
    <p> Titre </p>
    <input type="text" name="title" value="{{page.title}}" /><br />
    <p> Contenus </p>
    <textarea name="content" >{{page.content}}</textarea><br />
    <p> Cle </p>
    <input type="text" name="key" value="{{page.key}}" /><br />
    <input type="submit" value="Go"/>
    </form>
{% endblock %}
