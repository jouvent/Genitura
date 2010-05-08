{% extends "organisation_base.tpl" %}

{% block content %}
<h3>Email to {{user.name}} ( {{credit}} ) </h3>

<form name="email_user" id="email_user" method="post" action="">

    <p><label for="subject">Subject :</label><input type="text" id="subject" name="subject" /></p>
    <p><label for="body">Message :</label><textarea id="body" name="body" ></textarea></p>
    <p><label for="attachement">Attach a File</label><input type="file" name="attachement" id="attachement" /> </p>
    <p><input type="submit" id="send" name="send" value="Send" /></p>

</form>

{% endblock %}
