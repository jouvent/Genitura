{% extends 'base.html' %}

{% block body %}
    <p>{{ message }}</p>
    <form method="post" action="" >
    <input type="hidden" name="id" value="{{tache.id}}" /><br />
    <p> Titre </p>
    <input type="text" name="title" value="{{tache.title}}" /><br />
    <p> Contenus </p>
    <textarea name="content" >{{tache.content}}</textarea><br />
    <label for="close"> Close </label>
    <input type="checkbox" name="close" value="1" {{tache.close | checked}} /><br />
    <input type="submit" value="Go"/>
    </form>
{% endblock %}
