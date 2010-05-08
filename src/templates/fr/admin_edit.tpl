{% extends "organisation_base.tpl" %}

{% block content %}

<h3>Modifer l'Organisateur: {{user.name}}</h3>
{% include 'snipp/message.tpl' %}
<form method="post" action="">
<h3>Informations de contact</h3>
    {% include 'snipp/user_fields.tpl' %}

    <p><input type="submit" value="Enregistrer" /></p>
</form>

{% endblock %}
