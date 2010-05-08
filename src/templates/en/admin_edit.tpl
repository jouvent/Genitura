{% extends "organisation_base.tpl" %}

{% block content %}

<h3>Modify Organizer: {{user.name}}</h3>
{% include 'snipp/message.tpl' %}
<form method="post" action="">
<h3>Contact Information</h3>
    {% include 'snipp/user_fields.tpl' %}

    <p><input type="submit" value="Save" /></p>
</form>

{% endblock %}
