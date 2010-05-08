{% extends "base.html" %}

{% block body %}
<p>{{error}}</p>
<form action="" method="post" name="login" class="login">
    <p>
    <label>Email :</label>
    <input type="text" name="USERNAME" size="20" maxlength= "255">
    </p>
    <p>
    <label>Password :</label>
    <input type="password" name="PASSWORD" size="20" maxlength= "255">
    </p>
    <p>
    <input type="submit" name="submit" value="Entrer" />
    </p>
    <a href="/forgotpassword">Forgot password ?</a>
</form>
{% endblock %}
