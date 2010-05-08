{% extends 'base.html' %}

{% block body %}
    <p>{{ message }}</p>
    <form method="post" action="" >
    <input type="hidden" name="id" value="{{user.id}}" /><br />
    <p> Username </p>
    <input type="text" name="username" value="{{user.username}}" /><br />
    <p> Password </p>
    <input type="text" name="password" value="{{user.password}}" /><br />
    <p> Email </p>
    <input type="text" name="email" value="{{user.email}}" /><br />
    <input type="submit" value="Go"/>
    </form>
{% endblock %}
