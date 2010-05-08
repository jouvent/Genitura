{% extends "base.html" %}

{% block body %}
<p>{{error}}</p>
<form action="" method="post" name="login" class="login">
    <p>
    <label>Nom d'usager :</label>
    <input type="text" name="USERNAME" size="20" maxlength= "255">
    </p>
    <p>
    <label>Mot de passe :</label>
    <input type="password" name="PASSWORD" size="20" maxlength= "255">
    </p>
    <p>
    <input type="submit" name="submit" value="Entrer" />
    </p>
    <a href="/forgotpassword">Mot de passe oubli&eacute; ?</a>
</form>
{% endblock %}
