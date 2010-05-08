{% extends "organisation_base.tpl" %}

{% block content %}
<h3>Ecrire a {{user.name}} ( {{credit}} ) </h3>

<form name="email_user" id="email_user" method="post" action="">

    <p><label for="subject">Sujet :</label><input type="text" id="subject" name="subject" /></p>
    <p><label for="body">Message :</label><textarea id="body" name="body" ></textarea></p>
    <p><input type="submit" id="send" name="send" value="Envoyer" /></p>

</form>

{% endblock %}
